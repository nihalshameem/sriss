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

    public function index_why_factor()
    {   
        $factors['factors']=Faq::Where('id','2')->get();
        return view('why_factor_details',$factors);
    }

    public function index_faq()
    {
        $faqs['faqs']=Faq::Where('id','3')->get();
        return view('faq_details',$faqs);
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

    public function edit_factor($id)
    {
        $vision['vision'] = Faq::find($id);

        return view('factor_edit',$vision);
    }

    public function edit_faq($id)
    {
        $vision['vision'] = Faq::find($id);

        return view('faq_edit',$vision);
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
    public function update_factor(Request $request)
    {
         $vision = Faq::find($request->id);
            $vision->vision = $request->vision;

            if($vision->save()){

               return redirect('/why_factor_details');
            
            }else{

                echo "Update Failed.";
            }
    }
    public function update_faq(Request $request)
    {
         $vision = Faq::find($request->id);
            $vision->vision = $request->vision;

            if($vision->save()){

               return redirect('/faq_details');
            
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
