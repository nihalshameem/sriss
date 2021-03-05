<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\AboutUs;
use App\Models\AppImage;
use App\Models\AppImageConfig;
use App\Models\AppIcon;
use Illuminate\Support\Facades\Storage;
use App\Models\Member;
use App\Models\Compliance;
use App\Models\MemberProfile;
use App\Models\User;
use Session;
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

class WebApplicationController extends ApiController
{

    /********************Web Application*************/

    /***About Us*****/

    public function Index()
    {
        $Languages = Language::get();
        $AboutUs = AboutUs::first();
        return view('aboutus',compact('Languages','AboutUs'));
    }

    public function SaveAbout(Request $request)
    {
        AboutUs::where("Aboutus_id", '=', $request->AboutUsId)
                    ->update(['Aboutus_description'=> $request->description]);
        return redirect(route('aboutus'));
    }

    /******Language Lock******/

    public function ShowLanguageLock()
    {
        $Languages = Language::first();
        return view('Language.language_lock',compact('Languages'));
    }

    public function SaveLanguageLock(Request $request)
    {
         Language::where("Language_id", '=', '1')
                    ->update(['Language_lock'=> $request->Language_lock]);
        return redirect(route('list.languageLock'));
    }

    

    /*App Icon */

    public function AddAppIcon($AppIconId)
    {
        $AppIconEdit = AppIcon::where('AppIcon_id',$AppIconId)->first();
        $AppIcon = AppIcon::get();
        return view('AppIcon.save',compact('AppIcon'))->with([
            'AppIconEdit'   => $AppIconEdit,
            
        ]);
    }

     public function ShowAppIcon()
    {
        $AppIcon = AppIcon::get();
        return view('AppIcon.list',compact('AppIcon'));
    }

    public function SaveAppIcon(Request $request)
    {

        if ($request->hasFile('AppIconPath'))
        {
            $AppIcon = AppIcon::where("AppIcon_id", '=', $request->App_Icon_id)->first();
            $name = basename($AppIcon->AppIcon_image_path);
            //unlink(storage_path('app/public/AppIcon/'.$name));
            $image_ext = $request->file('AppIconPath')->getClientOriginalExtension();
            $image_extn = strtolower($image_ext);
            $imageName = time() .'_'. $request->AppIconPath->getClientOriginalName();
            $filePath = $request->file('AppIconPath')->storeAs('AppIcon', $imageName,'public');

            AppIcon::where("AppIcon_id", '=', $request->App_Icon_id)
                                        ->update(['AppIcon_image_path'=> config('app.url').'storage/app/public/AppIcon/'.$imageName,'AppIcon_desc'=> $request->AppIconEng,'AppIcon_text_ta'=>$request->AppIconTamil,'AppIcon_visible'=>$request->App_Icon_status]);

            return redirect(route('list.appIcon'));
        }
        else
        {
             AppIcon::where("AppIcon_id", '=', $request->App_Icon_id)
                                        ->update(['AppIcon_desc'=> $request->AppIconEng,'AppIcon_text_ta'=>$request->AppIconTamil,'AppIcon_visible'=>$request->App_Icon_status]);
            return redirect(route('list.appIcon'));
        }
        
        
    }

    /*Member Profile */

    public function ListProfiles()
    {
        $MemberProfile = MemberProfile::get();
        return view('Member.listProfiles',compact('MemberProfile'));
    }

    public function EditProfiles($profileId)
    {
       $EditProfiles = MemberProfile::where('id',$profileId)->first();
        return view('Member.saveprofiles')->with([
            'EditProfiles'   => $EditProfiles,
        ]);
    }

    public function UpdateProfiles(Request $request)
    {
        $MemberProfile = MemberProfile::where('id',$request->profileId)->first();
        $MemberProfile->field_name = $request->field_name;
        $MemberProfile->active = $request->active;
        $MemberProfile->save();
        return redirect(route('list.ProfileDetails'));
    }

   
    

    /*****************Web services*****************/

    /***About Us***/

    public function getAboutUs()
    {
        $aboutus = AboutUs::first();

        if($aboutus)
        {

            return $this->respond([
                            'status' => 'success',
                            'message' => 'success',
                            'code' => $this->getStatusCode(),
                            'data'=>$aboutus,   
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

    /***Compliance***/

    public function Compliance()
    {
        $Compliance = Compliance::where('Compliance_active','Y')->first();

        if($Compliance)
        {
            $vision = Compliance::where('Compliance_id','1')->where('Compliance_active','Y')->first();
            $terms = Compliance::where('Compliance_id','2')->where('Compliance_active','Y')->first();
            $privacy = Compliance::where('Compliance_id','3')->where('Compliance_active','Y')->first();
           
            
             return response()->json([
                    'status' => 'success',
                            'code' => $this->getStatusCode(),
                            'message' => 'success',
                            'data'=>array([
                            'vision'=>$vision,
                            'termsandconditions'=>$terms,
                            'privacy'=>$privacy,
                        ]),
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

    /***LanguageLock***/

    public function getLanguageLock(Request $request)
    {
        $rules = array (
            'member_id' => 'required',
            'token' => 'required',
            );

        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails())
        {
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else
        {
            if($user=$this->is_valid_token($request['token']))
            {
                $language = DB::table('drs_language_tbl')->where('Language_lock', 'Y')->value('Language_lock');
                
                $languagecount = DB::table('drs_language_tbl')->where('Language_lock', 'Y')->count();
                
                if($languagecount)
                {
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'data' =>[
                           'language_lock'=> $language
                            ],
                        'message'=>'success',   
                        ]);
                }
                else
                {
                    return $this->respond([
                        'status' => 'failure',
                        'code' => 400,
                        'message' => 'failure',
                        ]);
                }
              

            }
            else
            {
                 return $this->respondTokenError("Token Mismatched");
            }
        }
    }

    /***AppIcon***/
    
    public function getAppIcon(Request $request)
    {

        if($request->member_id!=null)
        {
            if($user=$this->is_valid_token($request['token']))
            {
                $member = User::where('Member_Id',$request->member_id)->first();

                if($member->Is_Volunteer=='Y')
                {
                    $appIcon = AppIcon::where('AppIcon_visible','Y')->get();
                }
                else
                {
                    $appIcon = AppIcon::where('AppIcon_visible','Y')->whereNotIn('AppIcon_desc', ['Collections'])->get();
                }
                if($appIcon)
                {
                    return $this->respond([
                                    'status' => 'success',
                                    'message' => 'success',
                                    'code' => $this->getStatusCode(),
                                    'data'=>$appIcon,   
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
            else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        
    
    }
    else
    {
         $appIcon = AppIcon::where('AppIcon_visible','Y')->get();
                if($appIcon)
                {
                    return $this->respond([
                                    'status' => 'success',
                                    'message' => 'success',
                                    'code' => $this->getStatusCode(),
                                    'data'=>$appIcon,   
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

    public function is_valid_token($token)
    {
        $user = User::where('api_token', $token)->first();
        return $user;
    }
    
}
