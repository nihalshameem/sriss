<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DonationText;
use App\Category;
use App\SanadhanamText;


class DonationController extends Controller
{
    public function index()
    {    
        $donations['donations']=DonationText::all();
        return view('donation_details',$donations);
    }

    public function show(DonationText $donationtext)
    {
        $categories = Category::where('type',"1")->where('type_id','1')->get(); 
        $subcategories = Category::where('type',"2")->where('type_id','1')->get();   
        return view('add_donation',compact('categories','subcategories'));
    }

    public function store(Request $request)
    {

        $Donation = new DonationText;
        $Donation->type = $request->type;
        $Donation->category = $request->category;
        $Donation->subcategory = $request->subcategory;
        $Donation->tamil = $request->tamil;
        $Donation->english = $request->english;
        $Donation->hindi = $request->hindi;
        $Donation->amount_per_day = $request->amountPerDay;
        $Donation->no_of_days = $request->noOfDays;
        $Donation->noOfPersons = $request->noOfPersons;
        $Donation->amount_1 = $request->amount_1;
        $Donation->amount_2 = $request->amount_2;
        $Donation->amount_3 = $request->amount_3;
        $Donation->amount_4 = $request->amount_4;

        if($Donation->save()){

            return redirect('/donation_details');

        }else{

            echo "Insert Failed.";
        }
    }

    public function edit($id)
    {
        $donations['donations'] = DonationText::find($id);
        $categories = Category::where('type',"1")->where('type_id','1')->get(); 
        $subcategories = Category::where('type',"2")->where('type_id','1')->get(); 

        return view('donation_edit',$donations,compact('categories','subcategories'));

    }
    


    public function update(Request $request)
    {

        $donations = DonationText::find($request->id);
        $donations->category = $request->category;
        $donations->subcategory = $request->subcategory;
        $donations->tamil = $request->tamil;
        $donations->english = $request->english;
        $donations->hindi = $request->hindi;
        $donations->amount_per_day = $request->amountPerDay;
        $donations->no_of_days = $request->noOfDays;
        $donations->noOfPersons = $request->noOfPersons;
        $donations->amount_1 = $request->amount_1;
        $donations->amount_2 = $request->amount_2;
        $donations->amount_3 = $request->amount_3;
        $donations->amount_4 = $request->amount_4;

            if($donations->save()){

               return redirect('/donation_details');
            
            }else{

                echo "Update Failed.";
            }
    }

    public function destroy($id)
    {
        $donation = DonationText::find($id);

            if($donation->delete()){

            return redirect('/donation_details');

        }else{

            echo "Delete Failed.";
        }
    }
    
    
    
    
    public function addCategory()
    {   
       return view('addCategory');
    }

    public function addSubCategory()
    {    
       return view('addSubCategory');
    }

    public function category()
    {   
        $categories['categories']=Category::all();
       return view('category_details',$categories);
    }

    public function addCategoryPost(Request $request)
    {   
       $category =new Category;
       $category->type_id = $request->typeId;
       $category->type = $request->type;
       $category->category = $request->category;
       $category->save();
       return redirect('/category');

    }

    public function addSubCategoryPost(Request $request)
    {    
       $category =new Category;
       $category->type_id = $request->typeId;
       $category->type = $request->type;
       $category->sub_category = $request->category;
       $category->keyvalue = $request->keyvalue;
       $category->save();
       return redirect('/category');
    }


    public function categoryDelete($id)
    {
        
        
        $category = Category::find($id);
        
        $type = $category['type_id'];
        
        $typeId = $category['type'];  // 1. Cate 2.SubCat
    
       $childId = '0';
       
       
        
        
        if($type == "1"){ //  Donation
            
            if($typeId == "1"){  // Category
                $childId = DonationText::where('category',$id)->count();
            }
            
            
            if($typeId == "2"){  // SubCategory
                
                $childId = DonationText::where('subcategory',$id)->count();

            }
            
        }
        
        if($type == "2"){ // Sanadhanams
            
            if($typeId == "1"){  // Category
                $childId = SanadhanamText::where('category',$id)->count();
            }
            
            if($typeId == "2"){  // SubCategory
                
                $childId = SanadhanamText::where('subcategory',$id)->count();
            }
            
        }
        

        if($childId > 0){
            
             return redirect()->back()->with('message','They are dependent on the Donation/Sanadhanam.So cant be able to delete...');
            
        }else{
            $category = Category::find($id)->delete();
            return redirect()->back()->with('message','Successfully Deleted...');
        }
    

    }


    public function categoryEdit($id)
    {
        $categories['categories'] = Category::find($id);

        return view('categoryUpdatee',$categories);
    }

    public function categoryUpdate(Request $request)
    {

        $category = Category::find($request->id);
        $category->type_id = $request->typeId;
        $category->type = $request->type;
        $category->sub_category = $request->subCategory;
        $category->category = $request->category;
        $category->keyvalue = $request->keyvalue;
        $category->save();

        return redirect('/category');
    }
}
