<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\PollsQuestions;
use App\Models\Member;
use App\Models\OfflineContribution;
use App\Models\OnlineContribution;
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
        $members_count = Member::where('active_flag','Y')->count();
        $Notification_count = Notification::where('Notification_active','Y')->count();
        $online_amount = OnlineContribution::where('payment_status','Payment Successfull')->sum('Online_Contribution_amount');
        $offline_amount = OfflineContribution::where('Offline_Contribution_payment_status','Completed')->sum('Offline_Contribution_amount');
        return view('home',compact('members_count','Notification_count','online_amount','offline_amount'));
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
