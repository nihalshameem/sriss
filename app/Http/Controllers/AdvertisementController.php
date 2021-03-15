<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\AdvertisementBroadcast;
use Session;
use Validator;
use App\Models\State;
use App\Models\Zones;
use App\Models\District;
use App\Models\Union;

class AdvertisementController extends Controller
{
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
                $advertisement->image_path = config('app.url').'storage/app/public/Advertisement/'.$imageName;  
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
                foreach ($request->Zone_id as $keyZ=>$zone) {
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
		                $adBroad->zone_id=$zone;
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
                            
                            $advertisement = AdvertisementBroadcast::where('advertisement_id',$request->Advertisement_id)->where('zone_id', $Zones)->first();
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
            else if($request->has('District_id') && $request->has('taluk_id') && $request->missing('Zone_id') && $request->missing('District_id') && $request->missing('State_id'))
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
                $imageName = time() .'_'. $request->NotificationPath->getClientOriginalName();
                $filePath = $request->file('AdvertisementImg')->storeAs('Notification', $imageName,'public');
                $Advertisement_image_path = config('app.url').'storage/app/public/Advertisement/'.$imageName; 

                 $Advertisement = Advertisement::where("id", $request->Advertisement_id)->update(['from_date'=> $request->from_date,'to_date'=> $request->to_date,'active'=> $request->active,'description'=> $request->description,'image_path'=> $Ad_image_path, 'link'=> $request->link,'description'=> $request->description]);
                 Session::put('Advertisement_id',$request->Advertisement_id);
                return redirect(route('list.advertisementbroadcastedit')); 
            }
            else
            {
                $Notification = Advertisement::where("id", $request->Advertisement_id)->update(['from_date'=> $request->from_date,'to_date'=> $request->to_date,'active'=> $request->active,'description'=> $request->description,'image_path'=> $Ad_image_path, 'link'=> $request->link,'description'=> $request->description]);
                Session::put('Advertisement_id',$request->Advertisement_id);
                return redirect(route('list.advertisementbroadcastedit'));  
            }
          
            
              
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

        public function editAdvertisement($Advertisement)
        {
            $Advertisements = Advertisement::where("id",$Advertisement)->first();

            return view('Advertisement.edit')->with([
            'Advertisements'   => $Advertisements,
            
        ]);
        }

        public function AdvertisementBroadCastEdit()
        {
            $AdvertisementBroadcast = AdvertisementBroadcast::where('advertisement_id',Session::get('Advertisement_id'))->get();
             $Advertisement = Advertisement::where('id',Session::get('advertisement_id'))->first();
             $states = State::where('State_active','Y')->get();
             $zones = Zones::get();
            return view('Advertisement.broadcast.edit',compact('AdvertisementBroadcast','states','Advertisement','zones'));
        }

}
