<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Response;
use App\Models\Member;
use App\Models\Volunteer;
use App\Models\OnlineContribution;
use App\Models\OfflineContribution;
use App\Models\District;
use App\Models\User;
use View;

class ReportsController extends Controller
{

    /******** Web Application Reports View and Download **********/

    public function ListReports()
    {
        return view('reports.list');
    }

    public function MembersList()
    {
        $Member = Member::get();
        $District = District::get();
        return view('reports.member_list',compact('Member','District'));
    }

    public function ContributionDetailsSelf()
    {
        $OnlineContribution = OnlineContribution::get();
        return view('reports.contribution_details',compact('OnlineContribution'));
    }

    public function OfflineCollection()
    {
        $OfflineContribution = OfflineContribution::orderby('Offline_Contribution_id','desc')->get();
        return view('reports.offline_collection',compact('OfflineContribution'));
    }

    public function MemberDeactivationReports()
    {
        $Member = Member::Where('active_flag','N')->get();
        return view('reports.member_deactivation_report',compact('Member'));
    }

     public function DueReports()
    {
        $OfflineContribution = OfflineContribution::Where('Offline_Contribution_payment_status','Pending')->get();
        return view('reports.due_reports',compact('OfflineContribution'));
    }

    public function MemberReportsFilter(Request $request)
    {
        if($request->updatedDate!='' && $request->Pincode!='' && $request->District!='')
        {
             $Member= Member::where('active_flag','Y')
                        ->whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->where('District_Id','=',$request->District)
                        ->where('Pincode','=',$request->Pincode)
                        ->get();
        }
        elseif($request->updatedDate!='' && $request->Pincode!='')
        {
             $Member= Member::where('active_flag','Y')
                        ->whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->where('Pincode','=',$request->Pincode)
                        ->get();
        }
        elseif($request->updatedDate!='' && $request->District!='')
        {
             $Member= Member::where('active_flag','Y')
                        ->whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->where('District_Id','=',$request->District)
                        ->get();
        }
        elseif($request->updatedDate=='' && $request->Pincode!='')
        {
             $Member= Member::where('active_flag','Y')
                        ->where('Pincode','=',$request->Pincode)
                        ->get();
        }
        elseif($request->updatedDate=='' && $request->District!='')
        {
             $Member= Member::where('active_flag','Y')
                        ->where('District_Id','=',$request->District)
                        ->get();
        }
        elseif($request->createdDate!='')
        {
             $Member= Member::where('active_flag','Y')
                        ->whereDate('created_at','=',$request->createdDate)
                        ->get();
        }
        else
        {
             $Member= Member::where('active_flag','Y')
                        ->whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->get();
        }

       
       Session::put("member_reports",$Member);
        $Member = View::make('reports.reportsfilter.member_list_filter', compact('Member'))->render();
        return Response::json(['Member' => $Member]);
    }

    public function MemberDeactivationReportsFilter(Request $request)
    {

        $Member= Member::where('active_flag','N')->whereDate('created_at','>=',$request->createdDate)
                                                    ->whereDate('updated_at','<=',$request->updatedDate)
                                                    ->get();
        Session::put("membeDeactivationreports",$Member);
        $Member = View::make('reports.reportsfilter.member_deactivation_filter', compact('Member'))->render();
        return Response::json(['Member' => $Member]);
    }

    public function OfflineCollectionReportsFilter(Request $request)
    {
        $OfflineContribution= OfflineContribution::whereDate('created_at','>=',$request->createdDate)
                                                ->whereDate('updated_at','<=',$request->updatedDate)
                                                    ->get();

        Session::put("offlinereports",$OfflineContribution);
        Session::put("offlinefilter_date",$request->createdDate);
        $OfflineContribution = View::make('reports.reportsfilter.offline_collection_filter', compact('OfflineContribution'))->render();
        return Response::json(['OfflineContribution' => $OfflineContribution]);
    }

