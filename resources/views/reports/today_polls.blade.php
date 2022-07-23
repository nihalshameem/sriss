@extends('layouts.app')

@section('content')

<?php
$i=1;
?>
<table width="100%" cellpadding="10px" class="col-md-offset-2 col-md-10">
    <tr style="border-bottom:none"><th colspan="8" style="text-align: center;padding:10px;font-size:20px">Today Polls<span class="label label-success">{{ count($today_polls) }}</span></th></tr>
    <tr style="padding:50px;height:50px">        
        <center>
        <td  colspan="8" style="border-right:none"><a href="{{ URL::previous() }}" style="color:blue;margin-left: 20px;padding:10px;font-size:25px;text-decoration:none"><i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        <a href="/today_polls_xlsx" style="color:purple;margin-left: 20px;padding:10px;font-size:25px"><i class="fa fa-download" aria-hidden="true"></i></a></td>
        </center>
    </tr>
<tr style="height:30px;background-color: brown;color:white;text-align:center;margin-left:25px;padding:10px">
    <th style="text-align:center;border:1px solid brown">Sl No.</th>
    <th style="text-align:center;border:1px solid brown;width:250px;">Booked date</th>
    <th style="text-align:center;border:1px solid brown">Question</th>
    <th style="text-align:center;border:1px solid brown">From_date</th>
    <th style="text-align:center;border:1px solid brown">To_date</th>
    <th style="text-align:center;border:1px solid brown">Active</th>
</tr>

@foreach($today_polls as $today_poll)
    <tr style="height:20px;border:1px solid grey">
         
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $i++ }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_poll['created_at'] }}</td>
        
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ substr($today_poll['question'],0,100) }}...<br>
        
        @foreach($today_poll['response'] as $key => $response )
            <ul>
                <li>{{ $today_poll['response'][$key] }} = {{ $today_poll['response_count'][$key] }} </li>
            </ul>
        @endforeach
        
        </td>
        
        <td style="padding:10px;text-align:centerDashboard;border:1px solid grey">{{ $today_poll['from_date'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_poll['to_date'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_poll['active'] }}</td>
    </tr>
@endforeach
</table>

@endsection
