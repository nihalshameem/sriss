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
use App\Models\Country;
use App\Models\State;
use App\Models\District;
use App\Models\ParliamentConsituency;
use App\Models\AssemblyConsituency;
use App\Models\PartyLeader;
use App\Models\ReligiousLeader;
use App\Models\CasteLeader;
use App\Models\Compliance;
use App\Models\Language;
use App\Models\MemberGroup;
use App\Models\GroupMembers;
use App\Models\MemberCategory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;
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

            $member = User::where('mobile_number',$request->mobile_number)->count();
        
            if ($member>0) {
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
                $member->Zones_Id = $Member->Zones_Id;
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
            $member = Member::where('Mobile_No',$request['mobile_number'])->value('Member_image');

                        return Response([
                            'status' => 'success',
                            'code' => $this->getStatusCode(),
                            'message' => 'Register Successfull',
                            'data' => $this->user_transform($user,$member)
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
                    if($memberactive->Member_Active_Flag=='Y' )
                    {
                        if($memberactive->Member_Approved_Flag=='Y')
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
                                    $member = Member::where('Mobile_No', $request['mobile_number'])->value('Member_image');
                                    return Response([
                                        'status' => 'success',
                                        'code' => 200,
                                        'message' => 'Login Successfull',
                                        'IsApproval' => true,
                                        'data' => $this->user_transform($user,$member)
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
                            return Response([
                                        'status' => 'success',
                                        'code' => 200,
                                        'message' => 'தங்களது உறுப்பினர் ஒப்புதல் செயலில் உள்ளது.24 மணி நேரம் கழித்து உள் நுழைய முயற்சி செய்யவும், பதிவு செய்து 24 நான்கு மணி  நேரத்திற்கு பிறகும் உள் நுழைய முடியவில்லையனில் இந்த எண்ணை  +91 87544 23520 தொடர்பு கொள்ளவும்.Your approval is in progress, please access the App after 24 hours, if you are not able to login after 24 hours please Contact  +91 87544 23520',
                                        'IsApproval' => false
                                    ]);
                        }
                    }
                    else
                    {
                        return Response([
                                        'status' => 'failure',
                                        'code' => 400,
                                        'message' => 'Deactivated',
                                        'IsApproval' => false
                                    ]);
                    }

                }  
                else
                {
                    return Response([
                                        'status' => 'failure',
                                        'code' => 400,
                                        'message' => 'Invalid Username or Password',
                                        'IsApproval' => false
                                    ]);
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
        $member = Member::where('Mobile_No', $mobile_number)->value('Profile_Picture');
        return Response([
            'status' => 'success',
            'code' => $this->getStatusCode(),
            'message' => 'Login successful!',
            'IsApproval' => true,
            'data' => $this->user_transform($user,$member)
        ]);
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

    public function user_transform($user,$member){
        return [
            'name' => $user->name,
            'member_id' => $user->Member_Id,
            'mobile_number' => $user->mobile_number,
            'email' => $user->email,
            'api_token' => $user->api_token,
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
                $Address1 = Member::where('Mobile_No',$request->mobile_number)->value('Address_Line_1');
                $Address2 = Member::where('Mobile_No',$request->mobile_number)->value('Address_Line_2');
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
                    $members->Member_image = config('app.url').'storage/app/public/Profile/'.$imageName;  
                }
                    if($members->save())
                    {
                        return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'Profile Picture Updated',
                        'data'=>$members->Member_image,
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

    public function getProfileData(Request $request)
    {
        $member_id = $request->member_id;
        $profiles =  MemberProfile::pluck('active','field_name')->toArray();
        $lang_id = Member::where('Member_id', $member_id)->first();
        $lang_id = strtolower($lang_id->Language_id);
        if($lang_id=='l1'){
            $lang_id = "d";
        }
        $labels =  MemberProfile::get();
        foreach($labels as $label)
        {

            $profiles = array_merge($profiles, array($label->field_name.'_label'=>$label->{$lang_id."_label"})); 
        }
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
                        'message' => 'Data Not Found',
                        ]);
        }
    }

    public function profileupdate(Request $request)
    {

        $rules = array (
            'member_id' => 'required',
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
                    
                    $members = Member::where("member_id", "=",$request['member_id'])->first();

                    if($request['First_Name']){
                    $members->First_Name = $request['First_Name'];
                    }
                    if($request['Last_Name']){
                    $members->Last_Name = $request['Last_Name'];
                    }
                    if($request['DOB']){
                    $members->DOB = $request['DOB'];
                    }
                    if($request['Age']){
                    $members->Age = $request['Age'];
                    }
                    if($request['DOB']){
                    $members->DOB = $request['DOB'];
                    }
                    if($request['Sex']){
                    $members->Sex = $request['Sex'];
                    }
                    if($request['Address_Line_1']){
                    $members->Address_Line_1 = $request['Address_Line_1'];
                    }
                    if($request['Address_Line_2']){
                    $members->Address_Line_2 = $request['Address_Line_2'];
                    }
                    if($request['Pincode']){
                    $members->Pincode = $request['Pincode'];
                    }
                    if($request['Mobile_No']){
                    $members->Mobile_No = $request['Mobile_No'];
                    }
                    if($request['Whatsapp_No']){
                    $members->Whatsapp_No = $request['Whatsapp_No'];
                    }
                    if($request['Email_Id']){
                    $members->Email_Id = $request['Email_Id'];
                    }
                    if($request['Voter_Id_card_no']){
                    $members->Voter_Id_card_no = $request['Voter_Id_card_no'];
                    }
                    if($request['Marital_Status']){
                    $members->Marital_Status = $request['Marital_Status'];
                    }
                    if($request['Wedding_Date']){
                    $members->Wedding_Date = $request['Wedding_Date'];
                    }
                    if($request['Spouse_Name']){
                    $members->Spouse_Name = $request['Spouse_Name'];
                    }
                    if($request['Spouse_DOB']){
                    $members->Spouse_DOB = $request['Spouse_DOB'];
                    }
                    if($request['Spouse_Age']){
                    $members->Spouse_Age = $request['Spouse_Age'];
                    }

                    if($request['Assembly_Constituency_Desc']){

                        $AssemblyConsituency = AssemblyConsituency::where('Assembly_Constituency_Desc',$request['Assembly_Constituency_Desc'])->first();

                        $members->Assembly_Constituency_Desc = $AssemblyConsituency->Assembly_Id;

                    }

                    if($request['Parliament_Constituency_Desc']){

                            $ParliamentConsituency = ParliamentConsituency::where('Parliament_Constituency_Desc',$request['Parliament_Constituency_Desc'])->first();
                        
                            $members->Parliament_Constituency_Desc = $ParliamentConsituency->Parliament_Id;

                    }

                    if($request['Ward_No'])
                    {
                        $members->Ward_No = $request['Ward_No'];
                    }
                    
                    if($request['Booth_No'])
                    {
                        $members->Booth_No  = $request['Booth_No'];
                    }
                    
                    if($request['Polling_Area']){
                    $members->Polling_Area = $request['Polling_Area'];
                    }
                    if($request['Gothram']){
                    $members->Gothram = $request['Gothram'];
                    }
                    if($request['Member_Nationality_Desc']){
                    $members->Member_Nationality_Desc = $request['Member_Nationality_Desc'];
                    }
                    if($request['Member_Religion_Desc']){
                    $members->Member_Religion_Desc = $request['Member_Religion_Desc'];
                    }
                    if($request['Member_Caste_Desc']){
                    $members->Member_Caste_Desc = $request['Member_Caste_Desc'];
                    }

                    if($request['Member_Religious_Leader_Name']){
                    $members->Member_Religious_Leader_Name  = $request['Member_Religious_Leader_Name'];
                    }
                    if($request['Member_Caste_Leader_Name']){
                    $members->Member_Caste_Leader_Name = $request['Member_Caste_Leader_Name'];
                    }
                     if($request['Member_Party_Leader_Name']){
                    $members->Member_Party_Leader_Name = $request['Member_Party_Leader_Name'];
                    }
                    if($request['Birth_Star']){
                    $members->Birth_Star = $request['Birth_Star'];
                    }
                    if($request['Pan_No']){
                    $members->Pan_No = $request['Pan_No'];
                    }
                     if($request['Profession']){
                    $members->Profession = $request['Profession'];
                    }
                    if($request['Referrar_Phone_No'])
                    {
                        $MemberUpdate = Member::where('Member_Id',$request->member_id)->first();
                        $referredBycheck = Member::where('Mobile_No',$request->Referrar_Phone_No)->count();
                        
                        if($request->Referrar_Phone_No==$MemberUpdate->Mobile_No)
                        {
                            return $this->respond([
                                'status' => 'failure',
                                'code' => 400,
                                'message' => 'You cannot refer yourself',
                                ]);
                        }
                        else
                        {
                            if($referredBycheck>0)
                            {
                                $members->Referrar_Phone_No = $request->Referrar_Phone_No;
                            }
                            else
                            {
                                return $this->respond([
                                'status' => 'Failed',
                                'status_code' => 400,
                                'message' => 'Enter Valid Member Mobile Number',
                                ]);
                            }
                        
                        }
                    }
                    
                    
                    if($request['Text_Field_1']){
                    $members->Text_Field_1 = $request['Text_Field_1'];
                    }
                    if($request['Text_Field_2']){
                    $members->Text_Field_2 = $request['Text_Field_2'];
                    }
                    if($request['Text_Field_3']){
                    $members->Text_Field_3 = $request['Text_Field_3'];
                    }
                    if($request['Text_Field_4']){
                    $members->Text_Field_4 = $request['Text_Field_4'];
                    }
                    if($request['Text_Field_5']){
                    $members->Text_Field_5 = $request['Text_Field_5'];
                    }
                    if($request['Text_Field_6']){
                    $members->Text_Field_6 = $request['Text_Field_6'];
                    }
                    if($request['Text_Field_7']){
                    $members->Text_Field_7 = $request['Text_Field_7'];
                    }
                    if($request['Text_Field_8']){
                    $members->Text_Field_8 = $request['Text_Field_8'];
                    }
                    if($request['Text_Field_9']){
                    $members->Text_Field_9 = $request['Text_Field_9'];
                    }
                    if($request['Text_Field_10']){
                    $members->Text_Field_10 = $request['Text_Field_10'];
                    }
                    if($request['Date_Field_1']){
                    $members->Date_Field_1 = $request['Date_Field_1'];
                    }
                    if($request['Date_Field_2']){
                    $members->Date_Field_2 = $request['Date_Field_2'];
                    }
                    if($request['Date_Field_3']){
                    $members->Date_Field_3 = $request['Date_Field_3'];
                    }
                    if($request['Date_Field_5']){
                    $members->Date_Field_5 = $request['Date_Field_5'];
                    }
                    if($request['Date_Field_4']){
                    $members->Date_Field_4 = $request['Date_Field_4'];
                    }
                    if($request['Yes_No_Field_1']){
                    $members->Yes_No_Field_1 = $request['Yes_No_Field_1'];
                    }
                    if($request['Yes_No_Field_2']){
                    $members->Yes_No_Field_2 = $request['Yes_No_Field_2'];
                    }
                    if($request['Yes_No_field_3']){
                    $members->Yes_No_field_3 = $request['Yes_No_field_3'];
                    }
                    if($request['Yes_No_field_4']){
                    $members->Yes_No_field_4 = $request['Yes_No_field_4'];
                    }
                    if($request['Yes_No_field_5']){
                    $members->Yes_No_field_5 = $request['Yes_No_field_5'];
                    }
                    if($request['District_Id']){
                        $district = District::where('District_desc',$request['District_Id'])->first();
                        $members->District_Id = $district->District_id;
                    }
                    if($request['State_Id']){
                        $State = State::where('State_desc',$request['State_Id'])->first();
                        $members->State_Id = $State->State_id;
                    }
                    if($request['Country_Id']){
                        $Country = Country::where('Country_desc',$request['Country_Id'])->first();
                        $members->Country_Id = $Country->Country_Id_id;
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
                $details = array();
                $member = Member::where('Member_Id',$request->member_id)
                                ->first()
                                ;

                $member = $member->makeHidden(['Assembly_Constituency_Desc','Parliament_Constituency_Desc'])->toArray();

                $members = Member::where('Member_Id',$request->member_id)->first();

                $districtscount = District::where('District_Id',$members->District_Id)->select('District_desc As District')->count();

                $statecount = State::where('State_id',$members->State_Id)->select('State_desc As State')->count();

                $ParliamentConsituencycount = ParliamentConsituency::where('Parliament_Id',$members->Parliament_Constituency_Desc)->select('Parliament_Constituency_Desc')->count();

                $AssemblyConsituencycount = AssemblyConsituency::where('Assembly_Id',$members->Assembly_Constituency_Desc)->select('Assembly_Constituency_Desc')->count();

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
                if($statecount>0)
                {
                    $State = State::where('State_id',$members->State_Id)->select('State_desc As State')->first()->toArray();
                   $arr11 = array_merge($member,$State); 
                   array_push($details,$arr11);
                   $single= array_reduce($details, 'array_merge', array());
                }
                else
                {
                    $State =  array("State"=>null);
                    $arr1 = array_merge($member,$State); 
                    array_push($details,$arr1);
                    $single= array_reduce($details, 'array_merge', array());
                }
                if($AssemblyConsituencycount>0)
                {
                    $AssemblyConsituency = AssemblyConsituency::where('Assembly_Id',$members->Assembly_Constituency_Desc)->select('Assembly_Constituency_Desc')->first()->toArray();
                   $AssemblyConsituencyarr = array_merge($member,$AssemblyConsituency); 
                   array_push($details,$AssemblyConsituencyarr);
                   $single= array_reduce($details, 'array_merge', array());
                }
                else
                {
                    $AssemblyConsituency =  array("Assembly_Constituency_Desc"=>null);
                    $AssemblyConsituencyarr = array_merge($member,$AssemblyConsituency); 
                    array_push($details,$AssemblyConsituencyarr);
                    $single= array_reduce($details, 'array_merge', array());
                }
                if($ParliamentConsituencycount>0)
                {
                    $ParliamentConsituency = ParliamentConsituency::where('Parliament_Id',$members->Parliament_Constituency_Desc)->select('Parliament_Constituency_Desc')->first()->toArray();
                   $ParliamentConsituencyarr = array_merge($member,$ParliamentConsituency); 
                   array_push($details,$ParliamentConsituencyarr);
                   $single= array_reduce($details, 'array_merge', array());
                }
                else
                {
                    $ParliamentConstituencyDesc =  array("Parliament_Constituency_Desc"=>null);
                    $ParliamentConstituencyDescarr = array_merge($member,$ParliamentConstituencyDesc); 
                    array_push($details,$ParliamentConstituencyDescarr);
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

    public function getMemberProfileDetails(Request $request)
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

    public function MemberReferal(Request $request)
    {
        $rules = array (
            'token' => 'required',
            'member_id' => 'required',
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
                $Member = Member::where('Member_Id', $request->member_id)->first();
                $referredBy = Member::where('Mobile_No', $Member->Referrar_Phone_No)->select('First_Name as Name','Mobile_No','Member_Id','Member_image')->first();
                $referredByCount = Member::where('Mobile_No', $Member->Referrar_Phone_No)->select('First_Name as Name','Mobile_No','Member_Id','Member_image')->count();
                $referrals = Member::where('Referrar_Phone_No', $Member->Mobile_No)->select('First_Name as Name','Mobile_No','Member_Id','Member_image')->get();

                $referralsCount = Member::where('Referrar_Phone_No', $Member->Mobile_No)->select('First_Name as Name','Mobile_No','Member_Id','Member_image')->count();

                if($referralsCount>0 && $referredByCount>0)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'data'=>array(
                            'Referred_By'=>$referredBy,
                            'Referrals'=>$referrals
                        ),
                        'message'=>'Success',   
                        ]);
                }
                elseif($referredByCount>0)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'data'=>array(
                            'Referred_By'=>$referredBy,
                            'Referrals'=>null
                        ),
                        'message'=>'Success',   
                        ]);
                }
                elseif( $referralsCount>0)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'data'=>array(
                            'Referred_By'=>null,
                            'Referrals'=>$referrals
                        ),
                        'message'=>'Success',   
                        ]);
                }
                else
                {
                    return $this->respond([
                        'status' => 'failure',
                        'code' => 400,
                        'data' =>array(
                            'Referred_By'=>null,
                            'Referrals'=>null
                        ),
                        'message' => 'Member Not Found',
                        ]);
                }
            }
            else
            {
                    return $this->respondTokenError("Token Mismatched");
            }
        }
    }

    public function MemberApprovalPending(Request $request)
    {
        $rules = array (
            'token' => 'required',
            'member_id' => 'required',
            'status' => 'required',
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
                $Member = Member::where('Member_Approved_Flag', $request->status)->select('Member_Id','First_Name as Name','Mobile_No','Member_Approved_Flag as Is_Approved')->get();

                if($Member->count()>0)
                {

                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'data'=>$Member,
                        'message'=>'Success',   
                        ]);
                }
                else
                {
                    if($request->status=="N"){
                        return $this->respond([
                        'status' => 'failure',
                        'code' => 400,
                        'message' => 'There is no record to approve',
                        ]);
                    }elseif ($request->status=="R") {
                        return $this->respond([
                        'status' => 'failure',
                        'code' => 400,
                        'message' => 'There is no record to reject',
                        ]);
                    }
                    
                }
            }
            else
            {
                    return $this->respondTokenError("Token Mismatched");
            }
        }
    }

    public function UpdateMemberApproval(Request $request)
    {
        $rules = array (
            'token' => 'required',
            'member_id' => 'required',
            'approval_id' => 'required',
            'status' => 'required',
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
                $myString = $request->approval_id;
                $myArray = explode(',', $myString);
                $MemberUpdate = Member::whereIn('Member_Id',$myArray)->update(['Member_Approved_Flag'=>$request->status,'Approval_Id'=>$request->member_id]);

                $Members = Member::whereIn('Member_Id',$myArray)->get();

                if($Members->count()>0)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message'=>'Updated Successfully',   
                        ]);
                }
                else
                {
                    return $this->respond([
                        'status' => 'failure',
                        'code' => 400,
                        'message' => 'Failed to update',
                        ]);
                }
            }
            else
            {
                    return $this->respondTokenError("Token Mismatched");
            }
        }
    }

    public function UpdateMemberReferal(Request $request)
    {
        $rules = array (
            'token' => 'required',
            'member_id' => 'required',
            'referred_by'=> 'required',
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
                $MemberUpdate = Member::where('Member_Id',$request->member_id)->first();
                $referredBycheck = Member::where('Mobile_No',$request->referred_by)->count();
                
                if($request->referred_by==$MemberUpdate->Mobile_No)
                {
                    return $this->respond([
                        'status' => 'failure',
                        'code' => 400,
                        'message' => 'You cannot refer yourself',
                        ]);
                }
                else
                {
                    if($referredBycheck>0)
                    {
                        $MemberUpdate->Referrar_Phone_No = $request->referred_by;
                    }
                    else
                    {
                        return $this->respond([
                        'status' => 'Failed',
                        'status_code' => 400,
                        'message' => 'Enter Valid Member Mobile Number',
                        ]);
                    }
                if($MemberUpdate->save())
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'data' =>$MemberUpdate,
                        'message'=>'Updated Successfully',   
                        ]);
                }
                else
                {
                    return $this->respond([
                        'status' => 'failure',
                        'code' => 400,
                        'message' => 'Failed to update',
                        ]);
                }
            }
            }
            else
            {
                    return $this->respondTokenError("Token Mismatched");
            }
        }
    }

    public function getCounts(Request $request)
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
                $Member = Member::where('Member_Id', $request->member_id)->first();

                $referralsCount = Member::where('Referrar_Phone_No', $Member->Mobile_No)->count();

                $MemberApprovalCount = Member::where('Member_Approved_Flag', 'N')->select('Member_Id','First_Name as Name','Mobile_No','Member_Approved_Flag as Is_Approved')->count();

                if($referralsCount>0 && $MemberApprovalCount>0)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'success',
                        'data' => [
                            'MemberReferalCount'=>$referralsCount,
                            'MemberApprovalCount'=>$MemberApprovalCount
                        ]
                    ]);
                }
                if($referralsCount>0)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'success',
                        'data' => [
                            'MemberReferalCount'=>$referralsCount,
                            'MemberApprovalCount'=>null
                        ]
                    ]);
                }
                if($MemberApprovalCount>0)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'success',
                        'data' => [
                            'MemberReferalCount'=>null,
                            'MemberApprovalCount'=>$MemberApprovalCount
                        ]
                    ]);
                }
                else
                {
                    return $this->respond([
                        'status' => 'failure',
                        'code' => 400,
                        'message' => 'Referals not available',
                        'data' => array()
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
        $Member = Member::orderby('id','desc')->get();
        $MemberCategory = MemberCategory::where('Category_active','Y')->get();
        $created_at = Member::distinct('created_at')->get();
        return view('Member.member_details',compact('Member','created_at','MemberCategory'));
    }

    public function membersearch(Request $request)
    {

        if($request->ajax())
     
        {
     
            $output="";

           
                $members = Member::where('Mobile_No','LIKE','%'.$request->membersearch."%")->orWhere('Email_Id','LIKE','%'.$request->membersearch."%")->orWhere('Member_Id','LIKE','%'.$request->membersearch."%")->first();

                if($request->memberCategory!=null)
                {
                    if($members->Member_Category_Id==$request->memberCategory)
                    {
                        $members = Member::where('Mobile_No','LIKE','%'.$request->membersearch."%")->orWhere('Email_Id','LIKE','%'.$request->membersearch."%")->orWhere('Member_Id','LIKE','%'.$request->membersearch."%")->get();
                    }
                    else
                    {
                        $members =array();
                    }
                }
                else
                {
                    $members = Member::where('Mobile_No','LIKE','%'.$request->membersearch."%")->orWhere('Email_Id','LIKE','%'.$request->membersearch."%")->orWhere('Member_Id','LIKE','%'.$request->membersearch."%")->get();
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
                '<td>'.$member->Address_Line_1.'</td>'.
                '<td>'.$member->Member_Active_Flag.'</td>'.
                '</tr>';
                 
                }  
                return Response($output);
            }

        }
     
    }

    /*Member Deactivation */

    public function MemberDeactivateList()
    {    
        $Member = Member::orderby('id','desc')->get();
        $demembers=Member::Where('Member_Active_Flag','N')->orderby('id','desc')->get();
        return view('Member.member_deactivation',compact('Member','demembers'));
    }

    public function MemberDeactivateSearch(Request $request)
    {
     
        if($request->ajax())
     
        {
     
            $output="";
     
            $members=Member::where('Mobile_NO','LIKE','%'.$request->memberdeactivate."%")->orWhere('Email_Id','LIKE','%'.$request->memberdeactivate."%")->orWhere('Member_Id','LIKE','%'.$request->memberdeactivate."%")->orderby('id','desc')->get();
     
            if($members)
            {
                
                foreach ($members as $key => $member) {
                if($member->Member_Active_Flag=='Y')
                {
                    $output.='<tr>'.
                     
                    '<td>'.$member->First_Name.'</td>'.
                    '<td>'.$member->Email_Id.'</td>'.
                    '<td>'.$member->Mobile_No.'</td>'.
                    '<td>'.$member->Member_Id.'</td>'.
                    '<td>'.$member->Pincode.'</td>'.
                    '<td>'.$member->Address_Line_1.'</td>'.
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
                    '<td>'.$member->Address_Line_1.'</td>'.
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
                        ->update(['Member_Active_Flag'=> 'N']);
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
                        ->update(['Member_Active_Flag'=> 'Y']);
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

   public function Mobile_Verification(Request $request)
    {
        $mobile_number = User::where('mobile_number', $request->mobile_number)->first();

        if($mobile_number)
        {
            return $this->respond([
                'status' => 'success',
                'code' => 200,
                'message' => 'Mobile number already exist',
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


    public function ListMemberPending()
    {
       $member = Member::where('Member_Approved_Flag','N')->orderby('id','desc')->get();
       return view('Member.pendinglist',compact('member'));
    }
    public function MemberPendingFilter(Request $request)
    {
        $member = Member::where('Member_Approved_Flag',$request->status)->orderby('id','desc');
        if($request->updatedDate!=null)
        {
            $member= $member->whereDate('created_at','<=',$request->updatedDate);
            
        }
        else if($request->createdDate!=null)
        {
            $member= $member->whereDate('created_at','>=',$request->createdDate);   
        }
        
        $member = $member->get();
        Log::info($member);
        

        $member = View::make('Member.filter.member_approval_filter', compact('member'))->render();
        return Response::json(['member' => $member]);
    }
 

    public function UpdateMemberApprovalPending(Request $request)
    {
        if($request->member_id!=null){
            if($request->submit == "Approve")
            {
                $MemberUpdate = Member::whereIn('Member_Id',$request->member_id)->update(['Member_Approved_Flag'=>'Y']);
            }
            else if($request->submit == "Reject")
            {
                $MemberUpdate = Member::whereIn('Member_Id',$request->member_id)->update(['Member_Approved_Flag'=>'R']);
            }
        
        return redirect(route('MemberPending.list'));

        }else{
            return \Redirect::back()->withInput()->withWarning( 'Select atleast one member!');
        }
        
    }


   
   
}