    public function OnlineCollectionReportsFilter(Request $request)
    {
        $OnlineContribution= OnlineContribution::whereDate('created_at','>=',$request->createdDate)
                                                    ->whereDate('updated_at','<=',$request->updatedDate)
                                                    ->get();

        Session::put("onlinereports",$OnlineContribution);
        Session::put("onlinereports_date",$request->createdDate);

        $OnlineContribution = View::make('reports.reportsfilter.online_collection_filter', compact('OnlineContribution'))->render();
        return Response::json(['OnlineContribution' => $OnlineContribution]);
    }

    public function VolunteerReports()
    {
        $profileKaryakarthas = User::where('Intrs_to_volunteer','Yes')->get();
        $contributionKaryakarthas = OfflineContribution::where('Intrs_to_volunteer','Yes')->get();
        return view('reports.karyakarthas_list',compact('profileKaryakarthas','contributionKaryakarthas'));
    }

    public function VolunteerReportFilter(Request $request)
    {
                $Volunteer = Volunteer::whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->get();

       Session::put("volunteer_reports",$Volunteer);
        $Volunteer = View::make('reports.reportsfilter.volunteer_list_filter', compact('Volunteer'))->render();
        return Response::json(['Volunteer' => $Volunteer]);
        
    }
    
    public function KaryakarthaReports()
    {
        
        $Volunteer = Volunteer::get();
        return view('reports.volunteer_list',compact('Volunteer'));
    }

    public function karyakarthaReportFilter(Request $request)
    {

        $Volunteer = Volunteer::whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->get();

        $Volunteer = View::make('reports.reportsfilter.volunteer_list_filter', compact('Volunteer'))->render();
        return Response::json(['Volunteer' => $Volunteer]);
    }

    public function KaryakarthaProfileReportsFilter(Request $request)
    {

        $profileKaryakarthas = User::whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->where('Intrs_to_volunteer','=','Yes')
                        ->get();

        $profileKaryakarthas = View::make('reports.reportsfilter.karyakarthas_profile_filter', compact('profileKaryakarthas'))->render();
        return Response::json(['profileKaryakarthas' => $profileKaryakarthas]);
    }

    public function KaryakarthaContributionReportsFilter(Request $request)
    {

        $contributionKaryakarthas = OfflineContribution::whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->where('Intrs_to_volunteer','=','Yes')
                        ->get();

        $contributionKaryakarthas = View::make('reports.reportsfilter.karyakarthas_offline_contribution_filter', compact('contributionKaryakarthas'))->render();
        return Response::json(['contributionKaryakarthas' => $contributionKaryakarthas]);
    }

    public function MemberReferalReports()
    {
        
        $member = Member::where('ReferedBy','!=',null)->orderby('id','desc')->get();
        $members = Member::get();
        return view('reports.member_referal_list',compact('member','members'));
    }

    public function MemberReferalReportsFilter(Request $request)
    {

       if($request->updatedDate!=null)
        {
            $members = Member::where('Mobile_No',$request->member_id)                    
                             ->first();

            $member = Member::where('ReferedBy','!=',null)->where('ReferedBy',$request->member_id)->whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->get();
        }
        else
        {
            if($request->createdDate!=null)
            {
                $members = Member::where('Mobile_No',$request->member_id)
                             ->first();

                  $member =Member::where('ReferedBy','!=',null)->where('ReferedBy',$request->member_id)->whereDate('created_at','>=',$request->createdDate)
                                        ->whereDate('updated_at','<=',date('Y-m-d'))
                        ->get();
            }
            else
            {
                $members = Member::where('Mobile_No',$request->member_id)
                             ->first();
                 
                $member = Member::where('ReferedBy','!=',null)->where('ReferedBy',$request->member_id)
                        ->get();
            }

            
        }

        $member = View::make('reports.reportsfilter.member_referal_filter', compact('member','members'))->render();
        return Response::json(['member' => $member]);
    }

