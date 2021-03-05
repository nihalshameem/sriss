<div class="add-button" >
	
	<a  class="btn btn-primary btn-md" href="{{route('ShowGreaterZone')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add</a>
</div>
<br><br>
<table class="table table-borderless">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>State Division</th>
			<th>Name</th>
			<th>Status</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($GreaterZones as $i => $GreaterZone)
		<tr>
			<td>{{ $i+1 }}</td>
			<?php
			$StateDivision = App\Models\StateDivision::where('State_Division_id',$GreaterZone->State_Division_id)->orderBy('State_Division_desc')->first()
			?>
			<td>{{ $StateDivision->State_Division_desc }}</td>
			<td>{{ $GreaterZone->Greater_Zones_desc }}</td>
			<td><span class="right badge @if($GreaterZone->Greater_Zones_active == 'Y') badge-success @else badge-danger @endif">{{ $GreaterZone->Greater_Zones_active  }}</span></td>
			<td>
				<a href="{{ route('EditGreaterZone', ['GreaterZoneid' => $GreaterZone->Greater_Zones_id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
			</td>

			
			
			<?php
			$zones = App\Models\Zones::where('Greater_Zones_id',$GreaterZone->Greater_Zones_id)->count();
			?>
			@if($zones>='1')
			<td>
				
			</td>
			@else
			<td><a onclick="DeleteGreaterZone('{{$GreaterZone->Greater_Zones_id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
			</td>
			@endif
		</tr>
		
		@endforeach
	</tbody>
</table>