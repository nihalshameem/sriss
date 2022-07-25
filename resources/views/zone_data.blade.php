<html>
<head>
<title>Dependent select Dropdown box in Laravel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-success">
<div class="panel-heading"><h2>Dependent Zone District Select Box</h2></div>

<div class="panel-body">
<form class="form-horizontal" role="form" method="POST" action="">

<div class="form-group-sm">



<div class="col-md-6">
<select name="zone" id="zone" class="form-control">
<option value="">--Select Zone--</option>
@foreach ($zones as $zone)
<option value="{{$zone->id}}"> {{$zone->zone}}</option>
@endforeach
</select>
</div>



<div class="col-md-4">
<select name="district" id="district" class="form-control">
<option>--District--</option>
</select>
</div>


</div>
</form>
</div>

<div class="panel-footer" style="height:50px;">
{{csrf_field()}}
<button class="btn btn-success pull-right" >Submit</button>
</div>
</div>
</div>
</div>
</div>

<script>
$(document).ready(function() {

$('#zone').change(function(){
var zoneID = $(this).val();
if(zoneID){
$.ajax({
type:"GET",
url:"{{url('getdistrictlist')}}?zoneid="+zoneID,
success:function(res){
if(res){
$("#district").empty();
$("#district").append('<option>Select</option>');
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

</body>
</html>