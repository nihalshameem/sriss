@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:15px">
    <div class="container-fluid">

      <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="/Notifications" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -5px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
          </div>
          <div class="col-sm-3">
            
          </div>
          <div class="col-sm-4">
            <h3 class="title-head">Add Notifications</h3>
          </div>
          <div class="col-sm-3">
          </div>
          
        </div>
      </div><br>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            
            <form role="form" method="post" class="col-md-10" action="{{ route('save.notification') }}" enctype="multipart/form-data" style="margin:0 auto">
              @csrf
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
              <div class="row">
                <div class="col-md-6">
                 <div class="form-group">
                  <label for="exampleInputPassword1">Start Date</label>
                  <input type="date" class="form-control" name="start_date"  value="{{{ $Notifications->Notification_start_date ?? '' }}}"  required>
                </div>
              </div>
              <div class="col-md-6">
               <div class="form-group">
                <label for="exampleInputPassword1">End Date</label>
                <input type="date" class="form-control" name="end_date"  value="{{{ $Notifications->Notification_end_date  ?? '' }}}" required>
                
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Message</label>
            <textarea class="form-control" name="message" placeholder="Enter Message" required>{{{ $Notifications->Notification_mesage  ?? '' }}}</textarea>
            
          </div>
          
          <div class="form-group">
            <label for="exampleInputFile">Notification Image Path</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="NotificationPath" id="exampleInputFile2" accept=" image/gif, image/jpeg ,image/png" onchange="upload_check2()">
                <label class="custom-file-label"  for="exampleInputFile2">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text" id="">Upload</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Active</label>
              </div>
              <!-- checkbox -->
              <div class="form-group clearfix">
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary11" value="Y" name="active" checked="">
                  <label for="checkboxPrimary11">Yes
                  </label>
                </div>
                
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary12" value="N"  name="active" >
                  <label for="checkboxPrimary12">
                    No
                  </label>
                </div>
              </div>
            </div>

            
            <div class="col-sm-6">
              <div class="form-group">
                <label>Approved</label>
              </div>
              <!-- checkbox -->
              <div class="form-group clearfix">
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary1" value="Y" name="approve" checked="">
                  <label for="checkboxPrimary1">Yes
                  </label>
                </div>
                
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary2" value="N"  name="approve" >
                  <label for="checkboxPrimary2">
                    No
                  </label>
                </div>
              </div>
            </div>
          </div>
          
          
          <div style="max-width: 200px; margin: auto;">
            <a href="/Notifications" class="btn btn-primary">Cancel</a>
            <button type="submit" class="btn btn-primary">Next</button>
          </div><br><br>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</section>
</div>
@endsection