<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SanadhanamText;
use App\Category;

class SanadhanamController extends Controller
{
    public function index()
    {    
        $sanadhanams['sanadhanams']=SanadhanamText::all();
        return view('sanadhanam_details',$sanadhanams);
    }

    public function show(SanadhanamText $sanadhanamtext)
    {
        
        $categories = Category::where('type',"1")->where('type_id','2')->get(); 
        $subcategories = Category::where('type',"2")->where('type_id','2')->get();   
        //dd($subcategories);
        return view('add_sanadhanam',compact('categories','subcategories'));
    }

    public function store(Request $request)
    {
        $Sanadhanam = new SanadhanamText;
        $Sanadhanam->type = $request->type;
        $Sanadhanam->category = $request->category;
        $Sanadhanam->subcategory = $request->subcategory;
        $Sanadhanam->tamil = $request->tamil;
        $Sanadhanam->english = $request->english;
        $Sanadhanam->hindi = $request->hindi;
        $Sanadhanam->amount = $request->amount;
        $Sanadhanam->link = $request->link;

        if($Sanadhanam->save()){

            return redirect('/sanadhanam_details');

        }else{

            echo "Insert Failed.";
        }
    }

    public function edit($id)
    {
        $sanadhanams['sanadhanams'] = SanadhanamText::find($id);
        $categories = Category::where('type',"1")->where('type_id','2')->get(); 
        $subcategories = Category::where('type',"2")->where('type_id','2')->get(); 
        return view('sanadhanam_edit',$sanadhanams,compact('categories','subcategories'));
    }

    public function update(Request $request)
    {

        $sanadhanams = SanadhanamText::find($request->id);
        $sanadhanams->tamil = $request->tamil;
        $sanadhanams->english = $request->english;
        $sanadhanams->hindi = $request->hindi;
        $sanadhanams->category = $request->category;
        $sanadhanams->subcategory = $request->subcategory;
        $sanadhanams->amount = $request->amount;
        $sanadhanams->link = $request->link;

            if($sanadhanams->save()){

               return redirect('/sanadhanam_details');
            
            }else{

                echo "Update Failed.";
            }
    }

    public function destroy($id)
    {
        $sanadhanam = SanadhanamText::find($id);

            if($sanadhanam->delete()){

            return redirect('/sanadhanam_details');

        }else{

            echo "Delete Failed.";
        }
    }
}
