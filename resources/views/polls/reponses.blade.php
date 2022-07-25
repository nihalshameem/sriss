@extends('layouts.app')

@section('content')
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content" style="padding-top:25px">
		<div class="container-fluid">
			<div class="col-12">

				<div class="row mb-2">
					<div class="col-sm-2">
						<a href="/Polls" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -12px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
					</div>
					<div class="col-sm-3">
					</div>
					<div class="col-sm-5">
						<h3 class="title-head">Polls Result</h3>
					</div>
					<div class="col-sm-3">
					</div>
					
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<!-- /.card-header -->
						
						<div class="card-body">
							<div class="add-button" >
								<div class="row">
									<div class="col-md-4">
										
									</div>
									<div class="col-md-4">
									</div>
									<div class="col-md-2">
										
									</div>
									<div class="col-md-2">
										
									</div>
								</div>
								
							</div>
							
							<div class="row">
								<div class="col-md-2">
								</div>
								<table id="example1" class="table col-md-8">
									
									<tbody>
										<tr>
											<td width="160px"><label>Question</label></td>
											<td colspan="3">{{$PollsQuestions->Polls_Questions}}</td>
										</tr>
										@foreach ($PollsResponses as $i => $pollsResponses)
										<tr>
											<td>Answer</td>
											

											<?php
											$pollsanswers = App\Models\PollsAnswers::where('Polls_Answers_id',$pollsResponses->Answer_id)->select('Polls_Answers_id','Polls_Answers_Options')->distinct()->get();
											?>
											@foreach ($pollsanswers as $i => $pollsanswers)
											<td>{{ $pollsanswers->Polls_Answers_Options }}</td>
											@endforeach
											<?php 
											$pollsanswersIn = App\Models\PollsAnswers::where('Polls_Answers_id',$pollsResponses->Answer_id)->pluck('Polls_Answers_id');

											$PollsanswersCount = App\Models\PollsResult::whereIn('Answer_id',$pollsanswersIn)->count();

											?>
											<td>{{ $PollsanswersCount }}</td>
											
											<td>{{ number_format((($PollsanswersCount/$TotalResponses) * 100), 2) }}%</td>

										</tr>
										@endforeach
										<tr>
											<td><label>Total Responses</label></td>
											<td></td>
											<td colspan="3">{{$TotalResponses}}</td>
										</tr>

									</tbody>
								</table>
							</div>
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