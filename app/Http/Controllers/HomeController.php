<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\PollsQuestions;
use App\Models\Member;
use App\Models\OfflineContribution;
use App\Models\OnlineContribution;
use App\Models\Feedback;
use App\Models\User;
use carbon\carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $members_count = Member::where('Member_Active_Flag','Y')->count();
        $Notification_count = Notification::where('Notification_active','Y')->count();
        $online_amount = OnlineContribution::where('payment_status','Payment Successfull')->sum('Online_Contribution_amount');
        $offline_amount = OfflineContribution::where('Offline_Contribution_payment_status','Completed')->sum('Offline_Contribution_amount');
        $feedback_count = Feedback::count();
        $profileKaryakarthas = User::where('Intrs_to_volunteer','Yes')->count();

        $toDay = date('d');
        $thisMonth = date('m');
        $thisYear = date('Y');
        
        $yesterday = date('d')-1;
        $lastMonth = date('m')-1;
        $lastYear = date('Y')-1;

        $Todaymember = Member::whereDay('created_at', $toDay)
                            ->whereYear('created_at', $thisYear)
                            ->whereMonth('created_at', $thisMonth)
                            ->where('Member_Active_Flag','Y')
                            ->count();
        $Todaynotification = Notification::where('Notification_active','Y')
                            ->whereDay('created_at', $toDay)
                            ->whereMonth('created_at', $thisMonth)
                            ->whereYear('created_at', $thisYear)
                            ->count();
        $Todayonline_amount = OnlineContribution::whereDay('created_at', $toDay)
                            ->whereMonth('created_at', $thisMonth)
                            ->whereYear('created_at', $thisYear)
                            ->where('payment_status','Payment Successfull')
                            ->sum('Online_Contribution_amount');
        $Todayoffline_amount = OfflineContribution::whereDay('created_at', $toDay)
                                ->whereMonth('created_at', $thisMonth)
                                ->whereYear('created_at', $thisYear)
                                ->where('Offline_Contribution_payment_status','Completed')->sum('Offline_Contribution_amount');
        $Todayfeedback_count = Feedback::whereDay('created_at', $toDay)
                                ->whereMonth('created_at', $thisMonth)
                                ->whereYear('created_at', $thisYear)
                                ->count();
        $TodayprofileKaryakarthas = User::whereDay('created_at', $toDay)
                                ->whereMonth('created_at', $thisMonth)
                                ->whereYear('created_at', $thisYear)
                                ->where('Intrs_to_volunteer','Yes')
                                ->count();


        $Previousmember = Member::whereDay('created_at', $yesterday)
                            ->whereMonth('created_at', $thisMonth)
                            ->whereYear('created_at', $thisYear)
                            ->where('Member_Active_Flag','Y')
                            ->count();
        $Previousnotification = Notification::where('Notification_active','Y')
                            ->whereDay('created_at', $yesterday)
                            ->whereMonth('created_at', $thisMonth)
                            ->whereYear('created_at', $thisYear)
                            ->count();
        $Previousonline_amount = OnlineContribution::whereDay('created_at', $yesterday)
                                    ->whereMonth('created_at', $thisMonth)
                                    ->whereYear('created_at', $thisYear)
                                    ->where('payment_status','Payment Successfull')
                                    ->sum('Online_Contribution_amount');
        $Previousoffline_amount = OfflineContribution::whereDay('created_at', $yesterday)
                                ->whereMonth('created_at', $thisMonth)
                                ->whereYear('created_at', $thisYear)
                                ->where('Offline_Contribution_payment_status','Completed')->sum('Offline_Contribution_amount');
        $Previousfeedback_count = Feedback::whereDay('created_at', $yesterday)
                                ->whereMonth('created_at', $thisMonth)
                                ->whereYear('created_at', $thisYear)
                                ->count();
        $PreviousprofileKaryakarthas = User::whereDay('created_at', $yesterday)
                                ->whereMonth('created_at', $thisMonth)
                                ->whereYear('created_at', $thisYear)
                                ->where('Intrs_to_volunteer','Yes')
                                ->count();

                                
        $Thisweekmember = Member::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                ->whereYear('created_at', $thisYear)
                                ->whereMonth('created_at', $thisMonth)
                                ->where('Member_Active_Flag','Y')
                                ->count();
        $Thisweeknotification = Notification::where('Notification_active','Y')
                            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                            ->whereMonth('created_at', $thisMonth)
                            ->whereYear('created_at', $thisYear)
                            ->count();
        $Thisweekonline_amount = OnlineContribution::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', $thisMonth)
                                    ->whereYear('created_at', $thisYear)
                                    ->where('payment_status','Payment Successfull')
                                    ->sum('Online_Contribution_amount');
        $Thisweekoffline_amount = OfflineContribution::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', $thisMonth)
                                ->whereYear('created_at', $thisYear)
                                ->where('Offline_Contribution_payment_status','Completed')->sum('Offline_Contribution_amount');
        $Thisweekfeedback_count = Feedback::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', $thisMonth)
                                ->whereYear('created_at', $thisYear)
                                ->count();
        $ThisweekprofileKaryakarthas = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->whereMonth('created_at', $thisMonth)
                                ->whereYear('created_at', $thisYear)
                                ->where('Intrs_to_volunteer','Yes')
                                ->count();


        $ThisMonthmember = Member::whereYear('created_at', $thisYear)
                                ->whereMonth('created_at', $thisMonth)
                                ->where('Member_Active_Flag','Y')
                                ->count();
        $ThisMonthnotification = Notification::where('Notification_active','Y')
                            ->whereMonth('created_at', $thisMonth)
                            ->whereYear('created_at', $thisYear)
                            ->count();
        $ThisMonthonline_amount = OnlineContribution::whereMonth('created_at', $thisMonth)
                                    ->whereYear('created_at', $thisYear)
                                    ->where('payment_status','Payment Successfull')
                                    ->sum('Online_Contribution_amount');
                                    
        $ThisMonthoffline_amount = OfflineContribution::whereMonth('created_at', $thisMonth)
                                ->whereYear('created_at', $thisYear)
                                ->where('Offline_Contribution_payment_status','Completed')
                                ->sum('Offline_Contribution_amount');
        $ThisMonthfeedback_count = Feedback::whereMonth('created_at', $thisMonth)
                                ->whereYear('created_at', $thisYear)
                                ->count();
        $ThisMonthprofileKaryakarthas = User::whereMonth('created_at', $thisMonth)
                                ->whereYear('created_at', $thisYear)
                                ->where('Intrs_to_volunteer','Yes')
                                ->count();

                                
        $PreviousMonthmember = Member::whereYear('created_at', $thisYear)
                                ->whereMonth('created_at', $thisMonth-1)
                                ->where('Member_Active_Flag','Y')
                                ->count();  
        $Previousmonthnotification = Notification::where('Notification_active','Y')
                            ->whereMonth('created_at', $thisMonth-1)
                            ->whereYear('created_at', $thisYear)
                            ->count();
        $Previousmonthonline_amount = OnlineContribution::whereMonth('created_at', $thisMonth-1)
                                    ->whereYear('created_at', $thisYear)
                                    ->where('payment_status','Payment Successfull')
                                    ->sum('Online_Contribution_amount');
        $Previousmonthoffline_amount = OfflineContribution::whereMonth('created_at', $thisMonth-1)
                                ->whereYear('created_at', $thisYear)
                                ->where('Offline_Contribution_payment_status','Completed')->sum('Offline_Contribution_amount');
        $Previousmonthfeedback_count = Feedback::whereMonth('created_at', $thisMonth-1)
                                ->whereYear('created_at', $thisYear)
                                ->count();
        $PreviousMonthprofileKaryakarthas = User::whereMonth('created_at', $thisMonth-1)
                                ->whereYear('created_at', $thisYear)
                                ->where('Intrs_to_volunteer','Yes')
                                ->count();


        $ThisYearmember = Member::whereYear('created_at', $thisYear)
                                ->where('Member_Active_Flag','Y')
                                ->count();
        $ThisYearnotification = Notification::where('Notification_active','Y')
                            ->whereYear('created_at', $thisYear)
                            ->count();
        $ThisYearonline_amount = OnlineContribution::whereYear('created_at', $thisYear)
                                    ->where('payment_status','Payment Successfull')
                                    ->sum('Online_Contribution_amount');
        $ThisYearoffline_amount = OfflineContribution::whereYear('created_at', $thisYear)
                                ->where('Offline_Contribution_payment_status','Completed')->sum('Offline_Contribution_amount');
        $ThisYearfeedback_count = Feedback::whereYear('created_at', $thisYear)
                                ->count();
        $ThisYearprofileKaryakarthas = User::whereYear('created_at', $thisYear)
                                ->where('Intrs_to_volunteer','Yes')
                                ->count();

        return view('home',compact('members_count','Notification_count','online_amount','offline_amount', 'feedback_count', 'profileKaryakarthas','Todaymember','Todaynotification','Todayonline_amount','Todayoffline_amount','Todayfeedback_count','TodayprofileKaryakarthas','Previousmember','Previousnotification','Previousonline_amount','Previousoffline_amount','Previousfeedback_count','PreviousprofileKaryakarthas','Thisweekmember','Thisweeknotification','Thisweekonline_amount','Thisweekoffline_amount','Thisweekfeedback_count','ThisweekprofileKaryakarthas','ThisMonthmember','ThisMonthnotification','ThisMonthonline_amount','ThisMonthoffline_amount','ThisMonthfeedback_count','ThisMonthprofileKaryakarthas','PreviousMonthmember','Previousmonthnotification','Previousmonthonline_amount','Previousmonthoffline_amount','Previousmonthfeedback_count','PreviousMonthprofileKaryakarthas','ThisYearmember','ThisYearnotification','ThisYearonline_amount','ThisYearoffline_amount','ThisYearfeedback_count','ThisYearprofileKaryakarthas'));


    }

    public function OnlineContributions()
    {
        $toDay = date('d');
        $thisMonth = date('m');
        $thisYear = date('Y');
        
        $yesterday = date('d')-1;
        $lastMonth = date('m')-1;
        $lastYear = date('Y')-1;

        $today_contributions = OnlineContribution::whereDay('created_at', $toDay)
                                                    ->whereYear('created_at', $thisYear)
                                                    ->where('payment_status','Payment Successfull')
                                                    ->sum('Online_Contribution_amount');

        $yesterday_contributions = OnlineContribution::whereDay('created_at', $yesterday)
                                                    ->whereYear('created_at', $thisYear)
                                                    ->where('payment_status','Payment Successfull')
                                                    ->sum('Online_Contribution_amount');

        $thisWeek_contributions = OnlineContribution::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('payment_status','Payment Successfull')->sum('Online_Contribution_amount');

        $thisMonth_contributions = OnlineContribution::whereMonth('created_at', $thisMonth)
                                                    ->whereYear('created_at', $thisYear)
                                                    ->where('payment_status','Payment Successfull')
                                                    ->sum('Online_Contribution_amount');

        $lastMonth_contributions = OnlineContribution::whereMonth('created_at', $lastMonth)
                                                    ->whereYear('created_at', $thisYear)
                                                    ->where('payment_status','Payment Successfull')
                                                    ->sum('Online_Contribution_amount');

        $thisYear_contributions = OnlineContribution::whereYear('created_at', $thisYear)
                                                    ->where('payment_status','Payment Successfull')
                                                    ->sum('Online_Contribution_amount');


        $contributions = 'Online Contribution Details';

        return view('contribution_reports',compact('thisYear_contributions','lastMonth_contributions','thisMonth_contributions','yesterday_contributions','today_contributions','contributions','thisWeek_contributions'));

    }

    public function OfflineContributions()
    {
        $toDay = date('d');
        $thisMonth = date('m');
        $thisYear = date('Y');
        
        $yesterday = date('d')-1;
        $lastMonth = date('m')-1;
        $lastYear = date('Y')-1;

        $today_contributions = OfflineContribution::whereDay('created_at', $toDay)
                                                    ->whereYear('created_at', $thisYear)
                                                    ->where('Offline_Contribution_payment_status','Completed')
                                                    ->sum('Offline_Contribution_amount');

        $yesterday_contributions = OfflineContribution::whereDay('created_at', $yesterday)
                                                    ->whereYear('created_at', $thisYear)
                                                    ->where('Offline_Contribution_payment_status','Completed')
                                                    ->sum('Offline_Contribution_amount');

        $thisWeek_contributions = OfflineContribution::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('Offline_Contribution_payment_status','Completed')->sum('Offline_Contribution_amount');

        $thisMonth_contributions = OfflineContribution::whereMonth('created_at', $thisMonth)
                                                    ->whereYear('created_at', $thisYear)
                                                    ->where('Offline_Contribution_payment_status','Completed')
                                                    ->sum('Offline_Contribution_amount');

        $lastMonth_contributions = OfflineContribution::whereMonth('created_at', $lastMonth)
                                                    ->whereYear('created_at', $thisYear)
                                                    ->where('Offline_Contribution_payment_status','Completed')
                                                    ->sum('Offline_Contribution_amount');

        $thisYear_contributions = OfflineContribution::whereYear('created_at', $thisYear)
                                                    ->where('Offline_Contribution_payment_status','Completed')
                                                    ->sum('Offline_Contribution_amount');
        $contributions = 'Offline Contribution Details';
        return view('contribution_reports',compact('thisYear_contributions','lastMonth_contributions','thisMonth_contributions','yesterday_contributions','today_contributions','contributions','thisWeek_contributions'));

    }
   
}
