@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
        <div class="col-12 row">
            <div class="col-sm-2">
                <a href="/geo" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
            </div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-5">
                <h3 class="title-head">Edit State Division</h3>
            </div>
            <div class="col-sm-2">
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            
              <form role="form" method="post" class="col-md-6 was-validated"  action="{{ route('UpdateStateDivision') }}" class="UpdateDistrict" style="margin: 0 auto;padding-top: 10px;padding-bottom:20px">
                @csrf
                <div class="modal-body">

                  <div class="form-group">
                    <input type="hidden" name="StateDivisionid" value="{{$StateDivisions->State_Division_id}}">
                    <label for="exampleInputPassword1">State </label>
                    <select class="form-control" name="stateId" required>
                      <option value="">Select State</option>
                      @if(isset($states))
                      @foreach($states as $state) 
                      <option value="{{$state->State_id}}" @if($state->State_id == $StateDivisions->State_id) selected @endif>{{ $state->State_desc}}</option>
                      @endforeach
                      @endif
                  </select>
                  
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$StateDivisions->State_Division_desc}}" required>
                
            </div>
            <div class="form-group">
              <label >Status</label><br>
              <div class="icheck-primary d-inline">
                <input type="radio" id="checkboxPrimary11" value="Y" name="Status" {{ ($StateDivisions->State_Division_active == "Y") ? 'checked' : '' }}>
                <label for="checkboxPrimary11">Yes
                </label>
            </div>
            
            <div class="icheck-primary d-inline">
                <input type="radio" id="checkboxPrimary12" value="N"  name="Status" {{ ($StateDivisions->State_Division_active == "N") ? 'checked' : '' }}>
                <label for="checkboxPrimary12">
                  No
              </label>
          </div>
      </div>
      
      
  </div>
  <div style="max-width: 200px; margin: auto;">
      <a href="/geo" class="btn btn-primary">Cancel</a>
      <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>
</div>
</div>


</div>
<!-- /.container-fluid -->
</section>
</div>
@endsection