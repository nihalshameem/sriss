<form role="form" method="post" action="{{ route('MemberApproval.Update') }}">
              @csrf
<table id="approvalreport" class="table table-borderless">
                                      <thead>
                                        <tr>
                                          <th>S.No</th>
                                          <th>Member Id</th>
                                          <th>First Name</th>
                                          <th>Email</th>
                                          <th>Mobile Number</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody >
                                        @foreach($member as $i =>$member)
                                        
                                        <tr>
                                          <td>{{ $i+1 }}</td>
                                          <td>{{ $member->Member_Id }}</td>
                                                                                 
                                          <td>{{ $member->First_Name }} {{ $member->Last_Name }}</td>
                                          <td>{{ $member->Email_Id }} </td>  
                                          <td>{{ $member->Mobile_No }}</td>  
                                           @if($member->Is_Approved=='N')
                                             <td><span class="badge bg-danger">Pending</td>
                                             @endif 
                                            @if($member->Is_Approved=='R')
                                              <td><span class="badge bg-danger">Rejected</span></td>
                                             @endif 
                                          <td><input type="checkbox" class="individual" name="member_id[]" value="{{ $member->Member_Id }}"/> </td>
                                         
                                        </tr>
                                        @endforeach
                                        </tbody>
                    </table>
                    <div style="max-width: 400px; margin: auto;">
  <a href="#" class="btn btn-primary">Cancel</a>
  <button type="submit" name = "submit" value = "Approve" class="btn btn-primary">Approve</button>
  <button type="submit" name = "submit" value = "Reject" class="btn btn-primary">Reject</button>
</div>
        </form>