    /******** Web Application Reports View **********/

    public function ListReportsView()
    {
        return view('reportsview.list');
    }

    public function MembersListView()
    {
        $Member = Member::get();
        $District = District::get();
        return view('reportsview.member_list',compact('Member','District'));
    }

    public function ContributionDetailsSelfView()
    {
        $OnlineContribution = OnlineContribution::get();
        return view('reportsview.contribution_details',compact('OnlineContribution'));
    }

    public function OfflineCollectionView()
    {
        $OfflineContribution = OfflineContribution::orderby('Offline_Contribution_id','desc')->get();
        return view('reportsview.offline_collection',compact('OfflineContribution'));
    }

    public function MemberDeactivationReportsView()
    {
        $Member = Member::Where('active_flag','N')->get();
        return view('reportsview.member_deactivation_report',compact('Member'));
    }

     public function DueReportsView()
    {
        $OfflineContribution = OfflineContribution::Where('Offline_Contribution_payment_status','Pending')->get();
        return view('reportsview.due_reports',compact('OfflineContribution'));
    }

    public function MemberReportsFilterView(Request $request)
    {
        if($request->updatedDate!='' && $request->Pincode!='' && $request->District!='')
        {
             $Member= Member::where('active_flag','Y')
                        ->whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->where('District_Id','=',$request->District)
                        ->where('Pincode','=',$request->Pincode)
                        ->get();
        }
        elseif($request->updatedDate!='' && $request->Pincode!='')
        {
             $Member= Member::where('active_flag','Y')
                        ->whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->where('Pincode','=',$request->Pincode)
                        ->get();
        }
        elseif($request->updatedDate!='' && $request->District!='')
        {
             $Member= Member::where('active_flag','Y')
                        ->whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->where('District_Id','=',$request->District)
                        ->get();
        }
        elseif($request->updatedDate=='' && $request->Pincode!='')
        {
             $Member= Member::where('active_flag','Y')
                        ->where('Pincode','=',$request->Pincode)
                        ->get();
        }
        elseif($request->updatedDate=='' && $request->District!='')
        {
             $Member= Member::where('active_flag','Y')
                        ->where('District_Id','=',$request->District)
                        ->get();
        }
        elseif($request->createdDate!='')
        {
             $Member= Member::where('active_flag','Y')
                        ->whereDate('created_at','=',$request->createdDate)
                        ->get();
        }
        else
        {
             $Member= Member::where('active_flag','Y')
                        ->whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->get();
        }

       
       Session::put("member_reports",$Member);
        $Member = View::make('reportsview.reportsfilter.member_list_filter', compact('Member'))->render();
        return Response::json(['Member' => $Member]);
    }

    public function MemberDeactivationReportsFilterView(Request $request)
    {

        $Member= Member::where('active_flag','N')->whereDate('created_at','>=',$request->createdDate)
                                                    ->whereDate('updated_at','<=',$request->updatedDate)
                                                    ->get();
        Session::put("membeDeactivationreports",$Member);
        $Member = View::make('reportsview.reportsfilter.member_deactivation_filter', compact('Member'))->render();
        return Response::json(['Member' => $Member]);
    }

    public function OfflineCollectionReportsFilterView(Request $request)
    {
        $OfflineContribution= OfflineContribution::whereDate('created_at','>=',$request->createdDate)
                                                ->whereDate('updated_at','<=',$request->updatedDate)
                                                    ->get();

        Session::put("offlinereports",$OfflineContribution);
        Session::put("offlinefilter_date",$request->createdDate);
        $OfflineContribution = View::make('reportsview.reportsfilter.offline_collection_filter', compact('OfflineContribution'))->render();
        return Response::json(['OfflineContribution' => $OfflineContribution]);
    }

