@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
        <div class="col-12">

            <div class="row mb-2">
              <div class="col-sm-2">
                <a href="/geo" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
            </div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-5">
                <h3 class="title-head">Edit State</h3>
            </div>
            <div class="col-sm-2">
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            
              <form role="form" method="post" class="col-md-6 was-validated"  action="{{ route('UpdateState') }}" class="UpdateDistrict" style="margin: 0 auto;padding-top: 40px;padding-bottom:20px">
                @csrf
                <div class="modal-body">

                  <div class="form-group">
                   <input type="hidden" class="form-control" name="Stateid" placeholder="Enter Name" value="{{$State->State_id}}" required>
                   <label for="exampleInputPassword1">Country </label>
                   <select class="form-control" name="CountryId" required>
                      <option value="">Select Country</option>
                      @if(isset($country))
                      @foreach($country as $country) 
                      <option value="{{$country->Country_id}}" @if($country->Country_id == $State->Country_id) selected @endif>{{ $country->Country_desc}}</option>
                      @endforeach
                      @endif
                  </select>
                  
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$State->State_desc}}" required>
                
            </div>
            <div class="form-group">
              <label >Status</label><br>
              <div class="icheck-primary d-inline">
                <input type="radio" id="checkboxPrimary11" value="Y" name="Status" {{ ($State->State_active == "Y") ? 'checked' : '' }}>
                <label for="checkboxPrimary11">Yes
                </label>
            </div>
            
            <div class="icheck-primary d-inline">
                <input type="radio" id="checkboxPrimary12" value="N"  name="Status" {{ ($State->State_active == "N") ? 'checked' : '' }}>
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