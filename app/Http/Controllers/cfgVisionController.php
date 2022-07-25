<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Vision;
use App\Language;
use App\cfgVision;
use Response;


class cfgVisionController extends Controller
{

    public function cfgVisionIndex(){
        $cfgvisions = DB::table('cfg_visions')->get();
    	return view('/cfgVisionDetails',compact('cfgvisions'));
    }


    public function cfgVisionAdd(){
    	
        return view('addcfgVisions');
    }

    
    public function cfgVisionStore(Request $request)
    {
    	$this->validate(request(), [
            'cfgVision' => 'required',
        ]);

        $vision = new cfgVision;
        $vision->vision = $request->cfgVision;
        
        $vision->save();

        return redirect('/cfgVisions');
    }


	public function cfgVisionDelete($id){
		$vision = cfgVision::find($id)->delete();
		return redirect('/cfgVisions');
	}


	public function cfgVisionEdit($id){
		$visionData = cfgVision::find($id);
		return view('/cfgVisionEdit',compact('visionData'));
	}


	public function cfgVisionUpdate(Request $request){

		$this->validate(request(), [
            'cfgVision' => 'required',
        ]);

        $vision = cfgVision::find($request->id);
        $vision->vision = $request->cfgVision;
        $vision->save();

        return redirect('/cfgVisions');
	}

}
