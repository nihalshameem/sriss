<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pollquestion;
use App\Pollanswer;
use DB;
use Carbon\Carbon;
use Session;


class PollquestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pollquestions['pollquestions']=Pollquestion::orderBy('id', 'DESC')->get();
        return view('poll_details',$pollquestions);
    }
    
    
    public function pollsearch(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            if(isset($request->pollsearch) && ($request->pollsearch1)){
                $polls=DB::table('pollquestions')
                ->whereBetween('from_date', [$request->pollsearch, $request->pollsearch1])
                ->orderBy('id', 'DESC')->get();
            }

            if($polls){
                foreach ($polls as $key => $poll) {
                    $output.='<tr>'.
                                '<td>'.$poll->id.'</td>'.
                                '<td>'.$poll->question.'</td>'.
                                '<td>'.$poll->from_date.'</td>'.
                                '<td>'.$poll->to_date.'</td>'.
                
                                
                                '<td><a href="/poll_receipt_edit/'.$poll->id.'"  ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>'.
                                
                                '<td><a href="/poll_delete/'.$poll->id.'" onclick="return checkDelete()"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>'.
                             
                                '</tr>';
                }
            }

            return Response($output);

        }
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
        $request->validate([
            'pollques' => 'required',
            'fdate' => 'required',
            'tdate' => 'required',
        ]);
        if($request->fdate >$request->tdate)
        {
            return back()->with('date-error', 'To Date must be greater than from date!! ');
        }
        
        
        if ($request->pollques == "" && $request->pollques == null){
            Session::flash('message', '');
            return back()->withInput();
        }
        
        $poll = new Pollquestion;
        $poll->question = $request->pollques;
        $poll->from_date = $request->fdate;
        $poll->to_date = $request->tdate;
        $poll->active = $request->active;


        if($poll->save()){

            return redirect(url('add_poll_responses'));

        }else{

            echo "Insert Failed.";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pollquestion  $pollquestion
     * @return \Illuminate\Http\Response
     */
    public function show(Pollquestion $pollquestion)
    {
        return view('add_poll_question');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pollquestion  $pollquestion
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
    {
        $pollquestions['pollquestions'] = Pollquestion::find($id);
        return view('pollquestion_edit',$pollquestions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pollquestion  $pollquestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pollquestion $pollquestion)
    {
        $request->validate([
            'question' => 'required',
            'fdate' => 'required',
            'tdate' => 'required',
        ]);
        
        $pollquestion = Pollquestion::find($request->id);
            $pollquestion->question = $request->question;
            $pollquestion->from_date = $request->fdate;
            $pollquestion->to_date = $request->tdate;
        
            if($pollquestion->save()){

               return redirect('/poll_details');
            
            }else{

                echo "Update Failed.";
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pollquestion  $pollquestion
     * @return \Illuminate\Http\Response
     */
    public function pollquestiononlydestroy($id)
    {
        $pollquestion = Pollquestion::find($id);

            if($pollquestion->delete()){

            return redirect('/add_poll_questions');

        }else{

            echo "Delete Failed.";
        }
    }
    
    public function destroy($id)
    {
        $polls = DB::table('pollquestions')->where('id',$id)->delete(); 
        $polls = DB::table('pollanswers')->where('question_id',$id)->delete();
        $polls = DB::table('pollreceipts')->where('question_id',$id)->delete();

            //if($polls){

            return redirect('/poll_details');

        //}else{

            //echo "Delete Failed.";
        //}
    }
    
    
    public function poll_mass_delete_index()
    {
        $today=Carbon::now()->toDateTimeString();
        
        $polls['polls']=Pollquestion::where('to_date','<',$today)
                                    ->orderBy('id', 'DESC')->get();
        
        return view('poll_mass_delete',$polls);
    }

    public function poll_mass_delete(Request $request)
    {
        $poll_to_delete=$request->poll;
        if($poll_to_delete != "" || $poll_to_delete != NULL){
        DB::table('pollquestions')->whereIn('id', $poll_to_delete)->delete();
        DB::table('pollanswers')->whereIn('question_id', $poll_to_delete)->delete();
        DB::table('pollreceipts')->whereIn('question_id', $poll_to_delete)->delete();
    }
        return redirect(url('poll_details'));
    }
    
}
