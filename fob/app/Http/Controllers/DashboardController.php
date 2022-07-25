<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Notification;
use App\Advertisement;
use App\Pollquestion;
use carbon\carbon;
use DB;

class DashboardController extends Controller
{

 	public function index()
    {   
    $toDay = date('d');
    $thisMonth = date('m');
    $thisYear = date('Y');
    
    $lastDay = date('d')-1;
    $lastMonth = date('m')-1;
    $lastYear = date('Y')-1;
        //dd($toDay);
        
    $today_members = DB::table('members')->where('active_flag','yes')->whereDay('created_at', $toDay)->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
    $today_notifications = DB::table('notifications')->whereDay('created_at', $toDay)->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
    $today_ads = DB::table('advertisements')->whereDay('created_at', $toDay)->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
    $today_polls = DB::table('pollquestions')->whereDay('created_at', $toDay)->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
    
    
    $yesterday_members = DB::table('members')->where('active_flag','yes')->whereDay('created_at', $lastDay)->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
    $yesterday_notifications = DB::table('notifications')->whereDay('created_at', $lastDay)->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
    $yesterday_ads = DB::table('advertisements')->whereDay('created_at', $lastDay)->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
    $yesterday_polls = DB::table('pollquestions')->whereDay('created_at', $lastDay)->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
    
    
    
    $thismonth_members = DB::table('members')->where('active_flag','yes')->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
    $thismonth_notifications = DB::table('notifications')->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
    $thismonth_ads = DB::table('advertisements')->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
    $thismonth_polls = DB::table('pollquestions')->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
    
    $lastmonth_members = DB::table('members')->where('active_flag','yes')->whereMonth('created_at', $lastMonth)->whereYear('created_at', $thisYear)->get();
    $lastmonth_notifications = DB::table('notifications')->whereMonth('created_at', $lastMonth)->whereYear('created_at', $thisYear)->get();
    $lastmonth_ads = DB::table('advertisements')->whereMonth('created_at', $lastMonth)->whereYear('created_at', $thisYear)->get();
    $lastmonth_polls = DB::table('pollquestions')->whereMonth('created_at', $lastMonth)->whereYear('created_at', $thisYear)->get();
    
    
    $thisyear_members = DB::table('members')->where('active_flag','yes')->whereYear('created_at', $thisYear)->get();
    $thisyear_notifications = DB::table('notifications')->whereYear('created_at', $thisYear)->get();
    $thisyear_ads = DB::table('advertisements')->whereYear('created_at', $thisYear)->get();
    $thisyear_polls = DB::table('pollquestions')->whereYear('created_at', $thisYear)->get();
    
    $lastyear_members = DB::table('members')->where('active_flag','yes')->whereYear('created_at', $lastYear)->get();
    $lastyear_notifications = DB::table('notifications')->whereYear('created_at', $lastYear)->get();
    $lastyear_ads = DB::table('advertisements')->whereYear('created_at', $lastYear)->get();
    $lastyear_polls = DB::table('pollquestions')->whereYear('created_at', $lastYear)->get();


	$today_members=$today_members->count();
	$today_notifications=$today_notifications->count();
	$today_ads=$today_ads->count();
	$today_polls=$today_polls->count();
	
	$yesterday_members=$yesterday_members->count();
	$yesterday_notifications=$yesterday_notifications->count();
	$yesterday_ads=$yesterday_ads->count();
	$yesterday_polls=$yesterday_polls->count();
	
	
	$thismonth_members=$thismonth_members->count();
	$thismonth_notifications=$thismonth_notifications->count();
	$thismonth_ads=$thismonth_ads->count();
	$thismonth_polls=$thismonth_polls->count();
	
	$lastmonth_members=$lastmonth_members->count();
	$lastmonth_notifications=$lastmonth_notifications->count();
	$lastmonth_ads=$lastmonth_ads->count();
	$lastmonth_polls=$lastmonth_polls->count();
	
	
	$thisyear_members=$thisyear_members->count();
	$thisyear_notifications=$thisyear_notifications->count();
	$thisyear_ads=$thisyear_ads->count();
	$thisyear_polls=$thisyear_polls->count();
	
	$lastyear_members=$lastyear_members->count();
	$lastyear_notifications=$lastyear_notifications->count();
	$lastyear_ads=$lastyear_ads->count();
	$lastyear_polls=$lastyear_polls->count();
	
	
	$total_members = Member::where('active_flag','yes')->count();
    $total_notifications= Notification::count();
    $total_ads= Advertisement::count();
    $total_polls= Pollquestion::count();
    
    
	
	$wordlist = DB::table('members')
	    ->where('referral_id','!=','')
	    ->get();
	$total_referrals = count($wordlist);     


	

	//this week
	$thisweek_members = Member::where('active_flag','yes')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
	$thisweek_members=$thisweek_members->count();
	$thisweek_notifications = Notification::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
	$thisweek_notifications=$thisweek_notifications->count();
	$thisweek_ads = Advertisement::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
	$thisweek_ads=$thisweek_ads->count();
	$thisweek_polls = Pollquestion::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
	$thisweek_polls=$thisweek_polls->count();







        return view('dashboard',compact('total_members','total_notifications','total_ads','total_polls','today_members','today_notifications','today_ads','today_polls','yesterday_members','yesterday_notifications','yesterday_ads','yesterday_polls','thisweek_members','thisweek_notifications','thisweek_ads','thisweek_polls','lastmonth_members','lastmonth_notifications','lastmonth_ads','lastmonth_polls','lastyear_members','lastyear_notifications','lastyear_ads','lastyear_polls','total_referrals','thismonth_members','thismonth_notifications','thismonth_ads','thismonth_polls','thisyear_members','thisyear_notifications','thisyear_ads','thisyear_polls'));

            
        }

}
