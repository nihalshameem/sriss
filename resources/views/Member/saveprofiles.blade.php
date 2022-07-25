@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
      <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="/Profiles" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-4">
            <h3 class="title-head">Edit Profile</h3>
        </div>
        <div class="col-sm-3">
        </div>
        
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
       
        <form role="form" method="post" class="col-md-6" action="{{ route('update.ProfileDetails') }}" enctype="multipart/form-data" style="margin: 0 auto;padding-top: 10px;padding-bottom:20px">
          @csrf

          
          <div class="form-group">
            <label >Name</label>
            <input type="hidden" class="form-control"  value="{{ $EditProfiles->id}}" name="profileId">
            <div class="form-group" >
                <input type="text" class="form-control"  value="{{ $EditProfiles->field_name}}" name="field_name" readonly>
            </div>
        </div>
        <div class="form-group">
            <label >D_Lable</label>
            <div class="form-group" >
                <input type="text" class="form-control"  value="{{ $EditProfiles->d_label}}" name="d_label" >
            </div>
        </div>
        <div class="form-group">
            <label >L2_Lable</label>
            <div class="form-group" >
                <input type="text" class="form-control"  value="{{ $EditProfiles->l2_label}}" name="l2_label" >
            </div>
        </div>
        <div class="form-group">
            <label >L3_Lable</label>
            <div class="form-group" >
                <input type="text" class="form-control"  value="{{ $EditProfiles->l3_label}}" name="l3_label" >
            </div>
        </div>
        <div class="form-group">
            <label >Status</label>
            <select class="form-control" name="active" required>
                <option>Status</option>
                <option value="Y" {{ ($EditProfiles->active == 'Y') ? 'selected' : '' }}>Yes</option>
                <option value="N" {{ ($EditProfiles->active == 'N') ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div style="padding: 1.25rem 9.25rem">
            <a href="/Profiles" class="btn btn-primary">Cancel</a>
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