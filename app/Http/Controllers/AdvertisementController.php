<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Session;
use Storage;
 
class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisements['advertisements']=Advertisement::orderBy('id', 'DESC')->get();
        return view('advertisement_details',$advertisements);
    }
    
    public function advertisementsearch(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            if(isset($request->advertisementsearch) && ($request->advertisementsearch1)){
                $advertisements=DB::table('advertisements')
                ->whereBetween('from_date', [$request->advertisementsearch, $request->advertisementsearch1])
                ->orderBy('id', 'DESC')->get();
            }

            if($advertisements){
                foreach ($advertisements as $key => $advertisement) {
                    $output.='<tr>'.
                                '<td>'.$advertisement->id.'</td>'.
                                '<td>'.$advertisement->description.'</td>'.
                                '<td>'.$advertisement->company.'</td>'.
                                '<td>'.$advertisement->from_date.'</td>'.
                                '<td>'.$advertisement->to_date.'</td>'.
                                '<td>'.$advertisement->active.'</td>'.
                                '<td><a href="/advertisement_approval/'.$advertisement->id.'" ><i class="fa fa-check fa-lg" style="text-align:cenetr;"></i></a></td>'.
                                '<td><a href="/advertisement_edit/'.$advertisement->id.'" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>'.
                                
                                '<td><a href="/advertisement_receipt_edit/'.$advertisement->id.'" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>'.
                                
                                '<td><a href="/advertisement_delete/'.$advertisement->id.'" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>'.
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
        
        if($request->fdate >$request->tdate)
        {
            
            Session::flash('date-error', 'To Date must be greater than from date!! ');
            return back()->withInput();
            
        }
        $validator = \Validator::make($request->all(), [
    'img' => 'max:500',
    'bannerimg' => 'max:500',
]);
    if ($validator-> fails()){
            Session::flash('image-error', 'image error!! ');
            return back()->withInput();
        }

        if($request->img){

        $extension=$request->img->getClientOriginalExtension();
        $filename = str_random(15).".".$extension;
        
        $request->img->storeAs('public/upload/advertisements',$filename);
        }
        
        if($request->bannerimg){

        $bannerextension=$request->bannerimg->getClientOriginalExtension();
        $bannerfilename = str_random(15).".".$bannerextension;
        
        $request->bannerimg->storeAs('public/upload/advertisements/banner',$bannerfilename);
        }
        
        
        if ($request->description == "" && $request->description == null){
            Session::flash('message-des', '');
            return back()->withInput();
        }
        
        if ($request->company == "" && $request->company == null){
            Session::flash('message-company', '');
            return back()->withInput();
        }
        
        
        
        $advertisement = new Advertisement;
        $advertisement->description = $request->description;
        $advertisement->company = $request->company;
        if($request->img){
        $advertisement->image_path = 'sriss.in/storage/app/public/upload/advertisements/'.$filename;
        }
        
        if($request->bannerimg){
        $advertisement->banner_image = 'sriss.in/storage/app/public/upload/advertisements/banner/'.$bannerfilename;
        }
        if($request->link){
        $advertisement->link = $request->link;
        }
        $advertisement->from_date = $request->fdate;
        $advertisement->to_date = $request->tdate;
        $advertisement->active = $request->active;

        if($advertisement->save()){

            return redirect(url('add_areceipt'));

        }else{

            echo "Insert Failed.";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
         return view('add_advertisement');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advertisement['advertisement'] = Advertisement::find($id);
        
        $image = Advertisement::where('id',$id)->get()->toArray(); 
        
       
        
        $imageurl = $image[0]['image_path'];
        $imagename = "No Image";
        
        if($imageurl != null){
        preg_match("/[^\/]+$/", $imageurl, $matches);
        $imagename = $matches[0];
        }
        
        
        $banner = $image[0]['banner_image'];
        $bannerimage = "No Image";
        
        if($banner != null){
        preg_match("/[^\/]+$/", $banner, $matches1);
        $bannerimage = $matches1[0];
        }

        return view('advertisement_edit',$advertisement,compact('imagename','bannerimage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        if($request->fdate >$request->tdate)
        {
            Session::flash('date-error', 'To Date must be greater than from date!! ');
            return back()->withInput();
        }
        
        
        
        $adverts = Advertisement::find($request->id);
         
    if($request->img){
        if($adverts->image_path != "" ){
        $imageUrl =$adverts->image_path;
        preg_match("/[^\/]+$/", $imageUrl, $matches);
        $last_word = $matches[0];
        
        if($last_word){
        Storage::delete('public/upload/advertisements/'.$last_word.'');
        }
        }
    }
    
    if($request->bannerimg){
        if($adverts->banner_image != "" ){
        $imageUrl =$adverts->banner_image;
        preg_match("/[^\/]+$/", $imageUrl, $matches);
        $last_word = $matches[0];
        
        if($last_word){
        Storage::delete('public/upload/advertisements/banner/'.$last_word.'');
        }
        }
    }
        
        
        
        if($request->img){

        $extension=$request->img->getClientOriginalExtension();
        $filename = str_random(15).".".$extension;
        $request->img->storeAs('public/upload/advertisements',$filename);
        }
        
        
        if($request->bannerimg){

        $bannerextension=$request->bannerimg->getClientOriginalExtension();
        $bannerfilename = str_random(15).".".$bannerextension;
        $request->bannerimg->storeAs('public/upload/advertisements/banner',$bannerfilename);
        }
        
        
        
        
        
        
        if ($request->description == "" && $request->description == null){
            Session::flash('message-des', '');
            return back()->withInput();
        }
        
        if ($request->company == "" && $request->company == null){
            Session::flash('message-company', '');
            return back()->withInput();
        }
        
        
        $advertisements = Advertisement::find($request->id);
            $advertisements->description = $request->description;
            $advertisements->company = $request->company;
            if(isset($request->img))
            {
            $advertisements->image_path ='sriss.in/storage/app/public/upload/advertisements/'.$filename;
            }
            
            if(isset($request->bannerimg))
            {
            $advertisements->banner_image ='sriss.in/storage/app/public/upload/advertisements/'.$bannerfilename;
            }
            
            $advertisements->link = $request->link;
            $advertisements->from_date = $request->fdate;
            $advertisements->to_date = $request->tdate;

            if($advertisements->save()){

               return redirect('/advertisement_details');
            
            }else{

                echo "Update Failed.";
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        
        $adverts = Advertisement::find($id);
        $last_word = "";
        
        if($adverts->image_path != "" ){
        $imageUrl =$adverts->image_path;
        preg_match("/[^\/]+$/", $imageUrl, $matches);
        $last_word = $matches[0];
        
        if($last_word){
        Storage::delete('public/upload/advertisements/'.$last_word.'');
        }
        }
        
        
        if($adverts->banner_image != "" ){
        $imageUrl =$adverts->banner_image;
        preg_match("/[^\/]+$/", $imageUrl, $matches);
        $last_word = $matches[0];
        
        if($last_word){
        Storage::delete('public/upload/advertisements/banner/'.$last_word.'');
        }
        }
        
        
        
        $advertisement = DB::table('advertisements')->where('id',$id)->delete(); 
        $advertisement = DB::table('areceipts')->where('advertisement_id',$id)->delete();


        return redirect('/advertisement_details');

    }
    
    public function advertisementonlydestroy($id)
    {
        
        $adverts = Advertisement::find($id);
        $last_word = "";
        
        if($adverts->image_path != "" ){
        $imageUrl =$adverts->image_path;
        preg_match("/[^\/]+$/", $imageUrl, $matches);
        $last_word = $matches[0];
        
        if($last_word){
        Storage::delete('public/upload/advertisements/'.$last_word.'');
        }
        }
        
        
        if($adverts->banner_image != "" ){
        $imageUrl =$adverts->banner_image;
        preg_match("/[^\/]+$/", $imageUrl, $matches);
        $last_word = $matches[0];
        
        if($last_word){
        Storage::delete('public/upload/advertisements/banner/'.$last_word.'');
        }
        }
        
        
        $advertisement = DB::table('advertisements')->where('id',$id)->delete(); 
        return redirect('/advertisement_details');

        
    }
    
    public function advertisement_approval($id)
    {
        
    $advertisement['advertisement'] = Advertisement::find($id);

    return view('advertisement_approval',$advertisement);
    }


    public function advertisement_approval_update(Request $request)
    {
        
        $areceipt = DB::table('areceipts')
            ->where("advertisement_id", '=', $request->id)->where("active", '!=' , "old")
            ->update(['active'=> $request->active]);
            
         $advertisements = Advertisement::find($request->id);
            $advertisements->active = $request->active;

            if($advertisements->save()){

               return redirect('/advertisement_details');
            
            }else{

                echo "Update Failed.";
            }
    }
    
    
    public function advertisement_mass_delete_index()
    {
        $today=Carbon::now()->toDateTimeString();
        $advertisements['advertisements']=Advertisement::where('to_date','<',$today)
                                                        ->where('active','!=','yes')
                                                        ->orderBy('id', 'DESC')->get();
        return view('advertisement_mass_delete',$advertisements);
    }

    public function advertisement_mass_delete(Request $request)
    {
        
         $this->validate($request, [
        'advertisement' => 'required',
        ]);
        
        
        foreach($request->advertisement as $key => $value){
            $adverts = Advertisement::find($value);
    
            if($adverts->image_path != "" ){
            $imageUrl =$adverts->image_path;
            preg_match("/[^\/]+$/", $imageUrl, $matches);
            
            $last_word = $matches[0];
            
            if($last_word){
            Storage::delete('public/upload/advertisements/'.$last_word.'');
            }
            }
        }
        
        foreach($request->advertisement as $key => $value){
            $adverts = Advertisement::find($value);
    
            if($adverts->banner_image != "" ){
            $imageUrl =$adverts->banner_image;
            preg_match("/[^\/]+$/", $imageUrl, $matches);
            
            $last_word = $matches[0];
            
            if($last_word){
            Storage::delete('public/upload/advertisements/banner/'.$last_word.'');
            }
            }
        }
        
        
        $advertisement_to_delete=$request->advertisement;
        if($advertisement_to_delete != "" || $advertisement_to_delete != NULL){
        DB::table('advertisements')->whereIn('id', $advertisement_to_delete)->delete();
        DB::table('areceipts')->whereIn('advertisement_id', $advertisement_to_delete)->delete();
    }
        return redirect(url('advertisement_details'));
    }
    
    
    
    
    
    
  public function AjaxApprove($id){

        
        $active = Advertisement::find($id)->active;


        if($active == "yes"){
        $nreceipt = DB::table('areceipts')
            ->where("advertisement_id", '=',  $id)->where("active", '!=' , "old")
            ->update(['active'=> 'no']);

        $notifications = Advertisement::find($id);
        $notifications->active = 'no';
        $notifications->save();
        }else{
        $nreceipt = DB::table('areceipts')
            ->where("advertisement_id", '=',  $id)->where("active", '!=' , "old")
            ->update(['active'=> 'yes']);

        $notifications = Advertisement::find($id);
        $notifications->active = 'yes';
        $notifications->save();
        }


        return ['status'=>true];

   }  
    
    
    
    
    
    
    
    
    
    
}
