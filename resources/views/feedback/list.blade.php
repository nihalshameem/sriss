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
						<h3 class="title-head">Feedback</h3>
					</div>
					<div class="col-sm-4">
						
					</div>
					
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					
					<div class="card">
						<!-- /.card-header -->
						<div class="card-body" style="padding-top: 0;">
							
							<table id="example1" class="table">
								<thead>
									<tr>
										<th>Send Email</th>
										<th>Date</th>
										<th>Member Id</th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone No</th>
										<th>Pincode</th>
										<th>Address</th>
										<th>Feedback</th>
										
									</tr>
								</thead>
								<tbody>
									@foreach ($feedbacks as $i => $feedback)
									<tr>
										<td>
											<a><span class="badge bg-danger"><i class="fas fa-paper-plane"></i>&nbsp;Send Mail</span></a>
										</td>
										<td>{{ $feedback->created_at->toDateString() }}</td>
										<td>{{ $feedback->Member_id }}</td>
										
										<?php
										$user = App\Models\User::where('Member_Id',$feedback->Member_id )->first();

										?>
										@if($user)
										<td>{{ $user->name }}</td> 
										<td class="col-sm-2">{{ $user->email }}</td> 
										@else
										<td></td>
										<td></td>
										@endif
										<?php
										$member = App\Models\Member::where('Member_Id',$feedback->Member_id )->first();

										?>
										<td>{{$member->Mobile_No}}</td>
										<td>{{$member->Pincode}}</td>
										<td>{{$member->Address1}}</td>

										<td>{{ $feedback->Feedback_desc }}</td> 
										
										  
										
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