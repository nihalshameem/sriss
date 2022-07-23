<?php

namespace App\Http\Controllers;

use App\Aos;
use App\Feedback;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class AosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aoss['aoss']=Aos::orderBy('id', 'DESC')->get();
        return view('aos_details',$aoss);
    }
    
    public function feedback()
    {
        $feedbacks['feedbacks']=Feedback::orderBy('id', 'DESC')->get();
        return view('feedback_details',$feedbacks);
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
        
        $validatedData = $request->validate([
        'slogam' => 'required',
        'fdate' => 'required',
        'tdate' => 'required',
    ]);
        
        if($request->fdate >$request->tdate)
        {
            return back()->with('date-error', 'To Date must be greater than from date!! ');
        }
        
       if ($request->slogam == "" || $request->slogam == null){
            Session::flash('message', '');
            return back()->withInput();
        }
        
        
        
        $aos = new Aos;
        $aos->slogam = $request->slogam;
        $aos->from_date = $request->fdate;
        $aos->to_date = $request->tdate;
        $aos->active = $request->active;


        if($aos->save()){

            return redirect('/aos_details');

        }else{

            echo "Insert Failed.";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aos  $aos
     * @return \Illuminate\Http\Response
     */
    public function show(Aos $aos)
    {
        
        return view('add_aos');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aos  $aos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aos['aos'] = Aos::find($id);

        return view('aos_edit',$aos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aos  $aos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $validatedData = $request->validate([
        'slogam' => 'required',
        'fdate' => 'required',
        'tdate' => 'required',
    ]);
            
            if($request->fdate >$request->tdate)
            {
            return back()->with('date-error', 'To Date must be greater than from date!! ');
            }
            
            if($request->slogam == "" || $request->slogam == null )
            {
            return back()->with('date-error', 'Slogam Required!! ');
            }
            
            $aoss = Aos::find($request->id);
            $aoss->slogam = $request->slogam;
            $aoss->from_date = $request->fdate;
            $aoss->to_date = $request->tdate;
            $aoss->active = $request->active;

            if($aoss->save()){

               return redirect('/aos_details');
            
            }else{

                echo "Update Failed.";
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aos  $aos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aos = Aos::find($id);

            if($aos->delete()){

            return redirect('/aos_details');

        }else{

            echo "Delete Failed.";
        }
    }
    
    
    
    public function aos_approval($id)
    {
        
    $aos['aos'] = Aos::find($id);

    return view('aos_approval',$aos);
    }


    public function aos_approval_update(Request $request)
    {
         $aoss = Aos::find($request->id);
            $aoss->active = $request->active;

            if($aoss->save()){

               return redirect('/aos_details');
            
            }else{

                echo "Update Failed.";
            }
    }
    
    
    public function aos_mass_delete_index()
    {
        $today=Carbon::now()->toDateTimeString();
        
        $aoss['aoss']=Aos::where('to_date','<',$today)->where('active','!=','yes')->orderBy('id', 'DESC')->get();
        
        return view('aos_mass_delete',$aoss);
    }

    public function aos_mass_delete(Request $request)
    {
        $aos_to_delete=$request->aos;
        if($aos_to_delete != "" || $aos_to_delete != NULL){
        DB::table('aoss')->whereIn('id', $aos_to_delete)->delete();
    }
        return redirect(url('aos_details'));
    }
    
    
    
    
    
    
  public function AjaxApprove($id){

        
        $active = Aos::find($id)->active;

        if($active == "yes"){
        $notifications = Aos::find($id);
        $notifications->active = 'no';
        $notifications->save();
        }else{
        $notifications = Aos::find($id);
        $notifications->active = 'yes';
        $notifications->save();
        }

        return ['status'=>true];

   }  
    
    
    
    
    
    
    
}
