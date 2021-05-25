<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CasteLeader;

use Validator;

class CasteController extends ApiController
{
    	public function listCasteLeader()
    	{
    		$CasteLeader = CasteLeader::get();
    		return view('Caste.list',compact('CasteLeader'));
    	}
    	public function AddCasteLeader()
	    {
	    	return view('Caste.add');
	    }

	    public function	SaveCasteLeader(Request $request)
		{
			$CasteLeader = new CasteLeader();
			$CasteLeader->Caste_name = $request->name;
            $CasteLeader->Caste_email = $request->email;
            $CasteLeader->Caste_phone = $request->phone;
            $CasteLeader->Caste_birth_date = $request->dob;
            $CasteLeader->Caste_death_date = $request->dod;
            $CasteLeader->Caste_organization = $request->organization;
            $CasteLeader->Caste_address = $request->address;
            $CasteLeader->Caste_whatsapp_no = $request->whatsapp;
			$CasteLeader->save();
			return redirect(route('list.Caste'));
		}

		public function EditCasteLeader($ReligiousId)
	    {
	    	$CasteLeader = CasteLeader::where('Caste_Id',$ReligiousId)->first();
	    	return view('Caste.edit',compact('CasteLeader'));
	    }

	    public function	UpdateCasteLeader(Request $request)
		{
			$ReligiousLeader = CasteLeader::where("Caste_Id", $request->id)->update([
                            'Caste_name'=> $request->name, 
                            'Caste_email'=> $request->email, 
                            'Caste_phone'=> $request->phone,
                            'Caste_birth_date'=> $request->dob,
                            'Caste_death_date'=> $request->dod,
                            'Caste_organization'=> $request->organization, 
                            'Caste_address'=> $request->address, 
                            'Caste_whatsapp_no'=> $request->whatsapp] );
			return redirect(route('list.Caste'));
		}

		public function	DeleteCasteLeader(Request $request)
		{
			$CasteLeader = CasteLeader::where('Caste_Id',$request->Caste_Id)->delete();
			echo json_encode($request->Caste_Id);
		}
		
		/************* Web Services ******/

		public function getCasteLeader(Request $request)
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
                $CasteLeader = CasteLeader::get();
                if($CasteLeader)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'Success',
                        'data' => $CasteLeader
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
