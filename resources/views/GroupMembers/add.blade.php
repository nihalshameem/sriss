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
            <h3 class="title-head">Add Group Members</h3>
        </div>
        <div class="col-sm-3">
        </div>
        
    </div>
</div><br>
<div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
          @if( Session::has( 'success' ))
          <div class="alert alert-success alert-block" style="border-color: #8ac38b;color: #388E3C;background-color: #cde0c4;">
            <a class="close" data-dismiss="alert" href="#">×</a>
            <p style="font-weight:600">{{ Session::get('success') }}</p>
        </div>
        @endif
        
   <form role="form" method="post" class="col-md-12 was-validated"  action="{{ route('save.singleGroupMember') }}" class="CreateGroup" style="margin: 0 auto;padding-top: 10px;padding-bottom:20px">   
<div class="row">
  
                @csrf
    <div class="col-md-4 form-group">
      <label for="exampleInputPassword1">Mobile Number</label><br>
      <select name="member_id" id="mobile_number" class="selectpicker form-control memberdeactivate"  data-live-search="true">
          <option value="">Mobile Number</option>
          @foreach ($members as $member)
          
          <option value="{{ $member->id }} ">{{ $member->Mobile_No }}
          </option>
          @endforeach 
      </select>
    @if( Session::has( 'warning1' ))
    <div class="alert alert-danger" style="margin-top:15px;">
        {{ Session::get('warning1') }}
    </div>
    @endif
</div>
<div class="col-md-4 form-group">
  <label for="exampleInputPassword1">Group Name</label><br>
  <select name="Group_id" id="group_name" class="selectpicker form-control memberdeactivate"  data-live-search="true" >
          <option value="">Group Name</option>
          @foreach ($memberGroups as $memberGroup)
          
          <option value="{{ $memberGroup->Group_id }} ">{{ $memberGroup->Group_name }}
          </option>
          @endforeach 
      </select>
 
</div>
<div class="col-md-4 form-group">
  
     <button style="margin-top: 32px" type="submit" class="btn btn-primary">Submit</button>
   
</div>

</div>
</form>
<form role="form" method="post" class="col-md-12 was-validated"  action="{{ route('save.multiGroupMember') }}" class="CreateGroup" style="margin: 0 auto;padding-top: 10px;padding-bottom:30px">   
<div class="row">
  
    @csrf
    <div class="col-md-4 form-group">
      <label for="exampleInputPassword1">Mobile Numbers</label><br>
      <textarea name="multi_member_id" class=" col-md-12 memberdeactivate"rows="4" ></textarea>
      <br>
      <p>Separate each mobile number with comma only.</p>
    @if( Session::has( 'warning2' ))
    <div class="alert alert-danger" style="margin-top:15px;">
        {{ Session::get('warning2') }}
    </div>
    @endif
    @if( Session::has( 'warning3' ))
     <div class="alert alert-success" style="margin-top:15px;">
          {{ Session::get('warning3') }}
      </div>
    @endif
    @if( Session::has( 'warning4' ))
     <div class="alert alert-danger" style="margin-top:15px;">
          {{ Session::get('warning4') }}
      </div>
    @endif
</div>
<div class="col-md-4 form-group">
  <label for="exampleInputPassword1">Group Name</label><br>
  <select name="multi_Group_id" id="group_name" class="selectpicker form-control memberdeactivate" data-live-search="true" >
          <option value="">Group Name</option>
          @foreach ($memberGroups as $memberGroup)
          
          <option value="{{ $memberGroup->Group_id }} ">{{ $memberGroup->Group_name }}
          </option>
          @endforeach 
      </select>
 
</div>
<div class="col-md-4 form-group">
  <label for="exampleInputPassword1">
     <button style="margin-top: 32px" type="submit" class="btn btn-primary">Submit</button>
   
</div>

</div>
</form>

</div>

</div>
</div>
</div>
</div>
</section>
</div>

<script type="text/javascript">
  function print(value){
    alert(value);
  }
</script>
@endsection