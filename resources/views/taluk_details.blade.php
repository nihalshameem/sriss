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
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;">List of Areas - India<a href="{{ url( 'add_taluk' ) }}"><i class="fa fa-plus-square fa-lg" style="float:right"></i></a>
                @if(Session::has('volunteer-added'))
                <strong style="color:green;float:left;">Volunteer added success!!</strong> {{ Session::get('message', '') }}
                @endif
                </div>

                <div class="panel-body" style="text-align: left;">
                    
                    <div class="col-md-3 form-group">
                    <select name="zone" id="zone" class="form-control">
                          @foreach ($zones as $zone)
                          <option value="{{ $zone->id }}">{{ $zone->zone }}</option>
                          @endforeach 
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                      <select name="district" id="district" class="form-control">
                      @foreach ($firstdistricts as $district)
                        <option value="{{ $district->id }}">{{ $district->district }}</option>
                      @endforeach 
                      </select>
                    </div>
                    
                <table class="table">
                  <thead>
                    <tr>
                      <th>Area</th>
                      <th>Pincode</th>
                      <th>Update</th>
                      <th>Delete</th>
                      <th>Vol Assign</th>
                      <th>Volunteers</th>
                    </tr>
                  </thead>
                  <tbody>  
                    @foreach($taluks as $taluk)
                      <tr>
                        <td>{{ $taluk['taluk'] }}</td>
                        <td>{{ $taluk['pincode'] }}</td>
                        <td><a href="/taluk_edit/{{ $taluk['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                        <td><a href="/taluk_delete/{{ $taluk['id'] }}" onclick="return confirm('Are you sure,You want to delete?')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
                        
                        @if($taluk['active_vol']=="yes")
                        <td><a href="/taluk_volunteer/{{ $taluk['id'] }}" ><i class="fa fa-check fa-lg" style="text-align:cenetr;"></i></a></td>
                        @else
                        <td><a href="/taluk_volunteer/{{ $taluk['id'] }}" ><i class="fa fa-remove fa-lg" style="text-align:cenetr;color:red;"></i></a></td>
                        @endif
                        
                        <td><a href="/taluk_volunteer_details/{{ $taluk['id'] }}" ><i class="fa fa-user fa-lg" style="text-align:cenetr;">{{ $taluk['volCount'] }}</i></a></td>
                    @endforeach
                  </tbody> 
                </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#district').on('change',function(){
      $value=$(this).val();
      $.ajax({
        type : 'get',
        url : '{{URL::to('searching')}}',
        data : {'search':$value},
        success:function(data){
          $('tbody').html(data);
        } 
      });
    })
</script>
  
  
<script>
$(document).ready(function() {

$('#zone').change(function(){
var zoneid = $(this).val();
if(zoneid){
$.ajax({
type:"GET",
url:"{{url('getdistrictlist')}}?zoneid="+zoneid,
success:function(res){
if(res){
$("#district").empty();
$("#district").append('<option>Select District</option>');
$.each(res,function(key,value){
$("#district").append('<option value="'+key+'">'+value+'</option>');
});

}else{
$("#district").empty();
}
}
});
}else{
$("#district").empty();
}
});

});
</script>

<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure?');
}
</script>
@endsection
