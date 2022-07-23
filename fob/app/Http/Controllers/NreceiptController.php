<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nreceipt;
use App\Notification;
use App\Zone;
use App\District;
use App\Taluk;
use App\Pin;
use DB;


class NreceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    if( ($request->zones)!='') 
    {

    if(isset($request->zones))
    {
        foreach($request->zones as $request->zone)
        {
        $nreceipt = new Nreceipt;
        $nreceipt->notification_id = $request->notifications;
        $nreceipt->zone_id = 0;
        $nreceipt->district_id = $request->zone;
        $nreceipt->taluk_id = 0;
        $nreceipt->pincode_id = 0;
        $nreceipt->save();
        }
        
        return redirect('/notification_details'); 
    }
    
    }else{
        return redirect()->back()->with('alert-select', 'Select minimum one district');
    }

    }
    
    
    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Nreceipt  $nreceipt
     * @return \Illuminate\Http\Response
     */
    
    
    public function show(Nreceipt $nreceipt)
    {
       
    $notifications = DB::table('notifications')->orderBy('id', 'DESC')->get();
    
    $zone = DB::table('zones')->pluck('zone');

    $zonesid=$zone = DB::table('zones')->pluck('id')->toArray();
    $zonesidcount=count($zonesid);
    
    
    foreach ($zonesid as $i){ 

         $zones[] = DB::table('districts')->where('zoneid',$i)->orderBy('id', 'ASC')->get()->toArray();

    }

    $lastid=DB::table('notifications')->where('id', DB::raw("(select max(`id`) from notifications)"))->get();

    return view('notification_receipt',compact('zone','notifications','zones','lastid'));      

    }
    
    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nreceipt  $nreceipt
     * @return \Illuminate\Http\Response
     */
    
    
    public function edit($id)
    {
    
    $notification['notification'] = Notification::find($id);
    
    $zone = DB::table('zones')->pluck('zone');
    
    $zonesid=$zone = DB::table('zones')->pluck('id')->toArray();
    $zonesidcount=count($zonesid);
    
    foreach ($zonesid as $i){ 

        $zones[] = DB::table('districts')->where('zoneid',$i)->orderBy('id', 'ASC')->get()->toArray();

    }
     
    $sentDistricts =Nreceipt::where('notification_id', $id)->where('active', 'yes')->pluck('district_id')->toArray();
    
    
    return view('notification_receipt_edit',$notification,compact('zone','notification','zones','sentDistricts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nreceipt  $nreceipt
     * @return \Illuminate\Http\Response
     */
   
    
    public function update(Request $request)
    {   

       $oldreceipt = DB::table('nreceipts')
            ->where("notification_id", '=',  $request->notifications)
            ->update(['active'=> 'old']);
            
            
            
        $notifyactive = DB::table('notifications')
            ->where("id", '=',  $request->notifications)
            ->update(['active'=> 'no']);
    
    if( ($request->zones)!='') 
    {

    if(isset($request->zones))
    {
        foreach($request->zones as $request->zone)
        {
        $nreceipt = new Nreceipt;
        $nreceipt->notification_id = $request->notifications;
        $nreceipt->zone_id = 0;
        $nreceipt->district_id = $request->zone;
        $nreceipt->taluk_id = 0;
        $nreceipt->pincode_id = 0;
        $nreceipt->active = "no";
        $nreceipt->save();
        }
        
        return redirect('/notification_details'); 
    }
    
    }else{
        return redirect()->back()->with('alert-select', 'Select minimum one district');
    }     
   

    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nreceipt  $nreceipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nreceipt $nreceipt)
    {
        //
    }
}