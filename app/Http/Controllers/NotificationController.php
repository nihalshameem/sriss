<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Notification;
use App\Models\User;
use App\Models\NotificationBroadcast;
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
use PDF;
use App;
use \Illuminate\Http\Response as Res;
use App\Models\Country;
use App\Models\State;
use App\Models\StateDivision;
use App\Models\GreaterZones;
use App\Models\Zones;
use App\Models\District;
use App\Models\Union;
use App\Models\Panchayat;
use App\Models\Village;
use App\Models\Volunteer;
use App\Models\Street;
use App\Models\NotificationGroupBroadcast;
use App\Models\MemberGroup;
use App\Models\GroupMembers;

class NotificationController extends ApiController
{

    /*****************Web Services***************/

    public function Notifications(Request $request)
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
        else{   
            if($user=$this->is_valid_token($request['token']))
            {
                    $Member = Member::where('Member_Id',$request->member_id)->first();
                    $Volunteer = Volunteer::first();
                    
                    $MemberLocation = Member::where('Member_Id',$request->member_id)->first();

                    $date = Carbon::now()->format('Y-m-d');
                    $Notifications = array();

                    if($MemberLocation->Union_Id!=null)
                    {
                          $NotificationBroadcast = NotificationBroadcast::where('Union_id',$MemberLocation->Union_Id)->pluck('Notification_id');
                            
                            
                            $NotificationUnion = Notification::where('Notification_active','Y')
                                                ->where('Notification_approved','Y')
                                                ->where('Notification_end_date','>=',$date)
                                                ->whereIn('Notification_id',$NotificationBroadcast)
                                                ->orderby('Notification_id','desc')->get()->toArray();
                            array_push($Notifications, $NotificationUnion);

                    }
                    if($MemberLocation->District_Id!=null)
                    {
                        $NotificationBroadcast = NotificationBroadcast::where('District_id',$MemberLocation->District_Id)->pluck('Notification_id');        
                            
                        $NotificationDistrict = Notification::where('Notification_active','Y')
                                                ->where('Notification_approved','Y')
                                                ->where('Notification_end_date','>=',$date)
                                                ->whereIn('Notification_id',$NotificationBroadcast)
                                                ->orderby('Notification_id','desc')->get()->toArray();
                        array_push($Notifications, $NotificationDistrict);                          
                    }
                    if($MemberLocation->Zones_Id!=null)
                    {
                        $NotificationBroadcast = NotificationBroadcast::where('Zone_id',$MemberLocation->Zones_Id)->pluck('Notification_id');
                            
                            
                        $NotificationZone =  Notification::where('Notification_active','Y')
                                                    ->where('Notification_approved','Y')
                                                    ->where('Notification_end_date','>=',$date)
                                                    ->whereIn('Notification_id',$NotificationBroadcast)
                                                    ->orderby('Notification_id','desc')
                                                    ->get()->toArray();

                        array_push($Notifications, $NotificationZone);                          
                    }
                    

                    if($MemberLocation->State_Id!=null)
                    {
                        $NotificationBroadcast = NotificationBroadcast::where('State_id',$MemberLocation->State_Id)->pluck('Notification_id');
                            
                        $NotificationState = Notification::where('Notification_active','Y')
                                                ->where('Notification_approved','Y')
                                                ->where('Notification_end_date','>=',$date)
                                                ->whereIn('Notification_id',$NotificationBroadcast)
                                                ->orderby('Notification_id','desc')
                                                ->get()->toArray();
                           array_push($Notifications, $NotificationState);
                    }

                    $MemberGroup=GroupMembers::where('Member_Id',$request->member_id)->pluck('Group_id');
                    $MemberGroup  = collect( $MemberGroup )->unique();

                    if(count($MemberGroup)>0){
                        $NotificationGroupBroad =NotificationGroupBroadcast::whereIn('Group_id', $MemberGroup)->pluck('Notification_id');

                            if(count($NotificationGroupBroad)>0){
                                $NotificationGroup =Notification::where('Notification_active','Y')
                                                ->where('Notification_approved','Y')
                                                ->where('Notification_end_date','>=',$date)
                                                ->whereIn('Notification_id',$NotificationGroupBroad)
                                                ->orderby('Notification_id','desc')
                                                ->get()->toArray();
                                                array_push($Notifications, $NotificationGroup);

                            }
                    }
                    
                    
                    $Notifications= array_reduce($Notifications, 'array_merge', array());
                    $Notifications = collect($Notifications)->sortBy('Notification_id')->reverse()->toArray();

                        
                        
                    if(count($Notifications)>0)
                    {

                            return $this->respond([
                                            'status' => 'success',
                                            'message' => 'success',
                                            'code' => $this->getStatusCode(),
                                            'data'=>$Notifications,   
                                            ]);
                    }
                    else
                    {
                        return $this->respond([
                                            'status' => 'failure',
                                            'code' => 400,
                                            'message' => 'Notification not available',
                                            ]);  
                    }
                    
            }
            else
            {
                return $this->respondTokenError("Token Mismatched");
            }  
        }
    }

    public function addAppNotification(Request $request)
        {   
            $rules = array (
            'member_id' => 'required',
            'token' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'message' => 'required',
            'active' => 'required',
            'approved' => 'required',
            'NotificationPath' => 'max:1024',
            );
            $validator = Validator::make($request->all(),$rules);

            if($validator->fails())
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator->errors());

            }
            else
            { 
                if($user=$this->is_valid_token($request['token']))
                {
                    
                    $Member = Member::where('Member_Id',$request->member_id)->first();
                    $Volunteer = Volunteer::first();
                    
                    $MemberLocation = Member::where('Member_Id',$request->member_id)->first();

                    $date = Carbon::now()->format('Y-m-d');
                    $Notifications = array();

                    $notification = new Notification();
                    $notification->Notification_mesage = $request->message;
                    $notification->Notification_start_date = $request->start_date;
                    $notification->Notification_end_date = $request->end_date;
                    $notification->Notification_active = $request->active;
                    $notification->Notification_approved = $request->approved;
                    if ($request->hasFile('NotificationPath'))
                    {
                        $image_ext = $request->file('NotificationPath')->getClientOriginalExtension();
                        $image_extn = strtolower($image_ext);
                        $imageName = time() .'_'. $request->NotificationPath->getClientOriginalName();
                        $filePath = $request->file('NotificationPath')->storeAs('Notification', $imageName,'public');
                        $notification->Notification_image_path = config('app.url').'storage/app/public/Notification/'.$imageName;  
                    }
                    $notification->save();

                    if($request->is_group=='N'){
                        NotificationBroadcast::create([
                            'Notification_id' => $request->NotificationId,
                            'State_id' => 1,
                        ]);

                    }else{
                        foreach (explode(',',$request->Group_id) as $row)
                        {
                            $data[] =[
                                'Group_id' => $row,
                                'Notification_id' => $notification->id,
                                'active' => 'Y',
                               ];
                        }
                        
                        NotificationGroupBroadcast::insert($data);
            
                    }

                    $notifications = Notification::orderby('Notification_id','DESC')->first();
                  
                    return Response([
                                'status' => 'success',
                                'code' => $this->getStatusCode(),
                                'message' => 'Uploded Successfull'
                            ]);                           
                }
                else
                {
                    return $this->respondTokenError("Token Mismatched");
                }          
            }
        }

        public function appNotificationList(Request $request)
        {   
            $rules = array (
            'member_id' => 'required',
            'token' => 'required', );
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails())
            {
                return Response([
                                    'status' => 'failure',
                                    'code' => 400,
                                    'message' => 'Field Validation Failed'
                                    ]);  
            }
            else
            { 
                if($user=$this->is_valid_token($request['token']))
                {
                    $Notifications = Notification::orderby('Notification_id','DESC')->get();
                        return Response([
                                    'status' => 'success',
                                    'code' => $this->getStatusCode(),
                                    'message' => 'Success',
                                    'data' => $Notifications
                                ]);                           
                }
                else
                {
                    return Response([
                                        'status' => 'failure',
                                        'code' => 400,
                                        'message' => 'Token Mismatched',
                                    ]);  
                }        
            }
        }

        public function appNotificationView(Request $request)
        {   
            $rules = array (
                'member_id' => 'required',
                'token' => 'required',
                'notification_id' => 'required' );
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails())
            {
                return Response([
                                    'status' => 'failure',
                                    'code' => 400,
                                    'message' => 'Field Validation Failed'
                                    ]);  
            }
            else
            { 
                if($user=$this->is_valid_token($request['token']))
                 {
                    
                    $Notification=Notification::where('Notification_id', $request->notification_id)->first();
                    $data=array('Notification_id'=>$Notification->Notification_id,
                                'Notification_mesage'=>$Notification->Notification_mesage,
                                'Notification_text'=>$Notification->Notification_text,
                                'Notification_start_date' => $Notification->Notification_start_date,
                                'Notification_end_date' => $Notification->Notification_end_date,
                                'Notification_image_path' => $Notification->Notification_image_path,
                                'Notification_active' => $Notification->Notification_active,
                                'Notification_approved' => $Notification->Notification_approved, );
                    
                            return Response([
                                        'status' => 'success',
                                        'code' => $this->getStatusCode(),
                                        'message' => 'Success',
                                        'data' => $data
                                    ]);                           
                }
                else
                {
                    return Response([
                                        'status' => 'failure',
                                        'code' => 400,
                                        'message' => 'Token Mismatched',
                                    ]);  
                }        
            }
        }

        public function appNotificationDelete(Request $request)
        {   
            $rules = array (
                'member_id' => 'required',
                'token' => 'required',
                'notification_id' => 'required' );
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails())
            {
                return Response([
                                    'status' => 'failure',
                                    'code' => 400,
                                    'message' => 'Field Validation Failed'
                                    ]);  
            }
            else
            { 
                if($user=$this->is_valid_token($request['token']))
                {
                    NotificationBroadcast::where('Notification_id', $request->notification_id)->delete();
                    NotificationGroupBroadcast::where('Notification_id', $request->notification_id)->delete();
                    Notification::where('Notification_id', $request->notification_id)->delete();
                            return Response([
                                        'status' => 'success',
                                        'code' => $this->getStatusCode(),
                                        'message' => 'Success'
                                    ]);                           
                }
                else
                {
                    return Response([
                                        'status' => 'failure',
                                        'code' => 400,
                                        'message' => 'Token Mismatched',
                                    ]);  
                }        
            }
        }

    

    public function is_valid_token($token)
    {
        $user = User::where('api_token', $token)->first();
        return $user;
    }
    


        /*********************Web Application*********/

        public function GetNotifications()
        {
            $Notifications = Notification::orderby('Notification_id','DESC')->get();
            return view('notification.list',compact('Notifications'));
        }

        public function Search(Request $request)
        {
            if($request->ajax())
        {
            $output="";
            if(isset($request->search) && ($request->search1)){
                $notifications=Notification::whereBetween('Notification_start_date', [$request->search, $request->search1])
                ->orderBy('Notification_id', 'DESC')->get();
            }

            if($notifications){
                foreach ($notifications as $i => $notification) {
                    $image;
                    $i = $i+1;
                    if($notification->Notification_image_path!=null)
                    {
                        $image="Yes";
                    }
                    else
                    {
                        $image="No";
                    }
                    $output.='<tr>'.
                                '<td>'.$i.'</td>'.
                                '<td>'.$notification->Notification_mesage.'</td>'.
                                '<td>'.$notification->Notification_start_date.'</td>'.
                                '<td>'.$notification->Notification_end_date.'</td>'.
                                '<td>'.$image.'</td>'.
                                '<td><span class="badge bg-success">'.$notification->Notification_active.'</span></td>'.
                                
                                '<td><a href="/Edit/'.$notification->Notification_id.'" ><span class="badge bg-danger"><i class="fa fa-edit fa-lg" style="text-align:center;"></i></span></a></td>'.
                                
                                '<td><a href="/notificationonly_delete/'.$notification->Notification_id.'" ><span class="badge bg-danger"><i class="fa fa-trash fa-lg" style="text-align:center;"></i></span></a></td>'.
                                '</tr>';
                }
            }

            return Response($output);

        }
        }

        public function NotificationShow()
        {
            Session::forget('notificationId');
            return view('notification.save');
        }

        public function SaveNotification(Request $request)
        {   
            $validator = Validator::make($request->all(),[
                'NotificationPath' => 'max:1024',
            ]);

            if($validator->fails()){
               return \Redirect::back()->withInput()->withWarning( 'Image Must be Less than 1MB');
            }
            if(Session::get('notificationId')==null)
            {
                $notification = new Notification();
                $notification->Notification_mesage = $request->message;
                $notification->Notification_start_date = $request->start_date;
                $notification->Notification_end_date = $request->end_date;
                $notification->Notification_active = $request->active;
                $notification->Notification_approved = $request->approve;
                if ($request->hasFile('NotificationPath'))
                {
                $image_ext = $request->file('NotificationPath')->getClientOriginalExtension();
                            $image_extn = strtolower($image_ext);
                            $imageName = time() .'_'. $request->NotificationPath->getClientOriginalName();
                            $filePath = $request->file('NotificationPath')->storeAs('Notification', $imageName,'public');
                $notification->Notification_image_path = config('app.url').'storage/app/public/Notification/'.$imageName;  
                }
                $notification->save();
                $notifications = Notification::orderby('Notification_id','DESC')->first();
                Session::put('notificationId',$notifications->Notification_id);

                if($request->broadtype=='Y'){
                    return redirect(route('list.NotificationBroadcast'));
                }elseif ($request->broadtype=='N') {
                    return redirect(route('show.NotificationGroupBroadcast'));
                }
                
           }
            else
            {
                if ($request->hasFile('NotificationPath'))
                {
          
                    $image_ext = $request->file('NotificationPath')->getClientOriginalExtension();
                    $image_extn = strtolower($image_ext);
                    $imageName = time() .'_'. $request->NotificationPath->getClientOriginalName();
                    $filePath = $request->file('NotificationPath')->storeAs('Notification', $imageName,'public');
                    $Notification_image_path = config('app.url').'storage/app/public/Notification/'.$imageName; 

                     $Notification = Notification::where("Notification_id", $request->Notification_id)->update(['Language_id'=> $request->LanguageId,'Notification_start_date'=> $request->start_date,'Notification_end_date'=> $request->end_date,'Notification_active'=> $request->active,'Notification_approved'=> $request->approve,'Notification_mesage'=> $request->message,'Notification_image_path'=> $Notification_image_path]);
                     Session::put('notificationId',$request->Notification_id);
                    if($request->broadtype=='Y'){
                        return redirect(route('list.NotificationBroadcast'));
                    }elseif ($request->broadtype=='N') {
                        return redirect(route('show.NotificationGroupBroadcast'));
                    }
                }
                else
                {
                    $Notification = Notification::where("Notification_id", Session::get('notificationId'))->update(['Language_id'=> $request->LanguageId,'Notification_start_date'=> $request->start_date,'Notification_end_date'=> $request->end_date,'Notification_active'=> $request->active,'Notification_approved'=> $request->approve,'Notification_mesage'=> $request->message,'Notification_image_path'=> $request->ImageNotification]);
                    Session::put('notificationId',Session::get('notificationId'));
                    if($request->broadtype=='Y'){
                        return redirect(route('list.NotificationBroadcast'));
                    }elseif ($request->broadtype=='N') {
                        return redirect(route('show.NotificationGroupBroadcast'));
                    }  
                }
            }
           
            
            
        }

        public function SaveBroadCast(Request $request)
        {
          
            if($request->has('State_id') && $request->missing('Zone_id') && $request->missing('District_id') && $request->missing('Union_id'))
            {
                foreach ($request->State_id as $keys=>$State) {   
                
                        NotificationBroadcast::create([
                            'Notification_id' => $request->NotificationId,
                            'State_id' => $State,
                           
                        ]);
                
                }
            }

            if($request->missing('State_id')){
            return \Redirect::back()->withInput()->withWarning('Must Select State ');
        }

            // else if($request->has('State_id') && $request->has('State_Division_id') && $request->missing('Greater_Zones_id') )
            // {
            //     foreach ($request->State_id as $keys=>$State) {   
            //     foreach ($request->State_Division_id as $keysd=>$statedivision) {
            //         if($statedivision==null)
            //         {
            //              NotificationBroadcast::create([
            //                 'Notification_id' => $request->NotificationId,
            //                 'State_id' => $State,
            //             ]);
            //         }
            //         else{
            //             NotificationBroadcast::create([
            //                 'Notification_id' => $request->NotificationId,
            //                 'State_Division_id' => $statedivision,
            //             ]);
            //         }

                       
                
            //     }
            //     }
            // }

            // else if($request->has('State_id') && $request->has('State_Division_id') && $request->has('Greater_Zones_id') && $request->missing('Zone_id'))
            // {
            //         foreach ($request->State_Division_id as $keysd=>$statedivision) {
            //         foreach ($request->Greater_Zones_id as $keyGZ=>$GreaterZonesid) {

            //         $greaterzone  = GreaterZones::where('State_Division_id',$request->State_Division_id[$keysd])->where('Greater_Zones_id',$request->Greater_Zones_id[$keyGZ])->first();

            //             if($greaterzone)
            //             {
            //                 NotificationBroadcast::create([
            //                     'Notification_id' => $request->NotificationId,
            //                     'Greater_Zones_id' => $GreaterZonesid,
            //                 ]); 
            //             }
            //             else
            //             {
            //                 $notification = NotificationBroadcast::where('Notification_id',$request->NotificationId)->where('State_Division_id', $statedivision)->first();
            //                 if($notification==null)
            //                 {
            //                      NotificationBroadcast::create([
            //                         'Notification_id' => $request->NotificationId,
            //                         'State_Division_id' => $statedivision,
            //                     ]);
            //                 }
            //             }

                           
                    
            //         }
            //         }

            // }

            else if($request->has('State_id') && $request->has('Zone_id') && $request->missing('District_id'))
            {
                    
                    foreach ($request->State_id as $keyS=>$Stateid) {
                    foreach ($request->Zone_id as $keyZ=>$Zones) {

                    $zone  = Zones::where('State_id',$request->$request->State_id[$keyS])->where('Zone_id',$request->Zone_id[$keyZ])->first();

                        if($zone)
                        {
                            NotificationBroadcast::create([
                                'Notification_id' => $request->NotificationId,
                                'Zone_id' => $Zones,
                            ]); 
                        }
                        else
                        {
                             
                            $notification = NotificationBroadcast::where('Notification_id',$request->NotificationId)->where('State_id', $Stateid)->first();
                            if($notification==null)
                            {
                                NotificationBroadcast::create([
                                'Notification_id' => $request->NotificationId,
                                'Greater_Zones_id' => $Stateid,
                                ]);
                            }
                        }
                    
                    }
                    }

            }

            else if($request->has('State_id') && $request->has('Zone_id') && $request->has('District_id') && $request->missing('Union_id'))
            {
                    
                    foreach ($request->Zone_id as $keyZ=>$Zones) {
                    foreach ($request->District_id as $keyD=>$District) {

                    $district  = District::where('Zone_id',$request->Zone_id[$keyZ])->where('District_id',$request->District_id[$keyD])->first();

                        if($district)
                        {
                            NotificationBroadcast::create([
                                'Notification_id' => $request->NotificationId,
                                'District_id' => $District,
                            ]); 
                        }
                        else
                        {
                            
                            $notification = NotificationBroadcast::where('Notification_id',$request->NotificationId)->where('Zone_id', $Zones)->first();
                            if($notification==null)
                            {
                                 NotificationBroadcast::create([
                                    'Notification_id' => $request->NotificationId,
                                    'Zone_id' => $Zones,
                                ]);
                            }
                        }
                        }

                           
                    
                    }
            }
            else if($request->has('District_id') && $request->has('Union_id') && $request->has('Zone_id') && $request->has('State_id'))
            {
                    
                    foreach ($request->District_id as $keyD=>$District) {
                    foreach ($request->Union_id as $keyU=>$Union) {
                    $union  = Union::where('District_id',$request->District_id[$keyD])
                                ->where('Union_id',$request->Union_id[$keyU])
                                ->first();

                        if($union)
                        {
                            NotificationBroadcast::create([
                                'Notification_id' => $request->NotificationId,
                                'Union_id' => $Union,
                            ]); 
                        }
                        else
                        {
                               $notification = NotificationBroadcast::where('Notification_id',$request->NotificationId)->where('District_id', $District)->first();
                                if($notification==null)
                                {
                                     NotificationBroadcast::create([
                                        'Notification_id' => $request->NotificationId,
                                        'District_id' => $District,
                                    ]);
                                }
                        }
                    }
                    }

            }
            Session::forget('notificationId');
          return redirect(route('list.notification'));  

        }


        public function editNotification($Notification)
        {
            $Notifications = Notification::where("Notification_id",$Notification)->first();
            $GeoCount=NotificationBroadcast::where("Notification_id",$Notification)->count();
            if($GeoCount>0){
                $Notifications->is_group='N';
            }else{
                $Notifications->is_group='Y';
            }
            return view('notification.edit')->with([
            'Notifications'   => $Notifications,
            
        ]);
        }

        public function UpdateNotification(Request $request)
        {
             $validator = Validator::make($request->all(),[
                'NotificationPath' => 'max:1024',
            ]);

            if($validator->fails()){
                return \Redirect::back()->withInput()->withWarning( 'Image Must be Less than 1MB');
            }

            if ($request->hasFile('NotificationPath'))
            {
      
                $image_ext = $request->file('NotificationPath')->getClientOriginalExtension();
                $image_extn = strtolower($image_ext);
                $imageName = time() .'_'. $request->NotificationPath->getClientOriginalName();
                $filePath = $request->file('NotificationPath')->storeAs('Notification', $imageName,'public');
                $Notification_image_path = config('app.url').'storage/app/public/Notification/'.$imageName; 

                 $Notification = Notification::where("Notification_id", $request->Notification_id)->update(['Language_id'=> $request->LanguageId,'Notification_start_date'=> $request->start_date,'Notification_end_date'=> $request->end_date,'Notification_active'=> $request->active,'Notification_approved'=> $request->approve,'Notification_mesage'=> $request->message,'Notification_image_path'=> $Notification_image_path]);
                 Session::put('notificationId',$request->Notification_id);
                 $broadCastcount = NotificationBroadcast::where('Notification_id',$request->Notification_id)->count();
                 if($broadCastcount>0){
                    return redirect(route('list.notificationbroadcastedit')); 
                 }else{
                    return redirect(route('edit.NotificationGroupBroadcast')); 
                 }
                
            }
            else
            {
                $Notification = Notification::where("Notification_id", $request->Notification_id)->update(['Language_id'=> $request->LanguageId,'Notification_start_date'=> $request->start_date,'Notification_end_date'=> $request->end_date,'Notification_active'=> $request->active,'Notification_approved'=> $request->approve,'Notification_mesage'=> $request->message,'Notification_image_path'=> $request->ImageNotification]);
                Session::put('notificationId',$request->Notification_id);
                $broadCastcount = NotificationBroadcast::where('Notification_id',$request->Notification_id)->count();
                 if($broadCastcount>0){
                    return redirect(route('list.notificationbroadcastedit')); 
                 }else{
                    return redirect(route('edit.NotificationGroupBroadcast')); 
                 }
            }
          
            
              
        }

        public function DeleteNotification(Request $request)
        {
            NotificationBroadcast::where('Notification_id', $request->notificationId)->delete();
            NotificationGroupBroadcast::where('Notification_id', $request->notificationId)->delete();
            Notification::where('Notification_id', $request->notificationId)->delete();
            echo json_encode($request->notificationId);
        }

        public function TruncateNotification()
        {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            NotificationBroadcast::truncate();
            Notification::truncate();
            echo json_encode('Truncated');
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        public function NotificationBroadcast()
        {
            $notifications = Notification::orderby('Notification_id','desc')->first();
            $cities = District::get();
            $states = State::where('State_active','Y')->get();
            $stateJson = StateDivision::get();
            return view('notification.broadcast',compact('notifications','cities','states','stateJson'));

        }

        public function NotificationBroadCastEdit()
        {
            $NotificationBroadcast = NotificationBroadcast::where('Notification_id',Session::get('notificationId'))->get();
             $Notification = Notification::where('Notification_id',Session::get('notificationId'))->first();
             $states = State::where('State_active','Y')->get();
            return view('notification.broadcast.edit',compact('NotificationBroadcast','states','Notification'));
        }
        public function NotificationGroupBroadCastEdit()
        {
            $NotificationGrpBroadcast = NotificationGroupBroadcast::where('Notification_id',Session::get('notificationId'))->get();
             $Notification = Notification::where('Notification_id',Session::get('notificationId'))->first();
             $groups = MemberGroup::where('active','Y')->get();
            return view('notification.broadcast.edit',compact('NotificationGrpBroadcast','groups','Notification'));
        }

        public function UpdateBroadCast(Request $request)
        {
            if($request->missing('State_id')){
            return \Redirect::back()->withInput()->withWarning('Must Select State ');
        }
            $NotificationBroadcast = NotificationBroadcast::where('Notification_id',$request->NotificationId)->delete();
          
            if($request->has('State_id') && $request->missing('Zone_id') && $request->missing('District_id') && $request->missing('Union_id'))
            {
                foreach ($request->State_id as $keys=>$State) {   
                
                        NotificationBroadcast::create([
                            'Notification_id' => $request->NotificationId,
                            'State_id' => $State,
                           
                        ]);
                
                }
            }

            else if($request->has('State_id') && $request->has('Zone_id') && $request->missing('District_id') && $request->missing('Union_id'))
            {
                foreach ($request->State_id as $keys=>$State) {   
                foreach ($request->Zone_id as $keyz=>$zone_id) {
                    if($zone_id==null)
                    {
                         NotificationBroadcast::create([
                            'Notification_id' => $request->NotificationId,
                            'State_id' => $State,
                        ]);
                    }
                    else{
                        NotificationBroadcast::create([
                            'Notification_id' => $request->NotificationId,
                            'State_Division_id' => $zone_id,
                        ]);
                    }

                       
                
                }
                }
            }

            // else if($request->has('State_id') && $request->has('State_Division_id') && $request->has('Greater_Zones_id') && $request->missing('Zone_id'))
            // {
            //         foreach ($request->State_Division_id as $keysd=>$statedivision) {
            //         foreach ($request->Greater_Zones_id as $keyGZ=>$GreaterZonesid) {

            //         $greaterzone  = GreaterZones::where('State_Division_id',$request->State_Division_id[$keysd])->where('Greater_Zones_id',$request->Greater_Zones_id[$keyGZ])->first();

            //             if($greaterzone)
            //             {
            //                 NotificationBroadcast::create([
            //                     'Notification_id' => $request->NotificationId,
            //                     'Greater_Zones_id' => $GreaterZonesid,
            //                 ]); 
            //             }
            //             else
            //             {
            //                 $notification = NotificationBroadcast::where('Notification_id',$request->NotificationId)->where('State_Division_id', $statedivision)->first();
            //                 if($notification==null)
            //                 {
            //                      NotificationBroadcast::create([
            //                         'Notification_id' => $request->NotificationId,
            //                         'State_Division_id' => $statedivision,
            //                     ]);
            //                 }
            //             }

                           
                    
            //         }
            //         }

            // }

            // else if($request->has('State_id') && $request->has('Zone_id') && $request->has('District_id') && $request->missing('Union_id'))
            // {
                    
            //         foreach ($request->Greater_Zones_id as $keyGZ=>$GreaterZonesid) {
            //         foreach ($request->Zone_id as $keyZ=>$Zones) {

            //         $zone  = Zones::where('Greater_Zones_id',$request->Greater_Zones_id[$keyGZ])->where('Zone_id',$request->Zone_id[$keyZ])->first();

            //             if($zone)
            //             {
            //                 NotificationBroadcast::create([
            //                     'Notification_id' => $request->NotificationId,
            //                     'Zone_id' => $Zones,
            //                 ]); 
            //             }
            //             else
            //             {
                             
            //                 $notification = NotificationBroadcast::where('Notification_id',$request->NotificationId)->where('Greater_Zones_id', $GreaterZonesid)->first();
            //                 if($notification==null)
            //                 {
            //                     NotificationBroadcast::create([
            //                     'Notification_id' => $request->NotificationId,
            //                     'Greater_Zones_id' => $GreaterZonesid,
            //                     ]);
            //                 }
            //             }
                    
            //         }
            //         }

            // }

            else if($request->has('State_id') && $request->has('Zone_id') && $request->has('District_id') && $request->missing('Union_id'))
            {
                    
                    foreach ($request->Zone_id as $keyZ=>$Zones) {
                    foreach ($request->District_id as $keyD=>$District) {

                    $district  = District::where('Zone_id',$request->Zone_id[$keyZ])->where('District_id',$request->District_id[$keyD])->first();

                        if($district)
                        {
                            NotificationBroadcast::create([
                                'Notification_id' => $request->NotificationId,
                                'District_id' => $District,
                            ]); 
                        }
                        else
                        {
                            
                            $notification = NotificationBroadcast::where('Notification_id',$request->NotificationId)->where('Zone_id', $Zones)->first();
                            if($notification==null)
                            {
                                 NotificationBroadcast::create([
                                    'Notification_id' => $request->NotificationId,
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
                            NotificationBroadcast::create([
                                'Notification_id' => $request->NotificationId,
                                'Union_id' => $Union,
                            ]); 
                        }
                        else
                        {

                               $notification = NotificationBroadcast::where('Notification_id',$request->NotificationId)->where('District_id', $District)->first();
                                if($notification==null)
                                {
                                     NotificationBroadcast::create([
                                        'Notification_id' => $request->NotificationId,
                                        'District_id' => $District,
                                    ]);
                                }
                             
                        }

                           
                    
                    }
                    }

            }
          return redirect(route('list.notification'));  

        }

        public function showNotificationGroupBroadcast(){
            $Groups=MemberGroup::where('active','Y')->get();
            $notifications=Notification::orderby('Notification_id','DESC')->first();
            return view('notification.group',compact('Groups','notifications'));
        }
        public function saveNotificationGroupBroadcast(Request $request){
            $data = array();

            foreach ($request->Group_id as $row)
            $data[] =[
                    'Group_id' => $row,
                    'Notification_id' => $request->notification_id,
                    'active' => 'Y',
                   ];

            NotificationGroupBroadcast::insert($data);
            return redirect(route('list.notification'));  
        }

        public function editNotificationGroupBroadcast(){
            $Groups=MemberGroup::where('active','Y')->get();
            $notifications=Notification::where('Notification_id',Session::get('notificationId'))->first();
            return view('notification.broadcast.editGroup',compact('Groups','notifications'));
        }

        public function updateNotificationGroupBroadcast(Request $request){
            if($request->Group_id==''){
                return redirect(route('list.notification'));
            }else{
            
                $NotificationGroupBroadcast = NotificationGroupBroadcast::where('Notification_id',Session::get('notificationId'))->delete();
                $data = array();

                foreach ($request->Group_id as $row)
                $data[] =[
                        'Group_id' => $row,
                        'Notification_id' => $request->notification_id,
                        'active' => 'Y',
                       ];

                NotificationGroupBroadcast::insert($data);
                Session::forget('notificationId');
                return redirect(route('list.notification')); 

        }
    }

        public function LoadZones(Request $request)
        {
            $Zones = Zones::whereIN('State_id',$request->State_id)->get();
            return response()->json($Zones);
        }

         public function LoadDistrict(Request $request)
        {
            $district = District::whereIN('Zone_id',$request->zone_id)->get();
            return response()->json($district);
        }

        public function LoadUnion(Request $request)
        {
            $union = Union::whereIN('District_id',$request->district_id)->get();
            return response()->json($union);
        }

        public function LoadPanchayat(Request $request)
        {
            $Panchayat = Panchayat::whereIN('Union_id',$request->union_id)->get();
            return response()->json($Panchayat);
        }


        public function LoadVillage(Request $request)
        {
            $Village = Village::whereIN('Panchayat_id',$request->panchayat_id)->get();
            return response()->json($Village);
        }

        public function LoadStreet(Request $request)
        {
            $Street = Street::whereIN('Village_id',$request->village_id)->get();
            return response()->json($Street);
        }


    }
