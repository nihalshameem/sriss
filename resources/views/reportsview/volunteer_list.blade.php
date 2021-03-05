@extends('layouts.app')

@section('content')
<div >
 <div class="content-wrapper">

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
          <h3 class="title-head">Karyakarthas&nbsp;</h3>
        </div>
        <div class="col-sm-3">
          
        </div>
        
      </div>
    </div>
    <div class="col-12">
      <div class="row mb-2">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
          <label>Start Date</label>
          <input type="date" class="form-control" id="start_date" >
        </div>
        <div class="col-sm-3">
          <label>End Date</label>
          <input type="date" class="form-control" id="end_date" >
        </div>
        <div class="col-sm-2" style="padding-top:30px">
         <button type="button" class="btn btn-primary" onclick="VolunteerFilter()">Search</button>
         
       </div>
        <div class="col-sm-1">
          
        </div>
        
      </div>
    </div>
    
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body" id="volunteersearch">
        @include('reports.reportsfilter.volunteer_list_filter')
        
      </div>
    </div>
  </section>
</div>
</section>
</div>
<script>
  function VolunteerFilter()
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
      url : '{{URL::to('ReportsView/volunteer/filter')}}',
      data : {'createdDate':currentVal,'updatedDate':updatedDate},
      success:function(data){
        $('#volunteersearch').empty();
        $('#volunteersearch').html(data['Volunteer']);
      } 
    });
  }
  }
</script>
@endsection