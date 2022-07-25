@extends('layouts.app')

@section('content')
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
						<h3 class="title-head">Contributions</h3>
					</div>
					<div class="col-sm-4">
						<a class="btn btn-primary btn-md" href="{{ route('ShowContributions') }}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add Contributions</a>          	
					</div>
					
				</div>
			</div>
			<div class="col-12">

				
				<div class="row">
					<div class="col-12">
						<div class="card">
							<!-- /.card-header -->
							<div class="card-body">
								
								
								<table id="example1" class="table table-borderless">
									<thead>
										<tr>
											<th>Sl No</th>
											<th>Member Id</th>
											<th>Name</th>
											<th>Mobile Number</th>
											<th>Payment Status</th>
											<th>Due Amount</th>
											<th>Edit</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($OfflineContribution as $i => $OfflineContribution)
										<tr>
											<td>{{ $i+1 }}</td>
											<td>{{ $OfflineContribution->Member_id }}</td>
											<td>{{ $OfflineContribution->First_Name }} {{ $OfflineContribution->last_Name }}</td>  
											<td>{{ $OfflineContribution->Mobile_No }}</td>   
											<td>{{ $OfflineContribution->Offline_Contribution_payment_status }}</td>
											<td>{{ $OfflineContribution->Due_amount }}</td>                  
											<td>
												<a href="{{ route('EditContributions', ['contributionId' => $OfflineContribution->Offline_Contribution_id]) }}"><span class="badge bg-danger"><i class="fas fa-edit"></i>&nbsp;Edit</span></a>
											</td>
										</tr>
										@endforeach

									</tbody>
								</table>
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
	@endsection