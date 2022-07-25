<div class="add-button" >
	<a  class="btn btn-primary btn-md" href="{{route('add.Parliament')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add
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
			@foreach ($ParliamentConsituency as $i => $parliamentConsituency)
		<tr>
			<td>{{ $i+1 }}</td>
			
			<td>{{ $parliamentConsituency->Parliament_Constituency_Desc }}</td>
						
			<td><a href="{{ route('Edit.Parliament', ['ParliamentId' => $parliamentConsituency->Parliament_Id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
			</td>
			<td>
				<a onclick="DeleteParliament('{{$parliamentConsituency->Parliament_Id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
			</td>
		</tr>
		
		
		@endforeach
	
</tbody>
</table>