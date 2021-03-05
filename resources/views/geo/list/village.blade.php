<table class="table table-borderless">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Panchayat</th>
			<th>Name</th>
			<th>Status</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($Village as $i => $village)
		<tr>
			<td>{{ $i+1 }}</td>
			<?php
			$Panchayat = App\Models\Panchayat::where('Panchayat_id',$village->Panchayat_id)->first();
			?>
			@if($Panchayat!=null)
			<td>{{ $Panchayat->Panchayat_desc }}</td>
			@else
			<td>-</td>
			@endif
			<td>{{ $village->Village_desc }}</td>
			<td><span class="right badge @if($village->Village_active == 'Y') badge-success @else badge-danger @endif">{{ $village->Village_active  }}</span></td>

			<td><a href="{{ route('EditVillage', ['VillageId' => $village->Village_id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
			</td>
			<?php
			$StreetCount = App\Models\Street::where('Village_id',$village->Village_id)->count();
			?>
			@if($StreetCount>='1')
			<td>

			</td>
			@else
			<td>
				<a onclick="DeleteVillage('{{$village->Village_id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
			</td>
			@endif

		</tr>

		@endforeach
	</tbody>
</table>