@extends('layouts.app')

@section('content')
<table width="100%" border="1" cellpadding="10px" class="col-md-offset-2 col-md-10">
    <tr><th colspan="7" style="text-align:left;font-size: 18px;"><a href="{{ URL::previous() }}" style="background-color: red;color:white;margin-left: 20px;padding:10px">Back</a></th></tr>
 <tr><th colspan="7" style="text-align: center">Today Notifications</th></tr>
<tr style="height:30px;background-color: blue;color:white;text-align:center;margin-left:25px">
    <th style="vertical-align: top;">Id</th>
    <th style="vertical-align: top;">Description</th>
    <th style="vertical-align: top;">From_date</th>
    <th style="vertical-align: top;">To_date</th>
    <th style="vertical-align: top;">Active</th>
</tr>

@foreach($total_notifications as $total_notification)
    <tr style="height:20px">
        <td>{{ $total_notification['id'] }}</td>
        <td>{{ $total_notification['description'] }}</td>
        <td>{{ $total_notification['from_date'] }}</td>
        <td>{{ $total_notification['to_date'] }}</td>
        <td>{{ $total_notification['active'] }}</td>  
    </tr>
@endforeach
</table>

@endsection
