@extends('layouts.app')

@section('content')
<table width="100%" border="1" cellpadding="10px" class="col-md-offset-2 col-md-10">
    <tr><th colspan="7" style="text-align:left;font-size: 18px;"><a href="{{ URL::previous() }}" style="background-color: red;color:white;margin-left: 20px;padding:10px">Back</a></th></tr>
    <tr><th colspan="7" style="text-align: center">Past Month Advertisements</th></tr>
<tr style="height:30px;background-color: blue;color:white;text-align:center;margin-left:25px">
    <th style="vertical-align: top;">Id</th>
    <th style="vertical-align: top;">Description</th>
    <th style="vertical-align: top;">Company</th>
    <th style="vertical-align: top;">Link</th>
    <th style="vertical-align: top;">From_date</th>
    <th style="vertical-align: top;">To_date</th>
    <th style="vertical-align: top;">Active</th>
</tr>

@foreach($thisweek_ads as $thisweek_ad)
    <tr style="height:20px">
        <td>{{ $thisweek_ad['id'] }}</td>
        <td>{{ $thisweek_ad['description'] }}</td>
        <td>{{ $thisweek_ad['company'] }}</td>
        <td>{{ $thisweek_ad['link'] }}</td>
        <td>{{ $thisweek_ad['from_date'] }}</td>
        <td>{{ $thisweek_ad['to_date'] }}</td>
        <td>{{ $thisweek_ad['active'] }}</td>
    </tr>
@endforeach
</table>

@endsection
