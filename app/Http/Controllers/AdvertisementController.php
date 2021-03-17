<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use View;
use Auth;
use DB;
use Route;
use PDF;
use App;
use App\Models\Advertisement;
use App\Models\AdvertisementBroadcast;
use Session;
use Validator;
use App\Models\State;
use App\Models\Zones;
use App\Models\District;
use App\Models\Union;
use App\Models\User;
use App\Models\Member;
use App\Models\Volunteer;
use Carbon\Carbon;
use Response;
use \Illuminate\Http\Response as Res;


class AdvertisementController extends ApiController
{

	/*******WEB SERVICE***********/
	public function Advertisements(Request $request)
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
                    $Advertisements = array();

                    if($MemberLocation->Union_Id!=null)
                    {
                          $AdvertisementBroadcast = AdvertisementBroadcast::where('taluk_id',$MemberLocation->Union_Id)->pluck('advertisement_id');
                            
                            
                            $AdvertisementTaluk = Advertisement::where('active','Y')
                                                ->where('to_date','>=',$date)
                                                ->whereIn('id',$AdvertisementBroadcast)
                                                ->orderby('id','desc')
                                                ->get()
                                                ->toArray();
                            array_push($Advertisements, $AdvertisementTaluk);

                    }
                    if($MemberLocation->District_Id!=null)
                    {
                        $AdvertisementBroadcast = AdvertisementBroadcast::where('district_id',$MemberLocation->District_Id)->pluck('advertisement_id');        
                            
                        $AdvertisementDistrict = Advertisement::where('active','Y')
                                                ->where('to_date','>=',$date)
                                                ->whereIn('id',$AdvertisementBroadcast)
                                                ->orderby('id','desc')
                                                ->get()
                                                ->toArray();
                        array_push($Advertisements, $AdvertisementDistrict);                          
                    }
                    if($MemberLocation->Zones_Id!=null)
                    {
                        $AdvertisementBroadcast = AdvertisementBroadcast::where('zone_id',$MemberLocation->Zones_Id)->pluck('advertisement_id');

                        $AdvertisementZone =  Advertisement::where('active','Y')
                                                    
                                                    ->where('to_date','>=',$date)
                                                    ->whereIn('id',$AdvertisementBroadcast)
                                                    ->orderby('id','desc')
                                                    ->get()
                                                    ->toArray();

                        array_push($Advertisements, $AdvertisementZone);            
                    }
                    
                    if($MemberLocation->State_Id!=null)
                    {
                        $AdvertisementBroadcast = AdvertisementBroadcast::where('State_id',$MemberLocation->State_Id)->pluck('advertisement_id');
                            
                        $AdvertisementState = Advertisement::where('active','Y')
                                                ->where('to_date','>=',$date)
                                                ->whereIn('id',$AdvertisementBroadcast)
                                                ->orderby('id','desc')
                                                ->get()->toArray();
                           array_push($Advertisements, $AdvertisementState);
                    }
                   
                     $Advertisements= array_reduce($Advertisements, 'array_merge', array());
                    $Advertisements=array_unique($Advertisements, SORT_REGULAR);
                    $Advertisements = collect($Advertisements)->sortBy('id')->reverse()->toArray();
                    $Advertisements=head($Advertisements);

