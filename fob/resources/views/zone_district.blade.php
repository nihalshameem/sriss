@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;"><a href="{{ redirect()->getUrlGenerator()->previous() }}"><i class="fa fa-arrow-left fa-lg" style="float:left"></i></a>Zone{{ $zone['id']}} Districts<a href="/fob/add_zone_district/{{ $zone['id'] }}"><i class="fa fa-plus-square fa-lg" style="float:right" ></i></a></div>

                <div class="panel-body" style="text-align: left;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>District</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>  
                   @foreach($districts as $dist)
                      <tr>
                        <td>{{ $dist['id'] }}</td>
                        <td>{{ $dist['district'] }}</td>
                        <td>{{ $dist['description'] }}</td>
                      </tr>
                    @endforeach
                  </tbody> 
                </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
