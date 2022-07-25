<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Notification;
use App\Advertisement;
use App\Pollquestion;
use carbon\carbon;
use DB;


class PrinController extends Controller
{
    
    
    public function thisyear_members()
	{
	$thisYear = date('Y');
	    $thisyear_members = Member::where('active_flag','yes')->whereYear('created_at', $thisYear)->get();
	    return view('reports.thisyear_members')->with(compact('thisyear_members'));
	}
	
	public function thisyear_notifications()
	{
	$thisYear = date('Y');
	    $thisyear_notifications = Notification::whereYear('created_at', $thisYear)->get();
	    return view('reports.thisyear_notifications')->with(compact('thisyear_notifications'));
	}
	
	public function thisyear_ads()
	{
	$thisYear = date('Y');
	    $thisyear_ads = Advertisement::whereYear('created_at', $thisYear)->get();
	    return view('reports.thisyear_ads')->with(compact('thisyear_ads'));
	}
	public function thisyear_polls()
	{
	$thisYear = date('Y');
	    $thisyear_polls = Pollquestion::whereYear('created_at', $thisYear)->get();
	    return view('reports.thisyear_polls')->with(compact('thisyear_polls'));
	}
	
	
	//last year
	public function index()
	{
	$lastYear = date('Y')-1;
	    $lastyear_notifications = Notification::whereYear('created_at', $lastYear)->get();
	    return view('reports.lastyear_notifications')->with(compact('lastyear_notifications'));
	}
	public function lastyear_members()
	{
	$lastYear = date('Y')-1;
	    $lastyear_members = Member::where('active_flag','yes')->whereYear('created_at', $lastYear)->get();
	    return view('reports.lastyear_members')->with(compact('lastyear_members'));
	}
	public function lastyear_ads()
	{
	$lastYear = date('Y')-1;
	    $lastyear_ads = Advertisement::whereYear('created_at', $lastYear)->get();
	    return view('reports.lastyear_ads')->with(compact('lastyear_ads'));
	}
	public function lastyear_polls()
	{
	$lastYear = date('Y')-1;
	    $lastyear_polls = Pollquestion::whereYear('created_at', $lastYear)->get();
	    return view('reports.lastyear_polls')->with(compact('lastyear_polls'));
	}



//last month

    public function thismonth_members()
	{
	    $thisMonth = date('m');
	    $thisYear = date('Y');

	    $thismonth_members = Member::where('active_flag','yes')->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
	    
	    return view('reports.thismonth_members')->with(compact('thismonth_members'));
	}
	public function thismonth_notifications()
	{	
		$thisMonth = date('m');
	    $thisYear = date('Y');
	    
	    $thismonth_notifications = Notification::whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
	    
	    return view('reports.thismonth_notifications')->with(compact('thismonth_notifications'));
	}
	public function thismonth_ads()
	{	
	    $thisMonth = date('m');
	    $thisYear = date('Y');
	    
	    $thismonth_ads = Advertisement::whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
	    return view('reports.thismonth_ads')->with(compact('thismonth_ads'));
	}
	public function thismonth_polls()
	{	
		$thisMonth = date('m');
	    $thisYear = date('Y');
	    $thismonth_polls = Pollquestion::whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->get();
	    return view('reports.thismonth_polls')->with(compact('thismonth_polls'));
	}
	
	
	public function lastmonth_members()
	{
	    $lastMonth = date('m')-1;
	    $thisYear = date('Y');

	    $lastmonth_members = Member::where('active_flag','yes')->whereMonth('created_at', $lastMonth)->whereYear('created_at', $thisYear)->get();
	    
	    return view('reports.lastmonth_members')->with(compact('lastmonth_members'));
	}
	public function lastmonth_notifications()
	{	
		$lastMonth = date('m')-1;
	    $thisYear = date('Y');
	    
	    $lastmonth_notifications = Notification::whereMonth('created_at', $lastMonth)->whereYear('created_at', $thisYear)->get();
	    
	    return view('reports.lastmonth_notifications')->with(compact('lastmonth_notifications'));
	}
	public function lastmonth_ads()
	{	
	    $lastMonth = date('m')-1;
	    $thisYear = date('Y');
	    
	    $lastmonth_ads = Advertisement::whereMonth('created_at', $lastMonth)->whereYear('created_at', $thisYear)->get();
	    return view('reports.lastmonth_ads')->with(compact('lastmonth_ads'));
	}
	public function lastmonth_polls()
	{	
		$lastMonth = date('m')-1;
	    $thisYear = date('Y');
	    $lastmonth_polls = Pollquestion::whereMonth('created_at', $lastMonth)->whereYear('created_at', $thisYear)->get();
	    return view('reports.lastmonth_polls')->with(compact('lastmonth_polls'));
	}


