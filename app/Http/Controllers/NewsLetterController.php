<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\NewsLetter;
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

class NewsLetterController extends ApiController
{
    /*****************  Web Application ***************/

    public function listNewsLetter()
    {
    	$NewsLetter = NewsLetter::get();
    	return view('newsletter.list',compact('NewsLetter'));
    }

    public function ShowNewsLetter()
    {
    	return view('newsletter.save');
    }

    public function SaveNewsLetter(Request $request)
    {
    	$NewsLetter = new NewsLetter();
    	$NewsLetter->Newsletter_desc = $request->Newsletter_desc;
    	$NewsLetter->Newsletter_date = $request->Newsletter_date;
        if ($request->hasFile('Newsletter'))
        {
            $image_ext = $request->file('Newsletter')->getClientOriginalExtension();
                        $image_extn = strtolower($image_ext);
                        $imageName = time() .'_'. $request->Newsletter->getClientOriginalName();
                        $filePath = $request->file('Newsletter')->storeAs('NewsLetter', $imageName,'public');
            $NewsLetter->Newsletter = config('app.url').'storage/app/public/NewsLetter/'.$imageName;  
        }
    	$NewsLetter->save();
    	return redirect(route('list.newsletter'));

    }

    public function EditNewsLetter($NewsLetterId)
    {
            $NewsLetter = NewsLetter::where("Newsletter_id",$NewsLetterId)->first();
            return view('newsletter.edit')->with([
            'NewsLetter'   => $NewsLetter,
            
        ]);
    }

     public function UpdateNewsLetter(Request $request)
    {
         if ($request->hasFile('Newsletter'))
            {
      
                $image_ext = $request->file('Newsletter')->getClientOriginalExtension();
                $image_extn = strtolower($image_ext);
                $imageName = time() .'_'. $request->Newsletter->getClientOriginalName();
                $filePath = $request->file('Newsletter')->storeAs('NewsLetter', $imageName,'public');
                $Newsletter =config('app.url').'storage/app/public/NewsLetter/'.$imageName; 

                 $NewsLetter = NewsLetter::where("Newsletter_id", $request->Newsletter_id)->update(['Newsletter_desc'=> $request->Newsletter_desc,'Newsletter_date'=> $request->Newsletter_date,'Newsletter'=> $Newsletter]);

                return redirect(route('list.newsletter')); 
            }
            else
            {
                $NewsLetter = NewsLetter::where("Newsletter_id", $request->Newsletter_id)->update(['Newsletter_desc'=> $request->Newsletter_desc,'Newsletter_date'=> $request->Newsletter_date,'Newsletter'=> $request->ImageNotification]);
                return redirect(route('list.newsletter'));  
            }
    }


    public function NewsLetterDelete(Request $request)
    {
        NewsLetter::where('Newsletter_id', $request->NewsLetterId)->delete(); 
        echo json_encode($request->NewsLetterId);
    }

    public function TruncateNewsLetter()
    {
        NewsLetter::truncate();
        echo json_encode('Truncated');
    }


    /******************Web Services**********************/


    public function getNewsLetter()
    {
        
        $newsLetterCount = NewsLetter::count();

        if($newsLetterCount!=0)
        {
            $newsLetter = NewsLetter::get();
            return $this->respond([
                            'status' => 'success',
                            'message' => 'success',
                            'code' => $this->getStatusCode(),
                            'data'=>$newsLetter,   
                            ]);
        }
        else
        {
          return $this->respond([
                            'status' => 'failure',
                            'message' => 'Newsletter not available',
                            'code' => 400,
                            ]);  
        }  
    }
}