    public function OnlineCollectionReportsFilterView(Request $request)
    {
        $OnlineContribution= OnlineContribution::whereDate('created_at','>=',$request->createdDate)
                                                    ->whereDate('updated_at','<=',$request->updatedDate)
                                                    ->get();

        Session::put("onlinereports",$OnlineContribution);
        Session::put("onlinereports_date",$request->createdDate);

        $OnlineContribution = View::make('reportsview.reportsfilter.online_collection_filter', compact('OnlineContribution'))->render();
        return Response::json(['OnlineContribution' => $OnlineContribution]);
    }

    public function VolunteerReportsView()
    {
        $profileKaryakarthas = User::where('Intrs_to_volunteer','Yes')->get();
        $contributionKaryakarthas = OfflineContribution::where('Intrs_to_volunteer','Yes')->get();
        return view('reportsview.karyakarthas_list',compact('profileKaryakarthas','contributionKaryakarthas'));
    }

    public function VolunteerReportFilterView(Request $request)
    {
                $Volunteer = Volunteer::whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->get();

       Session::put("volunteer_reports",$Volunteer);
        $Volunteer = View::make('reports.reportsfilter.volunteer_list_filter', compact('Volunteer'))->render();
        return Response::json(['Volunteer' => $Volunteer]);
        
    }
    
    public function KaryakarthaReportsView()
    {
        
        $Volunteer = Volunteer::get();
        return view('reportsview.volunteer_list',compact('Volunteer'));
    }

    public function karyakarthaReportFilterView(Request $request)
    {

        $Volunteer = Volunteer::whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->get();

        $Volunteer = View::make('reportsview.reportsfilter.volunteer_list_filter', compact('Volunteer'))->render();
        return Response::json(['Volunteer' => $Volunteer]);
    }

    public function KaryakarthaProfileReportsFilterView(Request $request)
    {

        $profileKaryakarthas = User::whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->where('Intrs_to_volunteer','=','Yes')
                        ->get();

        $profileKaryakarthas = View::make('reportsview.reportsfilter.karyakarthas_profile_filter', compact('profileKaryakarthas'))->render();
        return Response::json(['profileKaryakarthas' => $profileKaryakarthas]);
    }

    public function KaryakarthaContributionReportsFilterView(Request $request)
    {

        $contributionKaryakarthas = OfflineContribution::whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->where('Intrs_to_volunteer','=','Yes')
                        ->get();

        $contributionKaryakarthas = View::make('reportsview.reportsfilter.karyakarthas_offline_contribution_filter', compact('contributionKaryakarthas'))->render();
        return Response::json(['contributionKaryakarthas' => $contributionKaryakarthas]);
    }
     public function MemberReferalReportsView()
    {
        
        $member = Member::where('ReferedBy','!=',null)->orderby('id','desc')->get();
        $members = Member::get();
        return view('reportsview.member_referal_list',compact('member','members'));
    }

    public function MemberReferalReportsFilterView(Request $request)
    {

       if($request->updatedDate!=null)
        {
            $members = Member::where('Mobile_No',$request->member_id)
                             ->first();
              $member = Member::where('ReferedBy','!=',null)->where('ReferedBy',$request->member_id)->whereDate('created_at','>=',$request->createdDate)
                        ->whereDate('updated_at','<=',$request->updatedDate)
                        ->get();
        }
        else
        {
            if($request->createdDate!=null)
            {
                $members = Member::where('Mobile_No',$request->member_id)
                             ->first();

                  $member =Member::where('ReferedBy','!=',null)->where('ReferedBy',$request->member_id)->whereDate('created_at','>=',$request->createdDate)
                                        ->whereDate('updated_at','<=',date('Y-m-d'))
                        ->get();
            }
            else
            {
                $members = Member::where('Mobile_No',$request->member_id)
                             ->first();
                 
                $member = Member::where('ReferedBy','!=',null)->where('ReferedBy',$request->member_id)
                        ->get();
            }

            
        }

        $member = View::make('reportsview.reportsfilter.member_referal_filter', compact('member','members'))->render();
        return Response::json(['member' => $member]);
    }





}
