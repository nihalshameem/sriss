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
						<h3 class="title-head">Political Structure</h3>
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
										<a class="nav-link{{old('tab') == 'state-tabs-tab' ? ' active' : null}}" id="state-tab" data-toggle="pill" href="#state-tabs-tab" role="tab" aria-controls="state-tabs" aria-selected="true" style="color:#3a3a3a;font-weight:bold" >Parliament consituency</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{old('tab') == 'custom-tabs-three-messages' ? ' active' : null}}" id="zones-tabs" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false" style="color:#3a3a3a;font-weight:bold">Assembly consituency</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{old('tab') == 'custom-tabs-three-settings' ? ' active' : null}}" id="district-tabs" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false" style="color:#3a3a3a;font-weight:bold">Ward</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{old('tab') == 'custom-tabs-three-union' ? ' active' : null}}" id="Union-tabs" data-toggle="pill" href="#custom-tabs-three-union" role="tab" aria-controls="custom-tabs-three-union" aria-selected="false" style="color:#3a3a3a;font-weight:bold"  >Booth Agent</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{old('tab') == 'custom-tabs-three-booth-agent' ? ' active' : null}}" id="booth-agent-tabs" data-toggle="pill" href="#custom-tabs-three-booth-agent" role="tab" aria-controls="custom-tabs-three-booth-agent" aria-selected="false" style="color:#3a3a3a;font-weight:bold">Booth </a>
									</li>
								</ul>
							</div>
							<div class="card-body">
								<div class="tab-content" id="custom-tabs-three-tabContent">

									<div class="tab-pane{{old('tab') == 'state-tabs-tab' ? ' active' : null}}" id="state-tabs-tab" role="tabpanel" aria-labelledby="state-tabs">
										@include('PoliticalCategory.list.parliamentConsituency')
									</div>

									<div class="tab-pane{{old('tab') == 'custom-tabs-three-messages' ? ' active' : null}}" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="zones-tabs">
										@include('PoliticalCategory.list.assemblyConstituency')

									</div>
									<div class="tab-pane{{old('tab') == 'custom-tabs-three-settings' ? ' active' : null}}" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="district-tabs" >
										@include('PoliticalCategory.list.ward')

									</div>
									<div class="tab-pane{{old('tab') == 'custom-tabs-three-union' ? ' active' : null}}" id="custom-tabs-three-union" role="tabpanel" aria-labelledby="union-tabs">
									@include('PoliticalCategory.list.boothagent')

									</div>
									<div class="tab-pane{{old('tab') == 'custom-tabs-three-booth-agent' ? ' active' : null}}" id="custom-tabs-three-booth-agent" role="tabpanel" aria-labelledby="union-tabs">
										
										@include('PoliticalCategory.list.booth')
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
	
	function DeleteParliament (Parliament_Id){
		if (confirm("Are your sure you want to delete Parliament?")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('political/category/Parliament/Delete')}}',
				data : {'Parliament_Id':Parliament_Id},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {

		}
	}
</script>

<script type="text/javascript">
	
	function DeleteAssembly(Assembly_Id){
		console.log(Assembly_Id);
		if (confirm("Are your sure you want to delete Assembly?")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('political/category/Assembly/Delete')}}',
				data : {'Assembly_Id':Assembly_Id},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {

		}
	}
</script>

<script type="text/javascript">
	
	function DeleteWard(Ward_Id){
		if (confirm("Are your sure you want to delete Ward?")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('political/category/Ward/Delete')}}',
				data : {'Ward_Id':Ward_Id},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {

		}
	}
</script>

<script type="text/javascript">
	
	function DeleteBoothAgent(BoothAgentId){
		if (confirm("Are your sure you want to delete Booth Agent?")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('political/category/BoothAgent/Delete')}}',
				data : {'Booth_Agent_Id':BoothAgentId},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {

		}
	}
</script>
<script type="text/javascript">
	
	function DeleteBooth(BoothId){
		if (confirm("Are your sure you want to delete Booth?")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('political/category/Booth/Delete')}}',
				data : {'Booth_Id':BoothId},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {

		}
	}
</script>


@endsection