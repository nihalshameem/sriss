<?php

namespace App\Http\Controllers;
use App\Models\Polls;
use Illuminate\Http\Request;
use App\Models\PollsResult;
use App\Models\PollsQuestions;
use App\Models\PollsAnswers;
use App\Models\PollsBroadcast;
use App\Models\Member;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use JWTAuth;
use Response;
use View;
use Carbon\Carbon;
use Auth;
use DB;
use Route;
use Session;
use App\Models\Country;
use App\Models\State;
use App\Models\StateDivision;
use App\Models\GreaterZones;
use App\Models\Zones;
use App\Models\District;
use App\Models\Union;
use App\Models\Volunteer;

use \Illuminate\Http\Response as Res;

class PollsController extends ApiController
{

    /************** Web Services****************/

    public function PollsQuestions(Request $request)
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
            $date = Carbon::now()->format('Y-m-d');

            $PollsResult = PollsResult::where('Member_id',$request->member_id)->pluck('Questions_id');

            if($user=$this->is_valid_token($request['token']))
            {
                    $MemberLocation = Member::where('Member_Id',$request->member_id)->first();

                    $date = Carbon::now()->format('Y-m-d');
                    $Polls = array();

                        if($MemberLocation->Union_Id!=null)
                        {
                            $PollsBroadcast = PollsBroadcast::where('Union_id',$MemberLocation->Union_Id)->pluck('Polls_id');

                            $PollsQuestionsUnion = PollsQuestions::where('Polls_Questions_To_date','>=',$date)->WhereNotIn('id',$PollsResult)->whereIn('id',$PollsBroadcast)->get()->toArray();
                            array_push($Polls, $PollsQuestionsUnion);
            
                        }
                        if($MemberLocation->District_Id!=null)
                        {
                            $PollsBroadcast = PollsBroadcast::where('District_id',$MemberLocation->District_Id)->pluck('Polls_id');

                           $PollsQuestionsDistrict = PollsQuestions::where('Polls_Questions_To_date','>=',$date)->WhereNotIn('id',$PollsResult)->whereIn('id',$PollsBroadcast)->get()->toArray();

                            array_push($Polls, $PollsQuestionsDistrict);
            
                           
                        }
                        if($MemberLocation->Zones_Id!=null)
                        {
                            $PollsBroadcast = PollsBroadcast::where('Zone_id',$MemberLocation->Zones_Id)->pluck('Polls_id');

                            $PollsQuestionsZones = PollsQuestions::where('Polls_Questions_To_date','>=',$date)->WhereNotIn('id',$PollsResult)->whereIn('id',$PollsBroadcast)->get()->toArray();

                            array_push($Polls, $PollsQuestionsZones);

                           
                        }
                        if($MemberLocation->Greater_Zones_Id!=null)
                        {
                             $PollsBroadcast = PollsBroadcast::where('Greater_Zones_id',$MemberLocation->Greater_Zones_Id)->pluck('Polls_id');

                            $PollsQuestionsGreaterZones = PollsQuestions::where('Polls_Questions_To_date','>=',$date)->WhereNotIn('id',$PollsResult)->whereIn('id',$PollsBroadcast)->get()->toArray();

                            array_push($Polls, $PollsQuestionsGreaterZones);
            
                            
                        }
                        if($MemberLocation->State_Division_Id!=null)
                        {
                            $PollsBroadcast = PollsBroadcast::where('State_Division_id',$MemberLocation->State_Division_Id)->pluck('Polls_id');

                            $PollsQuestionstateDivision = PollsQuestions::where('Polls_Questions_To_date','>=',$date)->WhereNotIn('id',$PollsResult)->whereIn('id',$PollsBroadcast)->get()->toArray();

                            array_push($Polls, $PollsQuestionstateDivision);
            
                        }
                        if($MemberLocation->State_Id!=null)
                        {
                            $PollsBroadcast = PollsBroadcast::where('State_id',$MemberLocation->State_Id)->pluck('Polls_id');

                            $PollsQuestionstate = PollsQuestions::where('Polls_Questions_To_date','>=',$date)->WhereNotIn('id',$PollsResult)->whereIn('id',$PollsBroadcast)->get()->toArray();

                            array_push($Polls, $PollsQuestionstate);
            
                        
                        }

                        $Polls= array_reduce($Polls, 'array_merge', array());


                        
                        if(count($Polls)>0)
                        {

                            return $this->respond([
                                            'status' => 'success',
                                            'message' => 'success',
                                            'code' => $this->getStatusCode(),
                                            'data'=>$Polls,   
                                            ]);
                        }
                        else
                        {
                          return $this->respond([
                                            'status' => 'failure',
                                            'code' => 400,
                                            'message' => 'Polls not available',
                                            ]);  
                        }
              
                   
            }
            else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        } 
    }

    public function PollsAnswers(Request $request)
    {
        $rules = array (
            'member_id' => 'required',
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
        
                $pollAnswers = PollsAnswers::where('Questions_id',$request->question_id)->get();
                
                if($pollAnswers)
                {

                    return $this->respond([
                                    'status' => 'success',
                                    'message' => 'success',
                                    'code' => $this->getStatusCode(),
                                    'data'=>$pollAnswers,   
                                    ]);
                }
                else
                {
                  return $this->respond([
                                    'status' => 'failure',
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

    public function PollsAnswerPercentage(Request $request)
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
          
                $question_id = $request->question_id;
                $jsonPost = array();

                $PollsAnswers = PollsAnswers::where('Questions_id',$question_id)->orderby('Questions_id','ASC')
                    ->get();

                $PollsAnswersId = PollsAnswers::where('Questions_id',$question_id)
                    ->pluck('Polls_Answers_id');
                
            
                $PollsResult = PollsResult::where('Questions_id',$question_id)->whereIn('Answer_id',$PollsAnswersId)->select('Answer_id',DB::raw("count(*) as response_count"))->groupBy('Answer_id')->get()->toArray(); 

                $PollsResultId = PollsResult::where('Questions_id',$question_id)->whereIn('Answer_id',$PollsAnswersId)->select('Answer_id',DB::raw("count(*) as response_count"))->groupBy('Answer_id')->pluck('Answer_id'); 

                $PollsResultNot = PollsAnswers::where('Questions_id',$question_id)->whereNotIn('Polls_Answers_id',$PollsResultId)->select('Polls_Answers_id',DB::raw("0 as response_count"))->groupBy('Polls_Answers_id')->get()->toArray(); 
              
                    
                    $arr1 = array_merge($PollsResult,$PollsResultNot); 
                    array_push($jsonPost,$arr1);
                    $single= array_reduce($jsonPost, 'array_merge', array());
                    $PollsAnswerscount =PollsAnswers::where('Questions_id',$question_id)
                                                    ->count();

                
               if($PollsAnswerscount!=0)
                {

                    return $this->respond([
                                    'status' => 'success',
                                    'message' => 'success',
                                    'code' => $this->getStatusCode(),
                                    'data'=>array([
                                        'PollsAnswer'=>$PollsAnswers,
                                        'PollsResponse'=>$single
                                                    ])
                                    ]);
                }
                else
                {
                    
                    return $this->respond([
                                    'status' => 'failed',
                                    'message' => 'Polls response not availble',
                                    'code' => 400,

                                    ]);  
                }
        } 
    }


    public function PollsResponse(Request $request)
    {
        $rules = array (
            'member_id' => 'required',
            'token' => 'required',
            'answer_id' => 'required',
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
                
                $PollsResult =  new PollsResult();
                $PollsResult->Member_id = $request->member_id;
                $PollsResult->Answer_id = $request->answer_id;
                $PollsResult->Questions_id= $request->question_id;
                if($PollsResult->save())
                {


                    return $this->respond([
                                'status' => 'success',
                                'code' => $this->getStatusCode(),
                                'message' => 'Response Updated',
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

    /****************** Web Application *****************/

    public function ListPolls()
    {
        $PollsQuestions = PollsQuestions::orderby('id','desc')->get();
        return view('polls.list',compact('PollsQuestions'));
    }

    public function Addpolls()
    {
        return view('polls.save');
    }

    public function SavePolls(Request $request)
    {
        
            $PollsQuestions = new PollsQuestions();
            $PollsQuestions->Polls_Questions = $request->question;
            $PollsQuestions->Polls_Questions_From_date = $request->from_date;
            $PollsQuestions->Polls_Questions_To_date = $request->to_date;
            $PollsQuestions->save(); 
            $Answer_count = count($request['Answer']); 
            for($i = 0;$i < $Answer_count; $i++)
            {
                $PollsAnswers = new PollsAnswers();
                $PollsAnswers->Questions_id = $PollsQuestions->id;
                if($request->Answer[$i]!=null)
                {
                    $PollsAnswers->Polls_Answers_Options = $request->Answer[$i];
                    $PollsAnswers->save();
                    Session::put('AnswerId',$PollsAnswers->Polls_Answers_id);
                }
                
                
            }
            Session::put('PollsId',$PollsQuestions->id);
            
            return redirect(route('list.PollsBroadcast'));
        
        
    }

    public function EditQuestion($Questions_id)
    {
            $PollsQuestions = PollsQuestions::where("id",$Questions_id)->first();
            $PollsAnswers = PollsAnswers::where("Questions_id",$Questions_id)->get();
            $PollsAnswerCount = PollsAnswers::where("Questions_id",$Questions_id)->count();
            return view('polls.edit',compact('PollsAnswerCount'))->with([
            'PollsQuestions'   => $PollsQuestions,
            'PollsAnswers'   => $PollsAnswers,
            
        ]);
    }

    public function UpdateQuestion(Request $request)
    {
        $PollsQuestions = PollsQuestions::where("id", $request->PollsQuestions_id)->update(['Polls_Questions'=> $request->question,'Polls_Questions_From_date'=> $request->from_date,'Polls_Questions_To_date'=>$request->to_date]); 
        Session::put('PollsId',$request->PollsQuestions_id);
        $Answer_count = count($request['Answer']); 
        for($i = 0;$i < $Answer_count; $i++)
        {
            if($request->Answer_id[$i]!=null)
            {
                if($request->Answer[$i]!=null)
                {
                    $PollsAnswers = PollsAnswers::where("Polls_Answers_id", $request->Answer_id[$i])->update(['Polls_Answers_Options'=> $request->Answer[$i]]);
                }
                
            }
            else
            {
                $PollsAnswers = new PollsAnswers();
                $PollsAnswers->Questions_id = $request->PollsQuestions_id;
                if($request->Answer[$i]!=null)
                {
                    $PollsAnswers->Polls_Answers_Options = $request->Answer[$i];
                }
                $PollsAnswers->save();
            }
            
        }
        return redirect(route('list.PollsBroadCastEdit'));  
    }

    public function PollsBroadCast()
    {
        $Polls = PollsQuestions::orderby('id','desc')->first();
        $cities = District::get();
        $states = State::get();
        $stateJson = StateDivision::get();
        return view('polls.broadcast',compact('Polls','cities','states','stateJson'));
    }
    public function SavePollsBroadCast(Request $request)
    {
        if($request->has('State_id') && $request->missing('State_Division_id') && $request->missing('Greater_Zones_id') && $request->missing('Zone_id') && $request->missing('District_id') && $request->missing('Union_id'))
            {
                foreach ($request->State_id as $keys=>$State) {   
                
                        PollsBroadcast::create([
                            'Polls_id' => $request->PollsId,
                            'State_id' => $State,
                           
                        ]);
                
                }
            }
            else if($request->missing('State_id')){
            return \Redirect::back()->withInput()->withWarning('Must Select State ');
        }

            else if($request->has('State_id') && $request->has('State_Division_id') && $request->missing('Greater_Zones_id') )
            {
                foreach ($request->State_id as $keys=>$State) {   
                foreach ($request->State_Division_id as $keysd=>$statedivision) {
                    if($statedivision==null)
                    {
                         PollsBroadcast::create([
                            'Polls_id' => $request->PollsId,
                            'State_id' => $State,
                        ]);
                    }
                    else{
                        PollsBroadcast::create([
                            'Polls_id' => $request->PollsId,
                            'State_Division_id' => $statedivision,
                        ]);
                    }

                       
                
                }
                }
            }

            else if($request->has('State_id') && $request->has('State_Division_id') && $request->has('Greater_Zones_id') && $request->missing('Zone_id'))
            {
                    foreach ($request->State_Division_id as $keysd=>$statedivision) {
                    foreach ($request->Greater_Zones_id as $keyGZ=>$GreaterZonesid) {

                    $greaterzone  = GreaterZones::where('State_Division_id',$request->State_Division_id[$keysd])->where('Greater_Zones_id',$request->Greater_Zones_id[$keyGZ])->first();

                        if($greaterzone)
                        {
                            PollsBroadcast::create([
                                'Polls_id' => $request->PollsId,
                                'Greater_Zones_id' => $GreaterZonesid,
                            ]); 
                        }
                        else
                        {
                            $polls = PollsBroadcast::where('Polls_id',$request->PollsId)->where('State_Division_id', $statedivision)->first();
                            if($polls==null)
                            {
                                 PollsBroadcast::create([
                                    'Polls_id' => $request->PollsId,
                                    'State_Division_id' => $statedivision,
                                ]);
                            }
                        }

                           
                    
                    }
                    }

            }

            else if($request->has('State_id') && $request->has('State_Division_id') && $request->has('Greater_Zones_id') && $request->has('Zone_id') && $request->missing('District_id'))
            {
                    
                    foreach ($request->Greater_Zones_id as $keyGZ=>$GreaterZonesid) {
                    foreach ($request->Zone_id as $keyZ=>$Zones) {

                    $zone  = Zones::where('Greater_Zones_id',$request->Greater_Zones_id[$keyGZ])->where('Zone_id',$request->Zone_id[$keyZ])->first();

                        if($zone)
                        {
                            PollsBroadcast::create([
                                'Polls_id' => $request->PollsId,
                                'Zone_id' => $Zones,
                            ]); 
                        }
                        else
                        {
                             
                            $polls = PollsBroadcast::where('Polls_id',$request->PollsId)->where('Greater_Zones_id', $GreaterZonesid)->first();
                            if($polls==null)
                            {
                                PollsBroadcast::create([
                                'Polls_id' => $request->PollsId,
                                'Greater_Zones_id' => $GreaterZonesid,
                                ]);
                            }
                        }
                    
                    }
                    }

            }

            else if($request->has('State_id') && $request->has('State_Division_id') && $request->has('Greater_Zones_id') && $request->has('Zone_id') && $request->has('District_id') && $request->missing('Union_id'))
            {
                    
                    foreach ($request->Zone_id as $keyZ=>$Zones) {
                    foreach ($request->District_id as $keyD=>$District) {

                    $district  = District::where('Zone_id',$request->Zone_id[$keyZ])->where('District_id',$request->District_id[$keyD])->first();

                        if($district)
                        {
                            PollsBroadcast::create([
                                'Polls_id' => $request->PollsId,
                                'District_id' => $District,
                            ]); 
                        }
                        else
                        {
                            
                            $polls = PollsBroadcast::where('Polls_id',$request->PollsId)->where('Zone_id', $Zones)->first();
                            if($polls==null)
                            {
                                 PollsBroadcast::create([
                                    'Polls_id' => $request->PollsId,
                                    'Zone_id' => $Zones,
                                ]);
                            }
                        }
                        }

                           
                    
                    }
            }
            else
            {
                    
                    foreach ($request->District_id as $keyD=>$District) {
                    foreach ($request->Union_id as $keyU=>$Union) {
                    $union  = Union::where('District_id',$request->District_id[$keyD])->where('Union_id',$request->Union_id[$keyU])->first();

                        if($union)
                        {
                            PollsBroadcast::create([
                                'Polls_id' => $request->PollsId,
                                'Union_id' => $Union,
                            ]); 
                        }
                        else
                        {

                               $polls = PollsBroadcast::where('Polls_id',$request->PollsId)->where('District_id', $District)->first();
                                if($polls==null)
                                {
                                     PollsBroadcast::create([
                                        'Polls_id' => $request->PollsId,
                                        'District_id' => $District,
                                    ]);
                                }
                             
                        }

                           
                    
                    }
                    }

            }
            return redirect(route('list.polls')); 
            
    }

    public function PollsBroadCastEdit()
    {
        $PollsBroadcast = PollsBroadcast::where('Polls_id',Session::get('PollsId'))->get();
        $Polls = PollsQuestions::where('id',Session::get('PollsId'))->first();
        $states = State::get();
        return view('polls.broadcast.edit',compact('PollsBroadcast','states','Polls'));
    }

    public function PollsUpdateBroadCast(Request $request)
    {
        if($request->missing('State_id')){
            return \Redirect::back()->withInput()->withWarning('Must Select State ');
        }

        $PollsBroadcast = PollsBroadcast::where('Polls_id',$request->PollsId)->delete();

        if($request->has('State_id') && $request->missing('State_Division_id') && $request->missing('Greater_Zones_id') && $request->missing('Zone_id') && $request->missing('District_id') && $request->missing('Union_id'))
            {
                foreach ($request->State_id as $keys=>$State) {   
                
                        PollsBroadcast::create([
                            'Polls_id' => $request->PollsId,
                            'State_id' => $State,
                           
                        ]);
                
                }
            }

            else if($request->has('State_id') && $request->has('State_Division_id') && $request->missing('Greater_Zones_id') )
            {
                foreach ($request->State_id as $keys=>$State) {   
                foreach ($request->State_Division_id as $keysd=>$statedivision) {
                    if($statedivision==null)
                    {
                         PollsBroadcast::create([
                            'Polls_id' => $request->PollsId,
                            'State_id' => $State,
                        ]);
                    }
                    else{
                        PollsBroadcast::create([
                            'Polls_id' => $request->PollsId,
                            'State_Division_id' => $statedivision,
                        ]);
                    }

                       
                
                }
                }
            }

            else if($request->has('State_id') && $request->has('State_Division_id') && $request->has('Greater_Zones_id') && $request->missing('Zone_id'))
            {
                    foreach ($request->State_Division_id as $keysd=>$statedivision) {
                    foreach ($request->Greater_Zones_id as $keyGZ=>$GreaterZonesid) {

                    $greaterzone  = GreaterZones::where('State_Division_id',$request->State_Division_id[$keysd])->where('Greater_Zones_id',$request->Greater_Zones_id[$keyGZ])->first();

                        if($greaterzone)
                        {
                            PollsBroadcast::create([
                                'Polls_id' => $request->PollsId,
                                'Greater_Zones_id' => $GreaterZonesid,
                            ]); 
                        }
                        else
                        {
                            $polls = PollsBroadcast::where('Polls_id',$request->PollsId)->where('State_Division_id', $statedivision)->first();
                            if($polls==null)
                            {
                                 PollsBroadcast::create([
                                    'Polls_id' => $request->PollsId,
                                    'State_Division_id' => $statedivision,
                                ]);
                            }
                        }

                           
                    
                    }
                    }

            }

            else if($request->has('State_id') && $request->has('State_Division_id') && $request->has('Greater_Zones_id') && $request->has('Zone_id') && $request->missing('District_id'))
            {
                    
                    foreach ($request->Greater_Zones_id as $keyGZ=>$GreaterZonesid) {
                    foreach ($request->Zone_id as $keyZ=>$Zones) {

                    $zone  = Zones::where('Greater_Zones_id',$request->Greater_Zones_id[$keyGZ])->where('Zone_id',$request->Zone_id[$keyZ])->first();

                        if($zone)
                        {
                            PollsBroadcast::create([
                                'Polls_id' => $request->PollsId,
                                'Zone_id' => $Zones,
                            ]); 
                        }
                        else
                        {
                             
                            $polls = PollsBroadcast::where('Polls_id',$request->PollsId)->where('Greater_Zones_id', $GreaterZonesid)->first();
                            if($polls==null)
                            {
                                PollsBroadcast::create([
                                'Polls_id' => $request->PollsId,
                                'Greater_Zones_id' => $GreaterZonesid,
                                ]);
                            }
                        }
                    
                    }
                    }

            }

            else if($request->has('State_id') && $request->has('State_Division_id') && $request->has('Greater_Zones_id') && $request->has('Zone_id') && $request->has('District_id') && $request->missing('Union_id'))
            {
                    
                    foreach ($request->Zone_id as $keyZ=>$Zones) {
                    foreach ($request->District_id as $keyD=>$District) {

                    $district  = District::where('Zone_id',$request->Zone_id[$keyZ])->where('District_id',$request->District_id[$keyD])->first();

                        if($district)
                        {
                            PollsBroadcast::create([
                                'Polls_id' => $request->PollsId,
                                'District_id' => $District,
                            ]); 
                        }
                        else
                        {
                            
                            $polls = PollsBroadcast::where('Polls_id',$request->PollsId)->where('Zone_id', $Zones)->first();
                            if($polls==null)
                            {
                                 PollsBroadcast::create([
                                    'Polls_id' => $request->PollsId,
                                    'Zone_id' => $Zones,
                                ]);
                            }
                        }
                        }

                           
                    
                    }
            }
            else
            {
                    
                    foreach ($request->District_id as $keyD=>$District) {
                    foreach ($request->Union_id as $keyU=>$Union) {
                    $union  = Union::where('District_id',$request->District_id[$keyD])->where('Union_id',$request->Union_id[$keyU])->first();

                        if($union)
                        {
                            PollsBroadcast::create([
                                'Polls_id' => $request->PollsId,
                                'Union_id' => $Union,
                            ]); 
                        }
                        else
                        {

                               $polls = PollsBroadcast::where('Polls_id',$request->PollsId)->where('District_id', $District)->first();
                                if($polls==null)
                                {
                                     PollsBroadcast::create([
                                        'Polls_id' => $request->PollsId,
                                        'District_id' => $District,
                                    ]);
                                }
                             
                        }

                           
                    
                    }
                    }

            }
        return redirect(route('list.polls')); 
    }

    public function Search(Request $request)
        {
            if($request->ajax())
        {
            $output="";
            if(isset($request->pollsearch) && ($request->pollsearch1)){
                $polls=PollsQuestions::whereBetween('Polls_Questions_From_date', [$request->pollsearch, $request->pollsearch1])
                ->orderBy('id', 'DESC')->get();
            }

            if($polls){
                foreach ($polls as $i => $polls) {
                    $i = $i+1;
                    
                    $output.='<tr>'.
                                '<td>'.$i.'</td>'.
                                '<td>'.$polls->Polls_Questions.'</td>'.
                                '<td>'.$polls->Polls_Questions_From_date.'</td>'.
                                '<td>'.$polls->Polls_Questions_To_date.'</td>'.
                                '<td><a href="/EditPoll/'.$polls->id.'" ><span class="badge bg-danger"><i class="fa fa-edit fa-lg" style="text-align:center;"></i></span></a></td>'.
                                '<td><a href="/deletePoll/'.$polls->id.'" ><span class="badge bg-danger"><i class="fa fa-trash fa-lg" style="text-align:center;"></i></span></a></td>'.
                                '</tr>';
                }
            }

            return Response($output);

        }
        }

    public function Responses($question)
    {
        $PollsResponses = PollsResult::where('Questions_id',$question)->select('Answer_id')->distinct()->get();
        $TotalResponses = PollsResult::where('Questions_id',$question)->select('Answer_id')->count();
        $PollsQuestions = PollsQuestions::where('id',$question)->first();
        return view('polls.reponses',compact('PollsResponses','PollsQuestions','TotalResponses'));
    }

    public function DeleteQuestion(Request $request)
    {
        $PollsBroadcast = PollsBroadcast::where('Polls_id',$request->Questions_id)->delete();
        PollsResult::where('Questions_id', $request->Questions_id)->delete(); 
        PollsAnswers::where('Questions_id', $request->Questions_id)->delete(); 
        PollsQuestions::where('id', $request->Questions_id)->delete();
        echo json_encode($request->Questions_id); 
    }
    
    public function DeleteAnswer(Request $request)
    {
        PollsAnswers::where('Polls_Answers_id', $request->AnswerId)->delete();
        echo json_encode("Removed");
    }

    public function TruncatePolls()
    {
        PollsResult::truncate(); 
        PollsAnswers::truncate(); 
        PollsQuestions::truncate();
        echo json_encode('truncated');  
    }

}