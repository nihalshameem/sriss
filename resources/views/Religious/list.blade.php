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
            <div class="col-sm-4">
                <h3 class="title-head">Religious</h3>
            </div>
            <div class="col-sm-3">
            </div>
            
        </div>
    </div>
    
    <div class="row">
     <div class="col-12">
       <div class="card"  style="margin-bottom: 0;">
        
        <div class="card-body" style="text-align: left; padding-top: 0;">
<div class="add-button" >
	<a  class="btn btn-primary btn-md" href="{{route('add.Religious')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add
	</a>
</div>
<br><br>

<table class="table table-borderless">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Name</th>
			<th>Edit</th>
			<th>Delete</th>
			
		</tr>
	</thead>
	<tbody>
			@foreach ($ReligiousLeader as $i => $ReligiousLeader)
		<tr>
			<td>{{ $i+1 }}</td>
			
			<td>{{ $ReligiousLeader->Religious_name }}</td>
						
			<td><a href="{{ route('Edit.Religious', ['ReligiousId' => $ReligiousLeader->Religious_Id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
			</td>
			<td>
				<a onclick="DeleteReligious('{{$ReligiousLeader->Religious_Id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
			</td>
		</tr>
		
		
		@endforeach
	
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
<script type="text/javascript">
	
	function DeleteReligious(Religious_Id){
		if (confirm("Are your sure you want to delete Religious?")) {
			$.ajax({
				type : 'get',
				url : '{{URL::to('religious/Delete')}}',
				data : {'Religious_Id':Religious_Id},
				success:function(data){
					window.location.reload();
				} 
			});

		} else {

		}
	}
</script>
@endsection