	//this week
	public function thisweek_members()
	{	
	 $thisweek_members = Member::where('active_flag','yes')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
	 return view('reports.thisweek_members')->with(compact('thisweek_members'));
	}
	public function thisweek_notifications()
	{
		$thisweek_notifications = Notification::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
	    return view('reports.thisweek_notifications')->with(compact('thisweek_notifications'));
	}
	public function thisweek_ads()
	{
		$thisweek_ads = Advertisement::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
	    return view('reports.thisweek_ads')->with(compact('thisweek_ads'));
	}
	public function thisweek_polls()
	{
		$thisweek_polls = Pollquestion::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
	    return view('reports.thisweek_polls')->with(compact('thisweek_polls'));
	}


//yesterday
	public function yesterday_members()
	{
	$thisYear = date('Y');
    $lastDay = date('d')-1;
	    $yesterday_members = Member::where('active_flag','yes')->whereDay('created_at', $lastDay)->whereYear('created_at', $thisYear)->get();
	    return view('reports.yesterday_members')->with(compact('yesterday_members'));
	}
	public function yesterday_notifications()
	{
    $thisYear = date('Y');
    $lastDay = date('d')-1;
	    $yesterday_notifications = Notification::whereDay('created_at', $lastDay)->whereYear('created_at', $thisYear)->get();
	    return view('reports.yesterday_notifications')->with(compact('yesterday_notifications'));
	}
	public function yesterday_ads()
	{
	$thisYear = date('Y');
    $lastDay = date('d')-1;
	    $yesterday_ads = Advertisement::whereDay('created_at', $lastDay)->whereYear('created_at', $thisYear)->get();
	    return view('reports.yesterday_ads')->with(compact('yesterday_ads'));
	}
	public function yesterday_polls()
	{
	$thisYear = date('Y');
    $lastDay = date('d')-1;
	    $yesterday_polls = Pollquestion::whereDay('created_at', $lastDay)->whereYear('created_at', $thisYear)->get();
	    return view('reports.yesterday_polls')->with(compact('yesterday_polls'));
	}



//today
	public function today_members()
	{
    $toDay = date('d');
    $thisYear = date('Y');
		
		$today_members = Member::where('active_flag','yes')->whereDay('created_at', $toDay)->whereYear('created_at', $thisYear)->get();
		return view('reports.today_members')->with(compact('today_members'));
	}
	public function today_notifications()
	{
	
	$toDay = date('d');
    $thisYear = date('Y');
		$today_notifications = Notification::whereDay('created_at', $toDay)->whereYear('created_at', $thisYear)->get();
		return view('reports.today_notifications')->with(compact('today_notifications'));
	}
    public function today_ads()
	{
	$toDay = date('d');
    $thisYear = date('Y');
		$today_ads = Advertisement::whereDay('created_at', $toDay)->whereYear('created_at', $thisYear)->get();
		return view('reports.today_ads')->with(compact('today_ads'));
	}
    public function today_polls()
	{
	$toDay = date('d');
    $thisYear = date('Y');
		$today_polls = Pollquestion::whereDay('created_at', $toDay)->whereYear('created_at', $thisYear)->get();
		return view('reports.today_polls')->with(compact('today_polls'));
	}

	

	public function total_members()
	{
		$total_members = Member::where('active_flag','yes')->where('active_flag','yes')->get();
		return view('reports.total_members')->with(compact('total_members'));
	}
	public function total_notifications()
	{
		$total_notifications = Notification::get()->all();
		return view('reports.total_notifications')->with(compact('total_notifications'));
	}
    public function total_ads()
	{
		$total_ads = Advertisement::get()->all();
		return view('reports.total_ads')->with(compact('total_ads'));
	}
    public function total_polls()
	{
		$total_polls = Pollquestion::get()->all();
		return view('reports.total_polls')->with(compact('total_polls'));
	}
}

