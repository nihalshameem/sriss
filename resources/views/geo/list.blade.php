@extends('layouts.app')

@section('content')
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content" style="padding-top:25px">
		<div class="container-fluid">
			<div class="col-12">

				<div class="row mb-2">
					<div class="col-sm-2">
						<a href="/home" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
					</div>
					<div class="col-sm-3">
					</div>
					<div class="col-sm-5">
						<h3 class="title-head">Samithi Org Structure</h3>
					</div>
					<div class="col-sm-2">
					</div>

				</div>
			</div>
			<!-- ./row -->
			<div class="card card-primary ">
				<div class="row">
					
					<div class="col-12 col-sm-12 col-lg-12">
						<div class="card card-primary">
							<div class="card-header p-0 border-bottom-0">
								<ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist" style="border-top:1px solid #ffffb7">
									<li class="nav-item">
										<a class="nav-link{{old('tab') == 'state-tabs-tab' ? ' active' : null}}" id="state-tab" data-toggle="pill" href="#state-tabs-tab" role="tab" aria-controls="state-tabs" aria-selected="true" style="color:#8f3319;font-weight:bold" >State</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{old('tab') == 'custom-tabs-three-messages' ? ' active' : null}}" id="zones-tabs" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false" style="color:#8f3319;font-weight:bold">Zones</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{old('tab') == 'custom-tabs-three-settings' ? ' active' : null}}" id="district-tabs" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false" style="color:#8f3319;font-weight:bold">District</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{old('tab') == 'custom-tabs-three-union' ? ' active' : null}}" id="Union-tabs" data-toggle="pill" href="#custom-tabs-three-union" role="tab" aria-controls="custom-tabs-three-union" aria-selected="false" style="color:#8f3319;font-weight:bold"  onclick="DistrictReset();">Area</a>
									</li>
								</ul>
							</div>
							<div class="card-body">
								<div class="tab-content" id="custom-tabs-three-tabContent">

									<div class="tab-pane{{old('tab') == 'state-tabs-tab' ? ' active' : null}}" id="state-tabs-tab" role="tabpanel" aria-labelledby="state-tabs">
										@include('geo.list.state')
									</div>

									{{-- <div class="tab-pane{{old('tab') == 'statedivision-tabs' ? ' active' : null}}" id="statedivision-tabs" role="tabpanel" aria-labelledby="statedivision-tabs-tab">
										@include('geo.list.state_division')

									</div>
									<div class="tab-pane {{old('tab') == 'custom-tabs-three-profile' ? ' active' : null}}" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="greater-zones-tabs">

										@include('geo.list.greater_zone')

									</div> --}}
									<div class="tab-pane{{old('tab') == 'custom-tabs-three-messages' ? ' active' : null}}" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="zones-tabs">
										@include('geo.list.zone')

									</div>
									<div class="tab-pane{{old('tab') == 'custom-tabs-three-settings' ? ' active' : null}}" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="district-tabs" >

										@include('geo.list.district')

									</div>
									<div class="tab-pane{{old('tab') == 'custom-tabs-three-union' ? ' active' : null}}" id="custom-tabs-three-union" role="tabpanel" aria-labelledby="union-tabs">
										<div class="row">
											<div class="col-md-3">
											</div>
											<div class="col-md-3">
												<select class="form-control" id="UnionZoneFilterId" onchange="getUnionZones(this.value)" required>
													<option value="">Select Zones</option>
													@if(isset($Zonesfilter))
													@foreach($Zonesfilter as $Zones) 
													<option value="{{$Zones->Zone_id}}" >{{ $Zones->Zone_desc}}</option>
													@endforeach
													@endif

												</select>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="UnionDistrictFilterId" onchange="getDistrict(this.value)" required>
													<option value="">Select District</option>

												</select>
											</div>
											<div class="col-md-3">
												<a  class="btn btn-primary btn-md" href="{{route('ShowUnion')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add</a>
											</div>

										</div><br>
										<div id="UnionFiltersBlade">
											@include('geo.list.union')
										</div>

									</div>
								</div>

							</div>
						</div>
						<!-- /.card -->
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</div>
</div>
</div>
</section>
</div>


<script type="text/javascript">
	
	function DeleteZone(zoneId){
		if (confirm("Are your sure you want to delete zone")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('DeleteZone')}}',
				data : {'zoneId':zoneId},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {

		}
	}
</script>

<script type="text/javascript">
	
	function DeleteDistrict(districtId){
		if (confirm("Are your sure you want to delete district")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('DeleteDistrict')}}',
				data : {'Districtid':districtId},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {

		}
	}
</script>

<script type="text/javascript">
	
	function DeleteUnion(UnionId){
		if (confirm("Are your sure you want to delete union")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('DeleteUnion')}}',
				data : {'Union_id':UnionId},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {

		}
	}
</script>



<script>
	function getZonesFilter(ZoneId)
	{
		$.ajax({
			type : 'get',
			url : '{{URL::to('ZoneFilter')}}',
			data : {'ZoneId':ZoneId},
			success:function(data){
				$('#custom-tabs-three-settings').empty();
				$('#custom-tabs-three-settings').html(data['District']);
				$('#ZoneFilterId').val(ZoneId);
			} 
		});
	}
</script>

<script >
	function getUnionZones(UnionId){
		$('#UnionDistrictFilterId').empty();
		var id =  UnionId;
		var subArray =  @json($Districtfilter);
		var filteredArray = subArray.filter(x => x.Zone_id == id);
		$("#UnionDistrictFilterId").append( '<option value="">Select District</option>' );
		var options = filteredArray.forEach( function(item, index){
			$('#UnionDistrictFilterId').append('<option value="'+item.District_id+'">'+item.District_desc+'</option>');
		});
	}
</script>
<script>
	function getDistrict(DistrictId)
	{

		$.ajax({
			type : 'get',
			url : '{{URL::to('UnionFilter')}}',
			data : {'DistrictId':DistrictId},
			success:function(data){
				$('#UnionFiltersBlade').empty();
				$('#UnionFiltersBlade').html(data['union']);                 	
			}

		});
	}
</script>


@endsection