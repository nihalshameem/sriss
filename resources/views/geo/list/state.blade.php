<div class="add-button" >
	<a  class="btn btn-primary btn-md" href="{{route('ShowState')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add
	</a>
</div>
<br><br>

<table class="table table-borderless">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Name</th>
			<th colspan="2">Action</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($State as $i => $State)
		<tr>
			<td>1</td>
			<td>{{$State->State_desc}}</td>
			<td><span class="right badge @if($State->State_active == 'Y') badge-success @else badge-danger @endif">{{ $State->State_active  }}</span></td>
		</td>
		<td>
			<a href="{{ route('EditState', ['Stateid' => $State->State_id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
		</td>

		<?php
		$state = App\Models\StateDivision::where('State_id',$State->State_id)->count();
		?>
		@if($state>='1')
		<td>
			
		</td>
		@else
		<td><a onclick="DeleteState('{{$State->State_id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
		</td>
		@endif
	</tr>
	@endforeach
</tbody>
</table>