<div class="add-button" >
	<a  class="btn btn-primary btn-md" href="{{route('add.Ward')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add
	</a>
</div>
<br><br>

<table class="table table-borderless">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Ward Name</th>
			<th>Edit</th>
			<th>Delete</th>
			
		</tr>
	</thead>
	<tbody>
			@foreach ($Ward as $i => $Ward)
		<tr>
			<td>{{ $i+1 }}</td>
			
			<td>{{ $Ward->Ward_Name }}</td>
						
			<td><a href="{{ route('Edit.Ward', ['WardId' => $Ward->Ward_Id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
			</td>
			<td>
				<a onclick="DeleteWard('{{$Ward->Ward_Id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
			</td>
		</tr>
		
		
		@endforeach
	
</tbody>
</table>