<table id="example1" class="table table-borderless">
  <thead>
    <tr>
      <th>S.No</th>
      <th>First Name</th>
      <th>Email</th>
      <th>Mobile Number</th>
      <th>Member Id</th>
      <th>Pincode</th>
      <th>Reg Date</th>
      <th>Address</th>
    </tr>
  </thead>
  <tbody id="membersearch">
    @foreach($Member as $i =>$member)
    <tr>
      <td>{{ $i+1 }}</td>
      <td>{{ $member->First_Name }} {{ $member->Last_Name }}</td>
      <td>{{ $member->Email_Id }} </td>  
      <td>{{ $member->Mobile_No }}</td>   
      <td>{{ $member->Member_Id }}</td>  
      <td>{{ $member->Pincode }}</td>
       <td class="col-sm-2">{{ $member->created_at->toDateString() }} </td> 
              <?php
              $value = str_replace( ',', '<br />', $member->Address1 )
              ?>
              <td>{!! html_entity_decode($value) !!}</td>                  
      
    </tr>
    @endforeach
    

  </tbody>
</table>