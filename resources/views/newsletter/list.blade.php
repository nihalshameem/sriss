@extends('layouts.app')

@section('content')
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content" style="padding-top:25px">
		<div class="container-fluid">

			<div class="col-12">

				<div class="row mb-2">
					<div class="col-sm-1">
						<a href="/home" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
					</div>
					<div class="col-sm-4">
					</div>
					<div class="col-sm-3">
						<h3 class="title-head">Newsletter</h3>
					</div>
					<div class="col-md-2">
						<a  class="btn btn-primary btn-md" href="{{ route('show.newsletter') }}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add</a>
					</div>
					<div class="col-md-2">
						<a  class="btn btn-primary btn-md"  onclick="DeleteAll()"  style="float:right"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete All</a>
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
									<div class="col-md-3">
									</div>
									
								</div>
								
							</div>
							
							<table id="example1" class="table">
								<thead>
									<tr>
										<th>Sl No</th>
										<th>Description</th>
										<th>Date</th>
										<th>NewsLetter</th>
										<th colspan="2">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($NewsLetter as $i => $NewsLetter)
									<tr>
										<td>{{ $i+1 }}</td>
										<td>{{ $NewsLetter->Newsletter_desc }}</td>
										<td>{{ $NewsLetter->Newsletter_date }}</td> 
										<td><a href="{{ $NewsLetter->Newsletter }}" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>   
										<td>
											<a href="{{ route('edit.newsletter', ['NewsLetterId' => $NewsLetter->Newsletter_id]) }}"><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
										</td> 
										<td>
											<a  onclick="Delete('{{$NewsLetter->Newsletter_id}}')"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
										</td>              
									</tr>
									@endforeach

								</tbody>
							</table>
						</div>

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
<script>
	function Delete	(value) {
		console.log(value);
		if (confirm("Are your sure you want to delete the record")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('NewsLetterDelete')}}',
				data : {'NewsLetterId':value},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {
			
		}
	}
</script>
<script>
	function DeleteAll() {
		if (confirm("Are your sure you want to delete all the record")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('NewsLetterMassDelete')}}',
				data : {'NewsLetterId':''},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {
			
		}
	}
</script>
@endsection