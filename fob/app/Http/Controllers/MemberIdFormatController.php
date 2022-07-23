<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\memberIdConfig;

class MemberIdFormatController extends Controller
{


    public function index()
    {
        $memberid['memberid']=memberIdConfig::Where('id','1')->get();
        return view('memberIdFormat',$memberid);
    }


	public function edit($id)
    {
        $member=memberIdConfig::where('id',$id)->get()->toArray();
        return view('memberIdFormatEdit',compact('member'));
    }


	public function update(Request $request)
    {
         $memberId = memberIdConfig::find($request->id);
            
            $memberId->memberIdFormat = $request->memberIdFormat;

            if($memberId->save()){

               return redirect('/memberIdFormat');
            
            }else{

                return redirect('/memberIdFormat');
            }
    }
}
