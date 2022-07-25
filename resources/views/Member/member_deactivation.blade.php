@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="margin-bottom: 0;">

    <section class="content" style="padding-top:25px">
      <div class="container-fluid">

       <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="/home" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-2">
        </div>
        <div class="col-sm-4">
            <h3 class="title-head">Member Deactivation</h3>
        </div>
        <div class="col-sm-1">
        </div>
        <div class="col-sm-2">
            
        </div>
        
    </div>
</div>

<!-- /.card-header -->
<div class="card-body" style="padding-top: 0;">
  <div class="row">
    <div class="col-md-2">
      
    </div>
    <div class="col-md-3">
      <select name="membersearch" id="mobile_number" class="selectpicker form-control memberdeactivate"  data-live-search="true" >
          <option value="">Mobile Number</option>
          @foreach ($Member as $member)
          
          <option value="{{ $member->Mobile_No }} ">{{ $member->Mobile_No }}
          </option>
          @endforeach 
      </select>
  </div>
  <div class="col-md-3">
      <select name="membersearch" id="member_id" class="selectpicker form-control memberdeactivate"  data-live-search="true">
          <option value="">Email</option>
          @foreach ($Member as $member)
          
          <option value="{{ $member->Email_Id }} " >{{ $member->Email_Id }} 
          </option>
          @endforeach 
      </select>
  </div>
  <div class="col-md-3">
      <select name="membersearch" id="member_id" class="selectpicker form-control memberdeactivate"  data-live-search="true">
          <option value="">Member Id</option>
          @foreach ($Member as $member)
          <option value="{{ $member->Member_Id }} ">{{ $member->Member_Id }}
          </option>
          @endforeach 
      </select>
  </div>
</div>
</div>

<div class="card">
    <!-- /.card-header -->
    <div class="card-body" style="padding-top: 0;">
      <table id="example1" class="table table-borderless">
          <thead>
            <tr>
              <th>First Name</th>
              <th>Email</th>
              <th>Mobile Number</th>
              <th>Member Id</th>
              <th>Pincode</th>
              <th>Address</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody id="memberdeactivate">
          
      </tbody>
  </table>
</div>
</div>
<div class="card">
    <!-- /.card-header -->
    <div class="card-body" style="padding-top: 0;" >
     <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-4">
          </div>
          <div class="col-sm-4">
            <h3>Deactivated Members</h3>
        </div>
        <div class="col-sm-3">
        </div>
        
    </div>
</div>
<table id="example1" class="table table-borderless">
  <thead>
      <tr>
        <th>Sl.No</th>
        <th>First Name</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>Member Id</th>
        <th>Pincode</th>
        <th>Address</th>
        <th>Status</th>
    </tr>
</thead>
<tbody>
  @foreach($demembers as $i =>$demember)
  <tr>
      <td>{{ $i+1 }}</td>
      <td>{{ $demember->First_Name }} {{ $demember->Last_Name }}</td>
      <td>{{ $demember->Email_Id }} </td>  
      <td>{{ $demember->Mobile_No }}</td>   
      <td>{{ $demember->Member_Id }}</td> 
      <td>{{ $demember->Pincode }}</td>  
      <td>{{ $demember->Address1 }}</td> 
      <td> <a href="/MemberActivation/{{$demember->Member_Id}}" ><span class="badge bg-success">Activate</span></a>  </td>               
      
  </tr>
  @endforeach

  


</tbody>
</table>

</div>
</div>
</section>
</div>
@endsection