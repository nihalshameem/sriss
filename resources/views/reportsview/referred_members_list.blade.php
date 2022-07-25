 
 @extends('layouts.app')

@section('content')
<div >
 <div class="content-wrapper">

  <!-- Main content -->
  <section class="content" style="padding-top:25px">
   <div class="container-fluid">
    <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="/Reports/MemberReferal" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -12px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
          <h3 class="title-head">Referal Members List</h3>
        </div>
        <div class="col-sm-2">
         
        </div>
        
      </div>
    </div>
    
    
    <h5 class="title-head"><center>Referred By : {{$members->First_Name}}</center></h5>
    <table id="referal_reports" class="table table-borderless">
                                      <thead>
                                        <tr>
                                          <th>S.No</th>
                                          <th>Member Id</th>
                                          <th>Mobile Number</th>
                                          <th>First Name</th>
                                          <th>Email</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody >
                                        @foreach($member as $i =>$member)
                                        
                                        <tr>
                                          <td>{{ $i+1 }}</td>
                                          <td style="width: 25%;">{{ $member->Member_Id }}</td>
                                          <td style="width: 25%;">{{ $member->Mobile_No }}</td>
                                          
                                          <td style="width: 25%;">{{ $member->First_Name }} {{ $member->Last_Name }}</td>
                                          <td style="width: 25%;">{{ $member->Email_Id }} </td>  
                                        </tr>
                                        @endforeach
                                        </tbody>
										</table>
                  </div>
                </section>
              </div>
            </div>
@endsection