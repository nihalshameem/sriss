
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
.btn-primary {
    color: #fafafa !important;
    background-color: #0640b5;
    border-color: #0640b5 !important;
    
}
.btn-back {
    color: #fafafa !important;
    background-color: #0640b5;
    border-color: #0640b5 !important;
    
}
.btn-back:hover
  {

      color: #0640b5 !important;
      background: white !important;
      border: 1px solid #0640b5 !important;
      display: inline-block;
  }
  .btn-primary:hover
  {

      color: #0640b5 !important;
      background: white !important;
      border: 1px solid #0640b5 !important;
      display: inline-block;
  }
  
        .content-wrapper{
            background-color: #fafafa;
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
    .card{
      background-color: #fafafa;
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
  color: #3e3e3e;
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
.card{
      background-color: #fafafa;
    }
    .bg-bd{
      background-color: #fafafa;
    }
</style>

</head>
<body class="hold-transition sidebar-mini layout-fixed" style="background-color:#fafafa">
    <div class="wrapper">
     @include('layouts.header')
     @include('layouts.sidebar')
     <div class="content-wrapper" style="background-color: #FAFAFA">
        <!-- Main content -->
        <section class="content" style="padding-top:25px">
          <div class="container-fluid">
           <div class="col-12">

            <div class="row mb-2">
              <div class="col-sm-2">
                <a href="/Polls" class="btn btn-back" style="float:left;border-radius: 3px;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
            </div>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-4">
                <h3 class="title-head">Polls Group Broadcast</h3>
            </div>
            <div class="col-sm-3">
            </div>

        </div>
    </div><br>
    <form role="form" method="post"  action="{{ route('save.PollsGroupBroadcast') }}" enctype="multipart/form-data" >
      @csrf
      <div class="row">
        <input type="hidden" name="polls_id" value="{{$polls->id }}">
        <div class="col-md-3 form-group">
        </div>
        <div class="col-md-6 form-group">
          <label for="exampleInputPassword1" style="text-align:center">Polls Question</label><br>

          <textarea class="form-control" placeholder="Enter Message" disabled="" > {{ $polls->Polls_Questions}}</textarea>
      </div>
       <div class="col-md-3 form-group">

        </div>
  </div>
  <div class="row">
    <div class="col-md-3 form-group">
    </div>
    <div class="col-md-6 form-group">
      <label for="exampleInputPassword1">Select Group</label><br>
      <select id="group" multiple="multiple" name="Group_id[]" required="">
        <option disabled="">Select Group</option>
        @foreach($Groups as $Group)
          <option value="{{$Group->Group_id}}">{{$Group->Group_name}}</option>
        @endforeach
    </select>
    @if( Session::has( 'warning' ))

    <div class="alert alert-danger" style="margin-top:15px;">
        {{ Session::get('warning') }}
    </div>

    @endif

</div>
<div class="col-md-3 form-group">
    </div>


</div>
<div style="max-width: 250px; margin: auto;">
  <a href="/AddNotification" class="btn btn-primary">Previous</a>
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
  $('#group').multiselect({
        buttonWidth: '300px'
    });

     $('#group').multiselect();
</script>

</body>

</html>