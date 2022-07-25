<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Vision;
use Response;

class VisionController extends Controller
{
    
    public function visionIndex(){
    	$visions = DB::table('visions')->orderBy('typeId','ASC')->orderBy('languageId','ASC')->get();
        $cfgvisions = DB::table('cfg_visions')->get();
    	return view('/visionDetails',compact('visions','cfgvisions'));
    }


    public function visionAdd(){
    	$visions = DB::table('cfg_visions')->get();
    	$languages = DB::table('cfg_languages')->get();
        return view('addVisions',compact('visions','languages'));
    }

    
    public function visionStore(Request $request)
    {
    	$this->validate(request(), [
            'languageId' => 'required',
            'visionId' => 'required',
            'description' => 'required',
        ]);

        $vision = new Vision;
        $vision->languageId = $request->languageId;
        $vision->typeId = $request->visionId;
        $vision->description = $request->description;
        $vision->save();

        return redirect('/visions');
    }


	public function visionDelete($id){
		$vision = Vision::find($id)->delete();
		return redirect('/visions');
	}


	public function visionEdit($id){
		$visions = DB::table('cfg_visions')->get();
    	$languages = DB::table('cfg_languages')->get();
		$visionData = Vision::find($id);
		return view('/visionEdit',compact('visions','languages','visionData'));
	}


	public function visionUpdate(Request $request){

		$this->validate(request(), [
            'languageId' => 'required',
            'visionId' => 'required',
            'description' => 'required',
        ]);

        $vision = Vision::find($request->id);
        $vision->languageId = $request->languageId;
        $vision->typeId = $request->visionId;
        $vision->description = $request->description;
        $vision->save();

        return redirect('/visions');
	}



    public function vsearch(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            if($request->vsearch != "")
            {
                $visions=DB::table('visions')->where('typeId',$request->vsearch)->get();
            }else{
                $visions=DB::table('visions')->get();
            }

$i = 1;
            if($visions){
                foreach ($visions as $key => $vision) {
                    
    $languageName = DB::table('cfg_languages')->where('id',$vision->languageId)->first();
    $visionName = DB::table('cfg_visions')->where('id',$vision->typeId)->first();

                    $output.='<tr>'.
                                '<td>'.$i++.'</td>'.
                                '<td>'.$languageName->language.'</td>'.
                                '<td>'.$visionName->vision.'</td>'.
                                '<td>'.$vision->description.'</td>'.
                                '<td><a href="/fob/visionEdit/'.$vision->id.'" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>'.
                                '<td><a href="/fob/visionDelete/'.$vision->id.'" onclick="return checkDelete()" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;" ></i></a></td>'.
                                '</tr>';
                }
            }

            return Response($output);

        }
    }

}
