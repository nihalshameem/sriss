<div class="add-button" >
	<a  class="btn btn-primary btn-md" href="{{route('add.Assembly')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add
	</a>
</div>
<br><br>

<table class="table table-borderless">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Description</th>
			<th>Edit</th>
			<th>Delete</th>
			
		</tr>
	</thead>
	<tbody>
			@foreach ($AssemblyConsituency as $i => $assemblyConsituency)
		<tr>
			<td>{{ $i+1 }}</td>
			
			<td>{{ $assemblyConsituency->Assembly_Constituency_Desc }}</td>
						
			<td><a href="{{ route('Edit.Assembly', ['AssemblyId' => $assemblyConsituency->Assembly_Id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
			</td>
			<td>
				<?php 
					$ward = App\Models\Ward::where('Assembly_Const_Id',$assemblyConsituency->Assembly_Id)->first();
				?>
				@if($ward)
				@else
				<a onclick="DeleteAssembly('{{$assemblyConsituency->Assembly_Id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
				@endif
			</td>
		</tr>
		
		
		@endforeach
	
</tbody>
</table>