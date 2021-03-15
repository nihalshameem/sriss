
<!DOCTYPE html>
<html style="height: 100%">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Dharma Rakshana Samiti') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/login/images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/timepicker.css') }}">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Include the plugin's CSS and JS: -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" type="text/css"/>

    <style>
        .nav-link{
            color:white;
        }
        .btn-primary
        {
            color: #ffffff !important;
            background-color: #8f3319 !important;
            border-color: #8f3319 !important;
            transition: all 0.4s ease 0s;

        }
        .btn-primary:hover
        {

            color: #8f3319 !important;
            background: white !important;
            border: 2px solid #8f3319 !important;
            display: inline-block;
        }
        .btn-primary:focus
        {
            background-color: #ffffff;
            color:#8f3319;
            border:1px solid #8f3319;
        }
        .btn-primary:visited
        { 
            background-color: #ffffff;
            color:#8f3319;
            border:1px solid #8f3319;
        }
        .btn-back {
            color: #8f3319 !important;
            background-color: #ffffb7 !important;
            border-color: #8f3319 !important;
            transition: all 0.4s ease 0s;
        }
        .btn-back:hover {
            color: #ffffb7 !important;
            background-color: #8f3319 !important;
            border-color: #ffffb7 !important;
            transition: all 0.4s ease 0s;
        }
        .content-wrapper{
            background-color: #FFFFB7;
        }
        .table-borderless{
           border: 1px solid #ddd;
       }
       .table{
          background-color:#ffffcc;
      }
      .card-header{
        background-color:#ffffcc;
        border: 1px solid #ddd;

    }
    .card-title {
        float: left;
        font-size: 1.1rem;
        font-weight: 400;
        margin: 0;
    }
    .badge
    {
        font-size:15px;
    }

    table {
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
      border: 1px solid #ddd;
      padding-top:30px;

  }

  th
  {
      text-align: left;
      border: 1px solid #ddd;
      color:#8f3319;
      font-size:16px;
      font-family: sans-serif;
  }
  td
  {
      text-align: left;
      border: 1px solid #ddd;
      font-family: sans-serif;
  }

  tr:nth-child(even) {
      background-color: #fde0d7;
  }
  .bg-danger1
  {
      background-color: #8f3319;
      color:white;
  }
  .content-wrapper{
      padding-top:50px;
  }
  .nav-link{
      color:black;
      font-size:14px;
  }
  h3{
    font-size:20px;
}
.info-box-text{
    font-size:14px;

}
th{
  font-size:14px;  
}
td{
    font-size:14px;
}
.badge{
    font-size:14px;

}
.link1 {
    color: white;
    height: 100px;
    background-color: #874479;
    padding: 40px;
    text-decoration: none;
}
.title-head{
  font-weight: bold;
  color: #8f3319;
  font-size: 17px;
}
.example::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.example {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
</style>

</head>
<body class="hold-transition sidebar-mini layout-fixed" style="background-color:#ffffb7">
    <div class="wrapper">
     @include('layouts.header')
     @include('layouts.sidebar')
     <div class="content-wrapper">
        <!-- Main content -->
        <section class="content" style="padding-top:25px">
          <div class="container-fluid">
           <div class="col-12">

            <div class="row mb-2">
              <div class="col-sm-2">
                <a href="/Notifications" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
            </div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-4">
                <h3 class="title-head">Advertisement BroadCast</h3>
            </div>
            <div class="col-sm-3">
            </div>

        </div>
    </div><br>
    <form role="form" method="post"  action="{{ route('save.AdBroadcast') }}" enctype="multipart/form-data" >
      @csrf
      <div class="row">
        <input type="hidden" name="Advertisement_Id" value="{{$advertisement->id }}">
        <div class="col-md-3 form-group">

        </div>
        <div class="col-md-6 form-group">
          <label for="exampleInputPassword1" style="text-align:center">Advertisement Message</label><br>

          <textarea class="form-control" name="description" placeholder="Enter Message" value="{{$advertisement->description }}" disabled=""> {{ $advertisement->description}}</textarea>
      </div>
       <div class="col-md-3 form-group">

        </div>
  </div><br>
  <div class="row">
    <div class="col-md-4 form-group">
      <label for="exampleInputPassword1">State</label><br>
      <select id="states" multiple="multiple" name="State_id[]">
        <option disabled="">select state</option>
    </select>
    @if( Session::has( 'warning' ))

    <div class="alert alert-danger" style="margin-top:15px;">
        {{ Session::get('warning') }}
    </div>

    @endif

</div>
<br>
<div class="col-md-4 form-group">
  <label for="exampleInputPassword1">Zones</label><br>
  <select id="zone" multiple="multiple" name="Zone_id[]" onchange="LoadDistrict(this)">
    <option value="">Select Zones</option>
    @foreach ($zones as $zone)
    <option value="{{$zone->Zone_id}}">{{$zone->Zone_desc}}</option>
    @endforeach
</select>

</div>

<div class="col-md-4 form-group">
  <label for="exampleInputPassword1">District</label><br>
  <select id="district" multiple="multiple"  name="District_id[]" onchange="LoadUnion(this)">
    <option>Select district</option>

</select>

</div>
<div class="col-md-4 form-group">
  <label for="exampleInputPassword1">Union</label><br>
  <select id="union"  name="Taluk_id[]" multiple="multiple">
    <option>Select Union</option>

</select>

</div>
</div>
<div style="max-width: 250px; margin: auto;">
  <a href="/AddAdvertisements" class="btn btn-primary">Previous</a>
  <button type="submit" class="btn btn-primary">Submit</button>
</div><br><br>
</form>


</div>
</section>
</div>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script> $.widget.bridge('uibutton', $.ui.button); </script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
<!-- <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script> -->
<!-- <script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> -->
<link rel="stylesheet" href="{{ asset('assets/plugins/time-picker-bootstrap/timepicker.css')}}">
<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('assets/dist/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">

    $(document).ready(function() {


     var substateArray =  @json($states);
     console.log(substateArray);
     var options = substateArray.forEach( function(istate, index){
      $('#states').append('<option value="'+istate.State_id+'">'+istate.State_desc+'</option>').multiselect("refresh");;

      $('#states').multiselect('destroy');
  });
     $('#states').multiselect({
        buttonWidth: '300px'
    });
     $('#StateDivision').multiselect({
        buttonWidth: '300px'
    });
     $('#GreaterZones').multiselect({
        buttonWidth: '300px'
    });
     $('#zone').multiselect({
        buttonWidth: '300px'
    });
     $('#district').multiselect({
        buttonWidth: '300px'
    });
     $('#union').multiselect({
        buttonWidth: '300px'
    });

     $('#states').multiselect();
     $('#StateDivision').multiselect();
     $('#GreaterZones').multiselect();
     $('#zone').multiselect();
     $('#district').multiselect();
     $('#union').multiselect();
 });

</script>



<script>

 function LoadStateDivision(select){
  var result = [];
  var options = select && select.options;
  var opt;

  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
  }
}
$.ajax({
    type : 'get',
    url : '{{URL::to('LoadStateDivision')}}',
    data : {'state_id':result},
    success:function(response){
     $('#StateDivision').empty();
     var options = response.forEach( function(istate, index){
      $('#StateDivision').append('<option value="'+istate.State_Division_id+'">'+istate.State_Division_desc+'</option>').multiselect("refresh");;

      $('#StateDivision').multiselect('destroy');
  });
     $('#StateDivision').multiselect({
        buttonWidth: '300px',
        includeSelectAllOption: true
    });
 } 
});


}
</script>

