<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Taluk;
use App\Zone;
use DB;
use App\Volunteer;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $zones['zones']=DB::table('zones')->get();
        
        $districtId = District::pluck('id')->toArray();
        $districtCount = count($districtId);

        for($i=0; $i<$districtCount; $i++ ){
            $result[$i] = District::where('id',$districtId[$i])->get()->toArray();
            
             $result[$i][0]['volCount'] = Volunteer::where('type','d')->where('type_id',$districtId[$i])->where('active','yes')->count();
        }
        $districts = call_user_func_array("array_merge", $result);
        
        return view('district_details',$zones,compact('districts'));
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
        $district = new District;
            $district->district = $request->district;
            $district->description = $request->description;
            $district->zoneid = $request->zoneid;
        
        if($district->save()){

            return redirect('/district_details');

        }else{

            echo "Insert Failed.";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        $zones['zones']=DB::table('zones')->get();
        return view('add_district',$zones);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district['district'] = District::find($id);

        return view('district_edit',$district);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $districts = District::find($request->id);
            $districts->district = $request->district;
            $districts->description = $request->description;
            $district->zoneid = $request->zoneid;
            if($districts->save()){

               return redirect('/district_details');
            
            }else{

                echo "Update Failed.";
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $district = District::find($id);

            if($district->delete()){

            return redirect('/district_details');

        }else{

            echo "Delete Failed.";
        }
    }



    public function view($id)
    {
        $district['district'] = District::find($id);

        $taluks['taluks']=Taluk::where('distid', $id)->get();

        return view('district_taluk',$district,$taluks);
    }

    public function add_district_taluk($id)
    {
        $district['district'] = District::find($id);

        $taluks['taluks']=Taluk::all();

        return view('add_district_taluk',$district,$taluks);
    }

    public function taluk_distid(Request $request)
    {
        $result= Taluk::find($request['taluk'])->update([
                
                'distid' => $request['districtid']
                
                ]);
        
        return redirect('district_details');
       
    }
    
    
    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
    if($request->search != ""){
    $districts=DB::table('districts')->where('zoneid',$request->search)->get();
    }else{
    $districts=DB::table('districts')->get();
    }
            if($districts){
                foreach ($districts as $key => $district) {
                    $output.='<tr>'.
                                '<td>'.$district->district.'</td>'.
                                '<td>'.$district->description.'</td>'.
                                '<td><a href="/fob/district_view/'.$district->id.'" ><i class="fa fa-eye fa-lg" style="text-align:cenetr;"></i></a></td>'.
                                '<td><a href="/fob/district_edit/'.$district->id.'" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>'.
                                
                                '<td><a href="/fob/district_delete/'.$district->id.'" onclick="return checkDelete()" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;" ></i></a></td>'.
                                
                              
                                '<td><a href="/fob/district_volunteer/'.$district->id.'" >';
                                
                                if($district->active_vol=="yes"){
                                    
                                 $output.='<i class="fa fa-check fa-lg" style="text-align:cenetr;"></i></a></td>';   
                                
                                    
                                }else
                                {
                                 $output.='<i class="fa fa-remove fa-lg" style="text-align:cenetr;color:red;"></i></a></td>';   
                                }
                            
                                
                                $output.='<td><a href="/fob/district_volunteer_details/'.$district->id.'" ><i class="fa fa-user fa-lg" style="text-align:cenetr;"></i>'.$district["volCount"].'</a></td>'.
                                
                                '</tr>';
                }
            }

            return Response($output);

        }
    }
    
    public function add_district_volunteer($id)
    {    
        $district['district'] = District::find($id);
        $districts=DB::table('districts')->get();
        $members=DB::table('members')->where('active_flag','yes')->get();
        return view('districtvolunteer',$district,compact('districts','members'));
    }

    public function store_district_volunteer(Request $request)
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
            
            $districtvolunteer=District::where('id',$request->type_id)->first();
            $districtvolunteer->active_vol='yes';
            $districtvolunteer->save();

            return redirect('/district_details')->with('volunteer-added', 'Volunteer added success!! ');

        }else{

            echo "Insert Failed.";
        }
    }
    
    public function districtvolunteer_view($id)
    {
        
        $district['district'] = District::find($id);
        $districtvolunteers=DB::table('volunteers')
                        ->join('members','members.member_id','volunteers.member_id')
                        ->select('volunteers.id','members.member_id','members.name','members.email','members.mobile_number','volunteers.active')
                        ->where('type_id',$id)
                        ->where('type','d')
                        ->get()->toArray();
        return view('district_volunteer',$district,compact('districtvolunteers'));
        
        
    }

}
