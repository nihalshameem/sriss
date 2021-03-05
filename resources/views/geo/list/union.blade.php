

<table class="table table-borderless">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>District</th>
			<th>Name</th>
			<th>Status</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	<tbody id="unionfilterdetails">
		@foreach ($Unions as $i => $Union)
		<tr>
			<td>{{ $i+1 }}</td>
			<?php
			$District = App\Models\District::where('District_id',$Union->District_id)->first();
			?>
			@if($District!=null)
			<td>{{ $District->District_desc }}</td>
			@else
			<td>-</td>
			@endif
			<td>{{ $Union->Union_desc }}</td>
			<td><span class="right badge @if($Union->Union_active == 'Y') badge-success @else badge-danger @endif">{{ $Union->Union_active  }}</span></td>
			
			<td><a href="{{ route('EditUnion', ['Unionid' => $Union->Union_id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
			</td>

			
			<?php
			$PanchayatCount = App\Models\Panchayat::where('Union_id',$Union->Union_id)->count();
			?>
			@if($PanchayatCount>='1')
			<td>
				
			</td>
			@else
			<td>
				<a onclick="DeleteUnion('{{$Union->Union_id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
			</td>
			@endif
		</tr>
		
		@endforeach
	</tbody>
</table>