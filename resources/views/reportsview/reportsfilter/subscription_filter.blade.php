 <table id="example1" class="table table-borderless">
 	<thead>
 		<tr>
 			<th>Sl No</th>
 			<th>Date</th>
 			<th>Name</th>
 			<th>Mobile Number</th>
 			<th>Amount In Rs</th>
 			<th>Receipt</th>
 			<th>Payment Status</th>
 		</tr>
 	</thead>
 	<tbody>
 		@foreach ($Subscriptions as $i => $Subscription)
 		<tr>
 			<td>{{ $i+1 }}</td>
 			<td>{{ $Subscription->updated_at->toDateString() }}</td>
 			<?php
 			$member = \App\Models\Member::where('Member_Id',$Subscription->Member_id)->first();
 			?>
 			@if($member!=null)
 			<td>{{ $member->First_Name }} {{ $member->Last_Name }}</td>
 			<td>{{ $member->Mobile_No }}</td>
 			@endif
 			<td>{{ $Subscription->Subscription_amount }}.00</td> 
 			@if($Subscription->My_receipts_path!=null)   
 			<td><a href="{{ $Subscription->My_receipts_path}}" target="blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a><p style="display:none">{{ $Subscription->My_receipts_path }}</p></td>  
 			@else
 			<td>-</td>
 			@endif  
 			<td>{{ $Subscription->payment_status }}</td>
 			
 		</tr>
 		@endforeach

 	</tbody>
 </table>