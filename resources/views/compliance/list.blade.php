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
						<h3 class="title-head">Compliance</h3>
					</div>
					<div class="col-sm-2">
						
					</div>
					
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card" >
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table" >
								<thead>
									<tr>
										<th>Sl No</th>
										<th>Text</th>
										<th>Version</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($Compliances as $i => $Compliance)
									<tr>
										<td>{{ $i+1 }}</td>
										<td>{{ $Compliance->Compliance_desc }}</td>
										<td>{{ $Compliance->Version_no }}</td>                  
										<td>
											<a href="{{ route('edit.compliance', ['id' => $Compliance->Compliance_id]) }}"><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
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