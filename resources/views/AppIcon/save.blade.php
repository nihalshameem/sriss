@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
        <div class="col-12">

            <div class="row mb-2">
              <div class="col-sm-2">
                <a href="/appIcon" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
            </div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-4">
                <h3 class="title-head">Edit App Icon</h3>
            </div>
            <div class="col-sm-3">
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            
            <form role="form" method="post" class="col-md-9 was-validated" action="{{ route('save.appIcon') }}" enctype="multipart/form-data" style="margin: 0 auto;padding-top: 30px;padding-bottom:20px">
              @csrf
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>Icon Name</label>
                  <input type="hidden" name="App_Icon_id" value="{{$AppIconEdit->AppIcon_id}}">
                  <select class="form-control" name="App_Icon_id" disabled>
                    <option value="">Select Icon</option>
                    @if(isset($AppIcon))
                    @foreach($AppIcon as $appIcon) 
                    <option value="{{$appIcon->AppIcon_id}}" {{ ($AppIconEdit->AppIcon_text == $appIcon->AppIcon_text ) ? 'selected' : '' }}>{{ $appIcon->AppIcon_text}}</option>
                    @endforeach
                    @endif
                }
            </select>
        </div>
       
        <div class="col-md-6 form-group">
          <label >Icon Path</label>
          <div class="input-group" >
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="AppIconPath" accept=" image/gif, image/jpeg ,image/png">
                <label class="custom-file-label">Choose file</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text" id="">Upload</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 form-group"><br>
  <label>Uploaded Image</label>
  
  <img src="{{ $AppIconEdit->AppIcon_image_path}}" width="100px" height="50px">
  
</div>
</div>

<div class="row">

   <div class="col-md-6 form-group">
    <label >English Text</label>
    <input type="text" class="form-control" value="{{ $AppIconEdit->L1_text}}" name="l1_text">
</div>
<div class="col-md-6 form-group">
    <label >Tamil Text</label>
    
    <input type="text" class="form-control"  value="{{ $AppIconEdit->L2_text}}" name="l2_text">
    
</div>
<div class="col-md-6 form-group">
    <label >Hindi Text</label>
    
    <input type="text" class="form-control"  value="{{ $AppIconEdit->L3_text}}" name="l3_text">
    
</div>
</div>
<div class="form-group">
  <label >Status</label><br>
  <div class="icheck-primary d-inline">
    <input type="radio" id="checkboxPrimary11" value="Y" name="App_Icon_status" {{ ($AppIconEdit->AppIcon_visible == "Y") ? 'checked' : '' }}>
    <label for="checkboxPrimary11">Yes
    </label>
</div>

<div class="icheck-primary d-inline">
    <input type="radio" id="checkboxPrimary12" value="N"  name="App_Icon_status" {{ ($AppIconEdit->AppIcon_visible == "N") ? 'checked' : '' }}>
    <label for="checkboxPrimary12">
      No
  </label>
</div>
</div>
<div style="padding: 1.75rem 9.25rem">
  <a href="/appIcon" class="btn btn-primary">Cancel</a>
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