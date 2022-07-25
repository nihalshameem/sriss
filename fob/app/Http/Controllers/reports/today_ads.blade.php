@extends('layouts.app')

@section('content')
<table width="100%" border="1" cellpadding="10px" class="col-md-offset-2 col-md-10">
    <tr><th colspan="7" style="text-align:left;font-size: 18px;"><a href="{{ URL::previous() }}" style="background-color: red;color:white;margin-left: 20px;padding:10px">Back</a></th></tr>
     <tr><th colspan="7" style="text-align: center">Today Ads</th></tr>
<tr style="height:30px;background-color: blue;color:white;text-align:center;margin-left:25px">
    <th style="vertical-align: top;">Member Id</th>
    <th style="vertical-align: top;">Name</th>
    <th style="vertical-align: top;">Dob</th>
    <th style="vertical-align: top;">Sex</th>
    <th style="vertical-align: top;">Email</th>
    <th style="vertical-align: top;">Address</th>
</tr>

@foreach($today_ads as $today_ad)
    <tr style="height:20px">
        <td>{{ $today_ad['member_id'] }}</td>
        <td>{{ $today_ad['name'] }}</td>
        <td>{{ $today_ad['dob'] }}</td>
        <td>{{ $today_ad['sex'] }}</td>
        <td>{{ $today_ad['email'] }}</td>
        <td>{{ $today_ad['address'] }}</td>   
    </tr>
@endforeach
</table>

@endsection
