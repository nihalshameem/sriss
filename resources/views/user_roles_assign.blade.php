@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Assign Role</div>
        
        @if(session()->has('rolesuccess'))
    <div class="alert alert-success">
        {{ session()->get('rolesuccess') }}
    </div>
@endif


        <div class="panel-body">  
          <form class="form-horizontal" action="/roll_assignment" method="POST">
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

    <div class="col-sm-3">
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

    <div class="col-sm-3">
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
      <div id="membername" class="col-sm-3">
          <input type="text" class="form-control" name="membername" value="" readonly>
      </div>
    </div>


    <div class="form-group">
        <label class="control-label col-sm-3" for="roles">Roles :</label>
        <div class="col-sm-5">
            @foreach ($roles as $role)
            <input type="checkbox" name="roles[]" value="{{ $role->roles }}">{{ $role->roles }}<br>
            @endforeach
          </select>
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
    var member_id = $(this).val();
    if(member_id){
    $.ajax({
    type:"GET",
    url:"{{url('getMemberByMemberId')}}?member_id="+member_id,
    success:function(res){
        //console.log(res);
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
    console.log(value.name);
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
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
              <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;text-align:left;">Roles For Users<span style="float:right"><input id="myInput" type="text" placeholder="Search.."></span></div>
              <div class="panel-body" style="text-align: left;">
              <table class="table">
    <?php
        $i=1;
        $users = App\User::where('user_type','!=','MEMBER')->get()->toArray();
    ?>
                <thead>
                  <tr>
                    <th>SI NO</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Member Id</th>
                    <th>Roles</th>
                  </tr>
                </thead>
                <tbody id="myTable">  
                  @foreach($users as $user)
                      <tr>
                          <td>{{ $i++ }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['mobile_number'] }}</td>
                        <td>{{ $user['member_id'] }}</td>
                        <td>{{ $user['user_type'] }}</td>
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
