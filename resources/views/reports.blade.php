@extends('layouts.app')

@section('content')
<div class="container">
        <div class="col-md-6 col-md-offset-2" style="margin-top: 20px">
         
                <a class="col-md-8 " href="/referral_reports" style="text-decoration: none;font-size: 30px;font-weight: bold;background-color: #0e56ce;color:white;padding:20px">
                    <span style="margin-right: 80px">Total Referrals</span>{{ $total_referrals }}</a>
            
        </div>
</div>                

@endsection
