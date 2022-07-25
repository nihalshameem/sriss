@extends('layouts.app')

@section('content')
<div >

 <div class="content-wrapper">

  <!-- Main content -->
  <section class="content" style="padding-top:25px">
   <div class="container-fluid">
    <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="/home" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -12px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
          <h3 class="title-head">Member Approval</h3>
        </div>
        <div class="col-sm-2">
        </div>
        
      </div>
    </div>
    <div class="col-12">
      <div class="row" style="padding-left:60px">
       
        <div class="col-sm-3">
         <label>Start Date</label>
         <input type="date" class="form-control" id="start_date">
       </div>
       <div class="col-sm-3">
         <label>End Date</label>
         <input type="date" class="form-control" id="end_date">
         
       </div>
       <div class="col-sm-1" style="padding-top:30px">
         <button type="button" class="btn btn-primary" onclick="CollectionFilter()">Search</button>
         
       </div>
       <div class="col-sm-3" style="padding-top:40px">
         <div class="form-group clearfix">
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary11" value="N" name="status"  onclick="PendingFilter()" checked="">
                  <label for="checkboxPrimary11">Pending
                  </label>
                </div>
                
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary12" value="R"  name="active" >
                  <label for="checkboxPrimary12" onclick="RejectedFilter()">
                    Rejected
                  </label>
                </div>
              </div>
         
       </div>
       <div class="col-sm-2" style="padding-top:40px">
        <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary21" class="selectall">
                        <label for="checkboxPrimary21">Select All
                        </label>
                      </div>
        
      </div>
    </div>
  </div>
  <div class="col-12">

   
   <div class="row">
     <div class="col-12">
       <div class="card">
         <!-- /.card-header -->
         <div class="card-body" id="referalreport">
          
          @include('Member.filter.member_approval_filter')

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
</div>
<script>
  function CollectionFilter()
  {
    var startDate = document.getElementById("start_date").value;
    var endDate = document.getElementById("end_date").value;
     if ((Date.parse(endDate) <= Date.parse(startDate))) 
     {
      alert("End date should be greater than Start date");
      document.getElementById("end_date").value="";
      document.getElementById("start_date").value="";
    }
    else
    {
      if (document.getElementById('checkboxPrimary11').checked) {
        status = document.getElementById('checkboxPrimary11').value;
      }
      if (document.getElementById('checkboxPrimary12').checked) {
        status = document.getElementById('checkboxPrimary12').value;
      }

    var x = document.getElementById("start_date");
    var currentVal = x.value;
    var EndDate = document.getElementById("end_date");
    var updatedDate = EndDate.value;
    $.ajax({
      type : 'get',
      url : '{{URL::to('MemberPending/Filter')}}',
      data : {'createdDate':currentVal,'updatedDate':updatedDate,'status':status},
      success:function(data){
       $('#referalreport').empty();
       $('#referalreport').html(data['member']);
     } 
   });
  }
  }
</script>
<script>
  function PendingFilter()
  {
    var startDate = document.getElementById("start_date").value;
    var endDate = document.getElementById("end_date").value;
     if ((Date.parse(endDate) <= Date.parse(startDate))) 
     {
      alert("End date should be greater than Start date");
      document.getElementById("end_date").value="";
      document.getElementById("start_date").value="";
    }
    else
    {
        status = document.getElementById('checkboxPrimary11').value;      
        document.getElementById('checkboxPrimary12').checked = false
    var x = document.getElementById("start_date");
    var currentVal = x.value;
    var EndDate = document.getElementById("end_date");
    var updatedDate = EndDate.value;
    $.ajax({
      type : 'get',
      url : '{{URL::to('MemberPending/Filter')}}',
      data : {'createdDate':currentVal,'updatedDate':updatedDate,'status':status},
      success:function(data){
       $('#referalreport').empty();
       $('#referalreport').html(data['member']);
     } 
   });
  }
  }
</script>
<script>
  function RejectedFilter()
  {
    var startDate = document.getElementById("start_date").value;
    var endDate = document.getElementById("end_date").value;
     if ((Date.parse(endDate) <= Date.parse(startDate))) 
     {
      alert("End date should be greater than Start date");
      document.getElementById("end_date").value="";
      document.getElementById("start_date").value="";
    }
    else
    {
        status = document.getElementById('checkboxPrimary12').value;
        document.getElementById('checkboxPrimary11').checked = false
        var x = document.getElementById("start_date");
        var currentVal = x.value;
        var EndDate = document.getElementById("end_date");
        var updatedDate = EndDate.value;
        $.ajax({
          type : 'get',
          url : '{{URL::to('MemberPending/Filter')}}',
          data : {'createdDate':currentVal,'updatedDate':updatedDate,'status':status},
          success:function(data){
           $('#referalreport').empty();
           $('#referalreport').html(data['member']);
         } 
       });
  }
  }
</script>

  @endsection