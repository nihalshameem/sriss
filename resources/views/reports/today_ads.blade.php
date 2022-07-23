@extends('layouts.app')

@section('content')
<?php
$i=1;
?>

<table width="100%" cellpadding="10px" class="col-md-offset-2 col-md-10">
    <tr style="border-bottom:none"><th colspan="8" style="text-align: center;padding:10px;font-size:20px">Today Ads<span class="label label-success">{{ count($today_ads) }}</span></th></tr>
    <tr style="padding:50px;height:50px">        
        <center>
        <td  colspan="8" style="border-right:none"><a href="{{ URL::previous() }}" style="color:blue;margin-left: 20px;padding:10px;font-size:25px;text-decoration:none"><i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        <a href="/today_ads_xlsx" style="color:purple;margin-left: 20px;padding:10px;font-size:25px"><i class="fa fa-download" aria-hidden="true"></i></a></td>
        </center>
    </tr>
<tr style="height:30px;background-color: brown;color:white;text-align:center;margin-left:25px;padding:10px">
    <th style="text-align:center;border:1px solid brown">Sl No.</th>
    <th style="text-align:center;border:1px solid brown">Booked date</th>
    <th style="text-align:center;border:1px solid brown">Description</th>
    <th style="text-align:center;border:1px solid brown">Company</th>
    <th style="text-align:center;border:1px solid brown">Link</th>
    <th style="text-align:center;border:1px solid brown">From_date</th>
    <th style="text-align:center;border:1px solid brown">To_date</th>
    <th style="text-align:center;border:1px solid brown">Active</th>
</tr>

@foreach($today_ads as $today_ad)
    <tr style="height:20px;border:1px solid grey">
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $i++ }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_ad['created_at'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ substr($today_ad['description'],0,100) }}...</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_ad['company'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_ad['link'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_ad['from_date'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_ad['to_date'] }}</td>   
    </tr>
@endforeach
</table>

@endsection
