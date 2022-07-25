@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;"><a href="{{ url("zone_details") }}"><i class="fa fa-arrow-left fa-lg" style="float:left"></i></a>{{ $zone['zone']}} <a href="/add_zone_district/{{ $zone['id'] }}"><i class="fa fa-plus-square fa-lg" style="float:right" ></i></a></div>

                <div class="panel-body" style="text-align: left;">
                    
                <?php 
                    $i=1;
                ?>
                    
                <table class="table">
                  <thead>
                    <tr>
                      <th>SI NO</th>
                      <th>District</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>  
                   @foreach($districts as $dist)
                      <tr>
                        <td>{{ $i++ }}</td>
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
