<div class="add-button" >
	<a  class="btn btn-primary btn-md" href="{{route('ShowStateDivision')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add
	</a>
</div>
<br><br>
<table class="table table-borderless">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>State</th>
			<th>Name</th>
			<th>Status</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($StateDivision as $i => $StateDivision)
		<tr>
			<td>{{ $i+1 }}</td>
			<?php
			$state = App\Models\State::where('State_id',$StateDivision->State_id)->orderBy('State_desc')->first()
			?>
			<td>{{ $state->State_desc }}</td>
			<td>{{ $StateDivision->State_Division_desc }}</td>
			<td><span class="right badge @if($StateDivision->State_Division_active == 'Y') badge-success @else badge-danger @endif">{{ $StateDivision->State_Division_active  }}</span></td>
		</td>
		<td>
			<a href="{{ route('EditStateDivision', ['StateDivisionid' => $StateDivision->State_Division_id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
		</td>

		<?php
		$statedivisions = App\Models\GreaterZones::where('State_Division_id',$StateDivision->State_Division_id)->count();
		?>
		@if($statedivisions>='1')
		<td>
			
		</td>
		@else
		<td><a onclick="DeleteStateDivision('{{$StateDivision->State_Division_id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
		</td>
		@endif
		
	</tr>
	
	
	@endforeach
</tbody>
</table>