<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\StateDivision;
use App\Models\GreaterZones;
use App\Models\Zones;
use App\Models\District;
use App\Models\Union;
use App\Models\Panchayat;
use App\Models\Village;
use App\Models\Street;
use App\Models\User;
use View;
use Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use JWTAuth;
use Carbon\Carbon;
use Auth;
use DB;
use Route;
use \Illuminate\Http\Response as Res;

class GeoController extends ApiController
{
	public function listGeo()
	{
	    $State = State::get();
	    $StateDivision = StateDivision::orderBy('State_Division_desc')->get();
	    $GreaterZones = GreaterZones::orderBy('Greater_Zones_desc')->get();
	    $Zones = Zones::orderBy('Zone_desc')->get();
	    $District = District::orderBy('District_desc')->get();
	    $Unions = Union::orderBy('Union_desc')->get();
	    $Panchayat = Panchayat::orderBy('Panchayat_desc')->get();
	    $Village = Village::orderBy('Village_desc')->get();
	    $Street = Street::orderBy('Street_desc')->get();
	    $StateDivisionsfilter = StateDivision::orderBy('State_Division_desc')->get();
	    $GreaterZonesfilter = GreaterZones::orderBy('Greater_Zones_desc')->get();
	    $Zonesfilter = Zones::orderBy('Zone_desc')->get();
	    $Districtfilter = District::orderBy('District_desc')->get();
	    $Unionsfilter = Union::orderBy('Union_desc')->get();
	    $Panchayatfilter = Panchayat::orderBy('Panchayat_desc')->get();
	    $Villagefilter = Village::orderBy('Village_desc')->get();
	    $Streetfilter = Street::orderBy('Street_desc')->get();

	    return view('geo.list',compact('State','StateDivision','GreaterZones','Zones','District','Unions','Panchayat','Village','Street','StateDivisionsfilter','GreaterZonesfilter','Zonesfilter','Districtfilter','Unionsfilter','Panchayatfilter','Villagefilter','Streetfilter'));
	}

	/*State Crud */

	public function ShowState()
	{
		$country = Country::get();
		return view('geo.create.state_save',compact('country'));
	}

	public function	CreateState(Request $request)
	{
		$State = new State();
		$State->Country_id = $request->CountryId;
		$State->State_desc = $request->name;
		$State->State_active = $request->Status;
		$State->save();
		return redirect(route('listGeo'))->withInput(['tab'=>'state-tabs-tab']);
	}

	public function	EditState($Stateid)
	{
		$State = State::where('State_id',$Stateid)->first();
		$country = Country::get();
		 return view('geo.edit.edit_state',compact('country'))->with([
            'State'   => $State,
            
        ]);
	}

	public function	UpdateState(Request $request)
	{
		$State = State::where('State_id',$request->Stateid)->
		update(['Country_id'=> $request->countryId,'State_desc'=> $request->name,'State_active'=> $request->Status]);
		return redirect(route('listGeo'))->withInput(['tab'=>'state-tabs-tab']);
	}

	public function	DeleteState(Request $request)
	{
		$State = State::where('State_id',$request->StateId)->delete();
		echo json_encode($request->StateId);
	}


	/* Statedivision Crud */

	public function ShowStateDivision()
	{
		$states = State::get();
		return view('geo.create.state_division_save',compact('states'));
	}


	public function	CreateStateDivision(Request $request)
	{
		$StateDivision = new StateDivision();
		$StateDivision->State_id = $request->stateId;
		$StateDivision->State_Division_desc = $request->name;
		$StateDivision->State_Division_active = $request->Status;
		$StateDivision->save();
		return redirect(route('listGeo'))->withInput(['tab'=>'statedivision-tabs']);

	}

	public function	EditStateDivision($StateDivisionid)
	{
		$StateDivisions = StateDivision::where('State_Division_id',$StateDivisionid)->first();
		$states = State::get();
		 return view('geo.edit.edit_state_division',compact('states'))->with([
            'StateDivisions'   => $StateDivisions,
            
        ]);
	}

	public function	UpdateStateDivision(Request $request)
	{
		$GreaterZones = StateDivision::where('State_Division_id',$request->StateDivisionid)->
		update(['State_id'=> $request->stateId,'State_Division_desc'=> $request->name,'State_Division_active'=> $request->Status]);
		return redirect(route('listGeo'))->withInput(['tab'=>'statedivision-tabs']);
	}

	public function	DeleteStateDivision(Request $request)
	{
		$StateDivision = StateDivision::where('State_Division_id',$request->StateDivisionId)->delete();
		echo json_encode($request->StateDivisionId);
	}


	/*Greater Zone Crud */

	public function	ShowGreaterZone()
	{
		$StateDivision = StateDivision::where('State_Division_active','Y')->orderBy('State_Division_desc')->get();
		$GreaterZones = GreaterZones::get();
	    return view('geo.create.greaterzone',compact('GreaterZones','StateDivision'));
	}

	
	public function	CreateGreaterZone(Request $request)
	{
		$GreaterZones = new GreaterZones();
		$GreaterZones->State_Division_id = $request->DivisionId;
		$GreaterZones->Greater_Zones_desc = $request->name;
		$GreaterZones->Greater_Zones_active = $request->Status;
		$GreaterZones->save();
		return redirect(route('listGeo'))->withInput(['tab'=>'custom-tabs-three-profile']);
	}

	public function	EditGreaterZone($GreaterZoneid)
	{
		$StateDivisions = StateDivision::where('State_Division_active','Y')->orderBy('State_Division_desc')->get();
		$GreaterZone = GreaterZones::where('Greater_Zones_id',$GreaterZoneid)->first();
		 return view('geo.edit.greaterzoneEdit',compact('StateDivisions'))->with([
            'GreaterZone'   => $GreaterZone,
            
        ]);
	}


	public function	UpdateGreaterZone(Request $request)
	{
		$GreaterZones = GreaterZones::where('Greater_Zones_id',$request->GreaterZoneId)->
		update(['State_Division_id'=> $request->DivisionId,'Greater_Zones_desc'=> $request->name,'Greater_Zones_active'=> $request->Status]);
		return redirect(route('listGeo'))->withInput(['tab'=>'custom-tabs-three-profile']);
	}

	public function	DeleteGreaterZone(Request $request)
	{
		$Zone = Zones::where('Greater_Zones_id',$request->GreaterZoneId)->delete();

		$GreaterZone = GreaterZones::where('Greater_Zones_id',$request->GreaterZoneId)->delete();
		echo json_encode($request->GreaterZoneId);
	}

	/*Zones Crud */

	public function	ShowZone()
	{
		$states = State::get();
	    return view('geo.create.zones',compact('states'));
	}

	public function	CreateZone(Request $request)
	{
		$Zones = new Zones();
		$Zones->State_id = $request->StateId;
		$Zones->Zone_desc = $request->name;
		$Zones->Zone_active = $request->Status;
		$Zones->save();
		return redirect(route('listGeo'))->withInput(['tab'=>'custom-tabs-three-messages']);
	}


	public function	EditZone($Zoneid)
	{
		$State = State::orderBy('State_desc')->get();
		$Zones = Zones::where('Zone_id',$Zoneid)->first();

		 return view('geo.edit.zoneedit',compact('State'))->with([
            'Zones'   => $Zones,
            
        ]);
	}

	
	public function	UpdateZone(Request $request)
	{
		$Zones = Zones::where('Zone_id',$request->ZoneId)->
		update(['State_id'=> $request->StateId,'Zone_desc'=> $request->name,'Zone_active'=> $request->Status]);
		return redirect(route('listGeo'))->withInput(['tab'=>'custom-tabs-three-messages']);
	}

	public function	DeleteZone(Request $request)
	{
		$Zones = Zones::where('Zone_id',$request->zoneId)->delete();
		echo json_encode($request->zoneId);
	}



	/*District Crud */

	public function	ShowDistrict()
	{
		$Zones = Zones::where('Zone_active','Y')->orderBy('Zone_desc')->get();
	    return view('geo.create.district',compact('Zones'));
	}

	public function	CreateDistrict(Request $request)
	{

			$name_count = count($request['name']); 
	        for($i = 0;$i < $name_count; $i++)
	        {
	        	if($request->name[$i]!=null)
				{
		            $District = new District();
		            $District->Zone_id = $request->ZoneId;
		            $District->District_desc = $request->name[$i];
		            $District->District_active = $request->Status;
		            $District->save();
		        }
	        }
	    

		return redirect()->back()->withInput(['tab'=>'custom-tabs-three-settings']);
	}

	public function	EditDistrict($Districtid)
	{
		$Zones = Zones::orderBy('Zone_desc')->get();
		$District = District::where('District_id',$Districtid)->first();

		 return view('geo.edit.edit_district',compact('Zones'))->with([
            'District'   => $District,
            
        ]);
	}

