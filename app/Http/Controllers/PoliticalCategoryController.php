<?php

namespace App\Http\Controllers;
use App\Models\BoothAgent;
use App\Models\Ward;
use App\Models\Booth;
use App\Models\ParliamentConsituency;
use App\Models\AssemblyConsituency;
use App\Models\District;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class PoliticalCategoryController extends ApiController
{
    public function listCategory()
    {
        $State = State::get();
    	$ParliamentConsituency = ParliamentConsituency::get();
    	$AssemblyConsituency = AssemblyConsituency::get();
    	$Ward = Ward::get();
		$BoothAgent = BoothAgent::get();
    	$Booth = Booth::get();
    	return view('PoliticalCategory.list',compact('State', 'ParliamentConsituency','AssemblyConsituency','Ward','BoothAgent','Booth'));
    }

    /********* Parliament Constituent Operation *****************/

    public function AddParliament()
    {
        $states = State::where('State_active','Y')->get();
    	return view('PoliticalCategory.parliament.add', compact('states'));
    }

    public function	SaveParliament(Request $request)
	{
		$ParliamentConsituency = new ParliamentConsituency();
		$ParliamentConsituency->Parliament_Constituency_Desc = $request->Description;
		$ParliamentConsituency->save();
		return redirect(route('list.political.category'));
	}

	public function EditParliament($ParliamentId)
    {
        $states = State::where('State_active','Y')->get();
    	$ParliamentConsituency = ParliamentConsituency::where('Parliament_Id',$ParliamentId)->first();
    	return view('PoliticalCategory.parliament.edit',compact('ParliamentConsituency', 'states'));
    }

    public function	UpdateParliament(Request $request)
	{
		$ParliamentConsituency = ParliamentConsituency::where("Parliament_Id", $request->id)->update(['State_id'=> $request->state, 'Parliament_Constituency_Desc'=> $request->Description]);
		return redirect(route('list.political.category'));
	}

	public function	DeleteParliament(Request $request)
	{
		$State = ParliamentConsituency::where('Parliament_Id',$request->Parliament_Id)->delete();
		echo json_encode($request->Parliament_Id);
	}

	/**********Assembly Constituent Operations *********/

	public function AddAssembly()
    {
    	$districts = District::where('District_active','Y')->get();
    	return view('PoliticalCategory.assembly.add', compact('districts'));
    }

    public function	SaveAssembly(Request $request)
	{
		$AssemblyConsituency = new AssemblyConsituency();
        $AssemblyConsituency->Dist_Id = $request->district;
		$AssemblyConsituency->Assembly_Constituency_Desc = $request->Description;
		$AssemblyConsituency->save();
		return redirect(route('list.political.category'));
	}

	public function EditAssembly($AssemblyId)
    {
        $districts = District::where('District_active','Y')->get();
    	$AssemblyConsituency = AssemblyConsituency::where('Assembly_Id',$AssemblyId)->first();
    	return view('PoliticalCategory.assembly.edit',compact('AssemblyConsituency', 'districts'));
    }

    public function	UpdateAssembly(Request $request)
	{
		$ParliamentConsituency = AssemblyConsituency::where("Assembly_Id", $request->id)->update(['Assembly_Constituency_Desc'=> $request->Description, 'Dist_Id' => $request->district]);
		return redirect(route('list.political.category'));
	}

	public function	DeleteAssembly(Request $request)
	{
		$AssemblyId = AssemblyConsituency::where('Assembly_Id',$request->Assembly_Id)->delete();
		echo json_encode($request->AssemblyId);
	}

    

	/**********Ward  Operations *********/

	public function AddWard()
    {
    	$ParliamentConsituency = ParliamentConsituency::get();
    	$AssemblyConsituency = AssemblyConsituency::get();
    	 
    	return view('PoliticalCategory.ward.add',compact('ParliamentConsituency','AssemblyConsituency'));
    }

    public function	SaveWard(Request $request)
	{
		$AssemblyConsituency = new Ward();
		$AssemblyConsituency->Ward_Name = $request->Ward_Name;
        $AssemblyConsituency->Ward_No = $request->Ward_No;
		$AssemblyConsituency->Assembly_Const_Id = $request->Assembly_Const_Id;
		$AssemblyConsituency->save();
		return redirect(route('list.political.category'));
	}

	public function EditWard($WardId)
    {

    	$AssemblyConsituency = AssemblyConsituency::get();
    	$Ward = Ward::where('Ward_Id', $WardId)->first();
    	return view('PoliticalCategory.ward.edit', compact('Ward', 'AssemblyConsituency'));
    }

    public function	UpdateWard(Request $request)
	{
		$Ward = Ward::where("Ward_Id", $request->id)->update(['Ward_Name'=> $request->Ward_Name,'Ward_No'=> $request->Ward_No,'Assembly_Const_Id'=> $request->Assembly_Const_Id]);
		return redirect(route('list.political.category'));
	}

	public function	DeleteWard(Request $request)
	{
		$Ward = Ward::where('Ward_Id',$request->Ward_Id)->delete();
		echo json_encode($request->Ward_Id);
	}

	/**********Booth Agent  Operations *********/

	public function AddBoothAgent()
    {   
        $booth = Booth::get();
    	return view('PoliticalCategory.BoothAgent.add', compact('booth'));
    }

    public function	SaveBoothAgent(Request $request)
	{
		$BoothAgent = new BoothAgent();
        $BoothAgent->Booth_id = $request->booth_id;
		$BoothAgent->Booth_Agent_Desc = $request->Booth_Agent_Desc;
		$BoothAgent->Booth_Agent_Name = $request->Booth_Agent_Name;
		$BoothAgent->save();
		return redirect(route('list.political.category'));
	}

	public function EditBoothAgent($BoothAgentId)
    {
        $booth = Booth::get();
    	$BoothAgent = BoothAgent::where('Booth_Agent_Id',$BoothAgentId)->first();
    	return view('PoliticalCategory.BoothAgent.edit',compact('BoothAgent','booth'));
    }

    public function	UpdateBoothAgent(Request $request)
	{
		$BoothAgent = BoothAgent::where("Booth_Agent_Id", $request->id)->update(['Booth_Agent_Desc'=> $request->Booth_Agent_Desc,'Booth_Agent_Name'=> $request->Booth_Agent_Name]);
		return redirect(route('list.political.category'));
	}

	public function	DeleteBoothAgent(Request $request)
	{
		$BoothAgent = BoothAgent::where('Booth_Agent_Id',$request->Booth_Agent_Id)->delete();
		echo json_encode($request->Booth_Agent_Id);
	}

    public function LoadWard(Request $request)
        {
            $ward = Ward::where('Assembly_Const_Id', $request->Assembly_Const_Id)->get();
            return response()->json($ward);
        }

	/**********Booth  Operations *********/

	public function AddBooth()
    {
        $booth = Booth::get();
    	$ParliamentConsituency = ParliamentConsituency::get();
    	$AssemblyConsituency = AssemblyConsituency::get();
	   	$BoothAgent = BoothAgent::get();
	   	$Ward = Ward::get();
    	return view('PoliticalCategory.Booth.add',compact('ParliamentConsituency','AssemblyConsituency','BoothAgent','Ward'));
    }

    public function	SaveBooth(Request $request)
	{
		$Booth = new Booth();
		$Booth->Booth_Desc = $request->Booth_Desc;
		$Booth->Ward_Id = $request->Ward_Id;
        $Booth->Booth_No = $request->Booth_No;
		$Booth->Polling_Station_No = $request->Polling_Station_No;
		$Booth->Polling_Station_Location = $request->Polling_Station_Location;
		$Booth->Polling_Station_Area = $request->Polling_Station_Area;
		$Booth->Assembly_Const_Id = $request->Assembly_Const_Id;
		$Booth->save();
		return redirect(route('list.political.category'));
	}

	public function EditBooth($BoothId)
    {
    	$Booth = Booth::where('Booth_Id',$BoothId)->first();
        $ParliamentConsituency = ParliamentConsituency::get();
        $AssemblyConsituency = AssemblyConsituency::get();
        $BoothAgent = BoothAgent::get();
        $Ward = Ward::get();
    	return view('PoliticalCategory.Booth.edit',compact('Booth','ParliamentConsituency','AssemblyConsituency','BoothAgent','Ward'));
    }

    public function	UpdateBooth(Request $request)
	{
		$Booth = Booth::where("Booth_Id", $request->id)->update(['Booth_Desc'=> $request->Booth_Desc,'Booth_No'=>$request->Booth_No,'Ward_Id'=> $request->Ward_Id,'Polling_Station_No'=>$request->Polling_Station_No,'Polling_Station_Location'=>$request->Polling_Station_Location,'Polling_Station_Area'=>$request->Polling_Station_Area,'Booth_Agent_Id'=>$request->Booth_Agent_Id,'Assembly_Const_Id'=>$request->Assembly_Const_Id,'Parliament_Const_Id'=>$request->Parliament_Const_Id]);
		return redirect(route('list.political.category'));
	}

	public function	DeleteBooth(Request $request)
	{
		$Booth = Booth::where('Booth_Id',$request->Booth_Id)->delete();
		echo json_encode($request->Booth_Id);
	}

	/************ Web Services ********/

	public function getAssembly(Request $request)
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
                $AssemblyConsituency = AssemblyConsituency::get();
                if($AssemblyConsituency)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'Success',
                        'data' => $AssemblyConsituency
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

    public function getParliament(Request $request)
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
                $ParliamentConsituency = ParliamentConsituency::get();
                if($ParliamentConsituency)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'Success',
                        'data' => $ParliamentConsituency
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

    public function getWard(Request $request)
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
                $Ward = Ward::get();
                if($Ward)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'Success',
                        'data' => $Ward
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

    public function getBooth(Request $request)
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
                $Booth = Booth::get();
                if($Booth)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'Success',
                        'data' => $Booth
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
