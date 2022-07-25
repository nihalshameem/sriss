<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Vision;
use App\Language;
use Response;


class LanguageController extends Controller
{

    public function languageIndex(){
        $cfglanguages = DB::table('cfg_languages')->get();
    	return view('/languageDetails',compact('cfglanguages'));
    }


    public function languageAdd(){
    	
        return view('addLanguages');
    }

    
    public function languageStore(Request $request)
    {
    	$this->validate(request(), [
            'language' => 'required',
        ]);

        $vision = new Language;
        $vision->language = $request->language;
        
        $vision->save();

        return redirect('/languages');
    }






	public function languageDelete($id){
	    
	    $valueCount = Vision::where('languageId',$id)->count();
	    
	    if($valueCount >0)
	    {
	        return redirect()->back()->with('message','They are dependent on the Visions.So cant be able to delete...');
	    }else{
	        $vision = Language::find($id)->delete();
	        return redirect()->back()->with('message','Successfully Deleted...');
	    }
	}






	public function languageEdit($id){
		$visionData = Language::find($id);
		return view('/languageEdit',compact('visionData'));
	}


	public function languageUpdate(Request $request){

		$this->validate(request(), [
            'language' => 'required',
        ]);

        $vision = Language::find($request->id);
        $vision->language = $request->language;
        $vision->save();

        return redirect('/languages');
	}

}
