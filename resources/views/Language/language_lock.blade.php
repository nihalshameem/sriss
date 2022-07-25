@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
     
      <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-5">
          </div>
          <div class="col-sm-4">
            <h3 class="title-head">Language Lock</h3>
          </div>
          <div class="col-sm-3">
          </div>
          
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            
            <form role="form" method="post" class="col-md-6" action="{{ route('save.languageLock') }}" style="margin:0 auto;" >
              @csrf
              <div class="form-group" style="max-width: 200px; margin: auto;">
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary11" value="Y" name="Language_lock" {{ ($Languages->Language_lock == "Y") ? 'checked' : '' }}>
                  <label for="checkboxPrimary11">Yes
                  </label>
                </div>
                
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary12" value="N"  name="Language_lock" {{ ($Languages->Language_lock == "N") ? 'checked' : '' }}>
                  <label for="checkboxPrimary12">
                    No
                  </label>
                </div>
              </div><br>
              
              <div style="max-width: 200px; margin: auto;">
                <a href="/home" class="btn btn-primary">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection