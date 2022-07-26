<?php

namespace App\Http\Controllers;

use App\Models\GroupMembers;
use App\Models\Member;
use App\Models\MemberGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use View;

class MemberGroupController extends ApiController
{

    //Member Group Function

    public function ShowMemberGroup()
    {
        $membersGroup = MemberGroup::get();
        return view('MemberGroup.list', compact('membersGroup'));
    }

    public function AddMemberGroup()
    {
        return view('MemberGroup.create');
    }

    public function SaveMemberGroup(Request $request)
    {
        $memberGroup = new MemberGroup();
        $memberGroup->Group_name = $request->name;
        $memberGroup->active = $request->Status;
        $memberGroup->save();
        return view('MemberGroup.create');
    }

    public function DeleteMemberGroup(Request $request)
    {
        MemberGroup::where('Group_id', $request->Group_id)->delete();
        echo json_encode($request->Group_id);
    }

    public function EditMemberGroup($id)
    {
        $membersGroup = MemberGroup::where('Group_id', $id)->first();
        return view('MemberGroup.edit', compact('membersGroup'));
    }

    public function UpdateMemberGroup(Request $request)
    {

        $membersGroup = MemberGroup::where('Group_id', $request->id)->
            update(['Group_name' => $request->name, 'active' => $request->Status]);
        $membersGroup = MemberGroup::where('Group_id', $request->id)->first();
        return redirect()->back()->withSuccess('Successfully Updated!');
    }

    //Members Group Function

    public function SaveSingleGroupMember(Request $request)
    {

        $warn = "";
        $added = "";
        $member_reg_id = Member::where('id', $request->member_id)->pluck('Member_Id');

        foreach ($request->group_multi_id1 as $row2) {
            $count = GroupMembers::where('Group_id', $row2)
                ->where('Member_tbl_id', $request->member_id)
                ->count();
            if ($count > 0) {
                $warn .= $row2 . ",";

            } else if ($count == 0) {
                $GroupMembers = new GroupMembers();
                $GroupMembers->Group_id = $row2;
                $GroupMembers->Member_tbl_id = $request->member_id;
                $GroupMembers->Member_Id = $member_reg_id[0];
                $GroupMembers->active = 'Y';
                $GroupMembers->save();
                $added .= $row2 . ",";
            }
        }
        if ($warn == "") {

            return redirect()->back()->withSuccess('Successfully Updated!');
        } else {
            $warn = explode(',', $warn);
            $warnGrpName = MemberGroup::whereIn('Group_id', $warn)->get();
            $warn = $warnGrpName->implode('Group_name', ', ');
            $added = explode(',', $added);
            $addedGrpName = MemberGroup::whereIn('Group_id', $added)->get();
            $added = $addedGrpName->implode('Group_name', ', ');

            return redirect()->back()->with('warning1', 'Already Exist in ' . $warn)->withSuccess(' Successfully Updated in Group id ' . $added);
        }

    }

    public function SaveMultiGroupMember(Request $request)
    {

        $warn = "";
        $added = "";
        $invalid = "";
        foreach (explode(',', $request->multi_member_id) as $row) {
            if ($row != "") {
                $member_reg = Member::where('Mobile_No', $row)->first();
                if ($member_reg == null) {
                    $invalid .= $row . " is Invalid, ";
                } else {
                    foreach ($request->group_multi_id as $row2) {
                        $count = GroupMembers::where('Group_id', $row2)
                            ->where('Member_tbl_id', $member_reg->id)->count();
                        $grpName = MemberGroup::where('Group_id', $row2)
                            ->first();
                        if ($count > 0) {
                            $warn = $warn . $row . " already existing in " . $grpName->Group_name . ", ";
                        } else if ($count == 0) {
                            $added .= $row . " added " . $grpName->Group_name;
                            $GroupMembers = new GroupMembers();
                            $GroupMembers->Group_id = $row2;
                            $GroupMembers->Member_tbl_id = $member_reg->id;
                            $GroupMembers->Member_Id = $member_reg->Member_Id;
                            $GroupMembers->active = 'Y';
                            $GroupMembers->save();
                        }
                    }

                }
            }
        }
        if ($warn == "" && $invalid == "") {
            return redirect()->back()->with('warning3', $warn . 'Success');
        } else {
            $err = "";
            if ($added == "") {
                return redirect()->back()->with('warning2', $warn . "<br/>" . $invalid);
            } else {

                return redirect()->back()->with('warning2', $warn . "<br/>" . $invalid)->with('warning3', $added);
            }

        }
    }

    public function ShowGroupMember()
    {
        $memberGroups = MemberGroup::where('active', 'Y')->get();
        $members = Member::get();
        return view('GroupMembers.add', compact('memberGroups', 'members'));
    }

    public function ListGroupMembers($GroupId)
    {
        $memberGroups = MemberGroup::where('Group_id', $GroupId)->first();
        $memberId = GroupMembers::where('Group_id', $GroupId)->where('active', 'Y')->pluck('Member_Id');
        $members = Member::whereIn('Member_Id', $memberId)->get();
        return view('MemberGroup.ListGroupMembers', compact('members', 'memberGroups'));
    }

    public function DeleteGroupMember(Request $request)
    {
        GroupMembers::where('Member_Id', $request->member_id)
            ->where('Group_id', $request->group_id)
            ->update(['active' => 'N']);
        $val = GroupMembers::where('Member_Id', $request->member_id)
            ->where('Group_id', $request->group_id)->first();
        echo json_encode($val->active);
    }

    ///API Services

    public function getGroups(Request $request)
    {
        $rules = array(
            'member_id' => 'required',
            'token' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        } else {
            if ($user = $this->is_valid_token($request['token'])) {
                $memberGroups = MemberGroup::where('active', 'Y')->get();
                if ($memberGroups) {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'Success',
                        'data' => $memberGroups,
                    ]);
                } else {
                    return $this->respond([
                        'status' => 'Failed',
                        'code' => 400,
                        'message' => 'Failed',
                    ]);
                }
            } else {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }

    public function is_valid_token($token)
    {
        $user = User::where('api_token', $token)->first();
        return $user;
    }
}
