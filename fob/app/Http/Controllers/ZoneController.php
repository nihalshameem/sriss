<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zone;
use App\District;
use App\Taluk;
use DB;
use App\Volunteer;
use App\Feedback;
use URL;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function index()
    {    

        $zoneId = Zone::pluck('id')->toArray();
        $zoneCount = count($zoneId);

        for($i=0; $i<$zoneCount; $i++ ){
            $result[$i] = Zone::where('id',$zoneId[$i])->get()->toArray();
            
             $result[$i][0]['volCount'] = Volunteer::where('type','z')->where('type_id',$zoneId[$i])->where('active','yes')->count();
        }
        $zones = call_user_func_array("array_merge", $result);

        return view('zone_details',compact('zones'));
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
        $zone = new Zone;
        $zone->zone = $request->zone;
        $zone->description = $request->description;
        
        if($zone->save()){

            return redirect('/zone_details');

        }else{

            echo "Insert Failed.";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        
        return view('add_zone');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zone['zone'] = Zone::find($id);

        return view('zone_edit',$zone);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $zones = Zone::find($request->id);
            $zones->zone = $request->zone;
            $zones->description = $request->description;

            if($zones->save()){

               return redirect('/zone_details');
            
            }else{

                echo "Update Failed.";
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zone = Zone::find($id);

            if($zone->delete()){

            return redirect('/zone_details');

        }else{

            echo "Delete Failed.";
        }
    }


    public function view($id)
    {
        $zone['zone'] = Zone::find($id);

        $districts['districts']=District::where('zoneid', $id)->get();

        return view('zone_district',$zone,$districts);
    }





    public function add_zone_district($id)
    {
        $zone['zone'] = Zone::find($id);

        $districts['districts']=District::all();

        return view('add_zone_district',$zone,$districts);
    }

    public function dist_zoneid(Request $request)
    {
        $result= District::find($request['district'])->update([
                
                'zoneid' => $request['zoneid']]);
        
        return redirect('zone_details');
       
    }
    
    public function add_zone_volunteer($id)
    {    
        $zone['zone'] = Zone::find($id);
        $zones=DB::table('zones')->get();
        $members=DB::table('members')->where('active_flag','yes')->get();
        return view('zonevolunteer',$zone,compact('zones','members'));
    }

    public function store_zone_volunteer(Request $request)
    {
        $volunteer = new Volunteer;
        $volunteer->type = $request->type;
        $volunteer->type_id = $request->type_id;
        $volunteer->member_id = $request->member_id;
        $volunteer->name = $request->membername;
        $volunteer->fdate = $request->fdate;
        $volunteer->tdate = $request->tdate;
        $volunteer->active = $request->active;
       
        if($volunteer->save()){
            
            $zonevolunteer=Zone::where('id',$request->type_id)->first();
            $zonevolunteer->active_vol='yes';
            $zonevolunteer->save();
        
            return redirect('/zone_details')->with('volunteer-added', 'Volunteer added success!! ');

        }else{

            echo "Insert Failed.";
        }
    }
    
    public function zonevolunteer_view($id)
    {
        
        $zone['zone'] = Zone::find($id);
        $zonevolunteers=DB::table('volunteers')
                        ->join('members','members.member_id','volunteers.member_id')
                        ->select('volunteers.id','members.member_id','members.name','members.email','members.mobile_number','volunteers.active')
                        ->where('type_id',$id)
                        ->where('type','z')
                        ->get()->toArray();

        return view('zone_volunteer',$zone,compact('zonevolunteers'));
        
        
    }
    
    public function getMember(Request $request) {

        $member = DB::table("members")->where("member_id",$request->member_id)->pluck("name","id");

        return response()->json($member);

    }
    
    
    public function feedback()
    {
        $feedbacks['feedbacks']=Feedback::orderBy('id', 'DESC')->get();
        return view('feedback_details',$feedbacks);
    }
    
     public function feedback_info(Request $request)
    {
        $feed_member=DB::table("members")->where("member_id",$request->id)->get()->toArray();
        return view('feedback_member_info',compact('feed_member'));
    }
    
     public function volunteer_approval($id)
    {
        
    $volunteers['volunteers'] = Volunteer::find($id);
    $url['url']=url::previous();
    return view('volunteer_edit',$volunteers,$url);
    }


    public function volunteer_approval_update(Request $request)
    {
         $volunteers = Volunteer::find($request->id);
            $volunteers->active = $request->active;
            $url = $request->url;

            if($volunteers->save()){

               return redirect("$url");
            
            }else{

                echo "Update Failed.";
            }
    }
    
    public function volunteer_destroy($id)
    {
        $volunteer = Volunteer::find($id);

            if($volunteer->delete()){

            return redirect()->back();

        }else{

            echo "Delete Failed.";
        }
    }
}