<script>

 function LoadGreaterZones(select){
  var result = [];
  var options = select && select.options;
  var opt;

  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
  }
}
$.ajax({
    type : 'get',
    url : '{{URL::to('LoadGreaterZones')}}',
    data : {'statedivision_id':result},
    success:function(response){
     $('#GreaterZones').empty();
     var options = response.forEach( function(istate, index){
        $('#GreaterZones').append('<option value="'+istate.Greater_Zones_id+'">'+istate.Greater_Zones_desc+'</option>').multiselect("refresh");;
        $('#GreaterZones').multiselect('destroy');
    });
     $('#GreaterZones').multiselect({
        buttonWidth: '300px',
        includeSelectAllOption: true,
    });
 } 
});


}
</script>
<script>

 function LoadZones(select){
  console.log(select);
  var result = [];
  var options = select && select.options;
  var opt;

  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
  }
}
$.ajax({
    type : 'get',
    url : '{{URL::to('LoadZones')}}',
    data : {'state_id':result},
    success:function(response){
     $('#zone').empty();
     var options = response.forEach( function(istate, index){
        $('#zone').append('<option value="'+istate.Zone_id+'">'+istate.Zone_desc+'</option>').multiselect("refresh");
        $('#zone').multiselect('destroy');
    });
     $('#zone').multiselect({
        buttonWidth: '300px',
        enableFiltering: true,
        includeSelectAllOption: true,
        maxHeight: 200,
        dropUp: true,
        enableCaseInsensitiveFiltering: true,
    });
 } 
});


}
</script>

<script>

 function LoadDistrict(select){
  var result = [];
  var options = select && select.options;
  var opt;

  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
  }
}
$.ajax({
    type : 'get',
    url : '{{URL::to('LoadDistrict')}}',
    data : {'zone_id':result},
    success:function(response){
     $('#district').empty();
     var options = response.forEach( function(istate, index){
        $('#district').append('<option value="'+istate.District_id+'">'+istate.District_desc+'</option>').multiselect("refresh");
        $('#district').multiselect('destroy');
    });
     $('#district').multiselect({
      buttonWidth: '300px',
        enableFiltering: true,
        includeSelectAllOption: true,
        maxHeight: 200,
        dropUp: true,
        enableCaseInsensitiveFiltering: true,
    });
 } 
});


}
</script>

<script>

 function LoadUnion(select){
  var result = [];
  var options = select && select.options;
  var opt;

  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
  }
}
$.ajax({
    type : 'get',
    url : '{{URL::to('LoadUnion')}}',
    data : {'district_id':result},
    success:function(response){
     $('#union').empty();
     var options = response.forEach( function(istate, index){
        $('#union').append('<option value="'+istate.Union_id+'">'+istate.Union_desc+'</option>').multiselect("refresh");
        $('#union').multiselect('destroy');
    });
     $('#union').multiselect({
           buttonWidth: '300px',
        enableFiltering: true,
        includeSelectAllOption: true,
        maxHeight: 200,
        dropUp: true,
        enableCaseInsensitiveFiltering: true,
    });
 } 
});


}
</script>

</body>

</html>