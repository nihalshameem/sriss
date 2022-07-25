 <table id="example1" class="table table-borderless">
 	<thead>
 		<tr>
 			<th>Sl No</th>
 			<th>Date</th>
 			<th>Name</th>
 			<th>Mobile Number</th>
 			<th>Instrument No</th>
 			<th>Instrument Type</th>
 			<th>Amount In Rs</th>
 			<th>Receipts</th>
 			<th>Payment Status</th>
 		</tr>
 	</thead>
 	<tbody>
 		@foreach ($OfflineContribution as $i => $OfflineContribution)
 		<tr>
 			<td>{{ $i+1 }}</td>
 			<td>{{ $OfflineContribution->updated_at->toDateString() }}</td>
 			<td>{{ $OfflineContribution->First_Name }} {{ $OfflineContribution->last_Name }}</td>  
 			<td>{{ $OfflineContribution->Mobile_No }}</td>
 			<td>{{ $OfflineContribution->drs_Inst_No }}</td>
 			<td>{{ $OfflineContribution->drs_Inst_Type }}</td>
 			<td>{{ $OfflineContribution->Offline_Contribution_amount }}.00</td>
 			@if($OfflineContribution->My_receipts_path!=null)   
 			<td><a href="{{ $OfflineContribution->My_receipts_path}}" target="blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a><p style="display:none">{{ $OfflineContribution->My_receipts_path }}</p></td>  
 			@else
 			<td>-</td>
 			@endif
 			<td>{{ $OfflineContribution->Offline_Contribution_payment_status }}</td>
 			
 		</tr>
 		@endforeach

 	</tbody>
 </table>