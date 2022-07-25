<div class="row">
	<div class="col-md-4">
		
	</div>
	<div class="col-md-3">
		<select class="form-control" id="ZoneFilterId" onchange="getZonesFilter(this.value)" required>
			<option value="">Select Zone</option>
			@if(isset($Zonesfilter))
			@foreach($Zonesfilter as $Zones) 
			<option value="{{$Zones->Zone_id}}" >{{ $Zones->Zone_desc}}</option>
			@endforeach
			@endif
			
		</select>
	</div>

	<div class="col-md-3">
		
	</div>
	<div class="col-md-2">
		<a  class="btn btn-primary btn-md" href="{{route('ShowDistrict')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add</a>
	</div>
</div>

<br>
<table class="table table-borderless">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Zone</th>
			<th>Name</th>
			<th>Status</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	<tbody id="districtfilterdetails">
		@foreach ($District as $i => $District)
		<tr>
			<td>{{ $i+1 }}</td>
			<?php
			$Zones = App\Models\Zones::where('Zone_id',$District->Zone_id)->first();
			?>
			@if($Zones!=null)
			<td>{{ $Zones->Zone_desc }}</td>
			@else
			<td>-</td>
			@endif
			<td>{{ $District->District_desc }}</td>
			<td><span class="right badge @if($District->District_active == 'Y') badge-success @else badge-danger @endif">{{ $District->District_active  }}</span></td>
			
			<td><a href="{{ route('EditDistrict', ['Districtid' => $District->District_id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
			</td>
			<?php
			$UnionsCount = App\Models\Union::where('District_id',$District->District_id)->count();
			?>
			@if($UnionsCount>='1')
			<td>
				
			</td>
			@else
			<td>
				<a onclick="DeleteDistrict('{{$District->District_id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
			</td>
			@endif
		</tr>
		
		
		@endforeach
	</tbody>
</table>
