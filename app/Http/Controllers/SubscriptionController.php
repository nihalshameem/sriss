<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Response;
use App\Models\Member;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Compliance;
use View;
use Carbon\Carbon;

class SubscriptionController extends Controller
{

	public function SubscriptionReportView()
    {
        $Subscriptions = Subscription::get();
        return view('reportsview.subscription_details',compact('Subscriptions'));
    }

    public function SubscriptionReport()
    {
        $Subscriptions = Subscription::get();
        return view('reports.subscription_details',compact('Subscriptions'));
    }

    public function SubscriptionDefaulterReportView()
    {
        $Subscriptions = Subscription::whereDate('Subscription_end_date', '>=', Carbon::today())->pluck('Member_id');
        $members = Member::whereNotIn('Member_Id', $Subscriptions)->get();
        $amount = Compliance::where('Compliance_id', '6')->first();

        return view('reportsview.subscription_defaulter_details' ,compact('members', 'amount'));
    }

    public function SubscriptionDefaulterReport()
    {
        $Subscriptions = Subscription::whereDate('Subscription_end_date', '>=', Carbon::today())->pluck('Member_id');
        $members = Member::whereNotIn('Member_Id', $Subscriptions)->get();
        $amount = Compliance::where('Compliance_id', '6')->first();

        return view('reports.subscription_defaulter_details' ,compact('members', 'amount'));
    }

}