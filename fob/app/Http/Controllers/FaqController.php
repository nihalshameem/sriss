<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_vision()
    {
        $visions['visions']=Faq::Where('id','1')->get();
        return view('vision_details',$visions);
    }
    
    public function index_tac()
    {
        $tacs['tacs']=Faq::Where('id','4')->get();
        return view('terms_condition_details',$tacs);
    }

    public function index_privacypolicy()
    {
        $privacypolicy['privacypolicy']=Faq::Where('id','5')->get();
        return view('privacy_policy_details',$privacypolicy);
    }
    
    public function index_idcardvision()
    {
        $idcardvision['idcardvision']=Faq::Where('id','6')->get();
        return view('idcard_vision_details',$idcardvision);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit_vision($id)
    {
        $vision['vision'] = Faq::find($id);

        return view('vision_edit',$vision);
    }
    
    public function edit_tac($id)
    {
        $vision['vision'] = Faq::find($id);

        return view('tac_edit',$vision);
    }

    public function edit_privacypolicy($id)
    {
        $vision['vision'] = Faq::find($id);

        return view('privacypolicy_edit',$vision);
    }
    
    public function edit_idcardvision($id)
    {
        $vision['vision'] = Faq::find($id);

        return view('idcardvision_edit',$vision);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update_vision(Request $request)
    {
         $vision = Faq::find($request->id);
            $vision->vision = $request->vision;

            if($vision->save()){

               return redirect('/vision_details');
            
            }else{

                echo "Update Failed.";
            }
    }
    
    public function update_tac(Request $request)
    {
         $vision = Faq::find($request->id);
            $vision->vision = $request->vision;

            if($vision->save()){

               return redirect('/terms_condition_details');
            
            }else{

                echo "Update Failed.";
            }
    }

    public function update_privacypolicy(Request $request)
    {
         $vision = Faq::find($request->id);
            $vision->vision = $request->vision;

            if($vision->save()){

               return redirect('/privacy_policy_details');
            
            }else{

                echo "Update Failed.";
            }
    }
    
    public function update_idcardvision(Request $request)
    {
         $vision = Faq::find($request->id);
            $vision->vision = $request->vision;

            if($vision->save()){

               return redirect('/idcard_vision_details');
            
            }else{

                echo "Update Failed.";
            }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        //
    }
}
