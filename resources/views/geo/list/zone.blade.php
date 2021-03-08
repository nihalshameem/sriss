<div class="row">
	<div class="col-md-3">
		
	</div>
	<div class="col-md-3">
		
	</div>
	<div class="col-md-3">
		
	</div>
	<div class="col-md-3">
		<a  class="btn btn-primary btn-md" href="{{route('ShowZone')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add</a>
	</div>
</div>

<br>
<table class="table table-borderless" >
	<thead>
		<tr>
			<th>Sl No</th>
			<th>G.Zone</th>
			<th>Name</th>
			<th>Status</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	<tbody >
		@foreach ($Zones as $i => $Zones)
		<tr>
			<td>{{ $i+1 }}</td>
			<?php
			$State = App\Models\State::where('State_id',$Zones->State_id)->orderBy('State_desc')->first();
			?>
			@if($State!=null)
			<td>{{ $State->State_desc }}</td>
			@else
			<td>-</td>
			@endif
			<td>{{ $Zones->Zone_desc }}</td>
			<td><span class="right badge @if($Zones->Zone_active == 'Y') badge-success @else badge-danger @endif">{{ $Zones->Zone_active  }}</span></td>
			<td><a href="{{ route('EditZone', ['Zoneid' => $Zones->Zone_id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
			</td>
			<?php
			$Districtzones = App\Models\District::where('Zone_id',$Zones->Zone_id)->count();
			?>
			@if($Districtzones>='1')
			<td>
				
			</td>
			@else
			<td>
				<a onclick="DeleteZone('{{$Zones->Zone_id}}')"><span class="badge bg-danger" ><i class="fas fa-trash"></i></span></a>
			</td>
			@endif
			
			
		</tr>
		

		@endforeach
	</tbody>
</table>