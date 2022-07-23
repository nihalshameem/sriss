<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pollanswer;
use App\Pollquestion;
use DB;


class PollanswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    if(isset($request->responses))
    {
        foreach($request->responses as $request->response)
        {
        $response = new Pollanswer;
        $response->question_id = $request->questionid;
        $response->response = $request->response;
        $response->response_count = 0;
        $response->save();
        }
    }

            return redirect(url('add_pollreceipt'));


    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Pollanswer  $pollanswer
     * @return \Illuminate\Http\Response
     */
    public function show(Pollanswer $pollanswer)
    {
        $pollquestions = DB::table('pollquestions')->orderBy('id', 'DESC')->get();
        $lastid=DB::table('pollquestions')->where('id', DB::raw("(select max(`id`) from pollquestions)"))->get(); 
        $lastid=$lastid[0];
        return view('add_poll_response',compact('pollquestions','lastid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pollanswer  $pollanswer
     * @return \Illuminate\Http\Response
     */
    public function edit(Pollanswer $pollanswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pollanswer  $pollanswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pollanswer $pollanswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pollanswer  $pollanswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pollanswer $pollanswer)
    {
        //
    }
}
