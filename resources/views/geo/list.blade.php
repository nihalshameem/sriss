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
						<h3 class="title-head">TNDRS Org Structure</h3>
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
										<a class="nav-link{{old('tab') == 'statedivision-tabs' ? ' active' : null}}" id="statedivision-tabs-tab" data-toggle="pill" href="#statedivision-tabs" role="tab" aria-controls="statedivision-tabs" aria-selected="true" style="color:#8f3319;font-weight:bold">State Division</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{old('tab') == 'custom-tabs-three-profile' ? ' active' : null}}" id="greater-zones-tabs" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false" style="color:#8f3319;font-weight:bold">Greater Zones</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{old('tab') == 'custom-tabs-three-messages' ? ' active' : null}}" id="zones-tabs" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false" style="color:#8f3319;font-weight:bold">Zones</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{old('tab') == 'custom-tabs-three-settings' ? ' active' : null}}" id="district-tabs" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false" style="color:#8f3319;font-weight:bold">District</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{old('tab') == 'custom-tabs-three-union' ? ' active' : null}}" id="Union-tabs" data-toggle="pill" href="#custom-tabs-three-union" role="tab" aria-controls="custom-tabs-three-union" aria-selected="false" style="color:#8f3319;font-weight:bold"  onclick="DistrictReset();">Union</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{old('tab') == 'custom-tabs-three-panchayat' ? ' active' : null}}" id="panchayats-tabs" data-toggle="pill" href="#custom-tabs-three-panchayat" role="tab" aria-controls="custom-tabs-three-panchayat" aria-selected="false" style="color:#8f3319;font-weight:bold">Panchayat</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{old('tab') == 'custom-tabs-three-village' ? ' active' : null}}" id="villages-tabs" data-toggle="pill" href="#custom-tabs-three-village" role="tab" aria-controls="custom-tabs-three-village" aria-selected="false" style="color:#8f3319;font-weight:bold">Village</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{old('tab') == 'custom-tabs-three-street' ? ' active' : null}}" id="streets-tabs" data-toggle="pill" href="#custom-tabs-three-street" role="tab" aria-controls="custom-tabs-three-street" aria-selected="false" style="color:#8f3319;font-weight:bold">Street</a>
									</li>
									
								</ul>
							</div>
							<div class="card-body">
								<div class="tab-content" id="custom-tabs-three-tabContent">

									<div class="tab-pane{{old('tab') == 'state-tabs-tab' ? ' active' : null}}" id="state-tabs-tab" role="tabpanel" aria-labelledby="state-tabs">
										@include('geo.list.state')
									</div>

									<div class="tab-pane{{old('tab') == 'statedivision-tabs' ? ' active' : null}}" id="statedivision-tabs" role="tabpanel" aria-labelledby="statedivision-tabs-tab">
										@include('geo.list.state_division')

									</div>
									<div class="tab-pane {{old('tab') == 'custom-tabs-three-profile' ? ' active' : null}}" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="greater-zones-tabs">

										@include('geo.list.greater_zone')

									</div>
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
									<div class="tab-pane{{old('tab') == 'custom-tabs-three-panchayat' ? ' active' : null}}" id="custom-tabs-three-panchayat" role="tabpanel" aria-labelledby="union-tabs">
										<div class="row">

											<div class="col-md-3">
												<select class="form-control" id="PanchayatZoneFilterId" onchange="getPanchayatDistricts(this.value)" required>
													<option value="">Select Zones</option>
													@if(isset($Zonesfilter))
													@foreach($Zonesfilter as $Zones) 
													<option value="{{$Zones->Zone_id}}" >{{ $Zones->Zone_desc}}</option>
													@endforeach
													@endif

												</select>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="PanchayatDistrictFilterId" onchange="getPanchayatUnion(this.value)" required>
													<option value="">Select District</option>

												</select>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="PanchayatUnionFilterId" onchange="getPanchayat(this.value)" required>
													<option value="">Select Union</option>

												</select>
											</div>
											<div class="col-md-3">
												<a  class="btn btn-primary btn-md" href="{{route('ShowPanchayat')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add</a>
											</div>

										</div>
										<br>
										<div id="PanchayatfilterBlade">
											@include('geo.list.panchayat')
										</div>
									</div>
									<!-- Village Tab -->
									<div class="tab-pane{{old('tab') == 'custom-tabs-three-village' ? ' active' : null}}" id="custom-tabs-three-village" role="tabpanel" aria-labelledby="union-tabs">
										<div class="row">

											<div class="col-md-3">
												<select class="form-control"  id="VillageZoneFilterId" onchange="getVillageDistricts(this.value)" required>
													<option value="">Select Zones</option>
													@if(isset($Zonesfilter))
													@foreach($Zonesfilter as $Zones) 
													<option value="{{$Zones->Zone_id}}" >{{ $Zones->Zone_desc}}</option>
													@endforeach
													@endif

												</select>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="VillageDistrictFilterId" onchange="getVillageUnions(this.value)" required>
													<option value="">Select District</option>

												</select>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="VillageUnionFilterId" onchange="getVillagePanchayat(this.value)" required>
													<option value="">Select Union</option>

												</select>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="VillagePanchayatFilterId" onchange="getVillage(this.value)" required>
													<option value="">Select Panchayat</option>

												</select>
											</div>
											
											


										</div>
										<br>
										<div class="row">
											<div class="col-md-9">
											</div>
											<div class="col-md-3">
												<a  class="btn btn-primary btn-md" href="{{route('ShowVillage')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add 
												</a>
											</div>
										</div><br>
										<div id="VillageFilterEmpty">
											@include('geo.list.village')
										</div>

									</div>

									<!-- Street Tab -->
									<div class="tab-pane{{old('tab') == 'custom-tabs-three-street' ? ' active' : null}}" id="custom-tabs-three-street" role="tabpanel" aria-labelledby="street-tabs">
										<div class="row">

											<div class="col-md-2">
												<select class="form-control" id="StreetZoneFilterId" onchange="getStreetDistricts(this.value)" required>
													<option value="">Select Zones</option>
													@if(isset($Zonesfilter))
													@foreach($Zonesfilter as $Zones) 
													<option value="{{$Zones->Zone_id}}" >{{ $Zones->Zone_desc}}</option>
													@endforeach
													@endif

												</select>
											</div>
											<div class="col-md-2">
												<select class="form-control" id="StreetDistrictFilterId" onchange="getStreetUnions(this.value)" required>
													<option value="">Select District</option>

												</select>

											</div>
											<div class="col-md-2">
												<select class="form-control" id="StreetUnionFilterId" onchange="getStreetPanchayat(this.value)" required>
													<option value="">Select Union</option>

												</select>
											</div>
											<div class="col-md-3">
												<select class="form-control" id="StreetPanchayatFilterId" onchange="getStreetVillage(this.value)" required>
													<option value="">Select Panchayat</option>

												</select>
											</div>
											


											<div class="col-md-2">
												<select class="form-control"  id="StreetVillageFilterId" onchange="getStreet(this.value)" required>
													<option value="">Select Village</option>

												</select>
											</div>
											
											
										</div>
										<div class="row">
											<div class="col-md-9">
											</div>
											<div class="col-md-3">
												<a  class="btn btn-primary btn-md" href="{{route('ShowStreet')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add 
												</a>
											</div>
										</div><br>
										<div id="StreetFilterBlade">										@include('geo.list.street')
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
	
	function DeleteGreaterZone(GreaterZoneId){
		if (confirm("Are your sure you want to delete greater zone")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('DeleteGreaterZone')}}',
				data : {'GreaterZoneId':GreaterZoneId},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {

		}
	}
