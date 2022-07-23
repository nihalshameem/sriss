@extends('layouts.app')

@section('content')
<table width="100%" border="1" cellpadding="10px" class="col-md-offset-2 col-md-10">
    <tr><th colspan="7" style="text-align:left;font-size: 18px;"><a href="{{ URL::previous() }}" style="background-color: red;color:white;margin-left: 20px;padding:10px">Back</a></th></tr>
 <tr><th colspan="7" style="text-align: center">Yesterday Polls</th></tr>
<tr style="height:30px;background-color: blue;color:white;text-align:center;margin-left:25px">
    <th style="vertical-align: top;">Id</th>
    <th style="vertical-align: top;">Question</th>
    <th style="vertical-align: top;">From_date</th>
    <th style="vertical-align: top;">To_date</th>
    <th style="vertical-align: top;">Active</th>
</tr>

@foreach($yesterday_polls as $yesterday_poll)
    <tr style="height:20px">
        <td>{{ $yesterday_poll['id'] }}</td>
        <td>{{ $yesterday_poll['question'] }}</td>
        <td>{{ $yesterday_poll['from_date'] }}</td>
        <td>{{ $yesterday_poll['to_date'] }}</td>
        <td>{{ $yesterday_poll['active'] }}</td>
    </tr>
@endforeach
</table>

@endsection
