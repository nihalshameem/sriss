<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Models\PartyLeader;

class PartyLeaderController extends ApiController
{
   		
   		public function listPartyLeader()
    	{
    		$PartyLeader = PartyLeader::get();
    		return view('Party.list',compact('PartyLeader'));
    	}
    	public function AddPartyLeader()
	    {
	    	return view('Party.add');
	    }

	    public function	SavePartyLeader(Request $request)
		{
			$PartyLeader = new PartyLeader();
			$PartyLeader->Party_name = $request->name;
            $PartyLeader->Party_email = $request->email;
            $PartyLeader->Party_phone = $request->phone;
            $PartyLeader->Party_birth_date = $request->dob;
            $PartyLeader->Party_death_date = $request->dod;
            $PartyLeader->Party_organization = $request->organization;
            $PartyLeader->Party_address = $request->address;
            $PartyLeader->Party_whatsapp_no = $request->whatsapp;
			$PartyLeader->save();
			return redirect(route('list.Party'));
		}

		public function EditPartyLeader($ReligiousId)
	    {
	    	$PartyLeader = PartyLeader::where('Party_Id',$ReligiousId)->first();
	    	return view('Party.edit',compact('PartyLeader'));
	    }

	    public function	UpdatePartyLeader(Request $request)
		{
			$PartyLeader = PartyLeader::where("Party_Id", $request->id)->update([
                'Party_name'=> $request->name, 
                'Party_email'=> $request->email, 
                'Party_phone'=> $request->phone,
                'Party_birth_date'=> $request->dob,
                'Party_death_date'=> $request->dod,
                'Party_organization'=> $request->organization, 
                'Party_address'=> $request->address, 
                'Party_whatsapp_no'=> $request->whatsapp] );
			return redirect(route('list.Party'));
		}

		public function	DeletePartyLeader(Request $request)
		{
			$PartyLeader = PartyLeader::where('Party_Id',$request->Party_Id)->delete();
			echo json_encode($request->Party_Id);
		}

		/************* Web Services ******/

		public function getPartyLeader(Request $request)
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
                $PartyLeader = PartyLeader::get();
                if($PartyLeader)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'Success',
                        'data' => $PartyLeader
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
