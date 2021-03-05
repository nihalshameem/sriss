<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use App\Models\State;
use App\Models\Volunteer;
use Session;
use DateTime;
use View;
use Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use JWTAuth;
use Carbon\Carbon;
use Auth;
use DB;
use Route;
use \Illuminate\Http\Response as Res;

class VolunteerController extends ApiController
{
    /******************Web Application**************/
    
    public function ListVolunteer()
    {
        $NotInVolunteer = Volunteer::pluck('Member_id');
        $Member = Member::where('active_flag','Y')->whereNotIn('Member_Id',$NotInVolunteer)->get();
        $Volunteer = Member::where('active_flag','Y')->whereIn('Member_Id',$NotInVolunteer)->get();
        $Members = array();
        return view('volunteer.list',compact('Volunteer','Member','Members'));
    }

    public function VolunteerSearch(Request $request)
    {
        $Members=Member::where('Mobile_NO','LIKE','%'.$request->membersearch."%")->orWhere('Email_Id','LIKE','%'.$request->membersearch."%")->orWhere('Member_Id','LIKE','%'.$request->membersearch."%")->get();
        $Members = View::make('volunteer.filters.volunteer_search_filter', compact('Members'))->render();
        return Response::json(['Member' => $Members]);
 
    }


    public function UpdateVolunteer($memberId)
    {
        $member = User::Where("Member_Id", '=', $memberId)
                        ->update(['Is_Volunteer'=> 'Y']);
                        
        $user = User::where('Member_Id',$memberId)->first();
        $Member = Member::where('Member_Id',$memberId)->first();
        $Volunteer = new Volunteer();
        $Volunteer->Member_id = $user->Member_Id;
        $Volunteer->Pincode = $Member->Pincode;
        $Volunteer->Volunteer_Active = 'Y';
        $Volunteer->DRS_Service_Joining_Date ='0';
        $Volunteer->save();

        return redirect('/VolunteerList');
    }

    public function RemoveVolunteer($memberId)
    {
        $member = User::Where("Member_Id", '=', $memberId)
                        ->update(['Is_Volunteer'=> 'N']);
        Volunteer::where('Member_id', $memberId)->delete();
        return redirect('/VolunteerList'); 
    }

    /*Volunteer */

    public function Volunteer()
    {
        $State = State::get();
        
        $user = User::where('name',Session::get('name'))->first();
        $volunteer = Member::where('Member_Id',$user->Member_Id)->first();
        return view('volunteer.save',compact('State','user','volunteer'));
    }

    public function VolunteerSave(Request $request)
    {
        $userDob = $request->joining_date;

        //Create a DateTime object using the user's date of birth.
        $dob = new DateTime($userDob);

        //We need to compare the user's date of birth with today's date.
        $now = new DateTime();

        //Calculate the time difference between the two dates.
        $difference = $now->diff($dob);


        $user = User::where('name',Session::get('name'))->first();
        $Volunteer = Volunteer::where('Member_id',$user->Member_Id)->update([
        'DRS_Service_Joining_Date' => $request->joining_date,'DRS_Service_Experience' => $difference->y]);
        
        Member::where("Member_Id", '=', $user->Member_Id)
                                        ->update(['State_Id'=> $request->State_id,'State_Division_Id'=>$request->State_Division_id,
                                            'Greater_Zones_Id'=>$request->Greater_Zones_id,
                                            'Zones_Id'=>$request->Zone_id,
                                            'District_Id'=>$request->District_id,
                                            'Union_Id'=>$request->Union_id,
                                            'Panchayat_Id'=>$request->Panchayat_id,
                                            'Village_Id'=>$request->Village_id,
                                            'Street_Id'=>$request->Street_id,
                                            'Member_Designation'=>$request->member_designation,
                                            ]);
        return redirect(route('Volunteer'));

    }


    /**********************Web Services*********************/

    public function getVolunteer(Request $request)
    {
        $rules = array (
            'member_id' => 'required',
            'token' => 'required',
            );

        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails())
        {
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else
        {
            if($user=$this->is_valid_token($request['token']))
            {
                $Member = Member::where('Member_Id',$request->member_id)->first();
                
                 
                 $Volunteercount = Volunteer::where('Pincode',$Member->Pincode)->count();
                 
                if($Volunteercount!=0)
                {
                    $Volunteer = Volunteer::where('Pincode',$Member->Pincode)->first();
                    $FirstName = Member::where('Member_Id',$Volunteer->Member_id)->value('First_Name');
                
                    $Mobile = Member::where('Member_Id',$Volunteer->Member_id)->value('Mobile_No');
                    

                    return $this->respond([
                                    'status' => 'success',
                                    'message' => 'success',
                                    'code' => $this->getStatusCode(),
                                    'data'=>
                                    [[
                                    'name' =>$FirstName,
                                    'mobilenumber' =>$Mobile,
                                    ]],   
                                    ]);
                }
                else
                {
                  return $this->respond([
                                    'status' => 'failure',
                                    'message' => 'Volunteer not available',
                                    'code' => 400,
                                    ]);  
                }
            }
            else
            {
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
