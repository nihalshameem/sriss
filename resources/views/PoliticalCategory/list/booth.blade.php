<div class="add-button" >
	<a  class="btn btn-primary btn-md" href="{{route('add.Booth')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add
	</a>
</div>
<br><br>

<table class="table table-borderless">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Description</th>
			<th>Polling Station No</th>
			<th>Polling Station Location</th>
			<th>Polling Station Area</th>
			<th>Ward</th>
			<th>Booth Agent</th>
			<th>Assembly Const</th>
			<th>Parliament Const</th>
			<th>Edit</th>
			<th>Delete</th>
			
		</tr>
	</thead>
	<tbody>
			@foreach ($Booth as $i => $Booth)
		<tr>
			<td>{{ $i+1 }}</td>
			<td>{{ $Booth->Booth_Desc }}</td>
			<td>{{ $Booth->Polling_Station_No }}</td>
			<td>{{ $Booth->Polling_Station_Location }}</td>
			<td>{{ $Booth->Polling_Station_Area }}</td>
			<?php
				$ward = App\Models\Ward::where('Ward_Id',$Booth->Ward_Id)->first();
				$BoothAgent = App\Models\BoothAgent::where('Booth_Agent_Id',$Booth->Booth_Agent_Id)->first();

				$AssemblyConsituency = App\Models\AssemblyConsituency::where('Assembly_Id',$Booth->Assembly_Const_Id)->first();
				
				$ParliamentConsituency = App\Models\ParliamentConsituency::where('Parliament_Id',$Booth->Parliament_Const_Id)->first();
			?>
			<td>{{ $ward->Ward_Name }}</td>
			<td>{{ $BoothAgent->Booth_Agent_Desc }}</td>
			<td>{{ $AssemblyConsituency->Assembly_Constituency_Desc }}</td>
			<td>{{ $ParliamentConsituency->Parliament_Constituency_Desc }}</td>
						
			<td><a href="{{ route('Edit.Booth', ['BoothId' => $Booth->Booth_Id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
			</td>
			<td>
				<a onclick="DeleteBooth('{{$Booth->Booth_Id}}')" style="cursor:pointer"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
			</td>
		</tr>
		
		
		@endforeach
	
</tbody>
</table>