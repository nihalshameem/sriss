@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="btn-group col-md-10 col-md-offset-2 " style="margin-bottom:10px">
        <a href="{{ url('zone_details') }}"><button type="button" class="btn btn-primary">Zones</button></a>
        <a href="{{ url('district_details') }}"><button type="button" class="btn btn-primary">Districts</button></a>
        <a href="{{ url('taluk_details') }}"><button type="button" class="btn btn-primary">Areas</button></a>
    </div>
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;"><b>List of Zones - India</b><a href="{{ url( 'add_zone' ) }}"><i class="fa fa-plus-square fa-lg" style="float:right"></i></a>
                @if(Session::has('volunteer-added'))
                <strong style="color:green;float:left;">Volunteer added success!!</strong> {{ Session::get('message', '') }}
                @endif
                </div>
                
                <div class="panel-body" style="text-align: left;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Zone</th>
                      <th>Description</th>
                      <th>View</th>
                      <th>Update</th>
                      <th>Delete</th>
                      <th>Vol Assign</th>
                      <th>Volunteer</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($zones as $zone)
                        <tr>
                          <td>{{ $zone['zone'] }}</td>
                          <td>{{ $zone['description'] }}</td>
                          <td><a href="/zone_view/{{ $zone['id'] }}" ><i class="fa fa-eye fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td><a href="/zone_edit/{{ $zone['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td><a href="/zone_delete/{{ $zone['id'] }}" onclick="return confirm('Are you sure,You want to delete?')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
                          
                    @if($zone['active_vol'] =='yes')         
                        <td><a href="/zone_volunteer/{{ $zone['id'] }}" ><i class="fa fa-check fa-lg" style="text-align:cenetr;"></i></a></td>
                    @else
                        <td><a href="/zone_volunteer/{{ $zone['id'] }}" ><i class="fa fa-remove fa-lg" style="text-align:cenetr;color:red;"></i></a></td>
                    @endif
                          
                          <td><a href="/zone_volunteer_details/{{ $zone['id'] }}" ><i class="fa fa-user fa-lg" style="text-align:cenetr;">{{ $zone['volCount'] }}</i></a></td>
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
