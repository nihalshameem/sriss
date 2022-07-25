@extends('layouts.app')

@section('content')
<div >
 <div class="content-wrapper">

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
          <h3 class="title-head">Volunteer&nbsp;</h3>
        </div>
        <div class="col-sm-3">
          
        </div>
        
      </div>
    </div>
  
			<div class="card card-primary ">
				<div class="row">
					<div class="col-1 col-sm-1 col-lg-1">
					</div>
					<div class="col-10 col-sm-10 col-lg-10">
						<div class="card card-primary">
							<div class="card-header p-0 border-bottom-0">
								<ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist" style="border-top:1px solid #ffffb7">
									<li class="nav-item">
										<a class="nav-link{{old('tab') == 'state-tabs-tab' ? ' active' : null}}" id="state-tab" data-toggle="pill" href="#state-tabs-tab" role="tab" aria-controls="state-tabs" aria-selected="true" style="color:#8f3319;font-weight:bold" >Profile</a>
									</li>
									<li class="nav-item">
										<a class="nav-link{{old('tab') == 'statedivision-tabs' ? ' active' : null}}" id="statedivision-tabs-tab" data-toggle="pill" href="#statedivision-tabs" role="tab" aria-controls="statedivision-tabs" aria-selected="true" style="color:#8f3319;font-weight:bold">Offline Contribution</a>
									</li>
								
									
								</ul>
							</div>
							<div class="card-body">
								<div class="tab-content" id="custom-tabs-three-tabContent">

									<div class="tab-pane{{old('tab') == 'state-tabs-tab' ? ' active' : null}}" id="state-tabs-tab" role="tabpanel" aria-labelledby="state-tabs">
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
                            <input type="date" class="form-control" id="end_date">
                            
                        </div>
                        <div class="col-sm-2" style="padding-top:30px">
                         <button type="button" class="btn btn-primary" onclick="Filter()">Search</button>
                         
                       </div>
                        
                        <div class="col-sm-1">
                          <a onclick="exportTableToExcel('Profile_karyakarthas_reports','Profile karyakarthas reports')" style="float:right;cursor: pointer" style="float:right"><i class="fa fa-download" aria-hidden="true" style="font-size:30px;color:#8f3319"></i></a>
                      </div>
                  </div>
                </div>
                <div id="Profile_karyakarthas_reports">
									    @include('reports.reportsfilter.karyakarthas_profile_filter')
                  </div>
									</div>

									<div class="tab-pane{{old('tab') == 'statedivision-tabs' ? ' active' : null}}" id="statedivision-tabs" role="tabpanel" aria-labelledby="statedivision-tabs-tab">
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
                            <input type="date" class="form-control" id="end_date">
                            
                        </div>
                        <div class="col-sm-2" style="padding-top:30px">
                         <button type="button" class="btn btn-primary" onclick="ContributionFilter()">Search</button>
                         
                       </div>
                        
                        <div class="col-sm-1">
                          <a onclick="exportTableToExcel('contribution_karyakarthas_reports','Offline Contribution karyakarthas reports')" style="float:right;cursor: pointer" style="float:right"><i class="fa fa-download" aria-hidden="true" style="font-size:30px;color:#8f3319"></i></a>
                      </div>
                  </div>
                </div>
                    <div id="contribution_karyakarthas_reports_filter">
                      @include('reports.reportsfilter.karyakarthas_offline_contribution_filter')
                  </div>
									   
									</div>
									

									</div>
								</div>

							</div>
						</div>
						<div class="col-1 col-sm-1 col-lg-1">
          </div>
						<!-- /.card -->
					</div>
				</div>
			</div>
  </section>
</div>
</section>
</div>
<script>
  function Filter()
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
      url : '{{URL::to('Reports/KaryakarthaProfile/Filter')}}',
      data : {'createdDate':currentVal,'updatedDate':updatedDate},
      success:function(data){
       $('#Profile_karyakarthas_reports').empty();
       $('#Profile_karyakarthas_reports').html(data['profileKaryakarthas']);
     } 
   });
  }
  }
</script>
<script>
  function ContributionFilter()
  {
    var startDate = document.getElementById("con_start_date").value;
    var endDate = document.getElementById("con_end_date").value;
     if ((Date.parse(endDate) <= Date.parse(startDate))) 
     {
      alert("End date should be greater than Start date");
      document.getElementById("con_end_date").value="";
      document.getElementById("con_start_date").value="";
    }
    else
    {

    var x = document.getElementById("con_start_date");
    var currentVal = x.value;
    var EndDate = document.getElementById("con_end_date");
    var updatedDate = EndDate.value;
    $.ajax({
      type : 'get',
      url : '{{URL::to('Reports/KaryakarthaContribution/Filter')}}',
      data : {'createdDate':currentVal,'updatedDate':updatedDate},
      success:function(data){
       $('#contribution_karyakarthas_reports_filter').empty();
       $('#contribution_karyakarthas_reports_filter').html(data['contributionKaryakarthas']);
     } 
   });
  }
  }
</script>
@endsection