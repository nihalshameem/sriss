<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\AboutUs;
use App\Models\Compliance;
use App\Models\Feedback;
use App\Models\Member;
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

class ComplianceController extends Controller
{
    public function ListCompliance()
    {
    	$Compliances = Compliance::get();
    	return view('compliance.list',compact('Compliances'));
    }
    
    public function EditCompliance($id)
    {
        $Compliances = Compliance::where('Compliance_id',$id)->first();
        return view('compliance.save')->with([
            'Compliances'   => $Compliances,
        ]);
    }

    public function SaveCompliance(Request $request)
    {
        Compliance::where("Compliance_id", '=', $request->ComplianceId)
                ->update(['Compliance_desc'=> $request->Compliance_desc,'Compliance_text'=> $request->Compliance_text,'Version_no'=> $request->version, 'Compliance_active'=> $request->active]);

    	return redirect(route('list.compliance'));
    }

    public function ListFeedback()
    {
        $feedbacks = Feedback::orderby('Feedback_id','DESC')->get();
        return view('feedback.list',compact('feedbacks'));
    }

   
}
