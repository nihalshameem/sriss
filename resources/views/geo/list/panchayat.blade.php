						
<table class="table table-borderless">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Union</th>
			<th>Name</th>
			<th>Status</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($Panchayat as $i => $panchayat)
		<tr>
			<td>{{ $i+1 }}</td>
			<?php
			$Union = App\Models\Union::where('Union_id',$panchayat->Union_id)->first();
			?>
			@if($Union!=null)
			<td>{{ $Union->Union_desc }}</td>
			@else
			<td>-</td>
			@endif
			<td>{{ $panchayat->Panchayat_desc }}</td>
			<td><span class="right badge @if($panchayat->Panchayat_active == 'Y') badge-success @else badge-danger @endif">{{ $panchayat->Panchayat_active  }}</span></td>
			
			<td><a href="{{ route('EditPanchayat', ['Panchayatid' => $panchayat->Panchayat_id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
			</td>
			<?php
			$VillageCount = App\Models\Village::where('Panchayat_id',$panchayat->Panchayat_id)->count();
			?>
			@if($VillageCount>='1')
			<td>
				
			</td>
			@else
			<td>
				<a onclick="DeletePanchayat('{{$panchayat->Panchayat_id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
			</td>
			@endif

			
		</tr>
		
		@endforeach
	</tbody>
</table>
