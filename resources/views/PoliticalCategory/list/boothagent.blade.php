<div class="add-button" >
	<a  class="btn btn-primary btn-md" href="{{route('add.BoothAgent')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add
	</a>
</div>
<br><br>

<table class="table table-borderless">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Description</th>
			<th>Name</th>
			<th>Edit</th>
			<th>Delete</th>
			
		</tr>
	</thead>
	<tbody>
			@foreach ($BoothAgent as $i => $BoothAgent)
		<tr>
			<td>{{ $i+1 }}</td>
			
			<td>{{ $BoothAgent->Booth_Agent_Desc }}</td>
			<td>{{ $BoothAgent->Booth_Agent_Name }}</td>
						
			<td><a href="{{ route('Edit.BoothAgent', ['BoothAgentId' => $BoothAgent->Booth_Agent_Id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
			</td>
			<td>
				<a onclick="DeleteBoothAgent('{{$BoothAgent->Booth_Agent_Id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
			</td>
		</tr>
		
		
		@endforeach
	
</tbody>
</table>