<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use App\Models\MemberIdConfig;
use App\Models\IdCard;
use App\Models\Feedback;
use App\Models\MemberProfile;
use App\Models\Volunteer;
use App\Models\District;
use App\Models\Compliance;
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


class MembersController extends ApiController
{

    public function Registration(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|unique:users|max:255',
        ]);

            if ($validator->fails()) {
               return Response([
                            'status' => 'failure',
                            'code' => 400,
                            'message' => 'Mobile Number is already exist',
                        ]);  
            }
            
            else
            {
                
                $user = new User();
                $user->name = $request->first_name;
                $user->email = $request->email_id;
                $user->mobile_number = $request->mobile_number;
                $user->password = \Hash::make($request->password);
                $user->save();
            
                $month = Carbon::now()->format('m');
                $year = Carbon::now()->year;
                
                $memberIdFormat = MemberIdConfig::where('id','1')->get();
                $memberId = $memberIdFormat[0]['MemberIdFormat'];
                
                $member_id=$memberId.$month.$year.sprintf("%07d", $user->id);
                                    
                

        $volunteer = Volunteer::where('Pincode',$request['pin_code'])->first();
        if($volunteer)
        {
            $Member = Member::where('Member_Id',$volunteer->Member_id)->first();

                $member = new Member();
                $member->Member_Id = $member_id;
                $member->First_Name = $request->first_name;
                $member->Last_Name = $request->last_name;
                $member->Email_Id = $request->email_id;
                $member->Pincode = $request->pin_code;
                $member->Mobile_No = $request->mobile_number;
                $member->Pan_No = $request->pan_number;
                $member->Whatsapp_No = $request->whatsapp_number;
                $member->State_Id = $Member->State_Id;
                $member->State_Division_Id = $Member->State_Division_Id;
                $member->Greater_Zones_Id = $Member->Greater_Zones_Id;
                $member->Zones_Id = $Member->Zones_Id;
                $member->Union_Id = $Member->Union_Id;
                $member->Panchayat_Id = $Member->Panchayat_Id;
                $member->Village_Id = $Member->Village_Id;
                $member->Street_Id = $Member->Street_Id;
                if($member->save())
                {
                    $user = User::find($user->id);
                    $user->Member_Id = $member_id;
                    $user->save();
                }
                else
                {
                    $user = User::find($user->id)->delete();
                }
        }
        else
        {

                $member = new Member();
                $member->Member_Id = $member_id;
                $member->First_Name = $request->first_name;
                $member->Last_Name = $request->last_name;
                $member->Email_Id = $request->email_id;
                $member->Pincode = $request->pin_code;
                $member->Mobile_No = $request->mobile_number;
                $member->Pan_No = $request->pan_number;
                $member->Whatsapp_No = $request->whatsapp_number;
                if($member->save())
                {
                    $user = User::find($user->id);
                    $user->Member_Id = $member_id;
                    $user->save();
                }
                else
                {
                    $user = User::find($user->id)->delete();
                }
        }
        
         $credentials = ['mobile_number' => $request['mobile_number'], 'password' => $request['password']];
         
            if ( ! $token = JWTAuth::attempt($credentials)) {
                return $this->respondWithError("User does not exist!");
            }
            $user = auth()->user();
            $user->api_token = $token;
            $user->save();
        
            $user = User::where('mobile_number', $request['mobile_number'])->first();
            $language = DB::table('drs_language_tbl')->where('Language_lock', 'Y')->value('Language_lock');
            $member = Member::where('Mobile_No',$request['mobile_number'])->value('Profile_Picture');

                        return Response([
                            'status' => 'success',
                            'code' => $this->getStatusCode(),
                            'message' => 'Register Successfull',
                            'data' => $this->user_transform($user,$language,$member)
                        ]);   
            }
    }


    public function Authenticate(Request $request)
    {
       
        $rules = array ('mobile_number' => 'required','password' => 'required');
        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails()){
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else
        {
                $user=Auth::attempt(['mobile_number'=>$request['mobile_number'],'password' => $request['password']]);
                if($user)
                {
                    $memberactive = Member::where('Mobile_No',$request['mobile_number'])->first();
                    if($memberactive->active_flag=='Y')
                    {
                        $user = User::where('mobile_number',$request['mobile_number'])->first();
                        $api_token = $user['api_token'];

                        if($user['api_token'] == NULL)
                        {
                                return $this->_login($request['mobile_number'], $request['password']);
                        }
                        else
                        {
                            
                            try
                            {
                                $credentials = ['mobile_number'=>$request['mobile_number'],'password' => $request['password']];
                                $token = JWTAuth::attempt($credentials);
                                $user->api_token = $token;
                                $user->save();
                                $user = User::where('mobile_number', $request['mobile_number'])->first();
                                $member = Member::where('mobile_number', $request['mobile_number'])->value('Profile_Picture');
                                $language = DB::table('drs_language_tbl')->where('Language_lock', 'Y')->value('Language_lock');
                                return Response([
                                    'status' => 'success',
                                    'code' => $this->getStatusCode(),
                                    'message' => 'Login Successfull',
                                    'data' => $this->user_transform($user,$language,$member)
                                ]);
                            }catch(JWTException $e){
                                $user->api_token =null;
                                $user->save();
                                return $this->respondInternalError("Login Unsuccessful. An error occurred while performing an action!");
                            }
                        }
                    }
                    else
                    {
                        return $this->respondWithError("Deactivated");
                    }

                }  
                else
                {
                    return $this->respondWithError("Invalid Username or Password");
                }
            }
            
        
    }

    private function _login($mobile_number, $password)
    {
        $credentials = ['mobile_number' => $mobile_number, 'password' => $password];
        if ( ! $token = JWTAuth::attempt($credentials)) {
            return $this->respondWithError("User does not exist!");
        }
        $credentials = ['mobile_number'=>$mobile_number,'password' => $password];
        $token = JWTAuth::attempt($credentials);
        $user = User::where('mobile_number',$mobile_number)->first();
        $user->api_token = $token;
        $user->save();
        $user = User::where('mobile_number','LIKE','%'.$mobile_number.'%')->first();
        $language = DB::table('drs_language_tbl')->value('Language_lock');
        $member = Member::where('Mobile_No', $mobile_number)->value('Profile_Picture');
        return Response([
            'status' => 'success',
            'code' => $this->getStatusCode(),
            'message' => 'Login successful!',
            'data' => $this->user_transform($user,$language,$member)
        ]);
    }



    public function Mobile_Verification(Request $request)
    {
        $mobile_number = User::where('mobile_number', $request->mobile_number)->first();
        if($mobile_number)
        {
            return $this->respond([
                'status' => 'success',
                'code' => $this->getStatusCode(),
                'message'=>'Mobile Number already exist',   
                ]);
        }
        else
        {
            return $this->respond([
                'status' => 'failure',
                'code' => 400,
                'message' => 'Mobile number not match',
                ]);
        }
    }
    
   

    public function Forgot_password(Request $request)
    {

        $user = User::where('mobile_number',$request->mobile_number)->first();
        
        if ($user)
        { 
            $user->password = bcrypt($request->password);
            $user->save();
            return $this->respond([
                    'status' => 'success',
                    'code' => $this->getStatusCode(),
                    'message'=>'Your Password is reset, Now you may check!',   
                    ]);
        }
        else
        {
            return $this->respond([
                    'status' => 'failure',
                    'code' => 400,
                    'message'=>'Your Password is not reset',   
                    ]);
        }
    }
    

    public function transform($user){
        return [
            'name' => $user->name,
            'member_id' => $user->Member_Id,
            'mobile_number' => $user->mobile_number,
            'email' => $user->email,
            'api_token' => $user->api_token,
            'is_volunteer' => $user->Is_Volunteer,

        ];
    }

    public function user_transform($user,$language,$member){
        return [
            'name' => $user->name,
            'member_id' => $user->Member_Id,
            'mobile_number' => $user->mobile_number,
            'email' => $user->email,
            'api_token' => $user->api_token,
            'language_lock' => $language,
            'is_volunteer' => $user->Is_Volunteer,
            'profile_pic' => $member,

        ];
    }

    

    public function IdcardDetails(Request $request)
    {
        $rules = array (
            'mobile_number' => 'required',
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
                $Address1 = Member::where('Mobile_No',$request->mobile_number)->value('Address1');
                $Address2 = Member::where('Mobile_No',$request->mobile_number)->value('Address2');
                $First_Name = Member::where('Mobile_No',$request->mobile_number)->value('First_Name');
                $Last_Name = Member::where('Mobile_No',$request->mobile_number)->value('Last_Name');

                $membercount = Member::where('Mobile_No',$request->mobile_number)->first();

                $Idcardvision = Compliance::where('Compliance_id','4')->where('Compliance_active','Y')->value('Compliance_text');

                if($membercount)
                
                {
                    return response()->json([
                    'status' => 'success',
                            'code' => $this->getStatusCode(),
                            'message' => 'success',
                            'data'=>[
                            'Address'=>$Address1 ." " .$Address2,
                            'Name'=>$First_Name. " " . $Last_Name,
                            'Idcardvision'=>$Idcardvision,
                        ],
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'false',
                    'code' => 400,
                    'message' => 'Mobile Number is not registered',
                    ]);
                }
            }
            else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }


    public function profilepictureupdate(Request $request)
    {
        $rules = array (
            
            'mobile_number' => 'required',
            'token'=>'required',
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
                try
                {   
                    
                $members = Member::where("Mobile_No", "=",$request['mobile_number'])->first();
                if ($request->hasFile('profile'))
                {
                    $image_ext = $request->file('profile')->getClientOriginalExtension();
                    $image_extn = strtolower($image_ext);
                    $imageName = time() .'_'. $request->profile->getClientOriginalName();
                    $filePath = $request->file('profile')->storeAs('Profile', $imageName,'public');
                    $members->Profile_Picture = config('app.url').'storage/app/public/Profile/'.$imageName;  
                }
                    if($members->save())
                    {
                        return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'Profile Picture Updated',
                        'data'=>$members->Profile_Picture,
                        ]);
                    }
                    else
                    {
                        return $this->respond([
                        'status' => 'Failed',
                        'code' => $this->getStatusCode(),
                        'message' => 'Failed to Update',
                        ]);
                    }
                }catch(JWTException $e)
                {
                    $user->api_token = NULL;
                    $user->save();
                    return $this->respondInternalError("An error occurred while performing an action!");
                }
            }
            else
            {
                 return $this->respondTokenError("Token Mismatched");
                
            }
            
        }
    }

    public function IdCardUpdate(Request $request)
    {
        $rules = array (
            'mobile_number' => 'required',
            'token'=>'required',
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
                try
                {   
                    
                    $members = Member::where("Mobile_No", "=",$request['mobile_number'])->first();
                    
                    if ($request->hasFile('idcard'))
                    {

                        $IdCard = new IdCard();
                        $IdCard->Member_Id = $members->id;
                        $image_ext = $request->file('idcard')->getClientOriginalExtension();
                        $image_extn = strtolower($image_ext);
                        $imageName = time() .'_'. $request->idcard->getClientOriginalName();
                        $filePath = $request->file('idcard')->storeAs('idcard', $imageName,'public');
                        $IdCard->Member_Image = 'https://dharmarakshanasamiti.org/dev/storage/app/public/idcard/'.$imageName;
                    }
                    
                    if($IdCard->save())
                    {
                        return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'IdCard Updated',
                        'data'=>$members->Id_card_id,
                        ]);
                    }
                    else
                    {
                        return $this->respond([
                        'status' => 'Failed',
                        'code' => $this->getStatusCode(),
                        'message' => 'Failed to Update',
                        ]);
                    }
                }catch(JWTException $e)
                {
                    $user->api_token = NULL;
                    $user->save();
                    return $this->respondInternalError("An error occurred while performing an action!");
                }
            }
            else
            {
                 return $this->respondTokenError("Token Mismatched");
                
            }
            
        }
    }
    



    public function Feedback(Request $request)
    {
        $rules = array (
            'member_id' => 'required',
            'token' => 'required',
            'feedback_desc' => 'required',
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
                $Feedback = new Feedback();
                $Feedback->Member_id = $request->member_id;
                $Feedback->Feedback_desc = $request->feedback_desc;
                if($Feedback->save())
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'Feedback Updated',
                    ]);
                }
                else
                {
                    return $this->respond([
                        'status' => 'Failed',
                        'code' => $this->getStatusCode(),
                        'message' => 'Failed to Update',
                        ]);
                }
            }
            else
            {
                return $this->respondTokenError("Token Mismatched");
            } 
    }
    }
    
    public function logout(Request $request)
    {
        $rules = array (
            'mobile_number' => 'required',
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
                $user->api_token = null;
                $user->save();
                return $this->respond([
                    'status' => 'success',
                    'code' => $this->getStatusCode(),
                    'message' => 'Logout successfull!',
                    ]);
            }
            else
            {
                $user = User::where('mobile_number', $request['mobile_number'])->first();
                $user->api_token = null;
                $user->save();
                return $this->respondWithError("Token Mismatched");
            }
         }            

    }


    public function is_valid_token($token)
    {
        $user = User::where('api_token', $token)->first();
        return $user;
    }

    public function getProfileData()
    {
       
        $profiles =  MemberProfile::pluck('active','field_name');
        
        if($profiles)
        {
            return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'data' => $profiles,
                        'message' => 'Success',
            ]);
        }
        else
        {
            return $this->respond([
                        'status' => 'Failed',
                        'code' => 400,
                        'message' => 'Failed to Update',
                        ]);
        }
    }

    public function profileupdate(Request $request)
    {

        $rules = array (
            'mobile_number' => 'required',
            'token'=>'required',
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
                try
                {   
                    
                    $members = Member::where("Mobile_No", "=",$request['mobile_number'])->first();

                    if($request['first_name']){
                    $members->First_Name = $request['first_name'];
                    }
                    if($request['last_name']){
                    $members->Last_Name = $request['last_name'];
                    }
                    if($request['address1']){
                    $members->Address1 = $request['address1'];
                    }
                    if($request['address2']){
                    $members->Address2 = $request['address2'];
                    }
                    if($request['mobile_number']){
                    $members->Mobile_No = $request['mobile_number'];
                    }
                    if($request['whatsapp_number']){
                    $members->Whatsapp_No = $request['whatsapp_number'];
                    }
                    if($request['email_id']){
                    $members->Email_Id = $request['email_id'];
                    }
                    if($request['pan_number']){
                    $members->Pan_No = $request['pan_number'];
                    }
                    if($request['DOB']){
                    $members->DOB = $request['DOB'];
                    }
                    if($request['Age']){
                    $members->Age = $request['Age'];
                    }
                    if($request['wedding_date']){
                    $members->Wedding_Date = $request['wedding_date'];
                    }
                    if($request['pincode']){
                    $members->Pincode = $request['pincode'];
                    }
                    if($request['district']){
                    $district = District::where('District_desc',$request['district'])->first();
                    $members->District_Id = $district->District_id;
                    }
                    if($request['is_volunteer'])
                    {
                        $user = User::where('Member_Id',$members->Member_Id)->update(['Intrs_to_volunteer'=>$request['is_volunteer']]);
                    }
                    
                    if($members->save())
                    {
                        return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Profile Updated',
                        'data'=>$members
                        ]);
                    }
                    else
                    {
                        return $this->respond([
                        'status' => 'Failed',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Failed to Update',
                        ]);
                    }
                }catch(JWTException $e)
                {
                    $user->api_token = NULL;
                    $user->save();
                    return $this->respondInternalError("An error occurred while performing an action!");
                }
            }
            else
            {
                 return $this->respondTokenError("Token Mismatched");
                
            }
            
        }
    } 

    public function getProfileStored(Request $request)
    {
        $rules = array (
            'mobile_number' => 'required',
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
                $details =array();
                $member = Member::where('Mobile_No',$request->mobile_number)->first()->toArray();
                $members = Member::where('Mobile_No',$request->mobile_number)->first();
                $districtscount = District::where('District_Id',$members->District_Id)->select('District_desc As District')->count();
                if($districtscount>0)
                {
                    $district = District::where('District_Id',$members->District_Id)->select('District_desc As District')->first()->toArray();
                   $arr1 = array_merge($member,$district); 
                   array_push($details,$arr1);
                   $single= array_reduce($details, 'array_merge', array());
                }
                else
                {
                    $district =  array("District" => null);
                    $arr1 = array_merge($member,$district); 
                    array_push($details,$arr1);
                    $single= array_reduce($details, 'array_merge', array());
                }
                
                 
                if($member)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'Success',
                        'data' => $single
                    ]);
                }
                else
                {
                    return $this->respond([
                        'status' => 'Failed',
                        'code' => $this->getStatusCode(),
                        'message' => 'Failed to Update',
                        ]);
                }
            }
            else
            {
                return $this->respondTokenError("Token Mismatched");
            } 
    } 
    }

    
    
    

    /**************Web Application***********/

    /*Member Search */

    public function MemberDetails()
    {
        $Member = Member::get();
        $created_at = Member::distinct('created_at')->get();
        return view('Member.member_details',compact('Member','created_at'));
    }

    public function membersearch(Request $request)
    {
     
        if($request->ajax())
     
        {
     
            $output="";

            if($request->VolunteerSearch=='M')
            {
                $members = Member::where('Mobile_NO','LIKE','%'.$request->membersearch."%")->orWhere('Email_Id','LIKE','%'.$request->membersearch."%")->orWhere('Member_Id','LIKE','%'.$request->membersearch."%")->orWhere('created_at','LIKE','%'.$request->membersearch."%")->get();

            }
            else
            {
                $memberId = Member::where('Mobile_NO','LIKE','%'.$request->membersearch."%")->orWhere('Email_Id','LIKE','%'.$request->membersearch."%")->orWhere('Member_Id','LIKE','%'.$request->membersearch."%")->orWhere('created_at','LIKE','%'.$request->membersearch."%")->pluck('Member_Id');

                $volunteer = Volunteer::whereIn('Member_id',$memberId)->pluck('Member_id');
                if($volunteer!=null)
                {
                   $members = Member::whereIn('Member_Id',$volunteer)->get(); 
                }
                else
                {
                    $members = array();
                } 

            }
                            
            if($members)
         
            {
                
                   foreach ($members as $key => $member) {
                 
                $output.='<tr>'.
                 
                '<td>'.$member->First_Name.'</td>'.
                '<td>'.$member->Email_Id.'</td>'.
                '<td>'.$member->Mobile_No.'</td>'.
                '<td>'.$member->Member_Id.'</td>'.
                '<td>'.$member->Pincode.'</td>'.
                '<td>'.$member->created_at->toDateString().'</td>'.
                '<td>'.$member->Address1.'</td>'.
                '</tr>';
                 
                }  
                return Response($output);
            }

        }
     
    }

    /*Member Deactivation */

    public function MemberDeactivateList()
    {    
        $Member = Member::get();
        $demembers=Member::Where('active_flag','N')->get();
        return view('Member.member_deactivation',compact('Member','demembers'));
    }

    public function MemberDeactivateSearch(Request $request)
    {
     
        if($request->ajax())
     
        {
     
            $output="";
     
            $members=Member::where('Mobile_NO','LIKE','%'.$request->memberdeactivate."%")->orWhere('Email_Id','LIKE','%'.$request->memberdeactivate."%")->orWhere('Member_Id','LIKE','%'.$request->memberdeactivate."%")->get();
     
            if($members)
            {
                
                foreach ($members as $key => $member) {
                if($member->active_flag=='Y')
                {
                    $output.='<tr>'.
                     
                    '<td>'.$member->First_Name.'</td>'.
                    '<td>'.$member->Email_Id.'</td>'.
                    '<td>'.$member->Mobile_No.'</td>'.
                    '<td>'.$member->Member_Id.'</td>'.
                    '<td>'.$member->Pincode.'</td>'.
                    '<td>'.$member->Address1.'</td>'.
                    '<td><a href="/MemberDeactivation/'.$member->Member_Id.'" ><span class="badge bg-danger">Deactivate</span></a></td>'.
                    '</tr>';
                 
                } 
                else
                {
                    $output.='<tr>'.
                     
                    '<td>'.$member->First_Name.'</td>'.
                    '<td>'.$member->Email_Id.'</td>'.
                    '<td>'.$member->Mobile_No.'</td>'.
                    '<td>'.$member->Member_Id.'</td>'.
                    '<td>'.$member->Pincode.'</td>'.
                    '<td>'.$member->Address1.'</td>'.
                    '<td><a href="/MemberActivation/'.$member->Member_Id.'" ><span class="badge bg-success">Activate</span></a></td>'.
                    '</tr>';
                } 
                return Response($output);
            }

        }
    }
     
    }

    public function MemberDeactivation($memberId)
    {
        $member = Member::Where("Member_Id", '=', $memberId)
                        ->update(['active_flag'=> 'N']);
        if($member)
        {

            return redirect('/MemberEdit');
            
        }
        else
        {

                return redirect('/MemberEdit');
        }
        
    }

    public function MemberActivation($memberId)
    {
        $member = Member::Where("Member_Id", '=', $memberId)
                        ->update(['active_flag'=> 'Y']);
        if($member)
        {

            return redirect('/MemberEdit');
            
        }
        else
        {

                return redirect('/MemberEdit');
        }
        
    }
    
    public function MobileNumbersearch(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            if(isset($request->MobileNumbersearch) ){
                $members=Member::where('Mobile_No', $request->MobileNumbersearch)
                ->get();
            }
         

            return Response($members);

        }
    }

    

   
   
}
