<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppImage;
use App\Models\AppImageConfig;
use View;
use Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use JWTAuth;
use Carbon\Carbon;
use Auth;
use DB;
use Route;
use \Illuminate\Http\Response as Res;

class AppImageController extends ApiController
{

	/*********************** Web Application *******************************/

    public function List()
    {
        $AppImage = AppImage::get();
        $AppImageConfig = AppImageConfig::get();
        return view('AppImage.list',compact('AppImage','AppImageConfig'));
    }

    
    public function Show($imageId)
    {
        $AppImage = AppImage::where('App_image_cat_id',$imageId)->first();
        $AppImageConfig = AppImageConfig::where('App_cat_id',$imageId)->get();
        return view('AppImage.save',compact('AppImage','AppImageConfig'));
    }


    public function Save(Request $request)
    {
        
        if ($request->hasFile('AppImagePath'))
        {
            $AppImage = AppImageConfig::where("App_cat_id", '=', $request->App_image_cat_id)->first();
            $name = basename($AppImage->App_image_path);
            $image_ext = $request->file('AppImagePath')->getClientOriginalExtension();
            $image_extn = strtolower($image_ext);
            $imageName = time() .'_'. $request->AppImagePath->getClientOriginalName();
            $filePath = $request->file('AppImagePath')->storeAs('AppImage', $imageName,'public');
            AppImageConfig::where("App_image_config_id", '=', $request->App_image_id)
                                        ->update(['App_image_path'=> config('app.url').'storage/app/public/AppImage/'.$imageName,'App_image_text'=> $request->AppText]);

            return redirect(route('list.AppList'));
        }
        else
        {
            AppImageConfig::where("App_image_config_id", '=', $request->App_image_id)
                                        ->update(['App_image_text'=> $request->AppText]);
            return redirect(route('list.AppList'));
        }
        
        
    }

    public function Delete(Request $request)
    {
        $path = AppImageConfig::where("App_image_config_id", '=', $request->App_image_id)
                                        ->first(); 
        
        AppImageConfig::where("App_image_config_id", '=', $request->App_image_id)
                                        ->update(['App_image_path'=> null]); 
        echo json_encode("Removed");  
    }


    /********************* Web Services ********************/

    public function getAppImage()
    {
        $appImage = AppImageConfig::with('AppImage')->get();
        
        if($appImage)
        {
            
            $LoginheadingImage = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','2')
                                                ->where('App_image_config_id','13')
                                                ->value('App_image_path');

            $LoginheadingText = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','2')
                                                ->where('App_image_config_id','13')
                                                ->value('App_image_text');


            $LoginsubheadingImage = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','2')
                                                ->where('App_image_config_id','14')
                                                ->value('App_image_path');

                                             
             $LoginsubheadingText = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','2')
                                                ->where('App_image_config_id','14')
                                                ->value('App_image_text');


            $LoginlogoText = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','2')
                                                ->where('App_image_config_id','15')
                                                ->value('App_image_text');

            $LoginlogoImage = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','2')
                                                ->where('App_image_config_id','15')
                                                ->value('App_image_path');


            $LoginFooterText = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','2')
                                                ->where('App_image_config_id','16')
                                                ->value('App_image_text');

                                    

            $LoginFooterImage = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','2')
                                                ->where('App_image_config_id','16')
                                                ->value('App_image_path');


            $headingImage = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','1')
                                                ->where('App_image_config_id','1')
                                                ->value('App_image_path');


            $headingText = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','1')
                                                ->where('App_image_config_id','1')
                                                ->value('App_image_text');


            $subheadingImage = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','1')
                                                ->where('App_image_config_id','2')
                                                ->value('App_image_path');

            
             $subheadingText = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','1')
                                                ->where('App_image_config_id','2')
                                                ->value('App_image_text');


            $logoText = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','1')
                                                ->where('App_image_config_id','3')
                                                ->value('App_image_text');

            $logoImage = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','1')
                                                ->where('App_image_config_id','3')
                                                ->value('App_image_path');

            $symbolText = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','1')
                                                ->where('App_image_config_id','4')
                                                ->value('App_image_text');

            $symbolImage = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','1')
                                                ->where('App_image_config_id','4')
                                                ->value('App_image_path');

            $circleText = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','1')
                                                ->where('App_image_config_id','5')
                                                ->value('App_image_text');

                                            

            $circleImage = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','1')
                                                ->where('App_image_config_id','5')
                                                ->value('App_image_path'); 

                                              
            $companyText = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','1')
                                                ->where('App_image_config_id','6')
                                                ->value('App_image_text'); 

                                

            $companyImage = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','1')
                                                ->where('App_image_config_id','6')
                                                ->value('App_image_path'); 

            $sponsorText = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','1')
                                                ->where('App_image_config_id','8')
                                                ->value('App_image_text'); 


            $sponsorImage = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','1')
                                                ->where('App_image_config_id','8')
                                                ->value('App_image_path');  


            $AppLogo = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','3')
                                                ->where('App_image_config_id','7')
                                                ->value('App_image_path');  
                                               

            $AppTitle = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','4')
                                                ->where('App_image_config_id','17')
                                                ->value('App_image_text');

            $donation = AppImageConfig::with('AppImage')
                                                ->where('App_cat_id','5')
                                                ->where('App_image_config_id','18')
                                                ->value('App_image_text');



             return response()->json([
                    'status' => 'success',
                            'code' => $this->getStatusCode(),
                            'message' => 'success',
                            'data'=>[
                            'LaunchscreenheadingImage'=>$headingImage,
                            'LaunchscreenheadingText' =>$headingText,
                            'LaunchscreenSubheadingImage'=>$subheadingImage,
                            'LaunchscreenSubheadingText' =>$subheadingText,
                            'LaunchscreencircleImage' =>$circleImage,
                            'LaunchscreencircleText' =>$circleText,
                            'LaunchscreenlogoImage' =>$logoImage,
                            'LaunchscreenlogoText' =>$logoText,
                            'LaunchscreensymbolImage' =>$symbolImage,
                            'LaunchscreensymbolText' =>$symbolText,
                            'LaunchscreenCompanyImage' =>$companyImage,
                            'LaunchscreenCompanyText' =>$companyText,
                            'LaunchscreenSponsorImage' =>$sponsorImage,
                            'LaunchscreenSponsorText' =>$sponsorText,
                            'LoginscreenheadingImage'=>$LoginheadingImage,
                            'LoginscreenheadingText' =>$LoginheadingText,
                            'LoginscreenSubheadingImage'=>$LoginsubheadingImage,
                            'LoginscreenSubheadingText' =>$LoginsubheadingText,
                            'LoginscreenlogoImage' =>$LoginlogoImage,
                            'LoginscreenlogoText' =>$LoginlogoText,
                            'LoginscreenFooterImage' =>$LoginFooterImage,
                            'LoginscreenFooterText' =>$LoginFooterText,
                            'AppLogo' =>$AppLogo,
                            'AppTitle' =>$AppTitle,
                            'DonationText' =>$donation

                        ],
                    ]);
        }
        else
        {
          return $this->respond([
                            'status' => 'failure',
                            'code' => 400,
                            ]);  
        }
    }
}
