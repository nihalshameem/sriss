@extends('layouts.app')

@section('content')
<table width="100%" border="1" cellpadding="10px" class="col-md-offset-2 col-md-10">
    <tr><th colspan="7" style="text-align:left;font-size: 18px;"><a href="{{ URL::previous() }}" style="background-color: red;color:white;margin-left: 20px;padding:10px">Back</a></th></tr>
     <tr><th colspan="7" style="text-align: center">Past year Members</th></tr>
<tr style="height:30px;background-color: blue;color:white;text-align:center;margin-left:25px">
    <th style="vertical-align: top;">Member Id</th>
    <th style="vertical-align: top;">Name</th>
    <th style="vertical-align: top;">Mobil NO</th>
    <th style="vertical-align: top;">Dob</th>
    <th style="vertical-align: top;">Sex</th>
    <th style="vertical-align: top;">Email</th>
    <th style="vertical-align: top;">Address</th>
</tr>

@foreach($lastyear_members as $lastyear_member)
    <tr style="height:20px">
        <td>{{ $lastyear_member['member_id'] }}</td>
        <td>{{ $lastyear_member['name'] }}</td>
        <td>{{ $lastyear_member['mobile_number'] }}</td>
        <td>{{ $lastyear_member['dob'] }}</td>
        <td>{{ $lastyear_member['sex'] }}</td>
        <td>{{ $lastyear_member['email'] }}</td>
        <td>{{ $lastyear_member['address'] }}</td>   
    </tr>
@endforeach
</table>

@endsection
