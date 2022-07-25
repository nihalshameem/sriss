@extends('layouts.app')

@section('content')
<?php
$i=1;
?>
<table width="100%" cellpadding="10px" class="col-md-offset-2 col-md-10">
    <tr style="border-bottom:none"><th colspan="8" style="text-align: center;padding:10px;font-size:20px">Yesterday Polls<span class="label label-success">{{ count($yesterday_polls) }}</span></th></tr>
    <tr style="padding:50px;height:50px">        
        <center>
        <td  colspan="8" style="border-right:none"><a href="{{ URL::previous() }}" style="color:blue;margin-left: 20px;padding:10px;font-size:25px;text-decoration:none"><i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        <a href="/fob/yesterday_polls_xlsx" style="color:purple;margin-left: 20px;padding:10px;font-size:25px"><i class="fa fa-download" aria-hidden="true"></i></a></td>
        </center>
    </tr>
<tr style="height:30px;background-color: brown;color:white;text-align:center;margin-left:25px;padding:10px">
    <th style="text-align:center;border:1px solid brown">Sl No.</th>
    <th style="text-align:center;border:1px solid brown">Booked date</th>
    <th style="text-align:center;border:1px solid brown">Question</th>
    <th style="text-align:center;border:1px solid brown">From_date</th>
    <th style="text-align:center;border:1px solid brown">To_date</th>
    <th style="text-align:center;border:1px solid brown">Active</th>
</tr>

@foreach($yesterday_polls as $yesterday_poll)
     <tr style="height:20px;border:1px solid grey">
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $i++ }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $yesterday_poll['created_at'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $yesterday_poll['question'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $yesterday_poll['from_date'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $yesterday_poll['to_date'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $yesterday_poll['active'] }}</td>
    </tr>
@endforeach
</table>

@endsection
