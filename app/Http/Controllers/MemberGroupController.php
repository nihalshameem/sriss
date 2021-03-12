<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberIdConfig;
use App\Models\MemberProfile;
use App\Models\MemberGroup;
use App\Models\GroupMembers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use JWTAuth;
use Response;
use View;
use Carbon\Carbon;
use Auth;
use DB;
use Route;
use \Illuminate\Http\Response as Res;

class MemberGroupController extends Controller
{

	//Member Group Function
    
    public function ShowMemberGroup(){
        $membersGroup = MemberGroup::get();
        return view('MemberGroup.list',compact('membersGroup'));
    }

    public function AddMemberGroup(){
        return view('MemberGroup.create');
    }
    
    public function SaveMemberGroup(Request $request){
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

    public function EditMemberGroup($id){
        $membersGroup = MemberGroup::where('Group_id',$id)->first();
        return view('MemberGroup.edit',compact('membersGroup'));
    }

    public function UpdateMemberGroup(Request $request){

        $membersGroup = MemberGroup::where('Group_id',$request->id)->
        update(['Group_name'=> $request->name,'active'=> $request->Status]);
        $membersGroup = MemberGroup::where('Group_id',$request->id)->first();
        return view('MemberGroup.edit',compact('membersGroup'));
    }


    //Members Group Function

    public function SaveSingleGroupMember(Request $request){
    	
    	$member_reg_id=Member::where('id',$request->member_id)->pluck('Member_Id');
    	$count = GroupMembers::where('Group_id', $request->Group_id)
	    				->where('Member_tbl_id',$request->member_id)
	    				->count();
		if($count>0){
			return redirect()->back()->with('warning1','Already Exist!');
		}else if($count==0){
	        $GroupMembers = new GroupMembers();
	        $GroupMembers->Group_id = $request->Group_id;
	        $GroupMembers->Member_tbl_id = $request->member_id;
	        $GroupMembers->Member_Id = $member_reg_id[0];
	        $GroupMembers->active = 'Y';
	        $GroupMembers->save();
	    }
        
        return redirect()->back()->withSuccess('Successfully Updated!');
    }

    public function SaveMultiGroupMember(Request $request){
		$warn="";
		$added="";
    	foreach (explode(',',$request->multi_member_id) as $row){
    		if($row!=""){
    			$member_reg=Member::where('Mobile_No',$row)->first();
		    	$count = GroupMembers::where('Group_id', $request->multi_Group_id)
		    				->where('Member_tbl_id',$member_reg->id)->count();		
		    	if($count>0){
		    		$warn=$warn.$row.", ";
		    	}else if($count==0){
		    		$added.=$row.", ";
		    		$GroupMembers = new GroupMembers();
			        $GroupMembers->Group_id = $request->multi_Group_id;
			        $GroupMembers->Member_tbl_id = $member_reg->id;
			        $GroupMembers->Member_Id = $member_reg->Member_Id;
			        $GroupMembers->active = 'Y';
			        $GroupMembers->save();
		    	}
		    	}
        }
        if($warn==""){
	    		return redirect()->back()->with('warning2',$warn.'Success');
	    	}else{
	    		if($added==""){
	    			return redirect()->back()->with('warning2',$warn.' Already Exist!');
	    		}else{
	    			return redirect()->back()->with('warning2',$warn.' Already Exist!')->with('warning3',$added.' Updated!');
	    		}
	    		
	    	}
    }

    public function ShowGroupMember(){
        $memberGroups = MemberGroup::get();
        $members = Member::get();
        return view('GroupMembers.add',compact('memberGroups','members'));
    }

}
