@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:15px">
    <div class="container-fluid">

      <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-5">
          </div>
          <div class="col-sm-4">
            <h3 class="title-head">Volunteer Geo</h3>
        </div>
        <div class="col-sm-3">
        </div>
        
    </div>
</div><br>
<div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        
        <form role="form" method="post" class="col-md-10" action="{{ route('VolunteerSave') }}" enctype="multipart/form-data" id="volunteergeoform" style="margin:0 auto">
          @csrf
          @if( Session::has( 'success' ))
          <div class="alert alert-success alert-block" style="border-color: #8ac38b;color: #388E3C;background-color: #cde0c4;">
            <a class="close" data-dismiss="alert" href="#">×</a>
            <h4 class="alert-heading" style="font-weight:600">Success!</h4>
            <p style="font-weight:600">{{ Session::get('success') }}</p>
        </div>
        @elseif( Session::has( 'warning' ))
        <div class="alert alert-danger alert-block" style="border-color: #FFA07A;color: #388E3C;">
            <a class="close" data-dismiss="alert" href="#">×</a>
            <h4 class="alert-heading" style="font-weight:bold;color:white">Warning!</h4>
            <p style="font-weight:bold;color:white;">{{ Session::get('warning') }}</p>
        </div>

        @endif
        <div class="row">
            <div class="col-md-3 form-group">
              <label for="exampleInputPassword1">Name</label><br>
              <input type="text" class="form-control" disabled="" value="{{$user->name}}" />
          </div>
          <div class="col-md-3 form-group">
              <label for="exampleInputPassword1">Email</label><br>
              <input type="text" class="form-control" disabled="" value="{{$user->email}}"/>
          </div>
          <div class="col-md-3 form-group">
              <label for="exampleInputPassword1">Mobile No</label><br>
              <input type="text" class="form-control" disabled="" value="{{$user->mobile_number}}"/>
          </div>
          <div class="col-md-3 form-group">
              <label for="exampleInputPassword1">Member Id</label><br>
              <input type="text" class="form-control" disabled="" value="{{$user->Member_Id}}"/>
          </div>
      </div>
      <div id="accordion">
        <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
        <div class="card card-primary">
          <div class="">
            <h4 class="">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"class="btn btn-primary" style="float:right">
                View Geo
            </a>
        </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
        <div class="card-body">
           <table id="example1" class="table table-borderless">
              <thead>
                <tr>
                  <th>State</th>
                  <th>Zone</th>
                  <th>District</th>
                  <th>Union</th>
              </tr>
          </thead>
          <tbody>
             @if($volunteer!=null)
             <?php
             $state =\App\Models\State::where('State_id',$volunteer->State_Id)->first();
             $Zones =\App\Models\Zones::where('Zone_id',$volunteer->Zones_Id)->first();
             $District =\App\Models\District::where('District_id',$volunteer->District_Id)->first();
             $Union =\App\Models\Union::where('Union_id',$volunteer->Union_Id)->first();
             ?>
             <tr>

                @if($state!=null)
                <td>{{ $state->State_desc }}</td>
                @else
                <td></td>
                @endif

                @if($Zones!=null)
                <td>{{ $Zones->Zone_desc }}</td>
                @else
                <td></td>
                @endif

                @if($District!=null)
                <td>{{ $District->District_desc }}</td>
                @else
                <td></td>
                @endif

                @if($Union!=null)
                <td>{{ $Union->Union_desc }} </td>  
                @else
                <td></td>
                @endif
                @endif
            </tr>
        </tbody>
    </table>
</div>
</div>
</div>



</div>

<div class="row">
    <div class="col-md-4 form-group">
      <label for="exampleInputPassword1">State</label><br>
      <select class="form-control" id="states" name="State_id" onchange="LoadZones(this)">
        <option value="">Select State</option>
        @foreach($State as $State)
        <option value="{{ $State->State_id }} ">{{ $State->State_desc }} </option>
        @endforeach
        
    </select>
    @if( Session::has( 'warning' ))
    
    <div class="alert alert-danger" style="margin-top:15px;">
        {{ Session::get('warning') }}
    </div>

    @endif
    
</div>
<div class="col-md-4 form-group">
  <label for="exampleInputPassword1">Zones</label><br>
  <select class="form-control" id="zone" name="Zone_id" onchange="LoadDistrict(this)">
     
     <option value="">Select Zones</option>
     
 </select>
 
</div>
<div class="col-md-4 form-group">
    <label for="exampleInputPassword1">District</label><br>
    <select class="form-control"  id="district" name="District_id" onchange="LoadUnion(this)">
       
       <option value="">Select District</option>
       
   </select>
   
</div>
<div class="col-md-4 form-group">
  <label for="exampleInputPassword1">Union</label><br>
  <select class="form-control" id="union"  name="Union_id" onchange="LoadPanchayat(this)">
    
     <option value="">Select Union</option>
     
 </select>
 
</div>
</div>
<div class="row">
  <div class="col-md-4">
     <div class="form-group">
        <label for="exampleInputPassword1">DRS Joining Date</label>
        <input type="date" class="form-control" name="joining_date" value="{{ old('joining_date') }}" required>
        
    </div>
</div>
<div class="col-md-4">
   <div class="form-group">
      <label for="exampleInputPassword1">Member Designation</label>
      <input type="text" class="form-control" name="member_designation" value="{{ old('member_designation') }}" id="member_designation" required>
      
  </div>
</div>

<div class="col-md-4">
 <div class="form-group">

   <label>Pincode</label>
   <input type="number"  id="pincode" required="Required" class="form-control" name="pincode"/>
</div>

</div>


</div>

<div style="max-width: 200px; margin: auto;">
  <?php
  $user = App\Models\User::where('name',session::get('name'))->first();
  $role = App\Models\UserRoles::where('user_id',$user->id)->first();
  ?>
  @if($role->role_id=='1')
  <a href="/home" class="btn btn-primary">Cancel</a>
  @else
  <a onclick="resetForm();" class="btn btn-primary">Cancel</a>
  @endif
  <button type="submit" class="btn btn-primary">Submit</button>
</div><br><br>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
</div>
<script>
  function resetForm() {
    document.getElementById("volunteergeoform").reset();
}
</script>
@endsection