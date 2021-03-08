@extends('layouts.app')

@section('content')
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content" style="padding-top:20px">
       <div class="container-fluid">
          <div class="col-12">
              <div class="col-12">

                <div class="row mb-2">
                  <div class="col-sm-2">
                    <a href="/geo" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -10px;margin-left: -24px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
                </div>
                <div class="col-sm-3">
                </div>
                <div class="col-sm-5">
                    <h3 class="title-head">Add Zone</h3>
                </div>
                <div class="col-sm-3">
                </div>
                
            </div>
        </div>
        <div class="row">
         <div class="col-12">
             <div class="card">
               <!-- /.card-header -->
               <div class="card-body" >
                
                 
                <form role="form" id="zoneForm" method="post"  class="col-md-6 was-validated"  action="{{ route('AddZone') }}" enctype="multipart/form-data" style="margin: 0 auto;padding-top: 10px;padding-bottom:20px">
                  @csrf
                  <div class="form-group">
                      <label for="exampleInputPassword1">State</label>
                      <select class="form-control" name="StateId" required>
                        <option value="" disabled="">State</option>
                        @if(isset($states))
                        @foreach($states as $states) 
                        <option value="{{$states->State_id}}">{{ $states->State_desc}}</option>
                        @endforeach
                        @endif
                    </select>
                    
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter Description" value="{{ old('name') }}" required>
                  
              </div>
              <div class="form-group">
                  <label >Status</label><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="checkboxPrimary11" value="Y" name="Status" checked>
                    <label for="checkboxPrimary11">Yes
                    </label>
                </div>
                
                <div class="icheck-primary d-inline">
                    <input type="radio" id="checkboxPrimary12" value="N"  name="Status">
                    <label for="checkboxPrimary12">
                      No
                  </label>
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
</div>
</div>
</section>
</div>
@endsection