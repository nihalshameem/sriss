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
          <a href="/Reports" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -12px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
          <h3 class="title-head">Member Referral</h3>
        </div>
        <div class="col-sm-2">
         
        </div>
        
      </div>
    </div>

  <div class="col-12">

   
   <div class="row">
     <div class="col-12">
       <div class="card">
         <!-- /.card-header -->
         <div class="card-body" id="referal_reports">
           
            <table  class="table table-borderless" cellpadding="0" cellspacing="0" >
                                      <thead>
                                        <tr>
                                          <th>Member Id</th>
                                          <th>First Name</th>
                                          <th>Mobile Number</th>
                                          <th style="text-align:center">Total Members</th>
                                        </tr>
                                      </thead>
                                      <tbody >
                                        @foreach($member as $members)
                                        <tr>
                                         
                                          <td style="width: 25%;">{{ $members->Member_Id }}</td>
                                          <td style="width: 25%;">{{ $members->First_Name }} {{ $members->Last_Name }}</td>
                                           <td style="width: 25%;">{{ $members->Mobile_No }}</td>
                                          
                                          <td style="width: 25%;text-align:center"><a href="{{ route('MemberReferal.reports.members.list', ['mobile_number' => $members->ReferedBy]) }}" style="color:blue;font-weight:bolder">{{ $members->memberCount }}</a></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table><br>
           
         </div>
         <!-- /.card-body -->
       </div>
       <!-- /.card -->
     </div>
     <!-- /.col -->
   </div>
   <!-- /.row -->
 </div>
 <!-- /.container-fluid -->
</section>
</div>
</section>
</div>

@endsection