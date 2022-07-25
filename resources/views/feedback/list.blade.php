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
										<th>Date</th>	
										<th>Feedback</th>								
										<th>Member Id</th>
										<th>Name</th>
										<th>Phone No</th>
										
									</tr>
								</thead>
								<tbody>
									@foreach ($feedbacks as $i => $feedback)
									<tr>
										<td>{{ $feedback->created_at->toDateString() }}</td>
										<td>{{ $feedback->Feedback_desc }}</td> 
										<td>{{ $feedback->Member_id }}</td>
										<?php
										$user = App\Models\User::where('Member_Id',$feedback->Member_id )->first();

										?>
										@if($user)
										<td>{{ $user->name }}</td> 
										@else
										<td></td>
										@endif
										<?php
										$member = App\Models\Member::where('Member_Id',$feedback->Member_id )->first();

										?>
										<td>{{$member->Mobile_No}}</td>

										
										
										  
										
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