	public function	UpdateDistrict(Request $request)
	{
		$District = District::where('District_id',$request->DistrictId)->
		update(['Zone_id'=> $request->ZoneId,'District_desc'=> $request->name,'District_active'=> $request->Status]);
		return redirect(route('listGeo'))->withInput(['tab'=>'custom-tabs-three-settings']);
	}
	public function	DeleteDistrict(Request $request)
	{
		$Zones = District::where('District_id',$request->Districtid)->delete();
		echo json_encode($request->Districtid);
	}


	/*Union Crud */

	public function	ShowUnion()
	{
		$Districts = District::where('District_active','Y')->orderBy('District_desc')->get();
	    return view('geo.create.union',compact('Districts'));
	}

	public function	CreateUnion(Request $request)
	{
		
		$name_count = count($request['name']);
		for($i = 0;$i < $name_count; $i++)
	        {
	        	if($request->name[$i]!=null)
				{
		          
		            $Union = new Union();
            		$Union->District_id = $request->DistrictId;
            		$Union->pincode = $request->pincode[$i];
            		$Union->Union_desc = $request->name[$i];
            		$Union->Union_active = $request->Status;
            		$Union->save();
		        }
	        }
		return redirect(route('listGeo'))->withInput(['tab'=>'custom-tabs-three-union']);
	}

	public function	EditUnion($Unionid)
	{
		$Union = Union::where('Union_id',$Unionid)->first();
		$District = District::orderBy('District_desc')->get();

		 return view('geo.edit.edit_union',compact('District'))->with([
            'Union'   => $Union,
            
        ]);
	}

	public function	UpdateUnion(Request $request)
	{
		$Union = Union::where('Union_id',$request->UnionId)->
		update(['District_id'=> $request->DistrictId,'Union_desc'=> $request->name,'Union_active'=> $request->Status]);
		return redirect(route('listGeo'))->withInput(['tab'=>'custom-tabs-three-union']);
	}

	public function	DeleteUnion(Request $request)
	{
		$Union = Union::where('Union_id',$request->Union_id)->delete();
		echo json_encode($request->Union_id);
	}



	/*Panchayat Crud */

	public function	ShowPanchayat()
	{
		$Panchayat = Panchayat::where('Panchayat_active','Y')->get();
		$Union = Union::where('Union_active','Y')->orderBy('Union_desc')->get();
	    return view('geo.create.panchayat',compact('Panchayat','Union'));
	}

	public function	CreatePanchayat(Request $request)
	{
		
		$name_count = count($request['name']);
		for($i = 0;$i < $name_count; $i++)
	        {
	        	if($request->name[$i]!=null)
				{
		          
		            $Panchayat = new Panchayat();
            		$Panchayat->Union_id = $request->UnionId;
            		$Panchayat->Panchayat_desc = $request->name[$i];
            		$Panchayat->Panchayat_active = $request->Status;
            		$Panchayat->save();
		        }
	        }
		return redirect(route('listGeo'))->withInput(['tab'=>'custom-tabs-three-panchayat']);
	}

	public function	EditPanchayat($Panchayatid)
	{
		$Panchayat = Panchayat::where('Panchayat_id',$Panchayatid)->first();
		$Union = Union::where('Union_active','Y')->orderBy('Union_desc')->get();

		 return view('geo.edit.edit_panchayat',compact('Union'))->with([
            'Panchayat'   => $Panchayat,
            
        ]);
	}

	public function	UpdatePanchayat(Request $request)
	{
		$Panchayat = Panchayat::where('Panchayat_id',$request->PanchayatId)->
		update(['Union_id'=> $request->UnionId,'Panchayat_desc'=> $request->name,'Panchayat_active'=> $request->Status]);
		return redirect(route('listGeo'))->withInput(['tab'=>'custom-tabs-three-panchayat']);
	}

	public function	DeletePanchayat(Request $request)
	{
		$Panchayat = Panchayat::where('Panchayat_id',$request->PanchayatId)->delete();
		echo json_encode($request->PanchayatId);
	}


	/*Panchayat Crud */

	public function	ShowVillage()
	{
		$Panchayat = Panchayat::orderBy('Panchayat_desc')->get();
		$Village = Village::get();
	    return view('geo.create.add_village',compact('Panchayat','Village'));
	}

	public function	CreateVillage(Request $request)
	{
		
		$name_count = count($request['name']);
		for($i = 0;$i < $name_count; $i++)
	        {
	        	if($request->name[$i]!=null)
				{
		          
		            $Village = new Village();
            		$Village->Panchayat_id = $request->PanchayatId;
            		$Village->Village_desc = $request->name[$i];
            		$Village->Village_active = $request->Status;
            		$Village->save();
		        }
	        }
		return redirect(route('listGeo'))->withInput(['tab'=>'custom-tabs-three-village']);
	}

