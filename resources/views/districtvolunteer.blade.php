@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Add {{ $district['district']}} Volunteer</b></div>

                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('district_volunteer') }}" method="POST">
                             {{ csrf_field() }}
                        

  
                        <input type="hidden" class="form-control" name="type" value="d" >
                        <input type="hidden" class="form-control" name="type_id" value="{{ $district['id']}}" >

    <div class="form-group">
    <label class="control-label col-sm-3" for="search">Search By:</label>

    <div class="col-sm-5">          
      <label class="radio-inline">
      <input type="radio" class="searchby" name="active" value="mobile_number" checked>Mobile Number
      </label>
      <label class="radio-inline">
      <input type="radio" class="searchby" name="active" value="member_id">Member Id
      </label>
    </div>
    </div>


    <div class="form-group mobilediv">
    <label class="control-label col-sm-3" for="mobile_number">Mobile Number :</label>

    <div class="col-sm-5">
    <select name="mobile_number" id="mobile_number" class="selectpicker form-control mobile_number"  data-live-search="true">
        <option value="">Mobile Number</option>
          @foreach ($members as $member)
          <option value="{{ $member->member_id }}">{{ $member->mobile_number }}</option>
          @endforeach
    </select>
    </div>
    </div>

    <div class="form-group memberdiv" style="display: none">
    <label class="control-label col-sm-3" for="member_id">Member Id :</label>

    <div class="col-sm-5">
    <select name="mobile_number" id="member_id" class="selectpicker form-control member_id"  data-live-search="true">
        <option value="">Member Id</option>
          @foreach ($members as $member)
          <option value="{{ $member->member_id }}">{{ $member->member_id }}</option>
          @endforeach
    </select>
    </div>
    </div>

    <div class="form-group" id="memname" style="display: none">
      <div id="label">
          <label class="control-label col-sm-3" for="membername">Member Name :</label>
      </div>
      <div id="membername" class="col-sm-5">
          <input type="text" class="form-control" name="membername" value="" readonly>
      </div>
    </div>
					
					<div class="form-group">
                       	<label class="control-label col-sm-3" for="fdate">From Date:</label>
                       	<div class="col-sm-5">
                        <input type="date" class="form-control" max="9999-12-31" id="fdate" placeholder="Select From Date" name="fdate" max="9999-12-31" required>
                       	</div>
                    </div>

                    <div class="form-group">
                      	<label class="control-label col-sm-3" for="tdate">To Date:</label>
                      	<div class="col-sm-5">          
                        <input type="date" class="form-control" max="9999-12-31" id="tdate" placeholder="Enter To Date " name="tdate" max="9999-12-31" required>
                      	</div>
                    </div>

                    <input type="hidden" class="form-control" name="active" value="yes" >

                    <div class="form-group">        
                      <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-default" name="submit">Submit</button>
                        <a class="btn btn-default btn-close" href="{{ redirect()->getUrlGenerator()->previous() }}">Cancel</a>
                      </div>
                    </div>

                    </form>
                </div>
<script type="text/javascript">
    $(".searchby").on('change', function(){
    var searchby = $(this).val();
    if(searchby == "member_id"){
    $(".memberdiv").show();
    $(".mobilediv").hide();
    }else{
    $(".memberdiv").hide();
    $(".mobilediv").show();
    }
    });
    </script>

    <script type="text/javascript">
    $(".mobile_number").on('change', function(){
    var mobile_number = $(this).val();
    $('.member_id').val(mobile_number); 
    });
    $(".member_id").on('change', function(){
    var mobile_number = $(this).val();
    $('.member_id').val(mobile_number); 
    });
    </script>    

    <script>
    $(document).ready(function() {

    $('#mobile_number').change(function(){
    var member_id = $(this).val();
    if(member_id){
    $.ajax({
    type:"GET",
    url:"{{url('getMemberByMemberId')}}?member_id="+member_id,
    success:function(res){
        console.log(res);
    if(res){
    $("#membername").empty();
    $.each(res,function(key,value){
    $("#memname").show();
    $("#membername").append('<input type="text" class="form-control" name="membername" value="'+value+'" readonly>');
    });

    }else{
    $("#memname").hide();
    $("#membername").empty();
    }
    }
    });
    }else{
    $("#memname").hide();
    $("#membername").empty();
    }
    });

    });

    $(document).ready(function() {

    $('#member_id').change(function(){
    var member_id = $(this).val();
    if(member_id){
    $.ajax({
    type:"GET",
    url:"{{url('getMemberByMemberId')}}?member_id="+member_id,
    success:function(res){
    if(res){
    $("#membername").empty();
    $.each(res,function(key,value){
    $("#memname").show();
    $("#membername").append('<input type="text" class="form-control" name="membername" value="'+value+'" readonly>');
    });

    }else{
    $("#memname").hide();
    $("#membername").empty();
    }
    }
    });
    }else{
    $("#memname").hide();
    $("#membername").empty();
    }
    });

    });
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

            </div>
        </div>
    </div>
</div>
@endsection
