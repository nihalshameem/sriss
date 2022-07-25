<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Notification;
use App\Advertisement;
use App\Pollquestion;
use carbon\carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


 public function index()
        {   
            
             $today_members = Member::whereDate('created_at', Carbon::today())->get();
             $today_notifications = Notification::whereDate('created_at', Carbon::today())->get();
             $today_ads = Advertisement::whereDate('created_at', Carbon::today())->get();
             $today_polls = Pollquestion::whereDate('created_at', Carbon::today())->get();

             $today_members=$today_members->count();
             $today_notifications=$today_notifications->count();
             $today_ads=$today_ads->count();
             $today_polls=$today_polls->count();
             $wordlist = DB::table('members')
                    ->where('referral_id','!=','')
                    ->get();
        $total_referrals = count($wordlist);     


             //yesterday
             $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
             $yesterday_members = Member::whereDate('created_at', $yesterday )->get();
             $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
             $yesterday_notifications = Notification::whereDate('created_at', $yesterday )->get();
             $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
             $yesterday_ads = Advertisement::whereDate('created_at', $yesterday )->get();
             $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
             $yesterday_polls = Pollquestion::whereDate('created_at', $yesterday )->get();

             $yesterday_members=$yesterday_members->count();
             $yesterday_notifications=$yesterday_notifications->count();
             $yesterday_ads=$yesterday_ads->count();
             $yesterday_polls=$yesterday_polls->count();


             //this week
             $thisweek_members = Member::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
             $thisweek_members=$thisweek_members->count();
              $thisweek_notifications = Notification::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
             $thisweek_notifications=$thisweek_notifications->count();
             $thisweek_ads = Advertisement::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
             $thisweek_ads=$thisweek_ads->count();
             $thisweek_polls = Pollquestion::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
             $thisweek_polls=$thisweek_polls->count();

             //lastmonth
             
             $lastmonth_members = Member::where( DB::raw('MONTH(created_at)'), '=', date('n') )->get();
             $lastmonth_notifications = Notification::where( DB::raw('MONTH(created_at)'), '=', date('n') )->get();
             $lastmonth_ads = Advertisement::where( DB::raw('MONTH(created_at)'), '=', date('n') )->get();
             $lastmonth_polls = Pollquestion::where( DB::raw('MONTH(created_at)'), '=', date('n') )->get();

             $lastmonth_members=$lastmonth_members->count();
             $lastmonth_notifications=$lastmonth_notifications->count();
             $lastmonth_ads=$lastmonth_ads->count();
             $lastmonth_polls=$lastmonth_polls->count();


            
            //last year
             $lastyear_members = Member::whereYear('created_at', date('Y'))->get();
             $lastyear_notifications = Notification::whereYear('created_at', date('Y'))->get();
             $lastyear_ads = Advertisement::whereYear('created_at', date('Y'))->get();
             $lastyear_polls = Pollquestion::whereYear('created_at', date('Y'))->get();

             $lastyear_members=$lastyear_members->count();
             $lastyear_notifications=$lastyear_notifications->count();
             $lastyear_ads=$lastyear_ads->count();
             $lastyear_polls=$lastyear_polls->count();


            //total records
            $total_members = Member::count();
            $total_notifications= Notification::count();
            $total_ads= Advertisement::count();
            $total_polls= Pollquestion::count();





            return view('home',compact('total_members','total_notifications','total_ads','total_polls','today_members','today_notifications','today_ads','today_polls','yesterday_members','yesterday_notifications','yesterday_ads','yesterday_polls','thisweek_members','thisweek_notifications','thisweek_ads','thisweek_polls','lastmonth_members','lastmonth_notifications','lastmonth_ads','lastmonth_polls','lastyear_members','lastyear_notifications','lastyear_ads','lastyear_polls','total_referrals'));

            
        }
        public function referral_reports()
    {
        $totalreferrals=DB::table('members')
                       ->select('referral_id',DB::raw('count(*) as total'))
                       ->groupBy('referral_id')
                       ->orderBy('total','desc')
                       ->get()->toArray();
        //dd($totalmembers);
        return view('referral_reports',compact('totalreferrals'));

    }

}
