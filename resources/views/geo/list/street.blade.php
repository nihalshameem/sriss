						
<table class="table table-borderless">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Village</th>
			<th>Name</th>
			<th>Status</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($Street as $i => $street)
		<tr>
			<td>{{ $i+1 }}</td>
			<?php
			$Village = App\Models\Village::where('Village_id',$street->Village_id)->first();
			?>
			@if($Village!=null)
			<td>{{ $Village->Village_desc }}</td>
			@else
			<td>-</td>
			@endif
			<td>{{ $street->Street_desc }}</td>
			<td><span class="right badge @if($street->Street_active == 'Y') badge-success @else badge-danger @endif">{{ $street->Street_active  }}</span></td>
			
			<td><a href="{{ route('EditStreet', ['StreetId' => $street->Street_id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
			</td>

			<td>
				<a onclick="DeleteStreet('{{$street->Street_id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
			</td>
		</tr>
		
		@endforeach
	</tbody>
</table>