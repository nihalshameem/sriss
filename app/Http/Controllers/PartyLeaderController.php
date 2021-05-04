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
			$ParliamentConsituency = new PartyLeader();
			$ParliamentConsituency->Party_Desc = $request->Description;
			$ParliamentConsituency->save();
			return redirect(route('list.Party'));
		}

		public function EditPartyLeader($ReligiousId)
	    {
	    	$PartyLeader = PartyLeader::where('Party_Id',$ReligiousId)->first();
	    	return view('Party.edit',compact('PartyLeader'));
	    }

	    public function	UpdatePartyLeader(Request $request)
		{
			$PartyLeader = PartyLeader::where("Party_Id", $request->id)->update(['Party_Desc'=> $request->Description]);
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
