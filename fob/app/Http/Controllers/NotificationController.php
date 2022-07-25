<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\Zone;
use App\District;
use App\Taluk;
use App\Pin;
use DB;
use Validator;
use Carbon\Carbon;
use Session;
use Storage;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications['notifications']=Notification::orderBy('id', 'DESC')->get();
        return view('notification_details',$notifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     
     public function search1(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            if(isset($request->search) && ($request->search1)){
                $notifications=DB::table('notifications')
                ->whereBetween('from_date', [$request->search, $request->search1])
                ->orderBy('id', 'DESC')->get();
            }

            if($notifications){
                foreach ($notifications as $key => $notification) {
                    $output.='<tr>'.
                                '<td style="padding:6px">'.$notification->id.'</td>'.
                                '<td style="padding:6px">'.$notification->description.'</td>'.
                                '<td style="padding:6px">'.$notification->from_date.'</td>'.
                                '<td style="padding:6px">'.$notification->to_date.'</td>'.
                                '<td style="padding:6px">'.$notification->active.'</td>'.
                                '<td style="padding:6px"><a href="/fob/notification_approval/'.$notification->id.'" ><i class="fa fa-check fa-lg" style="text-align:cenetr;"></i></a></td>'.
                                '<td style="padding:6px"><a href="/fob/notification_edit/'.$notification->id.'" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>'.
                                
                                '<td style="padding:6px"><a href="/fob/notification_receipt_edit/'.$notification->id.'" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>'.
                                
                                '<td style="padding:6px"><a href="/fob/notification_delete/'.$notification->id.'" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>'.
                                '</tr>';
                }
            }

            return Response($output);

        }
    }
     
     
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    
    {
        
        if($request->fdate > $request->tdate)
        {
            Session::flash('date-error', 'To Date must be greater than from date!! ');
            return back()->withInput();
        }
        
        
        
        
        $validator = \Validator::make($request->all(), [
            'image' => 'max:500',
        ]);
        
        
    if ($validator-> fails()){
            Session::flash('image-error', 'image error!! ');
            return back()->withInput();
        }
        
        
        if ($request->description == "" && $request->description == null){
            Session::flash('message', '');
            return back()->withInput();
        }

        
        if($request->image){

        $extension=$request->image->getClientOriginalExtension();

        $filename = str_random(15).".".$extension;

        $request->image->storeAs('public/upload/notifications',$filename);
        }
        
        
        
        $notification = new Notification;
        $notification->description = $request->description;
        $notification->from_date = $request->fdate;
        $notification->to_date = $request->tdate;
        
   
        
        if($request->image){
        $notification->image = 'sriss.in/fob/storage/app/public/upload/notifications/'.$filename;
        }
        
        
        $notification->active = $request->active;


        if($notification->save()){

            return redirect(url('add_nreceipt'));

        }else{

            echo "Insert Failed.";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {


        return view('add_notification');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification['notification'] = Notification::find($id);
        
        $image = Notification::where('id',$id)->get()->toArray(); 
        $imageurl = $image[0]['image'];
        
        $imagename = "No Image";
        
        if($imageurl != null){
        preg_match("/[^\/]+$/", $imageurl, $matches);
        $imagename = $matches[0];
        }
        
        
        return view('notification_edit',$notification,compact('imagename'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $notify = Notification::find($request->id);
         
        $last_word = "";
    if($request->image){
        if($notify->image != "" ){
        $imageUrl =$notify->image;
        preg_match("/[^\/]+$/", $imageUrl, $matches);
        $last_word = $matches[0];
        
        if($last_word){
        Storage::delete('public/upload/notifications/'.$last_word.'');
        }
        }
    }  
        
        if($request->fdate >$request->tdate)
        {
            Session::flash('date-error', 'To Date must be greater than from date!! ');
            return back()->withInput();
        }
        
        if($request->image){
            
        $extension=$request->image->getClientOriginalExtension();
        
        $filename = str_random(15).".".$extension;
        
        $request->image->storeAs('public/upload/notifications',$filename);
        }
        
         if ($request->description == "" && $request->description == null){
            Session::flash('message', '');
            return back()->withInput();
        }
        
        $notifications = Notification::find($request->id);
            $notifications->description = $request->description;
            $notifications->from_date = $request->fdate;
            $notifications->to_date = $request->tdate;
           if(isset($request->image))
            {
            $notifications->image ='sriss.in/fob/storage/app/public/upload/notifications/'.$filename;
            }
            //$notifications->active = $request->active;

            if($notifications->save()){

               return redirect('/notification_details');
            
            }else{

                echo "Update Failed.";
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $notify = Notification::find($id);
        $last_word = "";
        if($notify->image != "" ){
        $imageUrl =$notify->image;
        preg_match("/[^\/]+$/", $imageUrl, $matches);
        $last_word = $matches[0];
        
        if($last_word){
        Storage::delete('public/upload/notifications/'.$last_word.'');
        }
        }
        
        
        $notification = DB::table('notifications')->where('id',$id)->delete();
        
        $notification = DB::table('nreceipts')->where('notification_id',$id)->delete();


            return redirect('/notification_details');
       
       
    }
    
    
    
    public function notificationonlydestroy($id)
    {
        $notify = Notification::find($id);
        $last_word = "";
        if($notify->image != "" ){
        $imageUrl =$notify->image;
        preg_match("/[^\/]+$/", $imageUrl, $matches);
        $last_word = $matches[0];
        
        if($last_word){
        Storage::delete('public/upload/notifications/'.$last_word.'');
        }
        }
        
        $notification = DB::table('notifications')->where('id',$id)->delete();
        
        if($notification){

            return redirect('/notification_details');

        }else{

            echo "Delete Failed.";
        }
    }
    
    public function notification_approval($id)
    {
        
    $notification['notification'] = Notification::find($id);

    return view('notification_approval',$notification);
    }


    public function notification_approval_update(Request $request)
    {
        
        $nreceipt = DB::table('nreceipts')
            ->where("notification_id", '=',  $request->id)->where("active", '!=' , "old")
            ->update(['active'=> $request->active]);
            
         $notifications = Notification::find($request->id);
            $notifications->active = $request->active;

            if($notifications->save()){

               return redirect('/notification_details');
            
            }else{

                echo "Update Failed.";
            }
    }
    
    
    public function notification_mass_delete_index()
    {
        $today=Carbon::now()->toDateTimeString();
        
        $notifications['notifications']=Notification::where('to_date','<',$today)
                                        ->where('active','!=','yes')
                                        ->orderBy('id', 'DESC')->get();
        
        return view('notification_mass_delete',$notifications);
    }

    public function notification_mass_delete(Request $request)
    {
        $this->validate($request, [
        'notification' => 'required',
    ]);
    
    
    foreach($request->notification as $key => $value){
    $notify = Notification::find($value);

        if($notify->image != "" ){
        $imageUrl =$notify->image;
        preg_match("/[^\/]+$/", $imageUrl, $matches);
        
        $last_word = $matches[0];
        
        if($last_word){
        Storage::delete('public/upload/notifications/'.$last_word.'');
        }
        }
    }
    
    
        $notification_to_delete=$request->notification;
        if($notification_to_delete != "" || $notification_to_delete != NULL){
        DB::table('notifications')->whereIn('id', $notification_to_delete)->delete();
        DB::table('nreceipts')->whereIn('notification_id', $notification_to_delete)->delete();
    }
        return redirect(url('notification_details'));
    }
    
    
    
    
    
    
    public function AjaxApprove($id){

        
        $active = Notification::find($id)->active;


        if($active == "yes"){
        $nreceipt = DB::table('nreceipts')
            ->where("notification_id", '=',  $id)->where("active", '!=' , "old")
            ->update(['active'=> 'no']);

        $notifications = Notification::find($id);
        $notifications->active = 'no';
        $notifications->save();
        }else{
        $nreceipt = DB::table('nreceipts')
            ->where("notification_id", '=',  $id)->where("active", '!=' , "old")
            ->update(['active'=> 'yes']);

        $notifications = Notification::find($id);
        $notifications->active = 'yes';
        $notifications->save();
        }


        return ['status'=>true];

   }
    
}
