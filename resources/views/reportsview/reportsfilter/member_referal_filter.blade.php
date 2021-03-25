
 <table  class="table table-borderless" cellpadding="0" cellspacing="0" >
                                      <thead>
                                        <tr>
                                          <th>Member Id</th>
                                          <th>First Name</th>
                                          <th>Total Members</th>
                                        </tr>
                                      </thead>
                                      <tbody >
                                        
                                        <tr>
                                          <td style="width: 25%;">{{ $members->Member_Id }}</td>
                                          <td style="width: 25%;">{{ $members->First_Name }} {{ $members->Last_Name }}</td>
                                          <?php
                                            $memberCount = \App\Models\Member::where('ReferedBy',$members->Mobile_No)->count();
                                          ?>
                                          <td style="width: 25%;">{{ $memberCount }}</td>
                                        </tr>
                                        </tbody>
                                    </table><br>
                                    <table id="Profile_karyakarthas_reports" class="table table-borderless">
                                      <thead>
                                        <tr>
                                          <th>S.No</th>
                                          <th>Member Id</th>
                                          <th>First Name</th>
                                          <th>Mobile Number</th>
                                          <th>Email</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody >
                                        @foreach($member as $i =>$member)
                                        
                                        <tr>
                                          <td>{{ $i+1 }}</td>
                                          <td>{{ $member->Member_Id }}</td>
                                          <td>{{ $member->First_Name }} {{ $member->Last_Name }}</td>
                                          <td>{{ $member->Mobile_No }}</td>
                                         
                                          <td>{{ $member->Email_Id }} </td>  
                                        </tr>
                                        @endforeach
                                        </tbody>
										</table>