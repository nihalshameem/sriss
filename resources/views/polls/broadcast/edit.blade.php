<!DOCTYPE html>
<html>
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
      background-color: #0653c8 !important;
      
      border: 1px solid #0653c8 !important;

    }
    .btn-primary:hover
    {

      color: #0653c8 !important;
      background: white !important;
      border: 1px solid #0653c8 !important;
      display: inline-block;
    }
    .btn-primary:focus
    {
      background-color: #0653c8;
      color:#ffffff;
      border:1px solid #0653c8;
    }
    .btn-primary:visited
    { 
      background-color: #0653c8;
      color:#ffffff;
      border:1px solid #0653c8;
    }
    .btn-back {
      color: #ffffff !important;
      background-color: #0653c8 !important;
      border-color: #0653c8 !important;
      
    }
    .btn-back:hover {
      color: #0653c8 !important;
      background-color: #ffffff !important;
      border-color: #0653c8 !important;
      
    }
    .content-wrapper{
      background-color: aliceblue;
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
  .card{
    background-color: aliceblue;
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
  }
  .multiselect-container {
    width: 100% !important;
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
  
</style>

</head>
<body class="hold-transition sidebar-mini layout-fixed" style="background-color:#fafafa">
  <div class="wrapper">
   @include('layouts.header')
   @include('layouts.sidebar')
   <div class="content-wrapper">
    <!-- Main content -->
    <section class="content" style="padding-top:25px">
      <div class="container-fluid">
       <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-4">
          </div>
          <div class="col-sm-4">
            <h3 style="text-align:center">Polls BroadCast Edit</h3>
          </div>
          <div class="col-sm-3">
          </div>
          
        </div>
      </div>

      <div class="col-12">
        <div id="accordion">
             <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                  <div class="card card-primary">
                    <div class="">
                      <h4 class="">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"class="btn btn-primary" style="float:right">
                          View Geo
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="card-body">
                          <table id="example1" class="table table-borderless">
              <thead>
                <tr>
                  <th>State</th>
                  <th>Zones</th>
                  <th>District</th>
                  <th>Area</th>
              </tr>
          </thead>
          <tbody>
             @foreach($PollsBroadcast as $broadcast)
             <tr>
                <?php
                $State = App\Models\State::where('State_id',$broadcast->State_id)->first();
                ?>
                @if($State!= null)
                <td>{{$State->State_desc}}</td>
                @else
                <td></td>
                @endif
              

                <?php
                $Zones = App\Models\Zones::where('Zone_id',$broadcast->Zone_id)->first();
                ?>
                @if($Zones!=null)
                <td>{{$Zones->Zone_desc}}</td>
                @else
                <td></td>
                @endif

                <?php
                $District = App\Models\District::where('District_id',$broadcast->District_id)->first();
                ?>
                @if($District!=null)
                <td>{{$District->District_desc}}</td>
                @else
                <td></td>
                @endif
                <?php
                $Union = App\Models\Union::where('Union_id',$broadcast->Union_id)->first();
                ?>
                @if($Union!=null)
                <td>{{$Union->Union_desc}}</td>
                @else
                <td></td>
                @endif

            </tr>
            @endforeach
        </tbody>
    </table>
                      </div>
                    </div>
                  </div>
           
    </div>
        
      <div class="col-12">
        
       <form role="form" method="post"  action="{{ route('PollsUpdateBroadCast') }}" enctype="multipart/form-data" onSubmit="return confirm('Please note that all the previous broadcast options will be removed and you have to re-enter broadcast details again');">
        @csrf
        <div class="row">
        <input type="hidden" name="PollsId" value="{{Session::get('PollsId')}}">
        <div class="col-md-3 form-group">

        </div>
        <div class="col-md-6 form-group">
          <label for="exampleInputPassword1" style="text-align:center">Poll Question</label><br>

          <textarea class="form-control" name="message" placeholder="Enter Message" value="{{$Polls->Polls_Questions }}" disabled=""> {{ $Polls->Polls_Questions}}</textarea>
      </div>
       <div class="col-md-3 form-group">
            
        </div>
  </div><br>
        <div class="row">
          <div class="col-md-3 form-group">
            <label >State&nbsp;<span style="color:red">*</span></label><br>
            <select id="states" multiple="multiple" name="State_id[]" onchange="LoadZones(this)">
              <option disabled="">Select State</option>
            </select>
            @if( Session::has( 'warning' ))
            
            <div class="alert alert-danger" style="margin-top:15px;">
              {{ Session::get('warning') }}
            </div>

            @endif
            
          </div>

          <div class="col-md-3 form-group">
            <label >Zones</label><br>
            <select id="zone" multiple="multiple" name="Zone_id[]" onchange="LoadDistrict(this)">
              <option>Select Zones</option>
              
            </select>
            
          </div>

          <div class="col-md-3 form-group">
            <label >District</label><br>
            <select id="district" multiple="multiple"  name="District_id[]" onchange="LoadUnion(this)">
              <option>Select district</option>
              
            </select>
            
          </div>
          <div class="col-md-3 form-group">
            <label >Union</label><br>
            <select id="union"  name="Union_id[]" multiple="multiple">
              <option>Select Union</option>
              
            </select>
            
          </div>
        </div>
        <div style="margin: auto; max-width: 250px;">
          <a href="/EditPoll/{{Session::get('PollsId')}}" class="btn btn-primary">Previous</a>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div><br>
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
    buttonWidth: '250px'
  });
   $('#StateDivision').multiselect({
    buttonWidth: '250px'
  });
   $('#GreaterZones').multiselect({
    buttonWidth: '250px'
  });
   $('#zone').multiselect({
    buttonWidth: '250px'
  });
   $('#district').multiselect({
    buttonWidth: '250px'
  });
   $('#union').multiselect({
    buttonWidth: '250px'
  });

   $('#states').multiselect();

   $('#zone').multiselect();
   $('#district').multiselect();
   $('#union').multiselect();
 });

</script>


<script>

 function LoadZones(select){
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
    data : {'State_id':result},
    success:function(response){
     $('#zone').empty();
     var options = response.forEach( function(istate, index){
      $('#zone').append('<option value="'+istate.Zone_id+'">'+istate.Zone_desc+'</option>').multiselect("refresh");
      $('#zone').multiselect('destroy');
    });
     $('#zone').multiselect({
      buttonWidth: '250px',
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
        buttonWidth: '250px',
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
         buttonWidth: '250px',
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