</script>
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

<script type="text/javascript">
	
	function DeleteStateDivision (StateDivisionId){
		if (confirm("Are your sure you want to delete statedivision")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('DeleteStateDivision')}}',
				data : {'StateDivisionId':StateDivisionId},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {

		}
	}
</script>
<script type="text/javascript">
	
	function DeleteState (StateId){
		if (confirm("Are your sure you want to delete state")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('DeleteState')}}',
				data : {'StateId':StateId},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {

		}
	}
</script>
<script type="text/javascript">
	
	function DeletePanchayat (PanchayatId){
		if (confirm("Are your sure you want to delete Panchayat")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('DeletePanchayat')}}',
				data : {'PanchayatId':PanchayatId},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {

		}
	}
</script>
<script type="text/javascript">
	
	function DeleteVillage (VillageId){
		if (confirm("Are your sure you want to delete village")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('DeleteVillage')}}',
				data : {'VillageId':VillageId},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {

		}
	}
</script>
<script type="text/javascript">
	
	function DeleteStreet (StreetId){
		if (confirm("Are your sure you want to delete street")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('DeleteStreet')}}',
				data : {'StreetId':StreetId},
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
<!--- Panchayat Functions--->
<script >
	function getPanchayatDistricts(ZoneId){
		$('#PanchayatDistrictFilterId').empty();
		var id =  ZoneId;
		var subArray =  @json($Districtfilter);
		var filteredArray = subArray.filter(x => x.Zone_id == id);
		$("#PanchayatDistrictFilterId").append( '<option value="">Select District</option>' );
		var options = filteredArray.forEach( function(item, index){
			$('#PanchayatDistrictFilterId').append('<option value="'+item.District_id+'">'+item.District_desc+'</option>');
		});
	}
</script>
<script >
	function getPanchayatUnion(DistrictId){
		$('#PanchayatUnionFilterId').empty();
		var id =  DistrictId;
		var subArray =  @json($Unionsfilter);
		var filteredArray = subArray.filter(x => x.District_id == id);
		$("#PanchayatUnionFilterId").append( '<option value="">Select Union</option>' );
		var options = filteredArray.forEach( function(item, index){
			$('#PanchayatUnionFilterId').append('<option value="'+item.Union_id+'">'+item.Union_desc+'</option>');
		});
	}
