<div class="add-button" >
	<a  class="btn btn-primary btn-md" href="{{route('add.Booth')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add
	</a>
</div>
<br><br>

<table class="table table-borderless">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Ward</th>
			<th>Description</th>
			<th>Polling Station No</th>
			<th>Polling Station Location</th>
			<th>Polling Station Area</th>
			<th>Edit</th>
			<th>Delete</th>
			
		</tr>
	</thead>
	<tbody>
			@foreach ($Booth as $i => $Booth)
		<tr>
		    <?php
		    
				$ward = App\Models\Ward::where('Ward_Id',$Booth->Ward_Id)->first();
				

			?>
			<td>{{ $i+1 }}</td>
			<td>{{ $ward->Ward_Name }}</td>
			<td>{{ $Booth->Booth_Desc }}</td>
			<td>{{ $Booth->Polling_Station_No }}</td>
			<td>{{ $Booth->Polling_Station_Location }}</td>
			<td>{{ $Booth->Polling_Station_Area }}</td>
						
			<td><a href="{{ route('Edit.Booth', ['BoothId' => $Booth->Booth_Id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
			</td>
			<td>
				<?php
					$BoothAgent = App\Models\BoothAgent::where('Booth_id',$Booth->Booth_Id)->first();
				?>
				@if($BoothAgent)
				@else
				<a onclick="DeleteBooth('{{$Booth->Booth_Id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
				@endif
			</td>
		</tr>
		
		
		@endforeach
	
</tbody>
</table>