	public function	EditVillage($VillageId)
	{
		$Village = Village::where('Village_id',$VillageId)->first();
		$Panchayat = Panchayat::orderBy('Panchayat_desc')->get();

		 return view('geo.edit.edit_village',compact('Panchayat'))->with([
            'Village'   => $Village,
            
        ]);
	}

	public function	UpdateVillage(Request $request)
	{
		$Village = Village::where('Village_id',$request->VillageId)->
		update(['Panchayat_id'=> $request->PanchayatId,'Village_desc'=> $request->name,'Village_active'=> $request->Status]);
		return redirect(route('listGeo'))->withInput(['tab'=>'custom-tabs-three-village']);
	}

	public function	DeleteVillage(Request $request)
	{
		$Village = Village::where('Village_id',$request->VillageId)->delete();
		echo json_encode($request->VillageId);
	}


	/*Street Crud */

	public function	ShowStreet()
	{
		$Village = Village::orderBy('Village_desc')->get();
		$Street = Street::where('Street_active','Y')->get();
	    return view('geo.create.add_street',compact('Village','Street'));
	}

	public function	CreateStreet(Request $request)
	{
		
		$name_count = count($request['name']);
		for($i = 0;$i < $name_count; $i++)
	        {
	        	if($request->name[$i]!=null)
				{
		          
		            $Street = new Street();
            		$Street->Village_id = $request->VillageId;
            		$Street->Street_desc = $request->name[$i];
            		$Street->Street_active = $request->Status;
            		$Street->save();
		        }
	        }
		return redirect(route('listGeo'))->withInput(['tab'=>'custom-tabs-three-street']);
	}

	public function	EditStreet($Streetid)
	{
		$Street = Street::where('Street_id',$Streetid)->first();
		$Village = Village::where('Village_active','Y')->orderBy('Village_desc')->get();

		 return view('geo.edit.edit_street',compact('Village'))->with([
            'Street'   => $Street,
            
        ]);
	}

	public function	UpdateStreet(Request $request)
	{
		$Street = Street::where('Street_id',$request->StreetId)->
		update(['Village_id'=> $request->VillageId,'Street_desc'=> $request->name,'Street_active'=> $request->Status]);
		return redirect(route('listGeo'))->withInput(['tab'=>'custom-tabs-three-street']);
	}

	public function	DeleteStreet(Request $request)
	{
		$Street = Street::where('Street_id',$request->StreetId)->delete();
		echo json_encode($request->StreetId);
	}

	/*GEO Filters*/

	public function DistrictFilter(Request $request)
	{
		$District= District::where('Zone_id',$request->ZoneId)->get();
		$Zonesfilter = Zones::orderBy('Zone_desc')->get();
		$District = View::make('geo.list.district', compact('District','Zonesfilter'))->render();
	  	return Response::json(['District' => $District]);

	}


	public function UnionFilter(Request $request)
	{
		$Unions = Union::where('District_id',$request->DistrictId)->get();
		$Zonesfilter = Zones::orderBy('Zone_desc')->get();
		$union = View::make('geo.list.union', compact('Unions','Zonesfilter'))->render();
	  	return Response::json(['union' => $union]);
		
	}

	public function PanchayatFilter(Request $request)
	{
		$Panchayat = Panchayat::where('Union_id',$request->UnionId)->get();
		$Zonesfilter = Zones::orderBy('Zone_desc')->get();
		$Panchayat = View::make('geo.list.panchayat', compact('Panchayat','Zonesfilter'))->render();
	  	return Response::json(['Panchayat' => $Panchayat]);
		
	}

	public function VillageFilter(Request $request)
	{
		$Village = Village::where('Panchayat_id',$request->PanchayatId)->get();
		$Zonesfilter = Zones::orderBy('Zone_desc')->get();
		$Village = View::make('geo.list.village', compact('Village','Zonesfilter'))->render();
	  	return Response::json(['Village' => $Village]);
		
	}

	public function StreetFilter(Request $request)
	{
		$Street = Street::where('Village_id',$request->VillageId)->get();
		$Zonesfilter = Zones::orderBy('Zone_desc')->get();
		$Street = View::make('geo.list.street', compact('Street','Zonesfilter'))->render();
	  	return Response::json(['Street' => $Street]);
		
	}

	/**************Web Services***************/

	public function getDistrict(Request $request)
    {
        $rules = array (
            'member_id' => 'required',
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
                $district = District::get();
                if($district)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'Success',
                        'data' => $district
                    ]);
                }
                else
                {
                    return $this->respond([
                        'status' => 'Failed',
                        'code' => 400,
                        'message' => 'Failed',
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


}
