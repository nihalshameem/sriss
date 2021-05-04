<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ReligiousLeader;
use Validator;

class ReligiousController extends ApiController
{
    	public function listReligiousLeader()
    	{
    		$ReligiousLeader = ReligiousLeader::get();
    		return view('Religious.list',compact('ReligiousLeader'));
    	}
    	public function AddReligiousLeader()
	    {
	    	return view('Religious.add');
	    }

	    public function	SaveReligiousLeader(Request $request)
		{
			$ParliamentConsituency = new ReligiousLeader();
			$ParliamentConsituency->Religious_Desc = $request->Description;
			$ParliamentConsituency->save();
			return redirect(route('list.Religious'));
		}

		public function EditReligiousLeader($ReligiousId)
	    {
	    	$ReligiousLeader = ReligiousLeader::where('Religious_Id',$ReligiousId)->first();
	    	return view('Religious.edit',compact('ReligiousLeader'));
	    }

	    public function	UpdateReligiousLeader(Request $request)
		{
			$ReligiousLeader = ReligiousLeader::where("Religious_Id", $request->id)->update(['Religious_Desc'=> $request->Description]);
			return redirect(route('list.Religious'));
		}

		public function	DeleteReligiousLeader(Request $request)
		{
			$ReligiousLeader = ReligiousLeader::where('Religious_Id',$request->Religious_Id)->delete();
			echo json_encode($request->Religious_Id);
		}

		/************* Web Services ******/

		public function getReligiousLeader(Request $request)
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
                $ReligiousLeader = ReligiousLeader::get();
                if($ReligiousLeader)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'Success',
                        'data' => $ReligiousLeader
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
