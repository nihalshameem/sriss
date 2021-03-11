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
    @if( Session::has( 'warning' ))
    <div class="alert alert-danger" style="margin-top:15px;">
        {{ Session::get('warning') }}
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
     <button type="submit" class="btn btn-primary">Submit</button>
   
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