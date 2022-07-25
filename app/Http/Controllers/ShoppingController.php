<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingText;
use App\Category;
use Storage;

class ShoppingController extends Controller
{
    public function index()
    {    
        $shoppings['shoppings']=ShoppingText::all();
        return view('shopping_details',$shoppings);
    }

    public function show(ShoppingText $Shoppingtext)
    {
        
         $categories = Category::where('type',"1")->where('type_id','3')->get(); 
        $subcategories = Category::where('type',"2")->where('type_id','3')->get();   
        return view('add_shopping',compact('categories','subcategories'));
    }

    public function store(Request $request)
    {

        if($request->image){

        $extension=$request->image->getClientOriginalExtension();

        $filename = str_random(15).".".$extension;

        $request->image->storeAs('public/upload/shopping',$filename);
        }
        
        
        $Shooping = new ShoppingText;
        $Shooping->type = $request->type;
        $Shooping->category = $request->category;
         $Shooping->product_name = $request->productName;
        $Shooping->subcategory = $request->subcategory;
        $Shooping->description = $request->description;
        $Shooping->amount = $request->amount;
        $Shooping->quantity = $request->quantity;
        $Shooping->link = $request->link;
        
        if($request->image){
        $Shooping->image = 'sriss.in/storage/app/public/upload/shopping/'.$filename;
        }

        if($Shooping->save()){

            return redirect('/shopping_details');

        }else{

            echo "Insert Failed.";
        }
    }

    public function edit($id)
    {
        $shoppings['shoppings'] = ShoppingText::find($id);

        $categories = Category::where('type',"1")->where('type_id','3')->get(); 
        $subcategories = Category::where('type',"2")->where('type_id','3')->get();   


        return view('shopping_edit',$shoppings,compact('categories','subcategories'));
    }

    public function update(Request $request)
    {

        $shoppings = ShoppingText::find($request->id);
        
        
        $last_word = "";
         
        if($request->image){
            if($shoppings->image != "" ){
            $imageUrl =$shoppings->image;
            preg_match("/[^\/]+$/", $imageUrl, $matches);
            $last_word = $matches[0];
            
            if($last_word){
            Storage::delete('public/upload/shopping/'.$last_word.'');
            }
            }
        }
        
        if($request->image){
           
        $extension=$request->image->getClientOriginalExtension();
        
        $filename = str_random(15).".".$extension;
        
        $request->image->storeAs('public/upload/shopping',$filename);
        }
        
        
        
        $shoppings->description = $request->description;
        $shoppings->category = $request->category;
        $shoppings->product_name = $request->productName;
        $shoppings->subcategory = $request->subcategory;
        $shoppings->amount = $request->amount;
        $shoppings->quantity = $request->quantity;
        $shoppings->link = $request->link;

         if(isset($request->image))
        {
            $shoppings->image ='sriss.in/storage/app/public/upload/shopping/'.$filename;
        }
            
            if($shoppings->save()){

               return redirect('/shopping_details');
            
            }else{

                echo "Update Failed.";
            }
    }

    public function destroy($id)
    {
        $shopping = ShoppingText::find($id);

            if($shopping->delete()){

            return redirect('/shopping_details');

        }else{

            echo "Delete Failed.";
        }
    }
}
