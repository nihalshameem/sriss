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
          <a href="/Reports" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -12px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
          <h3 class="title-head">Member Referral</h3>
        </div>
        <div class="col-sm-2">
         
        </div>
        
      </div>
    </div>
    <div class="col-12">
      <div class="row mb-2">
        <div class="col-sm-1">
        </div>
         <div class="col-sm-3">
         <label>Mobile Number</label>
         <input type="text" name="membersearch" id="member_id" class="form-control"  required>
         
       </div>
        <div class="col-sm-3">
         <label>Start Date</label>
         <input type="date" class="form-control" id="start_date" >
       </div>
       <div class="col-sm-3">
         <label>End Date</label>
         <input type="date" class="form-control" id="end_date">
         
       </div>
       
       <div class="col-sm-1" style="padding-top:30px">
         <button type="button" class="btn btn-primary" onclick="CollectionFilter()">Search</button>
         
       </div>
       <div class="col-sm-1">
        <a onclick="exportTableToExcel('referal_reports','Member Referral reports')" style="float:right;cursor: pointer" style="float:right"><i class="fa fa-download" aria-hidden="true" style="font-size:30px;color:#8f3319"></i></a>
      </div>
    </div>
  </div>
  <div class="col-12">

   
   <div class="row">
     <div class="col-12">
       <div class="card">
         <!-- /.card-header -->
         <div class="card-body" id="referal_reports">
          
           
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
</section>
</div>
<script>
  function CollectionFilter(updatedDate)
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
        var x = document.getElementById("start_date");
      var currentVal = x.value;
      var EndDate = document.getElementById("end_date");
      var updatedDate = EndDate.value;
       var member_id = document.getElementById("member_id");
      var member_id = member_id.value;
      console.log(member_id);
        $.ajax({
          type : 'get',
          url : '{{URL::to('Reports/MemberReferal/Filter')}}',
          data : {'createdDate':currentVal,'updatedDate':updatedDate,'member_id':member_id},
          success:function(data){
           $('#referal_reports').empty();
           $('#referal_reports').html(data['member']);
         } 
       });
    }
  }
</script>
@endsection