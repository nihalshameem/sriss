@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:20px">
    <div class="container-fluid">
      <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="/geo" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -10px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
          </div>
          <div class="col-sm-3">
          </div>
          <div class="col-sm-5">
            <h3 class="title-head">Edit Zone</h3>
          </div>
          <div class="col-sm-3">
          </div>
          
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            
           <form role="form" method="post" class="col-md-6 was-validated"  action="{{ route('UpdateZone') }}" class="Updatezone" style="margin: 0 auto;padding-top: 10px;padding-bottom:20px" >
            @csrf
            <div class="modal-body">

              <div class="form-group">
               <label for="exampleInputPassword1">State </label>
               <select class="form-control" name="StateId" required>
                <option value="">Select State</option>
                @if(isset($State))
                @foreach($State as $State) 
                <option value="{{$State->State_id}}" @if($State->State_id == $Zones->State_id) selected @endif>{{ $State->State_desc}}</option>
                @endforeach
                @endif
              </select>
            </div>
            <div class="form-group">
              <input type="hidden" name="ZoneId" value="{{$Zones->Zone_id}}">
              <label for="exampleInputPassword1">Name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter Description" value="{{$Zones->Zone_desc}}" required>
              
            </div>
            <div class="form-group">
              <label >Status</label><br>
              <div class="icheck-primary d-inline">
                <input type="radio" id="checkboxPrimary11" value="Y" name="Status" {{ ($Zones->Zone_active == "Y") ? 'checked' : '' }}>
                <label for="checkboxPrimary11">Yes
                </label>
              </div>
              
              <div class="icheck-primary d-inline">
                <input type="radio" id="checkboxPrimary12" value="N"  name="Status" {{ ($Zones->Zone_active == "N") ? 'checked' : '' }}>
                <label for="checkboxPrimary12">
                  No
                </label>
              </div>
            </div>
            
            
          </div>
          <div style="max-width: 200px; margin: auto;">
            <button type="submit"  class="btn btn-primary" value="Submit">Submit</button>
            <button type="button"  class="btn btn-primary" data-dismiss="modal">Cancel</button>
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