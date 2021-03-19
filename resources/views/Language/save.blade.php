@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
        <div class="col-12">

            <div class="row mb-2">
              <div class="col-sm-2">
                <a href="/language" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
            </div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-4">
                <h3 class="title-head">Edit Language</h3>
            </div>
            <div class="col-sm-3">
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            
            <form role="form" method="post" class="col-md-6 was-validated" action="{{ route('update.language') }}" enctype="multipart/form-data" style="margin: 0 auto;padding-top: 30px;padding-bottom:20px">
              @csrf
           <div class="form-group">
          <label for="exampleInputPassword1">Language</label>
          <input type="hidden" class="form-control" name="Language_id" value="{{ $language->Language_id }}">

          <input type="text" class="form-control" name="Language_name" placeholder="Enter Language" value="{{ $language->Language_name }}" required>
          
      </div>
<div class="form-group">
  <label >Status</label><br>
  <div class="icheck-primary d-inline">
    <input type="radio" id="checkboxPrimary11" value="D" name="active" {{ ($language->Language_active == "D") ? 'checked' : '' }}>
    <label for="checkboxPrimary11">Default
    </label>
</div>

<div class="icheck-primary d-inline">
    <input type="radio" id="checkboxPrimary12" value="N"  name="active" {{ ($language->Language_active == "N") ? 'checked' : '' }}>
    <label for="checkboxPrimary12">
      No
  </label>
</div>
</div>
<div style="padding: 1.75rem 9.25rem">
  <a href="/languageLock" class="btn btn-primary">Cancel</a>
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