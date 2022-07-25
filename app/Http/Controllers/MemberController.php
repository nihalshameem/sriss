<?php 
namespace App\Http\Controllers;
use App\User;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Requests;
use JWTAuth;
use Response; 
use App\Repository\Transformers\UserTransformer;
use \Illuminate\Http\Response as Res;
use Validator;
use DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Nreceipt;
use App\Areceipt;
use App\Pollquestion;
use App\Pollanswer;
use App\Pollreceipt;
use App\Notification;
use App\Advertisement;
use App\District;
use App\Taluk;
use App\Pin;
use App\Zone;
use App\Aos;
use Carbon\Carbon;
use App\Feedback;
use App\Nfeedback;
use App\Faq;
use App\Country;
use App\State;
use App\Myfamily;
use Auth;
use App\Role;
use App\Donation;
use App\DonationText;
use App\SanadhanamText;
use App\ShoppingText;
use App\memberIdConfig;
use App\Category;
use App\PollFeedback;


class MemberController extends ApiController
{
    /**
     * @var \App\Repository\Transformers\UserTransformer
     * */
    protected $userTransformer;

    public function __construct(userTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }

    /**
     * @description: Api user authenticate method
     * @author: Adelekan David Aderemi
     * @param: email, password
     * @return: Json String response
     */
    
    

    public function authenticate(Request $request)
    {
        $this->email= 
        filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile_number';
        $rules = array ('password' => 'required',);
        $request[$this->email]=$request->input('email');
        
        if($this->email=='email')
        {
            $rules['email']='required|email';
        }else
        {            
            $rules['mobile_number']='required';
        }




        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails()){
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else
        {

            
            // dd($request->all());
            $user=Auth::attempt([$this->email=>$request['email'],'password' => $request['password']]);
            if($user)
            {
                $user = User::where($this->email, $request['email'])->first();
                $api_token = $user['api_token'];

                if($user['api_token'] == NULL)
                {
                        return $this->_login($request['email'], $request['password']);
                }
                else
                {
                    
                    try
                    {
                        $credentials = [$this->email=>$request['email'],'password' => $request['password']];
                        $token = JWTAuth::attempt($credentials);
                        $user->api_token = $token;
                        $user->save();
                        $user = DB::table('users')->where($this->email, $request['email'])->first();
                        return $this->respond([
                            'status' => 'success',
                            'status_code' => $this->getStatusCode(),
                            'message' => 'Already logged in',
                            'data' => $this->userTransformer->transform($user)
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
                return $this->respondWithError("Invalid Username or Password");
            }
        }
    }




    private function _login($email, $password)
    {


        $credentials = [$this->email => $email, 'password' => $password];

        if ( ! $token = JWTAuth::attempt($credentials)) {
            return $this->respondWithError("User does not exist!");
        }
        $user = auth()->user();
        $user->api_token = $token;
        $user->save();
        $user = DB::table('users')->where($this->email,$email)->first();
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'message' => 'Login successful!',
            'data' => $this->userTransformer->transform($user)
        ]);
    }


    private function _loginreg($email, $password)
    {
        $credentials = ['email' => $email, 'password' => $password];

        if ( ! $token = JWTAuth::attempt($credentials)) {
            return $this->respondWithError("User does not exist!");
        }
        $user = JWTAuth::toUser($token);
        $user->api_token = $token;
        $user->save();
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'message' => 'Login successful!',
            'data' => $this->userTransformer->transform($user)
        ]);
    }
    
