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
use Assembly;
use App\Role;
use App\memberIdConfig;
use App\Vision;
use App\Language;
use App\cfgVision;


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
        $user = JWTAuth::toUser($token);
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
            'father_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'sex' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'zone' => 'required',
            'district' => 'required',
            'pincode' => 'required',
            'mobile_number' => 'required|unique:users',
        );
        // Get the value from the form
            $input['email'] =  $request['email'];
            
            // Must not already exist in the `email` column of `users` table
            $rules = array('email' => 'unique:users,email');
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
               return $this->respond([
                            'status' => 'error',
                            'status_code' => 400,
                            'message' => 'Email is already exist',
                        ]);  
            }
            
            else
            {
                
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'mobile_number' => $request['mobile_number'],
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
            'father_name' => $request['father_name'],
            'email' => $request['email'],   
            'sex' => $request['sex'],
            'dob' => $request['dob'],
            'address' => $request['address'],
            'country' => $request['country'],
            'state' => $request['state'],
            'zone' => $request['zone'],
            'district' => $request['district'],
            'pincode' => $request['pincode'],
            'mobile_number' => $request['mobile_number'],
            'whatsapp_number' => $request['whatsapp_number'],
            'referral_id' => $request['refer_id'],
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
                            'message' => 'Register Successfull',
                            'data' => $this->userTransformer->transform($user)
                        ]);   
            }
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
                //dd($user);
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





