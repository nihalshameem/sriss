@extends('layouts.app')

@section('content')
<?php
$i=1;
?>
<table width="100%" cellpadding="10px" class="col-md-offset-2">
    <tr style="border-bottom:none"><th colspan="8" style="text-align: center;padding:10px;font-size:20px">Total Members<span class="label label-success">{{ count($total_members) }}</span></th></tr>
    <tr style="padding:50px;height:50px">        
        <center>
        <td  colspan="8" style="border-right:none"><a href="{{ URL::previous() }}" style="color:blue;margin-left: 20px;padding:10px;font-size:25px;text-decoration:none"><i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        <!--<a href="/total_members_xlsx" style="color:purple;margin-left: 20px;padding:10px;font-size:25px"><i class="fa fa-download" aria-hidden="true"></i></a>-->
        <a href="{{ url('totalMembers/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
        <a href="{{ url('totalMembers/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
        <a href="{{ url('totalMembers/csv') }}"><button class="btn btn-success">Download CSV</button></a>
        </td>
        </center>
    </tr>
<tr style="height:30px;background-color: brown;color:white;text-align:center;margin-left:25px;padding:10px">
    <th style="text-align:center;border:1px solid brown">Sl No.</th>
    <th style="text-align:center;border:1px solid brown">Booked date</th>
    <th style="text-align:center;border:1px solid brown">Member Id</th>
    <th style="text-align:center;border:1px solid brown">Name</th>
    <th style="text-align:center;border:1px solid brown">Mobile No</th>
    <th style="text-align:center;border:1px solid brown">Whatsapp No</th>
    <th style="text-align:center;border:1px solid brown">Dob</th>
    <th style="text-align:center;border:1px solid brown">Sex</th>
    <th style="text-align:center;border:1px solid brown">Email</th>
    <th style="text-align:center;border:1px solid brown">Address</th>
</tr>

@foreach($total_members as $total_member)
    <tr style="height:20px;border:1px solid grey">
        <td style="padding:10px;border:1px solid grey">{{ $i++ }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $total_member['created_at'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $total_member['member_id'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $total_member['name'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $total_member['mobile_number'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $total_member['whatsapp_number'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $total_member['dob'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $total_member['sex'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $total_member['email'] }}</td>
        <td style="padding:10px;text-align:center;border:1px solid grey">{{ $total_member['address'] }}</td>   
    </tr>
@endforeach
</table>

@endsection