    public function register(Request $request)
    {
        $rules = array (
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'sex' => 'required',
            'dob' => 'required',
            'country' => 'required',
            'state' => 'required',
            'district' => 'required',
            'pincode' => 'required',
            'address_1' => 'required',
            'mobile_number' => 'required|unique:users',
        );
        
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'mobile_number' => $request['mobile_number'],
                'user_type' => $request['user_type'],
                'password' => \Hash::make($request['password']),
            ]);
            
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->year;
        
        $memberIdFormat = memberIdConfig::where('id','1')->get();
        $memberId = $memberIdFormat[0]['memberIdFormat'];
        
        
        $member_id=$memberId.$month.$year.sprintf("%07d", $user->id);
                            
   
        $user = User::find($user->id);
        $user->member_id = $member_id;
        $user->save();

        $member = Member::create([
            'member_id' => $member_id,
            'name' => $request['name'],
            'email' => $request['email'],
            'email_verification_status' => "false", 
            'sex' => $request['sex'],
            'dob' => $request['dob'],
            'referral_id' => $request['refer_id'],
            'country' => $request['country'],
            'state' => $request['state'],
            'zone' => $request['zone'],
            'district' => $request['district'],
            'taluk' => $request['taluk'],
            'pincode' => $request['pincode'],
            'address_1' => $request['address_1'],
            'mobile_number' => $request['mobile_number'],
            'whatsapp_number' => $request['whatsapp_number'],
        ]);
        $credentials = ['email' => $request['email'], 'password' => $request['password']];

            if ( ! $token = JWTAuth::attempt($credentials)) {
                return $this->respondWithError("User does not exist!");
            }
            $user = JWTAuth::toUser($token);
            $user->api_token = $token;
            $user->save();

             $user = DB::table('users')->where('email', $request['email'])->first();
                        return $this->respond([
                            'status' => 'success',
                            'status_code' => $this->getStatusCode(),
                            'message' => 'Login Successful',
                            'data' => $this->userTransformer->transform($user)
                        ]);
        
    }

    /**
     * @description: Api user logout method
     * @author: Adelekan David Aderemi
     * @param: null
     * @return: Json String response
     */
    
    
    
    
    public function logout(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Logout successfull!',
                    ]);
            }
            else
            {
                $user = User::where('email', $request['email'])->first();
                $user->api_token = null;
                $user->save();
                return $this->respondWithError("Logout Unsuccessfull!");
            }
         }            

    }

    public function is_valid_token($token)
    {
        $user = User::where('api_token', $token)->first();
        return $user;
    
    }


    public function notifications(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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

                $member=User::where('id',$user->id)->first();
                $member_id=$member->member_id;
                $member_detail=Member::where('member_id',$member_id)->first();

                $zone=$member_detail->zone;
                $district=$member_detail->district;
                $taluk=$member_detail->taluk;
                $pin=$member_detail->pincode;

                $nreceipt=Nreceipt::select('notification_id')
                ->distinct('notification_id')
                ->where('active','=', 'yes')
                ->where('district_id','=', $district)
                ->orderBy('notification_id','desc')
                ->get()->toArray();
                
$datas1 = array_map('current', $nreceipt);

$today=Carbon::now()->toDateTimeString();

                $notifications=Notification::select('id')
                ->distinct('id')
                ->where('to_date','>', $today)
                ->orderBy('id','desc')
                ->get()->toArray();
    
$datas2 = array_map('current', $notifications);


$results = array_intersect($datas1, $datas2);

arsort($results);

            if(!empty($results)){
                
                foreach($results as $key=>$value)
                {
                    $notification[]=Notification::select('*')
                    ->where('id', $value)
                    ->get();
                }
                
$data1 = array_map('current', $notification);

$total_notification=count($data1);
                if($data1)
                {
                    return $this->respond([
                    'status' => 'success',
                    'Total' => $total_notification,
                    'status_code' => $this->getStatusCode(),
                    'data'=>array_map('current', $data1),   
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'false',
                    'Total' => $total_notification,                   
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Notification Not Available For Your Profile',
                    ]);
                }
            }else{
                return $this->respond([
                    'status' => 'false',
                    'Total' => '0',                   
                    'status_code' => $this->getStatusCode(),
                    'data'=>array(),
                    ]);
            }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }



    public function advertisements(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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

                $member=User::where('id',$user->id)->first();
                $member_id=$member->member_id;
                $member_detail=Member::where('member_id',$member_id)->first();

                $zone=$member_detail->zone;
                $district=$member_detail->district;
                $taluk=$member_detail->taluk;
                $pin=$member_detail->pincode;

                $areceipt=Areceipt::select('advertisement_id')
                ->distinct('advertisement_id')
                ->where('active','=', 'yes')
                ->where('district_id','=', $district)
                ->orderBy('advertisement_id','desc')
                ->get()->toArray();
$datas1 = array_map('current', $areceipt);

$today=Carbon::now()->toDateTimeString();

                $advertisements=Advertisement::select('id')
                ->distinct('id')
                ->where('to_date','>', $today)
                ->orderBy('id','desc')
                ->get()->toArray();
$datas2 = array_map('current', $advertisements);

$results = array_intersect($datas1, $datas2);
                
                if(!empty($results)){
                    
                foreach($results as $key=>$value)
                {
                    $advertisement[]=Advertisement::select('*')
                    ->where('id', $value)
                    ->get();
                }
$data1 = array_map('current', $advertisement);

                if($data1)
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>array_map('current', $data1),   
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Advertisement Not Available For Your Profile',
                    ]);
                }
                }else{
                return $this->respond([
                    'status' => 'false',
                    'status_code' => $this->getStatusCode(),
                    'data'=>array(),
                    ]);
            }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }



   
   
    public function pollquestions(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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

                $member=User::where('id',$user->id)->first();
                $member_id=$member->member_id;
                $member_detail=Member::where('member_id',$member_id)->first();

                $district=$member_detail->district;

                $pollreceipt=Pollreceipt::select('question_id')
                ->distinct('question_id')
                ->where('district_id','=', $district)
                ->orderBy('question_id','desc')
                ->get()->toArray();

$datas1 = array_map('current', $pollreceipt);

$today=Carbon::now()->toDateTimeString();

                $pollquestions=Pollquestion::select('id')
                ->distinct('id')
                ->where('to_date','>', $today)
                ->orderBy('id','desc')
                ->get()->toArray();

$datas2 = array_map('current', $pollquestions);

$results = array_intersect($datas1, $datas2);

                if(!empty($results)){
                    
                foreach($results as $key=>$value)
                {
                    $pollquestion[]=Pollquestion::select('*')
                    ->where('id', $value)
                    ->get();
                }
$data1 = array_map('current', $pollquestion);
                if($data1)
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>array_map('current', $data1),   
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Polls Not Available For Your Profile',
                    ]);
                }
                }else{
                return $this->respond([
                    'status' => 'false',
                    'status_code' => $this->getStatusCode(),
                    'data'=>array(),
                    ]);
            }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }
   

    
    public function pollanswers(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
            'token' => 'required',
            'question_id' => 'required',
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

            $pollanswer = Pollanswer::where('question_id', $request->question_id)->get();
            

                if($pollanswer)
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>$pollanswer,   
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Not match the question.',
                    ]);
                }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }

    public function pollanswersdetails(Request $request)
    {
        $rules = array (         
            'question_id' => 'required',
            );

        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails())
        {
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else
        {
            $pollanswerpercentage = Pollanswer::where('question_id', $request->question_id)->get();

                if($pollanswerpercentage)
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>$pollanswerpercentage,   
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Not match the question.',
                    ]);
                }    
        }
    }


    public function zones(Request $request)
    {
        $zones = Zone::select('zone')
            ->orderBy('id', 'ASC')->get();
        
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$zones,   
                ]);
    }


    public function districts(Request $request)
    {
        $districts = District::select('district','zoneid','state_id' )
            ->orderBy('id', 'ASC')->get();
        
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$districts,   
                ]);
    }

    public function taluks(Request $request)
    {
        $taluks = Taluk::select('taluk','distid' )
            ->orderBy('id', 'ASC')->get();
        
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$taluks,   
                ]);
    }

    public function pins(Request $request)
    {
        $pins = Pin::select('pin','talukid' )
            ->orderBy('id', 'ASC')->get();
        
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$pins,   
                ]);
    }
    
    public function aos(Request $request)
    {
        
    $today=Carbon::now()->toDateTimeString();
        
        $aos = Aos::select('*')
        ->where('active','yes')
        ->where('from_date','<=', $today)
        ->where('to_date','>=', $today)
        ->orderBy('id', 'DESC')->get()->toArray();
    $total_aos=count($aos);

        if(!empty($aos)){
        return $this->respond([
                'status' => 'true',
                'Total' => $total_aos,
                'status_code' => $this->getStatusCode(),
                'data'=>$aos,   
                ]);
        }else{
            return $this->respond([
                'status' => 'false',
                'Total' => '0',
                'status_code' => $this->getStatusCode(),
                'data'=>$aos,   
                ]);   
        }
    }
    
    public function feedback(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
            'token' => 'required',
            'description' => 'required',
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
                
            $date=Carbon::now()->toDateTimeString();

            $feedback = Feedback::create([
            'member_id' => $user->member_id,
            'description' => $request['description'],
            'date' => $date,
   
            ]);
            
            return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'message' => $feedback,
              ]);
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            } 
        }
    }
    
    
    public function referral(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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
                $member_details=Member::select('name','email','member_id','profile_picture')->where('referral_id',$user->mobile_number)->get()->toArray();
                
                $myReferralCount = count($member_details);

                
                if(!empty($member_details))
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'myReferralCount' => $myReferralCount,
                    'data'=>$member_details,   
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'false',
                    'status_code' => $this->getStatusCode(),
                    'myReferralCount' => '0',
                    'date' => $member_details,
                    ]);
                }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }
    
    public function notification_feedback(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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
                
            $date=Carbon::now()->toDateTimeString();
            $nfeedback = Nfeedback::create([
            'member_id' => $user->member_id,
            'notification_id' => $request['notification_id'],
            'description' => $request['description'],
            'date' => $date,
   
            ]);
            if($nfeedback)
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>$nfeedback,   
                    ]);
                }
                
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }

        }
    }
    
    // public function poll_feedback(Request $request)
    // {
    //     $rules = array (
    //         'email' => 'required|email',
    //         'token' => 'required',
    //         'response_id' => 'required',
    //         );


    //     $validator = Validator::make($request->all(), $rules);
    //     if ($validator-> fails())
    //     {
    //         return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
    //     }

    //     else
    //     {           

    //         if($user=$this->is_valid_token($request['token']))
    //         {  
    //             if(isset($request['response_id'])){
    //                 Pollanswer::where('id', $request['response_id'])->update([
    //                     'response_count'=> DB::raw('response_count+1'), 
    //                     'updated_at' => Carbon::now()
    //                 ]);

    //                 return $this->respond([
    //                 'status' => 'success',
    //                 'status_code' => $this->getStatusCode(),
    //                 'data'=>'Your Poll Submitted Successfully.',   
    //                 ]);
    //             }else
    //             {
    //                 return $this->respond([
    //                 'status' => 'false',
    //                 'status_code' => $this->getStatusCode(),
    //                 'message' => 'Your Poll is Rejected',
    //                 ]);
    //             }

    //         }else
    //         {
    //             return $this->respondTokenError("Token Mismatched");
    //         }

    //     }
    // }
    
    
    
    public function poll_feedback(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
            'token' => 'required',
            'response_id' => 'required',
            'question_id' => 'required',
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
                
                $questionId = $request['question_id'];
                $feedbackExist = PollFeedback::where('questionId',$questionId)->where('emailId',$request['email'])->first();
            if($feedbackExist == null){
                if(isset($request['response_id'])){
                    Pollanswer::where('id', $request['response_id'])->update([
                        'response_count'=> DB::raw('response_count+1'), 
                        'updated_at' => Carbon::now()
                    ]);

                    $memId = Member::where('email',$request['email'])->first();

                    $pollFeedback = New PollFeedback;
                    $pollFeedback->memberId = $memId['member_id'];
                    $pollFeedback->emailId = $request['email'];
                    $pollFeedback->questionId = $request['question_id'];
                    $pollFeedback->responseId = $request['response_id'];
                    $pollFeedback->save();

                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>'Your Poll Submitted Successfully.',   
                    ]);
                }
            }

                else
                {
                    return $this->respond([
                    'status' => 'false',
                    'status_code' => $this->getStatusCode(),
                    'data' => 'You are already answered this question...',
                    ]);
                }

            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }

        }
    }
    
    
     public function vision(Request $request)
    {
        $vision = Faq::where('id','1')
            ->orderBy('id', 'ASC')->get();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$vision,   
                ]);
    }


    public function why_factor(Request $request)
    {
        $why_factor = Faq::where('id','2')
            ->orderBy('id', 'ASC')->get();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$why_factor,   
                ]);
    }


    public function faq(Request $request)
    {
        $faq = Faq::where('id','3')
            ->orderBy('id', 'ASC')->get();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$faq,   
                ]);
    }
    
    public function termsandcondition(Request $request)
    {
        $tac = Faq::where('id','4')
            ->orderBy('id', 'ASC')->get();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$tac,   
                ]);
    }

    public function privacypolicy(Request $request)
    {
        $privacypolicy = Faq::where('id','5')
            ->orderBy('id', 'ASC')->get();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$privacypolicy,   
                ]);
    }
    
    public function idcardvision(Request $request)
    {
        $idcardvision = Faq::where('id','6')
            ->orderBy('id', 'ASC')->get();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$idcardvision,   
                ]);
    }
    
    public function country(Request $request)
    {
        $country = Country::all();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$country,   
                ]);
    }
    
    public function state(Request $request)
    {
        $state = State::all();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$state,   
                ]);
    }
    
    
    
    public function forget_password(Request $request)
    {
       $rules = array (
            'mobile_number' => 'required',
            'password' => 'required',
            );

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator-> fails())
        {
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }else
            {

            $user = User::where([
            ['mobile_number', $request->mobile_number],
            ])->first();
        
                if ($user)
                { 
                $user->password = bcrypt($request->password);
                $user->save();
                return $this->respond([
                            'status' => 'success',
                            'status_code' => $this->getStatusCode(),
                            'data'=>'Your Password Updated Successfully.',   
                            ]);
                }else
                    {
                        return $this->respond([
                        'status' => 'false',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Your mobile number not match  ',
                        ]);
                    }
            }
    }
    
    
    public function myfamily(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
            'token' => 'required',
            'father' => 'required',
            'mother' => 'required',
            'active' => 'required',
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
                
                
            
        if($request->ggfather_image){
        $ggfather_img=$request->ggfather_image->getClientOriginalName('public/upload/');
        $request->ggfather_image->storeAs('public/upload/myfamily/ggfather',$ggfather_img);
    }
    if($request->gfather_image){
        $gfather_img=$request->gfather_image->getClientOriginalName('public/upload');
        $request->gfather_image->storeAs('public/upload/myfamily/gfather',$gfather_img);
    }
    if($request->father_image){
        $father_img=$request->father_image->getClientOriginalName('public/upload');
        $request->father_image->storeAs('public/upload/myfamily/father',$father_img);
    }
    if($request->ggmother_image){
        $ggmother_img=$request->ggmother_image->getClientOriginalName('public/upload');
        $request->ggmother_image->storeAs('public/upload/myfamily/ggmother',$ggmother_img);
    }
    if($request->gmother_image){
        $gmother_img=$request->gmother_image->getClientOriginalName('public/upload');
        $request->gmother_image->storeAs('public/upload/myfamily/gmother',$gmother_img);
    }
    if($request->mother_image){
        $mother_img=$request->mother_image->getClientOriginalName('public/upload');
        $request->mother_image->storeAs('public/upload/myfamily/mother',$mother_img);
    }


    $myfamily = new Myfamily;

    if($request->ggfather_image){
    $myfamily->ggfather_image = 'sriss.in/storage/app/public/upload/myfamily/ggfather/'.$ggfather_img;
    }else{
        $myfamily->ggfather_image=NULL;
    }
    if($request->gfather_image){
    $myfamily->gfather_image = 'sriss.in/storage/app/public/upload/myfamily/gfather/'.$gfather_img;
    }else{
        $myfamily->gfather_image=NULL;
    }
    if($request->father_image){
    $myfamily->father_image = 'sriss.in/storage/app/public/upload/myfamily/father/'.$father_img;
    }else{
        $myfamily->father_image=NULL;
    }
    if($request->ggmother_image){
    $myfamily->ggmother_image = 'sriss.in/storage/app/public/upload/myfamily/ggmother/'.$ggmother_img;
    }else{
        $myfamily->ggmother_image=NULL;
    }
    if($request->gmother_image){
    $myfamily->gmother_image = 'sriss.in/storage/app/public/upload/myfamily/gmother/'.$gmother_img;
    }
    else{
        $myfamily->gmother_image=NULL;
    }
    if($request->mother_image){
    $myfamily->mother_image = 'sriss.in/storage/app/public/upload/myfamily/mother/'.$mother_img;
    }else{
        $myfamily->mother_image=NULL;
    }         

    $myfamily->name = $user->name;
    $myfamily->member_id = $user->member_id;
    $myfamily->email = $user->email;
    $myfamily->ggfather = $request['ggfather'];
    $myfamily->ggmother = $request['ggmother'];
    $myfamily->gfather = $request['gfather'];
    $myfamily->gmother = $request['gmother'];
    $myfamily->father = $request['father'];
    $myfamily->mother = $request['mother'];
    $myfamily->ggfather_dob = $request['ggfather_dob'];
    $myfamily->ggmother_dob = $request['ggmother_dob'];
    $myfamily->gfather_dob = $request['gfather_dob'];
    $myfamily->gmother_dob = $request['gmother_dob'];
    $myfamily->father_dob = $request['father_dob'];
    $myfamily->mother_dob = $request['mother_dob'];
    $myfamily->active = 'yes';
    $myfamily->save();
                
        $user = User::where("email", "=",$request['email'])->first();
        
         if($request['father']){
                    $user->family = 'yes';
                    $user->save();
         }
                
                
                if($myfamily)
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>$myfamily,   
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Update your family details details',
                    ]);
                }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }


    public function myfamily_details(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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

            $myfamily = Myfamily::where([
               ['email', $request->email],
               ])->first();
            
            $active=$myfamily->active;
          

                if($active == 'yes')
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>$myfamily,   
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Update your family details details',
                    ]);
                }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }
    
    
    public function myfamilyupdate(Request $request)
    {

        $rules = array (
            
            'email' => 'required',
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
                   
                   
                    if($request->ggfather_image){
                        $ggfather_img=$request->ggfather_image->getClientOriginalName('public/upload/');
                        $request->ggfather_image->storeAs('public/upload/myfamily/ggfather',$ggfather_img);
                    }
                    if($request->gfather_image){
                        $gfather_img=$request->gfather_image->getClientOriginalName('public/upload');
                        $request->gfather_image->storeAs('public/upload/myfamily/gfather',$gfather_img);
                    }
                    if($request->father_image){
                        $father_img=$request->father_image->getClientOriginalName('public/upload');
                        $request->father_image->storeAs('public/upload/myfamily/father',$father_img);
                    }
                    if($request->ggmother_image){
                        $ggmother_img=$request->ggmother_image->getClientOriginalName('public/upload');
                        $request->ggmother_image->storeAs('public/upload/myfamily/ggmother',$ggmother_img);
                    }
                    if($request->gmother_image){
                        $gmother_img=$request->gmother_image->getClientOriginalName('public/upload');
                        $request->gmother_image->storeAs('public/upload/myfamily/gmother',$gmother_img);
                    }
                    if($request->mother_image){
                        $mother_img=$request->mother_image->getClientOriginalName('public/upload');
                        $request->mother_image->storeAs('public/upload/myfamily/mother',$mother_img);
                    }
                    
                    
                    
                    $members = Myfamily::where("email", "=",$request['email'])->first();
                    
                    if($request['ggfather']){
                    $members->ggfather = $request['ggfather'];
                    }
                    if($request['ggmother']){
                    $members->ggmother = $request['ggmother'];
                    }
                    
                    if($request['gfather']){
                    $members->gfather = $request['gfather'];
                    }
                    
                    if($request['gmother']){
                    $members->gmother = $request['gmother'];
                    }
                    
                    if($request['father']){
                    $members->father = $request['father'];
                    }
                    
                    if($request['mother']){
                    $members->mother = $request['mother'];
                    }
                    
                    if($request['ggfather_dob']){
                    $members->ggfather_dob = $request['ggfather_dob'];
                    }
                    
                    if($request['ggmother_dob']){
                    $members->ggmother_dob = $request['ggmother_dob'];
                    }
                    
                    if($request['gfather_dob']){
                    $members->gfather_dob = $request['gfather_dob'];
                    }
                    
                    if($request['gmother_dob']){
                    $members->gmother_dob = $request['gmother_dob'];
                    }
                    
                    if($request['father_dob']){
                    $members->father_dob = $request['father_dob'];
                    }
                    
                    if($request['mother_dob']){
                    $members->mother_dob = $request['mother_dob'];
                    }
                    
                    
                    
                    if($request['ggfather_image']){
                    $members->ggfather_image = 'sriss.in/storage/app/public/upload/myfamily/ggfather/'.$ggfather_img;
                    }
                    if($request['ggmother_image']){
                    $members->ggmother_image = 'sriss.in/storage/app/public/upload/myfamily/ggmother/'.$ggmother_img;
                    }
                    
                    if($request['gfather_image']){
                    $members->gfather_image = 'sriss.in/storage/app/public/upload/myfamily/gfather/'.$gfather_img;
                    }
                    
                    if($request['gmother_image']){
                    $members->gmother_image = 'sriss.in/storage/app/public/upload/myfamily/gmother/'.$gmother_img;
                    }
                    
                    if($request['father_image']){
                    $members->father_image = 'sriss.in/storage/app/public/upload/myfamily/father/'.$father_img;
                    }
                    
                    if($request['mother_image']){
                    $members->mother_image = 'sriss.in/storage/app/public/upload/myfamily/mother/'.$mother_img;
                    }
                    
                     
                    $user = User::where("email", "=",$request['email'])->first();
                    
                    if($members->save())
                    {
                    $user->family = 'yes';
                    $user->save();
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
    
   public function member_edit()
    {    
        $members['members']=Member::all();
        $demembers['demembers']=Member::where('active_flag','no')->get();
        return view('member_edit',$members,$demembers);
    }

    public function member_deactivation(Request $request)
    {
        
        $this->validate($request, [
            'deactivate_reason'             => 'required',
            'mobile_number'                 => 'required',
            'active_flag'             => 'required',
        ]
        );

        $member = DB::table('members')
            ->where("mobile_number", '=', $request->mobile_number)
            ->orWhere("member_id", '=', $request->mobile_number)
            ->update(['active_flag'=> $request->active_flag, 'deactivate_reason'=> $request->deactivate_reason]);
            if($member){

               return redirect('/member_edit');
            
            }else{

                return redirect('/member_edit');
           }
    }
    
    public function user_roles_assign()
    {    
        $members['members']=User::all();
        $roles['roles']=Role::all();
        $users = User::where('user_type','!=','MEMBER')->get()->toArray();

        return view('user_roles_assign',$members,$roles);
    }

    public function roll_assignment(Request $request)
    {

        $this->validate($request, [
            'roles'                 => 'required',
            'mobile_number'                 => 'required',
        ]
        );
        $user = User::where('mobile_number',$request->mobile_number)->get();
        $roles= implode(',',$request->roles);

        $user = DB::table('users')
            ->where("mobile_number", '=', $request->mobile_number)
            ->orWhere("member_id", '=', $request->mobile_number)
            ->update(['user_type'=> $roles]);

        return redirect()->back()->with('rolesuccess', 'Roll assigned success!');
    }
    
    public function countrystate(Request $request)
    {
        $rules = array (

            'country_id' => 'required',
            );

        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails())
        {
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else{
            $countrystate = State::where('country_id',$request->country_id)
            ->orderBy('id', 'ASC')->get();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$countrystate,   
                ]);
        }
    }

    public function statedistrict(Request $request)
    {
        $rules = array (

            'state_id' => 'required',
            );

        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails())
        {
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else{
            $statedistrict = District::where('state_id',$request->state_id)
            ->orderBy('district', 'ASC')->get();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$statedistrict,   
                ]);
        }
    }

    public function districtarea(Request $request)
    {
        $rules = array (

            'district_id' => 'required',
            );

        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails())
        {
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else{
            $districtarea = Taluk::where('distid',$request->district_id)
            ->orderBy('id', 'ASC')->get();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$districtarea,   
                ]);
        }
    }
    
    
    public function registerdetails(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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

                $register = Member::select('name','email','member_id','sex','dob','referral_id','country','state','zone','district','taluk','pincode','address_1','mobile_number','whatsapp_number')->where('email', $request->email)->first();
                
                if($register)
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>$register,   
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Update your details',
                    ]);
                }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }
    
    public function profiledetails(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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

                $profile = Member::where('email', $request->email)->first();

                if($profile)
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>$profile,   
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Profile not match',
                    ]);
                }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }
    
    
    
    public function religionupdate(Request $request)
    {

        $rules = array (
            
            'email' => 'required',
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
                    
                    $members = Member::where("email", "=",$request['email'])->first();
                    
                    if($request['religion']){
                    $members->religion = $request['religion'];
                    }
                    
                    if($request['caste']){
                    $members->caste = $request['caste'];
                    }
                    
                    if($request['subsect_1']){
                    $members->subsect_1 = $request['subsect_1'];
                    }
                    
                    if($request['subsect_2']){
                    $members->subsect_2 = $request['subsect_2'];
                    }
                    
                    if($request['aacharyan']){
                    $members->aacharyan = $request['aacharyan'];
                    }
                    
                    if($request['mutt']){
                    $members->mutt = $request['mutt'];
                    }
                    
                    if($members->save())
                    {
                        $update = DB::table('users')
                            ->where("email", '=',  $request->email)
                            ->update(['religion'=> 'yes']);
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
    
    
    public function maritalupdate(Request $request)
    {

        $rules = array (
            
            'email' => 'required',
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
                    
                    $members = Member::where("email", "=",$request['email'])->first();
                    
                    if($request['marital_status']){
                    $members->marital_status = $request['marital_status'];
                    }
                    
                    if($request['wedding_date']){
                    $members->wedding_date = $request['wedding_date'];
                    }
                    
                    if($request['spouse_name']){
                    $members->spouse_name = $request['spouse_name'];
                    }
                    
                    if($request['spouse_dob']){
                    $members->spouse_dob = $request['spouse_dob'];
                    }
                    
                    if($members->save())
                    {
                        $update = DB::table('users')
                            ->where("email", '=',  $request->email)
                            ->update(['marital'=> 'yes']);
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
    
    
    public function professionupdate(Request $request)
    {

        $rules = array (
            
            'email' => 'required',
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
                    
                    $members = Member::where("email", "=",$request['email'])->first();
                    
                    
                    if($request['volunteer_int']){
                    $members->volunteer_int = $request['volunteer_int'];
                    }
                    
                    if($request['donate_int']){
                    $members->donate_int = $request['donate_int'];
                    }
                    
                    if($members->save())
                    {
                        $update = DB::table('users')
                            ->where("email", '=',  $request->email)
                            ->update(['profession'=> 'yes']);
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
    
    
    
    public function profilepictureupdate(Request $request)
    {

        $rules = array (
            
            'email' => 'required',
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
                    
                    $members = Member::where("email", "=",$request['email'])->first();
                    
        if($request->profile){
            $filename=$request->profile->getClientOriginalName('public/upload');
            $request->profile->storeAs('public/upload/profile',$filename);
        }

                $members->profile_picture ='sriss.in/storage/app/public/upload/profile/'.$filename;
                    
                    if($members->save())
                    {
                        return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Profile Updated',
                        'data'=>$members->profile_picture,
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
    
    
    public function myprofilepicture(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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

                $myprofilepicture = Member::select('profile_picture')->where('email', $request->email)->first();
                
                if($myprofilepicture)
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>$myprofilepicture,   
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Update your profile picture',
                    ]);
                }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }
    
    
    
    public function idcardupdate(Request $request)
    {

        $rules = array (
            
            'email' => 'required',
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
                    
                    $members = Member::where("email", "=",$request['email'])->first();
                    
        if($request->idcard){
            $filename=$request->idcard->getClientOriginalName('public/upload');
            $request->idcard->storeAs('public/upload/idcard',$filename);
        }

                $members->id_card ='sriss.in/storage/app/public/upload/idcard/'.$filename;
                    
                    if($members->save())
                    {
                        return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Profile Updated',
                        'data'=>$members->id_card,
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
    
    
    public function religiondetails(Request $request)
    {

        $rules = array (
            
            'email' => 'required',
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
                    
                    $religiondetails = Member::select('religion','caste','subsect_1','subsect_2','aacharyan','mutt')->where('email', $request->email)->first();
                    
                    if($religiondetails)
                    {
                        return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Profile Updated',
                        'data'=>$religiondetails
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
    
    public function maritaldetails(Request $request)
    {

        $rules = array (
            
            'email' => 'required',
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



                    
                    $maritaldetails = Member::select('marital_status','wedding_date','spouse_name','spouse_dob')->where('email', $request->email)->first();
                    
                    if($maritaldetails)
                    {
                        return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Profile Updated',
                        'data'=>$maritaldetails
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
    
     public function professiondetails(Request $request)
    {

        $rules = array (
            
            'email' => 'required',
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
                    
                    $professiondetails = Member::select('profession','volunteer_int','donate_int')->where('email', $request->email)->first();
                    
                    if($professiondetails)
                    {
                        return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Profile Updated',
                        'data'=>$professiondetails
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
    
    
    public function profileupdate(Request $request)
    {

        $rules = array (
            
            'email' => 'required',
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
                    
                    $members = Member::where("email", "=",$request['email'])->first();
                    
                    if($request['address_1']){
                    $members->address_1 = $request['address_1'];
                    }
                    
                    if($request['address_2']){
                    $members->address_2 = $request['address_2'];
                    }
                    
                    if($request['email_verification_status']){
                    $members->email_verification_status = $request['email_verification_status'];
                    }
 
                    
                    if($request['country']){
                    $members->country = $request['country'];
                    }
                    
                    if($request['state']){
                    $members->state = $request['state'];
                    }
                    
                    if($request['zone']){
                    $members->zone = $request['zone'];
                    }
                    
                    if($request['district']){
                    $members->district = $request['district'];
                    }
                    
                    if($request['whatsapp_number']){
                    $members->whatsapp_number = $request['whatsapp_number'];
                    }
                    
                    if($request['landline_number']){
                    $members->landline_number = $request['landline_number'];
                    }
                    
                    if($request['sex']){
                    $members->sex = $request['sex'];
                    }
                    
                    if($request['dob']){
                    $members->dob = $request['dob'];
                    }
                    
                    if($request['profession']){
                    $members->profession = $request['profession'];
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
    
    
    
    public function profileCompletionPercentageUpdate(Request $request)
    {

        $rules = array (
            
            'email' => 'required',
            'token'=>'required',
            'percentage'=>'required',
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
                    
                    $members = Member::where("email", "=",$request['email'])->first();
                    
                    if($request['percentage']){
                    $members->profile_completion_percentage = $request['percentage'];
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
    
    public function mobileverification(Request $request)
    {
        $rules = array (
            
            'mobile_number' => 'required',
            
            );

        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails())
        {
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else
        {

                $mobile_number = User::where('mobile_number', $request->mobile_number)->first();

                if($mobile_number)
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message'=>'This is a valid mobile number.',   
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'Failed',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Mobile number Does not exist.',
                    ]);
                }
        }
    }
    
    
    public function idcarddetails(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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

                $member=Member::where('email',$user->email)->first();
                
                $country_id=$member->country;
                $state_id=$member->state;
                $zone_id=$member->zone;
                $district_id=$member->district;
                $country=Country::where('id',$country_id)->first();
                $countryname=$country->Name;

                $state=State::where('id',$state_id)->first();
                $statename=$state->Name;

                $zone=Zone::where('id',$zone_id)->first();
                $zonename=$zone->zone;

                $district=District::where('id',$district_id)->first();
                $districtname=$district->district;

                $address=$member->address_1;

                if($user)
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>array(['country'=> $countryname,'state'=>$statename,'zone'=>$zonename,'district'=>$districtname,'address'=>$address]),
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'false',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Notification Not Available For Your Profile',
                    ]);
                }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }
    
    public function member_details()
    {    
        $members['members']=Member::all();
        return view('member_details',$members);
    }


    public function membersearch(Request $request)
     
    {
     
    if($request->ajax())
     
    {
     
    $output="";
     
    $products=DB::table('members')->where('mobile_number','LIKE','%'.$request->membersearch."%")->orWhere('email','LIKE','%'.$request->membersearch."%")->orWhere('member_id','LIKE','%'.$request->membersearch."%")->get();
     
    if($products)
     
    {
     
    foreach ($products as $key => $product) {
     
    $output.='<tr>'.
     
    '<td>'.$product->name.'</td>'.
    '<td>'.$product->email.'</td>'.
    '<td>'.$product->mobile_number.'</td>'.
    '<td>'.$product->member_id.'</td>'.
    '<td>'.$product->address_1.'</td>'.
    '<td style="text-align:center;width:250px">'.$product->profile_completion_percentage.'%</td>'.
    '</tr>';
     
    }
      
    return Response($output);
     
       }

       }
     
    }
    
    
    public function generalprofilecompletion(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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

                $member=Member::where('email',$user->email)->first();
                
                $member_id = $name = $email = $address_1 = $country = $state = $zone = $district = $pincode = $mobile_number = $sex = $dob = $profession = 1;

        $general_profile_initial = $member_id + $name + $email + $address_1 + $country + $state + $zone + $district + $pincode + $mobile_number + $sex + $dob + $profession ;

                $member_id=$member->member_id;
                $name=$member->name;
                $email=$member->email;
                $address_1=$member->address_1;
                $country=$member->country;
                $state=$member->state;
                $zone=$member->zone;
                $district=$member->district;
                $pincode=$member->pincode;
                $mobile_number=$member->mobile_number;
                $sex=$member->sex;
                $dob=$member->dob;
                $profession=$member->profession;

                if($member_id != "" || $member_id != NULL){
                    $member_id_status = 1;
                }else{
                    $member_id_status = 0;
                }

                if($name != "" || $name != NULL){
                    $name_status = 1;
                }else{
                    $name_status = 0;
                }

                if($email != "" || $email != NULL){
                    $email_status = 1;
                }else{
                    $email_status = 0;
                }

                if($address_1 != "" || $address_1 != NULL){
                    $address_1_status = 1;
                }else{
                    $address_1_status = 0;
                }

                if($country != "" || $country != NULL){
                    $country_status = 1;
                }else{
                    $country_status = 0;
                }

                if($state != "" || $state != NULL){
                    $state_status = 1;
                }else{
                    $state_status = 0;
                }

                if($district != "" || $district != NULL){
                    $district_status = 1;
                }else{
                    $district_status = 0;
                }

                if($zone != "" || $zone != NULL){
                    $zone_status = 1;
                }else{
                    $zone_status = 0;
                }

                if($pincode != "" || $pincode != NULL){
                    $pincode_status = 1;
                }else{
                    $pincode_status = 0;
                }

                if($mobile_number != "" || $mobile_number != NULL){
                    $mobile_number_status = 1;
                }else{
                    $mobile_number_status = 0;
                }

                if($sex != "" || $sex != NULL){
                    $sex_status = 1;
                }else{
                    $sex_status = 0;
                }

                if($dob != "" || $dob != NULL){
                    $dob_status = 1;
                }else{
                    $dob_status = 0;
                }

                if($profession != "" || $profession != NULL){
                    $profession_status = 1;
                }else{
                    $profession_status = 0;
                }

        $general_profile_status = $member_id_status + $name_status + $email_status + $address_1_status + $country_status + $state_status + $zone_status + $district_status + $pincode_status + $mobile_number_status + $sex_status + $dob_status + $profession_status ;

        $percentage = number_format(($general_profile_status/$general_profile_initial) * 100)."%";


                if($percentage == "100%")
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>$percentage,
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'false',
                    'status_code' => $this->getStatusCode(),
                    'data' => $percentage,
                    ]);
                }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }
    
    public function religionprofilecompletion(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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

                $member=Member::where('email',$user->email)->first();
                
                $religion = $caste = $subsect_1 = $subsect_2 = $aacharyan = $mutt = 1;

        $religion_profile_initial = $religion + $caste + $subsect_1 + $subsect_2 + $aacharyan + $mutt;

                $religion=$member->religion;
                $caste=$member->caste;
                $subsect_1=$member->subsect_1;
                $subsect_2=$member->subsect_2;
                $aacharyan=$member->aacharyan;
                $mutt=$member->mutt;

                if($religion != "" || $religion != NULL){
                    $religion_status = 1;
                }else{
                    $religion_status = 0;
                }

                if($caste != "" || $caste != NULL){
                    $caste_status = 1;
                }else{
                    $caste_status = 0;
                }

                if($subsect_1 != "" || $subsect_1 != NULL){
                    $subsect_1_status = 1;
                }else{
                    $subsect_1_status = 0;
                }
                
                 if($subsect_2 != "" || $subsect_2 != NULL){
                    $subsect_2_status = 1;
                }else{
                    $subsect_2_status = 0;
                }

                if($aacharyan != "" || $aacharyan != NULL){
                    $aacharyan_status = 1;
                }else{
                    $aacharyan_status = 0;
                }

                if($mutt != "" || $mutt != NULL){
                    $mutt_status = 1;
                }else{
                    $mutt_status = 0;
                }


        $religion_profile_status = $religion_status + $caste_status + $subsect_1_status + $subsect_2_status + $aacharyan_status + $mutt_status;

        $percentage = number_format(($religion_profile_status/$religion_profile_initial) * 100)."%";


                if($percentage == "100%")
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>$percentage,
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'false',
                    'status_code' => $this->getStatusCode(),
                    'data' => $percentage,
                    ]);
                }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }
    
    
    public function familyprofilecompletion(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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

                $member=Member::where('email',$user->email)->first();
                
                $marital = $member->marital_status;
                
                if( $marital != "Yes"){
                    $percentage = "100%";
                }
                
                if( $marital != "No"){
                    
                $wedding_date = $spouse_name = $spouse_dob = 1;

        $family_profile_initial = $wedding_date + $spouse_name + $spouse_dob ;

                $wedding_date=$member->wedding_date;
                $spouse_name=$member->spouse_name;
                $spouse_dob=$member->spouse_dob;

                if($wedding_date != "" || $wedding_date != NULL){
                    $wedding_date_status = 1;
                }else{
                    $wedding_date_status = 0;
                }

                if($spouse_name != "" || $spouse_name != NULL){
                    $spouse_name_status = 1;
                }else{
                   $spouse_name_status = 0;
                }

                if($spouse_dob != "" || $spouse_dob != NULL){
                    $spouse_dob_status = 1;
                }else{
                    $spouse_dob_status = 0;
                }

        $family_profile_status = $wedding_date_status + $spouse_name_status + $spouse_dob_status;

        $percentage = number_format(($family_profile_status/$family_profile_initial) * 100)."%";

            }
                
                if($percentage == "100%")
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>$percentage,
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'false',
                    'status_code' => $this->getStatusCode(),
                    'data' => $percentage,
                    ]);
                }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }
    
    
    public function donations(Request $request)
    {
        $rules = array (
            'member_id'   => 'required',
            'category'    => 'required',
            'subcategory' => 'required',
            'amount'      => 'required',
            'status'      => 'required',
            );

        $validator = Validator::make($request->all(), $rules);

        if ($validator-> fails())
        {
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else
        {   
           
            $donations = Donation::create([
                'member_id' => $request['member_id'],
                'category' => $request['category'],
                'subcategory' => $request['subcategory'],
                'amount' => $request['amount'],
                'status' => $request['status'],
            ]);

            return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'data' => $donations,
              ]);
            }
        }


    public function donationupdate(Request $request)
    {
        $this->validate($request, [
            'member_id'   => 'required',
            'status'      => 'required',
        ]
        );

        $donation = Donation::where('member_id',$request->member_id)->get();

        $donationupdate = DB::table('donations')
            ->where("member_id", '=', $request->member_id)
            ->update(['status'=> $request->status]);
   
            return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'data' => $donation,
              ]);
       
    }
        
        public function getMemberByMobile1(Request $request) {

                $member = DB::table("users")->where("mobile_number",$request->mobile_number)->get();

                return response()->json($member);

            }
            
        public function getMemberByMemberId1(Request $request) {

            $member = DB::table("users")->where("member_id",$request->member_id)->get();

            return response()->json($member);

        }
        
        
        
    public function donationCategory(Request $request)
    {
         $category = Category::where('type_id','1')->where('category','!=',"")->orderBy('id', 'ASC')->get();
        
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$category,   
                ]);
    }
    
    
    public function donationText(Request $request)
    {
        
        $this->validate($request, [
            'categoryId'   => 'required',
        ]
        );
        
        $donations = DonationText::where('category',$request->categoryId)->orderBy('id', 'ASC')->get();
        foreach($donations as $key=>$donate){
            $subCategory = Category::find($donate['subcategory']);
            $donations[$key]['subCategoryName'] = $subCategory['sub_category'];
            $donations[$key]['keyvalue'] = $subCategory['keyvalue'];
        }
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$donations,   
                ]);
    }
    
    
    public function shoppingCategory(Request $request)
    {
         $category = Category::where('type_id','3')->where('category','!=',"")->orderBy('id', 'ASC')->get();
        
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$category,   
                ]);
    }
    
    
    
    public function shoppingSubCategory(Request $request)
    {
        
        $this->validate($request, [
            'categoryId'   => 'required',
        ]
        );
        
        $category = ShoppingText::where('category',$request->categoryId)->orderBy('id', 'ASC')->get();

        foreach($category as $key=>$value){
            $subCategoryId[] =  $value['subcategory'];
        }
        $subCategoryId = array_unique($subCategoryId);

    $users = DB::table('categories')->whereIn('id', $subCategoryId)->get();

        
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$users,   
                ]);
    }


    public function shoppingcartText(Request $request)
    {
        
        $this->validate($request, [
            'subCategoryId'   => 'required',
        ]
        );

        $shopping =ShoppingText::where('subcategory',$request->subCategoryId)->orderBy('id', 'ASC')->get();

        foreach($shopping as $key=>$value){
            $subCategory = Category::find($value['subcategory']);
            $shopping[$key]['subCategoryName'] = $value['sub_category'];
        }
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$shopping,   
                ]);
    }
    
    public function shoppingProduct(Request $request)
    {
         $this->validate($request, [
            'id'   => 'required',
        ]
        );
        $shopping = ShoppingText::find($request->id);
        
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$shopping,   
                ]);
    }
    
    
    
    
    public function sanadhanamCategory(Request $request)
    {
         $category = Category::where('type_id','2')->where('category','!=',"")->orderBy('id', 'ASC')->get();

        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$category,   
                ]);
    }
    
    
    
    public function sanadhanamSubCategory(Request $request)
    {
        
        $this->validate($request, [
            'categoryId'   => 'required',
        ]
        );
        
        $category = SanadhanamText::where('category',$request->categoryId)->orderBy('id', 'ASC')->get();

    
    if(count($category) > 0){
        foreach($category as $key=>$value){
        $subCategoryId[] =  $value['subcategory'];
        }

        $subCategoryId = array_unique($subCategoryId);


        $subCate = Category::whereIn('id',$subCategoryId)->get();
    }else{
         $subCate = null;
         $data = "Data is not available.";
    }
       
        if($subCate != null){
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$subCate,   
                ]);
        }else{
            return $this->respond([
                'status' => 'false',
                'status_code' => $this->getStatusCode(),
                'data' => $subCate,
                ]);
        }
        
    }
    
    
    public function sanadhanamText(Request $request)
    {
        
        $this->validate($request, [
            'subCategoryId'   => 'required',
        ]
        );

        $sanadhanam =SanadhanamText::where('subcategory',$request->subCategoryId)->orderBy('id', 'ASC')->get();

        foreach($sanadhanam as $key=>$value){
            $subCategory = Category::find($value['subcategory']);
            $sanadhanam[$key]['subCategoryName'] = $value['sub_category'];
        }
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$sanadhanam,   
                ]);
    }
    
    
    
    public function sanadhanam(Request $request)
    {
        
        $this->validate($request, [
            'id'   => 'required',
        ]
        );

        $sanadhanam =SanadhanamText::where('id',$request->id)->orderBy('id', 'ASC')->get();
       
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$sanadhanam,   
                ]);
    }
    
    
    
    public function referral_details(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
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
                $member_details=Member::where('mobile_number',$request->mobile_number)->orderBy('id','DESC')->get();

                if(!empty($member_details))
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'True',
                    'data'=>$member_details,   
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'false',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'false',
                    'date' => $member_details,
                    ]);
                }
            }else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }
    
    public function referral_active_update(Request $request)
    {

        $rules = array (
            
            'email' => 'required',
            'token'=>'required',
            'referral_id' => 'required',
            'active'=>'required',
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
                   
                    $members = Member::where("email", "=",$request['email'])->first();
                    
                    if($request['referral_id']){
                    $members->referral_id = $request['referral_id'];
                    }
                    
                    $user = User::where("email", "=",$request['email'])->first();
                    
                    if($members->save())
                    {
                    $user->referral_active = 'yes';
                    $user->save();
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
    
    
}