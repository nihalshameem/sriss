<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\AboutUs;
use App\Models\AppImage;
use App\Models\AppImageConfig;
use App\Models\AppIcon;
use App\Models\MemberCategory;
use App\Models\MemberCategoryAppIcon;
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
use Illuminate\Support\Str;

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

    /******Language******/

    public function ListLanguage()
    {
        $Languages = Language::get();
        return view('Language.list',compact('Languages'));
    }
    public function EditLanguage($languageId)
    {
        $language = Language::where('Language_id',$languageId)->first();
        return view('Language.save',compact('language'));
    }

    public function UpdateLanguage(Request $request)
    {
       
         Language::where("Language_id", '=', $request->Language_id)
                    ->update(['Language_name'=> $request->Language_name,'Language_active'=> $request->active]);
        return redirect(route('list.languageLock'));
    }

    

    /*App Icon */

    public function AddAppIcon($AppIconId)
    {
        $AppIconEdit = AppIcon::where('AppIcon_id',$AppIconId)->first();
        $AppIcon = AppIcon::get();
        $Languages = Language::get();
        return view('AppIcon.save',compact('AppIcon','Languages'))->with([
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
                                        ->update(['AppIcon_image_path'=> config('app.url').'storage/app/public/AppIcon/'.$imageName,'L1_text'=> $request->l1_text,
                                            'L2_text'=> $request->l2_text,
                                            'L3_text'=> $request->l3_text,
                                            'AppIcon_visible'=>$request->App_Icon_status]);

            return redirect(route('list.appIcon'));
        }
        else
        {
             AppIcon::where("AppIcon_id", '=', $request->App_Icon_id)
                                        ->update(['L1_text'=> $request->l1_text,
                                            'L2_text'=> $request->l2_text,
                                            'L3_text'=> $request->l3_text,
                                            'AppIcon_visible'=>$request->App_Icon_status]);
            return redirect(route('list.appIcon'));
        }
        
        
    }

    public function getConfiguration(Request $request)
    {
        
       // $otptext = Compliance::where('Compliance_id','5')->value('Compliance_text');
        //$approval_text = Compliance::where('Compliance_id','6')->value('Compliance_text');
        //$contact_person_no = Compliance::where('Compliance_id','7')->value('Compliance_text');
        $whatsapp_no = Compliance::where('Compliance_id','5')->value('Compliance_text');
        //$missed_call_no = Compliance::where('Compliance_id','9')->value('Compliance_text');
                
        if($otptext && $contact_person_no && $whatsapp_no)
        {
            return $this->respond([
                                    'status' => 'success',
                                    'message' => 'success',
                                    'code' => $this->getStatusCode(),
                                    'data'=>[
                                    'whatsapp_no'=>$whatsapp_no,
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
        $MemberProfile->d_label = $request->d_label;
        $MemberProfile->l2_label = $request->l2_label;
        $MemberProfile->l3_label = $request->l3_label;
        $MemberProfile->active = $request->active;
        $MemberProfile->save();
        return redirect(route('list.ProfileDetails'));
    }
    
    public function UpdateProfileStatus(Request $request)
    {
        $MemberProfile = MemberProfile::where('id',$request->id)->first();
        $MemberProfile->active = $request->value;
        $MemberProfile->save();
        echo "success";
    }

    /* Member Category */

    public function ListMemberCategory()
    {
        $membercategory = MemberCategory::get();
        return view('membercategory.list',compact('membercategory'));
    }

    public function AddMemberCategory()
    {
        return view('membercategory.add');

    }

    public function StoreMemberCategory(Request $request)
    {
        $membercategory = new MemberCategory();
        $membercategory->Category = $request->category;
        $membercategory->Category_active = $request->active;
        $membercategory->save();
        return redirect(route('MemberCategory.list'));
    }

    public function EditMemberCategory($categoryId)
    {
        $membercategory = MemberCategory::where('MemberCategory_id',$categoryId)->first();
        return view('membercategory.edit',compact('membercategory'));
    }

    public function UpdateMemberCategory(Request $request)
    {
        $membercategory = MemberCategory::where('MemberCategory_id',$request->categoryId)->update(['Category'=>$request->category,'Category_active'=>$request->active]);
        return redirect(route('MemberCategory.list'));
    }

    public function AssignAppIcon($categoryId)
    {
        $membercategory = MemberCategory::where('MemberCategory_id',$categoryId)->first();
        $appIcon = AppIcon::get();
        return view('membercategory.assign',compact('appIcon','membercategory'));
    }

    public function UpdateAppIconMemberCategory(Request $request)
    {
        $delete = MemberCategoryAppIcon::where('Category_Id',$request->categoryId)->delete();
        foreach ($request->AppIcon as $key=>$cost) {

            MemberCategoryAppIcon::create([
                'Category_Id' => $request->categoryId[$key],
                'AppIcon_Id' => $cost,
            ]);
        }
        return redirect(route('MemberCategory.list'));
    }

    public function DeleteMemberCategory($categoryId)
    {
        $memberCount = Member::where('Member_Category_Id',$categoryId)->count();
        if($memberCount>0)
        {
            return Redirect::back()->withErrors(['Please remove assigned members from this category', 'Please remove assigned members from this category']);

        }
        else
        {
            $MemberCategoryAppIcon = MemberCategoryAppIcon::where('Category_Id',$categoryId)->delete();
            $membercategory = MemberCategory::where('MemberCategory_id',$categoryId)->delete();
                    return redirect(route('MemberCategory.list'));

        }
        
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
            $vision = Compliance::where('Compliance_id','1')->where('Compliance_active','N')->first();
            $terms = Compliance::where('Compliance_id','2')->where('Compliance_active','N')->first();
            $privacy = Compliance::where('Compliance_id','3')->where('Compliance_active','N')->first();
            $language = Language::where('Language_active','D')->where('Language_active','Y')->get();

             return response()->json([
                    'status' => 'success',
                            'code' => $this->getStatusCode(),
                            'message' => 'success',
                            'data'=>array([
                            'vision'=>$vision,
                            'termsandconditions'=>$terms,
                            'privacy'=>$privacy,
                            'language'=>$language,
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

    /***Language***/

    public function getComplianceLock(Request $request)
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
               
                $compliance_lock = Compliance::pluck('Compliance_active', 'Compliance_desc');
                $compliancecount = $compliance_lock->count();
              
                if($compliancecount)
                {
                    foreach ($compliance_lock as $key => $value) {
                        $newCompliance[Str::slug($key,'_')]=$value;
                    }
                    return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'data' =>$newCompliance
                            ,
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
    public function Setlanguage(Request $request)
    {
        $rules = array (
            'member_id' => 'required',
            'token' => 'required',
            'language' => 'required',
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
                $members = Member::where("Member_Id",$request['member_id'])->first();

                if($request['language']){
                    $members->Language_id = $request['language'];
                    }
                    if($members->save())
                    {
                        return $this->respond([
                        'status' => 'success',
                        'code' => $this->getStatusCode(),
                        'message' => 'Language Updated',
                        'data'=>$members
                        ]);
                    }
                    else
                    {
                        return $this->respond([
                        'status' => 'Failed',
                        'code' => $this->getStatusCode(),
                        'message' => 'Failed to Update',
                        ]);
                    }
                
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
                $member = Member::where('Member_Id',$request->member_id)->first();
            
                $membercategory = MemberCategoryAppIcon::where('Category_Id',$member->Member_Category_Id)->pluck('AppIcon_Id');
                $appIcon = AppIcon::whereIn('AppIcon_id',$membercategory)->where('AppIcon_visible','Y')->select('AppIcon_image_path',$member->Language_id.'_text As text','AppIcon_visible','AppIcon_text')->get();
                
                
                if($appIcon->count()>0)
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
    
    }
    
    public function TermsandConditions(Request $request)
    {
       
        $termsandconditions = Compliance::where('Compliance_id','2')->first();
                
       if($termsandconditions->count()>0)
        {
            return $this->respond([
                'status' => 'success',
                'message' => 'success',
                'code' => $this->getStatusCode(),
                'data'=>$termsandconditions,   
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

    public function is_valid_token($token)
    {
        $user = User::where('api_token', $token)->first();
        return $user;
    }
    
}
