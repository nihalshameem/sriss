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
          <a href="/ReportsView" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -12px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
          <h3 class="title-head">Subscription Defaulter report</h3>
        </div>
        <div class="col-sm-2">
        </div>
        
      </div>
    </div>
  <div class="col-12">

   
   <div class="row">
     <div class="col-12">
       <div class="card">
         <!-- /.card-header -->
         <div class="card-body" id="onlinereport">
          
          @include('reportsview.reportsfilter.subscription_defaulter_filter')
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

		var x = document.getElementById("start_date");
    var currentVal = x.value;
    var EndDate = document.getElementById("end_date");
    var updatedDate = EndDate.value;
    $.ajax({
      type : 'get',
      url : '{{URL::to('ReportsView/SubscriptionDefaulter/Filter')}}',
      data : {'createdDate':currentVal,'updatedDate':updatedDate},
      success:function(data){
       $('#onlinereport').empty();
       $('#onlinereport').html(data['Subscriptions']);
     } 
   });
  }
  }
</script>

  @endsection