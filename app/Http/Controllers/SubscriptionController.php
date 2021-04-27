<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Response;
use App\Models\Member;
use App\Models\User;
use App\Models\Subscription;
use View;

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

}