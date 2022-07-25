@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">Member Deactivation</div>

          <div class="panel-body">
              
          <form class="form-horizontal" action="/member_deactivation" method="POST">
                             {{ csrf_field() }}

    <div class="form-group">
    <label class="control-label col-sm-3" for="search">Search By:</label>

    <div class="col-sm-4">          
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

    <div class="col-sm-4">
    <select name="mobile_number" id="mobile_number" class="selectpicker form-control mobile_number"  data-live-search="true">
        <option value="">Mobile Number</option>
          @foreach ($members as $member)
          <option value="{{ $member->mobile_number }}">{{ $member->mobile_number }}</option>
          @endforeach
    </select>
    </div>
    </div>

    <div class="form-group memberdiv" style="display: none">
    <label class="control-label col-sm-3" for="member_id">Member Id :</label>

    <div class="col-sm-4">
    <select name="member_id" id="member_id" class="selectpicker form-control member_id"  data-live-search="true">
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
      <div id="membername" class="col-sm-4">
          <input type="text" class="form-control" name="membername" value="" readonly>
      </div>
    </div>
      
    <div class="form-group">
      <label class="control-label col-sm-3" for="reason">Reason :</label>
      <div class="col-sm-4">
        <input type="text" name="deactivate_reason" class="form-control" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-3" for="des">Active:</label>
        <div class="col-sm-4">          
          <label class="radio-inline">
          <input type="radio" name="active_flag" value="yes" checked>Yes
          </label>
          <label class="radio-inline">
          <input type="radio" name="active_flag" value="no">No
          </label>
        </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-3 col-sm-5">
        <button type="submit" class="btn btn-default" name="submit">Submit</button>
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
    var mobile_number = $(this).val();
    if(mobile_number){
    $.ajax({
    type:"GET",
    url:"{{url('getMemberByMobile1')}}?mobile_number="+mobile_number,
    success:function(res){
    if(res){
    $("#membername").empty();
    $.each(res,function(key,member){
    $("#memname").show();
    $("#membername").append('<input type="text" class="form-control" name="membername" value="'+member['name']+'" readonly>'+
    '<input type="text" class="form-control" name="membername" value="'+member['mobile_number']+'" readonly>'+
    '<input type="text" class="form-control" name="membername" value="'+member['email']+'" readonly>');
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
    url:"{{url('getMemberByMemberId1')}}?member_id="+member_id,
    success:function(res){
    if(res){
    $("#membername").empty();
    $.each(res,function(key,member){
    $("#memname").show();
   $("#membername").append('<input type="text" class="form-control" name="membername" value="'+member['name']+'" readonly>'+
    '<input type="text" class="form-control" name="membername" value="'+member['mobile_number']+'" readonly>'+
    '<input type="text" class="form-control" name="membername" value="'+member['email']+'" readonly>');
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
        
        
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;text-align:left;">Deactivated Members</div>
                <div class="panel-body" style="text-align: left;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile Number</th>
                      <th>Member Id</th>
                      <th>Reason</th>
                    </tr>
                  </thead>
                  <tbody>  
                    @foreach($demembers as $demember)
                        <tr>
                          <td>{{ $demember['name'] }}</td>
                          <td>{{ $demember['email'] }}</td>
                          <td>{{ $demember['mobile_number'] }}</td>
                          <td>{{ $demember['member_id'] }}</td>
                          <td>{{ $demember['deactivate_reason'] }}</td>
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