//referral_details
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
//dd($today);
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
            'response' => "" ,
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
    
   //referral 
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

                if(!empty($member_details))
                {
                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>$member_details,   
                    ]);
                }
                else
                {
                    return $this->respond([
                    'status' => 'false',
                    'status_code' => $this->getStatusCode(),
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
    
    public function poll_feedback(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
            'token' => 'required',
            'response_id' => 'required',
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
                if(isset($request['response_id'])){
                    Pollanswer::where('id', $request['response_id'])->update([
                        'response_count'=> DB::raw('response_count+1'), 
                        'updated_at' => Carbon::now()
                    ]);

                    return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'data'=>'Your Poll Submitted Successfully.',   
                    ]);
                }else
                {
                    return $this->respond([
                    'status' => 'false',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Your Poll is Rejected',
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
        $vision = Faq::select('description','vision')->where('id','1')
            ->orderBy('id', 'ASC')->get();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$vision,   
                ]);
    }

    public function faq(Request $request)
    {
        $faq = Faq::select('description','vision')->where('id','3')
            ->orderBy('id', 'ASC')->get();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$faq,   
                ]);
    }
    
    public function termsandcondition(Request $request)
    {
        $tac = Faq::select('description','vision')->where('id','4')
            ->orderBy('id', 'ASC')->get();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$tac,   
                ]);
    }

    public function privacypolicy(Request $request)
    {
        $privacypolicy = Faq::select('description','vision')->where('id','5')
            ->orderBy('id', 'ASC')->get();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$privacypolicy,   
                ]);
    }
    
    public function idcardvision(Request $request)
    {
        $idcardvision = Faq::select('description','vision')->where('id','6')
            ->orderBy('id', 'ASC')->get();
    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$idcardvision,   
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
    
//   ----Start---- Web Application Member Activation or Deactivation ----

   public function member_edit()
    {    
        $members['members']=Member::all();
        $demembers['demembers']=Member::where('active_flag','no')->get();

        return view('member_edit',$members,$demembers);
    }

    public function member_deactivation(Request $request)
    {
        // $member = Member::find($request->member_id);
        // $member->active_flag = $request->active_flag;
        // $member->deactivate_reason = $request->deactivate_reason;
        //     if($member->save()){

        //       return redirect('/member_edit');
            
        //     }else{

        //         echo "Update Failed.";
        //   }

        $member = DB::table('members')
            ->where("mobile_number", '=', $request->mobile_number)
            ->orWhere("member_id", '=', $request->member_id)
            ->update(['active_flag'=> $request->active_flag, 'deactivate_reason'=> $request->deactivate_reason]);
            if($member){

               return redirect('/member_edit');
            
            }else{

                return redirect('/member_edit');
           }
        
    }
//   ----End----  Web Application Member Activation or Deactivation ----
    
    
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
    
    public function districtassembly(Request $request)
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
           
            $districtassembly = DB::table('Assembly_Cons')->where('District',$request->district_id)->orderBy('Name', 'ASC')->get();
            //dd($districtassembly);
            
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$districtassembly,   
                ]);
        }
    }
    
    public function districtparliamentary(Request $request)
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
            
            $districtassembly = DB::table('Parli_Cons')->where('District',$request->district_id)->orderBy('Name', 'ASC')->get();

    
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$districtassembly,   
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

                $members->profile_picture ='sriss.in/fob/storage/app/public/upload/profile/'.$filename;
                    
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

                $members->id_card ='sriss.in/fob/storage/app/public/upload/idcard/'.$filename;
                    
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

                    if($request['address']){
                    $members->address = $request['address'];
                    }
                    
                    if($request['whatsapp_number']){
                    $members->whatsapp_number = $request['whatsapp_number'];
                    }

                    if($request['referral_id']){
                    $members->referral_id = $request['referral_id'];
                    }

                    if($request['voter_id']){
                    $members->voter_id = $request['voter_id'];
                    }
                    
                    if($request['profession']){
                    $members->profession = $request['profession'];
                    }

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

                    if($request['assembly_constituency']){
                    $members->assembly_constituency = $request['assembly_constituency'];
                    }

                    if($request['parliamentary_constituency']){
                    $members->parliamentary_constituency = $request['parliamentary_constituency'];
                    }
                    
                    if($request['country']){
                    $members->country = $request['country'];
                    }
                    
                    if($request['state']){
                    $members->state = $request['state'];
                    }
                    
                    if($request['district']){
                    $members->district = $request['district'];
                    }
                    
                    if($request['zone']){
                    $members->zone = $request['zone'];
                    }
                    
                    if($members->save())
                    {
                        $update = DB::table('users')
                            ->where("email", '=',  $request->email)
                            ->update(['profile'=> 'yes']);
                            
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
    
    
    //referral_active_update
    
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
    
    
    
    
    
     public function referralActiveUpdate(Request $request)
    {

        $rules = array (
            
            'email' => 'required',
            'token'=>'required',
            'mobile_number'=>'required',
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
                    
                    $users = User::where("mobile_number", "=",$request['mobile_number'])->first();

                    if($users){
                    $users->referral_active = $request['active'];
                    $users->save();
                    }
                    
                    
                    if($users)
                    {
                        return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Profile Updated',
                        'data'=>$user
                        ]);
                    }
                    else
                    {
                        return $this->respond([
                        'status' => 'Failed',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Referral Mobile Number Not Found',
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
                    'message' => 'Mobile number not match.',
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

                $address=$member->address;

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
//dd($roles);
        $user = DB::table('users')
            ->where("mobile_number", '=', $request->mobile_number)
            ->orWhere("member_id", '=', $request->mobile_number)
            ->update(['user_type'=> $roles]);

        //return redirect('/user_roles_assign');
        return redirect()->back()->with('rolesuccess', 'Roll assigned success!');
    }
    
    
    
    
    public function getMemberByMobile1(Request $request) {

        $member = DB::table("users")->where("mobile_number",$request->mobile_number)->get();

        return response()->json($member);

    }
    
    public function getMemberByMemberId1(Request $request) {

        $member = DB::table("users")->where("member_id",$request->member_id)->get();

        return response()->json($member);

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
    '<td>'.$product->address.'</td>'.
    '</tr>';
     
    }
      
    return Response($output);
     
       }

       }
     
    }

   
   
   
   
   
   
   public function languagesList(Request $request)
    {
        $languages = Language::select('language')
            ->orderBy('id', 'ASC')->get();
        
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$languages,   
                ]);
    } 
    
    
    public function cfgVisionsList(Request $request)
    {
        $cfgVision = cfgVision::select('vision')
            ->orderBy('id', 'ASC')->get();
        
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$cfgVision,   
                ]);
    }
    
    
    
    public function visionsMenu(Request $request)
    {
        
        $this->validate($request, [
            'languageId'   => 'required',
            'visionId'   => 'required',
        ]
        );

        $vision =Vision::where('languageId',$request->languageId)->where('typeId',$request->visionId)->orderBy('id', 'ASC')->first();

        
        return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'data'=>$vision,   
                ]);
    }
    
    
    public function feedbackMail($id){
        $visionData = Feedback::find($id);
        dd($visionData);
        return view('/feedbackMail',compact('visionData'));
    }
    
}