</script>
<script>
	function getPanchayat(UnionId)
	{
		$.ajax({
			type : 'get',
			url : '{{URL::to('PanchayatFilter')}}',
			data : {'UnionId':UnionId},
			success:function(data){
				$('#PanchayatfilterBlade').empty();
				$('#PanchayatfilterBlade').html(data['Panchayat']);

			} 
		});
	}
</script>
<!--- Village Functions--->
<script >
	function getVillageDistricts(ZoneId){
		$('#VillageDistrictFilterId').empty();
		var id =  ZoneId;
		var subArray =  @json($Districtfilter);
		var filteredArray = subArray.filter(x => x.Zone_id == id);
		$("#VillageDistrictFilterId").append( '<option value="">Select District</option>' );
		var options = filteredArray.forEach( function(item, index){
			$('#VillageDistrictFilterId').append('<option value="'+item.District_id+'">'+item.District_desc+'</option>');
		});
	}
</script>
<script >
	function getVillageUnions(DistrictId){
		$('#VillageUnionFilterId').empty();
		var id =  DistrictId;
		var subArray =  @json($Unionsfilter);
		var filteredArray = subArray.filter(x => x.District_id == id);
		$("#VillageUnionFilterId").append( '<option value="">Select Union</option>' );
		var options = filteredArray.forEach( function(item, index){
			$('#VillageUnionFilterId').append('<option value="'+item.Union_id+'">'+item.Union_desc+'</option>');
		});
	}
</script>
<script >
	function getVillagePanchayat(UnionId){
		$('#VillagePanchayatFilterId').empty();
		var id =  UnionId;
		var subArray =  @json($Panchayatfilter);
		var filteredArray = subArray.filter(x => x.Union_id == id);
		$("#VillagePanchayatFilterId").append( '<option value="">Select Panchayat</option>' );
		var options = filteredArray.forEach( function(item, index){
			$('#VillagePanchayatFilterId').append('<option value="'+item.Panchayat_id+'">'+item.Panchayat_desc+'</option>');
		});
	}
</script>
<script>
	function getVillage(PanchayatId)
	{

		$.ajax({
			type : 'get',
			url : '{{URL::to('VillageFilter')}}',
			data : {'PanchayatId':PanchayatId},
			success:function(data){
				$('#VillageFilterEmpty').empty();
				$('#VillageFilterEmpty').html(data['Village']);
			}
		});
	}
</script>
<!--- Street Functions--->
<script >
	function getStreetDistricts(ZoneId){
		$('#StreetDistrictFilterId').empty();
		var id =  ZoneId;
		var subArray =  @json($Districtfilter);
		var filteredArray = subArray.filter(x => x.Zone_id == id);
		$("#StreetDistrictFilterId").append( '<option value="">Select District</option>' );
		var options = filteredArray.forEach( function(item, index){
			$('#StreetDistrictFilterId').append('<option value="'+item.District_id+'">'+item.District_desc+'</option>');
		});
	}
</script>
<script >
	function getStreetUnions(DistrictId){
		$('#StreetUnionFilterId').empty();
		var id =  DistrictId;
		var subArray =  @json($Unionsfilter);
		var filteredArray = subArray.filter(x => x.District_id == id);
		$("#StreetUnionFilterId").append( '<option value="">Select Union</option>' );
		var options = filteredArray.forEach( function(item, index){
			$('#StreetUnionFilterId').append('<option value="'+item.Union_id+'">'+item.Union_desc+'</option>');
		});
	}
</script>
<script >
	function getStreetPanchayat(UnionId){
		$('#StreetPanchayatFilterId').empty();
		var id =  UnionId;
		var subArray =  @json($Panchayatfilter);
		var filteredArray = subArray.filter(x => x.Union_id == id);
		$("#StreetPanchayatFilterId").append( '<option value="">Select Panchayat</option>' );
		var options = filteredArray.forEach( function(item, index){
			$('#StreetPanchayatFilterId').append('<option value="'+item.Panchayat_id+'">'+item.Panchayat_desc+'</option>');
		});
	}
</script>
<script >
	function getStreetVillage(PanchayatId){
		$('#StreetVillageFilterId').empty();
		var id =  PanchayatId;
		var subArray =  @json($Villagefilter);
		var filteredArray = subArray.filter(x => x.Panchayat_id == id);
		$("#StreetVillageFilterId").append( '<option value="">Select Village</option>' );
		var options = filteredArray.forEach( function(item, index){
			$('#StreetVillageFilterId').append('<option value="'+item.Village_id+'">'+item.Village_desc+'</option>');
		});
	}
</script>
<script>
	function getStreet(VillageId)
	{

		$.ajax({
			type : 'get',
			url : '{{URL::to('StreetFilter')}}',
			data : {'VillageId':VillageId},
			success:function(data){
				$('#StreetFilterBlade').empty();
				$('#StreetFilterBlade').html(data['Street']);

			} 
		});
	}
</script>

@endsection