                    if($Advertisements==false){
                        return $this->respond([
                                            'status' => 'failure',
                                            'code' => 400,
                                            'message' => 'Advertisement not available',
                                            ]);

                    } else{   
                    if(count($Advertisements)>0)
                    {
                        $data=array('image_path' => $Advertisements['image_path'],
                                            'link' => $Advertisements['link'] );

                            return $this->respond([
                                            'status' => 'success',
                                            'message' => 'success',
                                            'code' => $this->getStatusCode(),
                                            'data' => $data
                                            ]);
                    }
                    else
                    {
                        return $this->respond([
                                            'status' => 'failure',
                                            'code' => 400,
                                            'message' => 'Advertisement not available',
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

    public function is_valid_token($token)
    {
        $user = User::where('api_token', $token)->first();
        return $user;
    }



	/********WEB APPLICATION*********/
    	public function GetAdvertisements()
        {
            $Advertisements = Advertisement::orderby('id','DESC')->get();
            return view('Advertisement.list',compact('Advertisements'));
        }

        public function AdvertisementShow()
        {
            $Advertisements = Advertisement::where('id',Session::get('Advertisement_id'))->first();
            return view('Advertisement.save',compact('Advertisements'));
        }

        public function SaveAdvertisement(Request $request)
        {   
            $validator = Validator::make($request->all(),[
                'AdvertisementImg' => 'max:500',
            ]);

            if($validator->fails()){
               return \Redirect::back()->withInput()->withWarning( 'Image Must be Less than 500Kb');
            }
            if(Session::get('Advertisement_id')==null)
            {
                $advertisement = new Advertisement();
                $advertisement->description = $request->description;
                $advertisement->company = $request->company;
                $advertisement->from_date = $request->from_date;
                $advertisement->to_date = $request->to_date;
                $advertisement->active = $request->active;
                $advertisement->link = $request->link;
                if ($request->hasFile('AdvertisementImg'))
                {
                $image_ext = $request->file('AdvertisementImg')->getClientOriginalExtension();
                            $image_extn = strtolower($image_ext);
                            $imageName = time() .'_'. $request->AdvertisementImg->getClientOriginalName();
                            $filePath = $request->file('AdvertisementImg')->storeAs('Advertisement', $imageName,'public');
                            $Ad_image_path = config('app.url').'storage/app/public/Advertisement/'.$imageName;
                $advertisement->image_path = $Ad_image_path;  
                }else{
                	Session::put('Advertisement_id',$advertisement->id);
                    return \Redirect::back()->withInput()->withWarning('Must upload image field');
                }
                $advertisement->save();
                $advertisement = Advertisement::orderby('id','DESC')->first();
                Session::put('Advertisement_id',$advertisement->id);
               
                return redirect(route('list.AdvertisementBroadcast'));
           }
            else
            {
                if ($request->hasFile('AdvertisementImg'))
                {
          
                    $image_ext = $request->file('AdvertisementImg')->getClientOriginalExtension();
                    $image_extn = strtolower($image_ext);
                    $imageName = time() .'_'. $request->AdvertisementImg->getClientOriginalName();
                    $filePath = $request->file('AdvertisementImg')->storeAs('Advertisement', $imageName,'public');
                    $Ad_image_path = config('app.url').'storage/app/public/Advertisement/'.$imageName; 

                     $Advertisement = Advertisement::where("id", $request->Advertisement_id)->update(['from_date'=> $request->from_date,'to_date'=> $request->to_date,'active'=> $request->active,'description'=> $request->description,'image_path'=> $Ad_image_path, 'link'=> $request->link,'description'=> $request->description]);
                     Session::put('Advertisement_id',$request->Advertisement_id);
                    return redirect(route('list.AdvertisementBroadcast')); 
                }
                else
                {
                    Session::put('Advertisement_id',Session::get('advertisement_id'));
                    return \Redirect::back()->withInput()->withWarning('Must upload image field');
                }
            }
           
            
            
        }


         public function UpdateAdvertisement(Request $request)
        {
             $validator = Validator::make($request->all(),[
                'AdvertisementImg' => 'max:500',
            ]);

            if($validator->fails()){
                return \Redirect::back()->withInput()->withWarning( 'Image Must be Less than 500Kb');
            }

            if ($request->hasFile('AdvertisementImg'))
            {
      
                $image_ext = $request->file('AdvertisementImg')->getClientOriginalExtension();
                $image_extn = strtolower($image_ext);
                $imageName = time() .'_'. $request->AdvertisementImg->getClientOriginalName();
                $filePath = $request->file('AdvertisementImg')->storeAs('Advertisement', $imageName,'public');
                $Advertisement_image_path = config('app.url').'storage/app/public/Advertisement/'.$imageName; 

                 $Advertisement = Advertisement::where("id", $request->Advertisement_id)->update(['from_date'=> $request->from_date,'to_date'=> $request->to_date,'active'=> $request->active,'description'=> $request->description,'image_path'=> $Advertisement_image_path, 'link'=> $request->link,'description'=> $request->description]);
                 Session::put('Advertisement_id',$request->Advertisement_id);
                return redirect(route('list.advertisementbroadcastedit')); 
            }
            else
            {
                $Advertisement = Advertisement::where("id", $request->Advertisement_id)->update(['from_date'=> $request->from_date,'to_date'=> $request->to_date,'active'=> $request->active,'description'=> $request->description, 'link'=> $request->link,'description'=> $request->description]); 
                Session::put('Advertisement_id',$request->Advertisement_id);
                return redirect(route('list.advertisementbroadcastedit')); 
            }
              
        }


        public function editAdvertisement($Advertisement)
        {
            $Advertisements = Advertisement::where("id",$Advertisement)->first();

            return view('Advertisement.edit')->with([
            'Advertisements'   => $Advertisements,
            
        ]);
        }

        public function DeleteAdvertisement(Request $request)
        {
            AdvertisementBroadcast::where('advertisement_id', $request->Advertisement_Id)->delete();
            Advertisement::where('id', $request->Advertisement_Id)->delete();
            echo json_encode($request->Advertisement_Id);
        }

        public function TruncateAdvertisement()
        {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            AdvertisementBroadcast::truncate();
            Advertisement::truncate();
            echo json_encode('Truncated');
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        public function AdvertisementBroadcast()
        {
            $advertisement = Advertisement::orderby('id','desc')->first();
            $districts = District::get();
            $states = State::where('State_active','Y')->get();
            $zones = Zones::get();
            $taluk = Union::get();
            return view('Advertisement.broadcast',compact('advertisement','districts','states','taluk','zones'));

        }

        public function SaveAdBroadCast(Request $request)
        {
          
            if($request->has('State_id') && $request->missing('Zone_id') && $request->missing('District_id') && $request->missing('Taluk_id'))
            {
                foreach ($request->State_id as $keys=>$State) {   
                $adBroad=new AdvertisementBroadcast();
                $adBroad->advertisement_id=$request->Advertisement_Id;
                $adBroad->State_id=$State;
               // dd($adBroad);
                $adBroad->save();

                        // AdvertisementBroadcast::create([
                        //     'advertisement_id' => $request->Advertisement_Id,
                        //     'State_id' => $State,
                           
                        // ]);
                
                }
            }

            if($request->missing('State_id')){
            return \Redirect::back()->withInput()->withWarning('Must Select State ');
        }

            else if($request->has('State_id') && $request->has('Zone_id') && $request->missing('District_id') )
            {
                foreach ($request->State_id as $keyS=>$State) {   
                foreach ($request->Zone_id as $keyZ=>$Zone) {
                	$zone  = Zones::where('State_id',$request->State_id[$keyS])->where('Zone_id',$request->Zone_id[$keyZ])->first();
                    if($zone==null)
                    {
                    	$adBroad=new AdvertisementBroadcast();
		                $adBroad->advertisement_id=$request->Advertisement_Id;
		                $adBroad->State_id=$State;
		                $adBroad->save();
                         
                    }
                    else{

                        $adBroad=new AdvertisementBroadcast();
		                $adBroad->advertisement_id=$request->Advertisement_Id;
		                $adBroad->zone_id=$Zone;
		                $adBroad->save();
                    }

                       
                
                }
                }
            }


            else if($request->has('State_id') && $request->has('Zone_id') && $request->has('District_id') && $request->missing('Taluk_id'))
            {
                    
                    foreach ($request->Zone_id as $keyZ=>$Zones) {
                    foreach ($request->District_id as $keyD=>$District) {

                    $district  = District::where('Zone_id',$request->Zone_id[$keyZ])->where('District_id',$request->District_id[$keyD])->first();
                        if($district)
                        {
                        
                            $adBroad=new AdvertisementBroadcast();
			                $adBroad->advertisement_id=$request->Advertisement_Id;
			                $adBroad->district_id=$District;
		                	$adBroad->save();

                        }
                        else
                        {
                            
                            $advertisement = AdvertisementBroadcast::where('advertisement_id',$request->Advertisement_id)->where('Zone_id', $Zones)->first();
                            if($advertisement==null)
                            {
                                 
                            	$adBroad=new AdvertisementBroadcast();
				                $adBroad->advertisement_id=$request->Advertisement_Id;
				                $adBroad->zone_id=$Zones;
			                	$adBroad->save();
                            }
                        }
                        }

                           
                    
                    }
            }
            else if($request->has('District_id') && $request->has('Taluk_id') && $request->missing('Zone_id') && $request->missing('District_id') && $request->missing('State_id'))
            {
                    
                    foreach ($request->District_id as $keyD=>$District) {
                    foreach ($request->Union_id as $keyU=>$Union) {
                    $union  = Union::where('District_id',$request->District_id[$keyD])->where('Union_id',$request->Union_id[$keyU])->first();

                        if($union)
                        {
                           
                            $adBroad=new AdvertisementBroadcast();
			                $adBroad->advertisement_id=$request->Advertisement_Id;
			                $adBroad->taluk_id=$Union;
		                	$adBroad->save(); 
                        }
                        else
                        {

                               $notification = AdvertisementBroadcast::where('advertisement_id',$request->Advertisement_id)->where('district_id', $District)->first();
                                if($notification==null)
                                {
                                     
                                    $adBroad=new AdvertisementBroadcast();
									$adBroad->advertisement_id=$request->Advertisement_Id;
									$adBroad->district_id=$District;
									$adBroad->save(); 
                                }
                             
                        }

                           
                    
                    }
                    }

            }
            Session::forget('Advertisement_id');
          return redirect(route('list.advertisements'));  

        }


        public function AdvertisementBroadCastEdit()
        {
            $AdvertisementBroadcast = AdvertisementBroadcast::where('advertisement_id',Session::get('Advertisement_id'))->get();
             $Advertisement = Advertisement::where('id',Session::get('Advertisement_id'))->first();

             $states = State::where('State_active','Y')->get();
             $zones = Zones::get();
            return view('Advertisement.broadcast.edit',compact('AdvertisementBroadcast','states','Advertisement','zones'));
        }


        public function UpdateAdBroadCast(Request $request)
        {
            if($request->missing('State_id')){
            return \Redirect::back()->withInput()->withWarning('Must Select State ');
        }
            $AdvertisementBroadcast = AdvertisementBroadcast::where('advertisement_id',$request->Advertisement_id)->delete();
          
            if($request->has('State_id') && $request->missing('Zone_id') && $request->missing('district_id') && $request->missing('Taluk_id'))
            {
                foreach ($request->State_id as $keys=>$State) {   
                
                        $adBroad=new AdvertisementBroadcast();
		                $adBroad->advertisement_id=$request->Advertisement_Id;
		                $adBroad->State_id=$State;
	                	$adBroad->save(); 
                
                }
            }

            else if($request->has('State_id') && $request->has('Zone_id') && $request->missing('district_id') && $request->missing('Taluk_id') )
            {
                foreach ($request->State_id as $keyS=>$State) {   
                foreach ($request->Zone_id as $keyZ=>$Zone) {
                	$zone  = Zones::where('State_id',$request->State_id[$keyS])->where('Zone_id',$request->Zone_id[$keyZ])->first();
                    if($zone==null)
                    {
                         
                         $adBroad=new AdvertisementBroadcast();
		                $adBroad->advertisement_id=$request->Advertisement_Id;
		                $adBroad->State_id=$State;
	                	$adBroad->save(); 
                    }
                    else{
                        
                        $adBroad=new AdvertisementBroadcast();
		                $adBroad->advertisement_id=$request->Advertisement_Id;
		                $adBroad->zone_id=$Zone;
	                	$adBroad->save(); 
                    }

                       
                
                }
                }
            }



            else if($request->has('State_id') && $request->has('Zone_id') && $request->has('District_id') && $request->missing('Taluk_id'))
            {
                    
                    foreach ($request->Zone_id as $keyZ=>$Zones) {
                    foreach ($request->District_id as $keyD=>$District) {

                    $district  = District::where('Zone_id',$request->Zone_id[$keyZ])->where('District_id',$request->District_id[$keyD])->first();

                        if($district)
                        {
                            
                            $adBroad=new AdvertisementBroadcast();
		                $adBroad->advertisement_id=$request->Advertisement_Id;
		                $adBroad->District_id=$District;
	                	$adBroad->save(); 
                        }
                        else
                        {
                            
                            $advertismentBroad = AdvertisementBroadcast::where('advertisement_id',$request->Advertisement_id)->where('Zone_id', $Zones)->first();
                            if($advertismentBroad==null)
                            {
                                 
                                 $adBroad=new AdvertisementBroadcast();
		                $adBroad->advertisement_id=$request->Advertisement_Id;
		                $adBroad->Zone_id=$Zones;
	                	$adBroad->save(); 
                            }
                        }
                        }

                           
                    
                    }
            }
            else
            {
                    
                    foreach ($request->District_id as $keyD=>$District) {
                    foreach ($request->Taluk_id as $keyU=>$Union) {
                    $union  = Union::where('District_id',$request->District_id[$keyD])->where('Union_id',$request->Taluk_id[$keyU])->first();

                        if($union)
                        {
                             
                            $adBroad=new AdvertisementBroadcast();
		                $adBroad->advertisement_id=$request->Advertisement_Id;
		                $adBroad->Taluk_id=$Union;
	                	$adBroad->save(); 
                        }
                        else
                        {

                               $notification = AdvertisementBroadcast::where('advertisement_id',$request->Advertisement_id)->where('District_id', $District)->first();
                                if($notification==null)
                                {
                                 $adBroad=new AdvertisementBroadcast();
				                $adBroad->Advertisement_id=$request->Advertisement_Id;
				                $adBroad->State_id=$District;
			                	$adBroad->save(); 
                                }
                        }
                    }
                    }

            }
          return redirect(route('list.advertisements'));  

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

}
