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
                <h3 class="title-head">Total Members&nbsp;</h3>
            </div>
            <div class="col-sm-3">
                
            </div>
            
        </div>
    </div>
    <div class="col-12">
        <div class="row mb-2">
          <div class="col-sm-2">
          </div>
          <div class="col-sm-2">
            <label>Start Date</label>
            <input type="date" class="form-control" id="start_date" >
        </div>
        <div class="col-sm-2">
            <label>End Date</label>
            <input type="date" class="form-control" id="end_date" >
        </div>
        <div class="col-sm-2">
            <label>District</label>
            <select class="form-control" id="District" required>
             <option value="">Select District</option>
             @if(isset($District))
             @foreach($District as $District) 
             <option value="{{$District->District_id}}"  >{{ $District->District_desc}}</option>
             @endforeach
             @endif
         </select>
     </div>
     <div class="col-sm-2">
        <label>Pincode</label>
        <input type="number" class="form-control" id="pincode" >
    </div>
    <div class="col-sm-2" style="padding-top:30px">
        <button type="button" class="btn btn-primary" onclick="MemberFilter()">Search</button>
    </div>
    
</div>
</div>
<div class="col-12">
    <div class="row mb-2">
      <div class="col-sm-3">
      </div>
      <div class="col-sm-3">
        
      </div>
      <div class="col-sm-3">
        
      </div>
      <div class="col-sm-3" style="padding-top:9px;float:right">
          
      </div>
      
  </div>
</div>

<div class="card">
    <!-- /.card-header -->
    <div class="card-body" id="member_report">
      @include('reports.reportsfilter.member_list_filter')
      
  </div>
</div>
</section>
</div>
</section>
</div>
<script>
  function MemberFilter()
  {
    var x = document.getElementById("start_date");
    var currentVal = x.value;
    var end_date = document.getElementById("end_date");
    var updatedDate = end_date.value;
    var val = document.getElementById("District");
    var District = val.value;
    var pval = document.getElementById("pincode");
    var Pincode = pval.value;
    console.log(Pincode);
    $.ajax({
        type : 'get',
        url : '{{URL::to('ReportsView/MemberList/Filter')}}',
        data : {'createdDate':currentVal,'updatedDate':updatedDate,'District':District,'Pincode':Pincode},
        success:function(data){
          console.log(data);
            $('#member_report').empty();
            $('#member_report').html(data['Member']);
        } 
    });
}
</script>
@endsection