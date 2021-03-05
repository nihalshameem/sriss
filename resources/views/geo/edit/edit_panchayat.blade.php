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
                    <h3 class="title-head">Edit Panchayat</h3>
                </div>
                <div class="col-sm-2">
                 
                </div>
                
            </div>
        </div>
        <div class="row">
         <div class="col-12">
             <div class="card">
               <!-- /.card-header -->
               <div class="card-body" >
                
                <form role="form" method="post"  class="col-md-6 was-validated"  action="{{ route('UpdatePanchayat') }}" enctype="multipart/form-data" style="margin: 0 auto;padding-top: 10px;padding-bottom:20px">
                  @csrf
                  <div class="form-group">
                      <label for="exampleInputPassword1">Union</label>
                      <select class="form-control" name="UnionId" required>
                          <option value="">Select Union</option>
                          @if(isset($Union))
                          @foreach($Union as $union) 
                          <option value="{{$union->Union_id}}"  @if($union->Union_id == $Panchayat->Union_id) selected @endif>{{ $union->Union_desc}}</option>
                          @endforeach
                          @endif
                      </select>
                      
                  </div>
                  <div class="form-group">
                      <input type="hidden" name="PanchayatId" value="{{$Panchayat->Panchayat_id}}">
                      <label for="exampleInputPassword1">Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Enter Description" value="{{$Panchayat->Panchayat_desc}}" required>

                  </div>
                  
                  <div class="form-group">
                      <label >Status</label><br>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="checkboxPrimary11" value="Y" name="Status" {{ ($Panchayat->Panchayat_active == "Y") ? 'checked' : '' }}>
                        <label for="checkboxPrimary11">Yes
                        </label>
                    </div>
                    
                    <div class="icheck-primary d-inline">
                        <input type="radio" id="checkboxPrimary12" value="N"  name="Status" {{ ($Panchayat->Panchayat_active == "N") ? 'checked' : '' }}>
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