@extends('layouts.app')

@section('content')
<?php
$i=1;
?>

<table width="100%" cellpadding="10px" class="col-md-offset-2">
    <tr style="border-bottom:none"><th colspan="8" style="text-align: center;padding:10px;font-size:20px">Today Members<span class="label label-success">{{ count($today_members) }}</span></th></tr>
    <tr style="padding:50px;height:50px">        
        <center>
        <td  colspan="8" style="border-right:none"><a href="{{ URL::previous() }}" style="color:blue;margin-left: 20px;padding:10px;font-size:25px;text-decoration:none"><i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        <a href="/today_members_xlsx" style="color:purple;margin-left: 20px;padding:10px;font-size:25px"><i class="fa fa-download" aria-hidden="true"></i></a></td>
        </center>
    </tr>
<tr style="height:30px;background-color: brown;color:white;text-align:center;margin-left:25px;padding:10px">
    <th style="text-align:center;border:1px solid brown">Sl No.</th>
    <th style="text-align:center;border:1px solid brown">Booked date</th>
    <th style="text-align:center;border:1px solid brown">Member Id</th>
    <th style="text-align:center;border:1px solid brown">Name</th>
    <th style="text-align:center;border:1px solid brown">Mobile No</th>
    <th style="text-align:center;border:1px solid brown">whatsapp No</th>
    <th style="text-align:center;border:1px solid brown">Dob</th>
    <th style="text-align:center;border:1px solid brown">Sex</th>
    <th style="text-align:center;border:1px solid brown">Email</th>
    <th style="text-align:center;border:1px solid brown">Address</th>
</tr>

@foreach($today_members as $today_member)
    <tr style="height:20px;border:1px solid grey">
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $i++ }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_member['created_at'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_member['member_id'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_member['name'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_member['mobile_number'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_member['whatsapp_number'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_member['dob'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_member['sex'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_member['email'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $today_member['address'] }}</td>   
    </tr>
@endforeach
</table>

@endsection
