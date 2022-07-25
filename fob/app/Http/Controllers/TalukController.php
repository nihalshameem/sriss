<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Taluk;
use App\Pin;
use App\District;
use DB;
use App\Zone;
use App\Volunteer;

class TalukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function index()
    {   
        
    $zones = DB::table('zones')->orderBy('id', 'ASC')->get();
    $firstzone = DB::table('zones')->orderBy('id', 'ASC')->first();
    $firstzoneid = $firstzone->id;
    $districts = DB::table('districts')->orderBy('district', 'ASC')->get();
    $firstdistricts = DB::table('districts')->where('zoneid',$firstzoneid)->orderBy('district', 'ASC')->get();
    $firstdistrictid = $firstdistricts->first()->id;
    
    
    $talukId = Taluk::where('distid',$firstdistrictid)->orderBy('taluk')->pluck('id')->toArray();
    $talukCount = count($talukId);

    for($i=0; $i<$talukCount; $i++ ){
        $result[$i] = Taluk::where('id',$talukId[$i])->get()->toArray();
        
         $result[$i][0]['volCount'] = Volunteer::where('type','a')->where('type_id',$talukId[$i])->where('active','yes')->count();
    }
    $taluks = call_user_func_array("array_merge", $result);
    
    
    
    return view('taluk_details',$taluks,compact('zones','districts','firstzone','firstdistricts','taluks'));
    }
    
    public function getDistricts(Request $request) {

        $districts = DB::table("districts")->where("zoneid",$request->zoneid)->OrderBy('id','ASC')->pluck("district","id");

        return response()->json($districts);

    }


    public function searching(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            
            
        $talukId = Taluk::where('distid',$request->search)->pluck('id')->toArray();
        $talukCount = count($talukId);

        for($i=0; $i<$talukCount; $i++ ){
            $result[$i] = Taluk::where('id',$talukId[$i])->get()->toArray();
            
             $result[$i][0]['volCount'] = Volunteer::where('type','a')->where('type_id',$talukId[$i])->where('active','yes')->count();
        }
        
    $taluks = call_user_func_array("array_merge", $result);

            if($taluks){
                foreach ($taluks as $key => $taluk) {
                    $output.='<tr>'.

                                '<td>'.$taluk["taluk"].'</td>'.
                                '<td>'.$taluk["pincode"].'</td>'.
                               
                                '<td><a href="/fob/taluk_edit/'.$taluk["id"].'" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>'.
                                
                                '<td><a href="/fob/taluk_delete/'.$taluk["id"].'" onclick="return checkDelete()"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>'.
                                
                                
                                 '<td><a href="/fob/taluk_volunteer/'.$taluk["id"].'" >';
                                
                                if($taluk["active_vol"]=="yes"){
                                    
                                 $output.='<i class="fa fa-check fa-lg" style="text-align:cenetr;"></i></a></td>';   
                                
                                    
                                }else
                                {
                                 $output.='<i class="fa fa-remove fa-lg" style="text-align:cenetr;color:red;"></i></a></td>';   
                                }
                            
                                
                                $output.='<td><a href="/fob/taluk_volunteer_details/'.$taluk["id"].'" ><i class="fa fa-user fa-lg" style="text-align:cenetr;">'.$taluk["volCount"].'</i></a></td>'.

                                '</tr>';
                }
            }

            return Response($output);

        }
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
        $taluk = new Taluk;
            $taluk->taluk = $request->taluk;
            $taluk->pincode = $request->pincode;
            $taluk->distid = $request->distid;
        
        if($taluk->save()){

            return redirect('/taluk_details');

        }else{

            echo "Insert Failed.";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taluk  $taluk
     * @return \Illuminate\Http\Response
     */
    public function show(Taluk $taluk)
    {
        $districts['districts']=District::orderBy('district')->get();
        return view('add_taluk',$districts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Taluk  $taluk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $taluk['taluk'] = Taluk::find($id);

        return view('taluk_edit',$taluk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taluk  $taluk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $taluks = Taluk::find($request->id);
            $taluks->taluk = $request->taluk;
            $taluks->pincode = $request->pincode;

            if($taluks->save()){

               return redirect('/taluk_details');
            
            }else{

                echo "Update Failed.";
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Taluk  $taluk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taluk = Taluk::find($id);

            if($taluk->delete()){

            return redirect('/taluk_details');

        }else{

            echo "Delete Failed.";
        }
    }



    public function view($id)
    {
        $taluk['taluk'] = Taluk::find($id);

        $pins['pins']=Pin::where('talukid', $id)->get();

        return view('taluk_pin',$taluk,$pins);
    }

    public function add_taluk_pin($id)
    {
        $taluk['taluk'] = Taluk::find($id);

        $pins['pins']=Pin::all();

        return view('add_taluk_pin',$taluk,$pins);
    }

    public function pin_talukid(Request $request)
    {
        $result= Pin::find($request['pin'])->update([
                
                'talukid' => $request['talukid']
                
                ]);
        
        return redirect('taluk_details');
       
    }

    public function add_taluk_volunteer($id)
    {    
        $taluk['taluk'] = Taluk::find($id);
        $taluks=DB::table('taluks')->get();
        $members=DB::table('members')->where('active_flag','yes')->get();
        return view('talukvolunteer',$taluk,compact('taluks','members'));
    }

    public function store_taluk_volunteer(Request $request)
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
    
            $talukvolunteer=Taluk::where('id',$request->type_id)->first();
            $talukvolunteer->active_vol='yes';
            $talukvolunteer->save();
            
            return redirect('/taluk_details')->with('volunteer-added', 'Volunteer added success!! ');

        }else{

            echo "Insert Failed.";
        }
    }
    
    
    public function talukvolunteer_view($id)
    {
        
        $taluk['taluk'] = Taluk::find($id);
        $talukvolunteers=DB::table('volunteers')
                        ->join('members','members.member_id','volunteers.member_id')
                        ->select('volunteers.id','members.member_id','members.name','members.email','members.mobile_number','volunteers.active')
                        ->where('type_id',$id)
                        ->where('type','a')
                        ->get()->toArray();
        return view('taluk_volunteer',$taluk,compact('talukvolunteers'));
        
        
    }

}
