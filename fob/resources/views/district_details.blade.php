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
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;">District Details<a href="{{ url( 'add_district' ) }}"><i class="fa fa-plus-square fa-lg" style="float:right"></i></a>
                
                @if(Session::has('volunteer-added'))
                <strong style="color:green;float:left;">Volunteer added success!!</strong> {{ Session::get('message', '') }}
                @endif
                </div>

                <div class="panel-body" style="text-align: left;">
                
                <div class="panel-body" style="text-align: left;">
                  
                  
                  <div class="col-md-3 form-group">
                    <select name="search" id="search" class="form-control">
                          <option value="">Select Zone</option>
                          @foreach ($zones as $zone)
                          <option value="{{ $zone->id }}">{{ $zone->zone }}</option>
                          @endforeach 
                        </select>
                  </div>
                
                
                <table class="table">
                  <thead>
                    <tr>
                      <th>District</th>
                      <th>Description</th>
                      <th>View</th>
                      <th>Update</th>
                      <th>Delete</th>
                      <th>Vol Assign</th>
                      <th>Volunteer</th>
                    </tr>
                  </thead>
                  <tbody>  
                   @foreach($districts as $district)
                      <tr>
                        <td>{{ $district['district'] }}</td>
                        <td>{{ $district['description'] }}</td>
                        <td><a href="/fob/district_view/{{ $district['id'] }}" ><i class="fa fa-eye fa-lg" style="text-align:cenetr;"></i></a></td>
                        <td><a href="/fob/district_edit/{{ $district['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                        <td><a href="/fob/district_delete/{{ $district['id'] }}" onclick="return confirm('Are you sure,You want to delete?')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
                        
                        @if($district['active_vol'] =='yes')         
                        <td><a href="/fob/district_volunteer/{{ $district['id'] }}" ><i class="fa fa-check fa-lg" style="text-align:cenetr;"></i></a></td>
                        @else
                        <td><a href="/fob/district_volunteer/{{ $district['id'] }}" ><i class="fa fa-remove fa-lg" style="text-align:cenetr;color:red;"></i></a></td>
                        @endif
                        
                        <td><a href="/fob/district_volunteer_details/{{ $district['id'] }}" ><i class="fa fa-user fa-lg" style="text-align:cenetr;"></i>{{ $district['volCount'] }}</a></td>
                      </tr>
                    @endforeach
                  </tbody> 
                </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#search').on('change',function(){
      $value=$(this).val();
      $.ajax({
        type : 'get',
        url : '{{URL::to('search')}}',
        data : {'search':$value},
        success:function(data){
          $('tbody').html(data);
        } 
      });
    })
  </script>
  
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure?');
}
</script>
  
@endsection
