@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
       <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="/NewsLetter" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-4">
            <h3 class="title-head">Edit Newsletter</h3>
        </div>
        <div class="col-sm-3">
        </div>
        
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="add-button" >
          <div class="row">
            <div class="col-md-4">
              
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-2">
              
            </div>
            <div class="col-md-2">
              
            </div>
        </div>
        
    </div>
    
    <form role="form" method="post" class="col-md-6" action="{{ route('update.newsletter') }}" enctype="multipart/form-data" style="margin: 0 auto;">
      @csrf
      <div class="card card-primary">
        

         
          

        <div class="form-group">
          <label for="exampleInputPassword1">Description</label>
          <input type="hidden" class="form-control" name="Newsletter_id" value="{{ $NewsLetter->Newsletter_id }}">

          <input type="text" class="form-control" name="Newsletter_desc" placeholder="Enter Description" value="{{ $NewsLetter->Newsletter_desc }}" required>
          
      </div>
      <div class="form-group">
          
         <label for="rank" class="cols-sm-2 control-label">Date</label>
         <div class="cols-sm-10">
            <div class="input-group">
               <input type="date" required="Required" class="form-control" name="Newsletter_date" value="{{ $NewsLetter->Newsletter_date }}"/>
           </div>
       </div>

       
   </div>
   <div class="form-group">
      <label>Uploaded File</label>
      <a href="{{ $NewsLetter->Newsletter}}" target="blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
  </div>

  <input type="hidden" value="{{ $NewsLetter->Newsletter}}" name="ImageNotification">
  <div class="form-group">
    <label for="exampleInputFile">Newsletter Path</label>
    <div class="input-group">
      <div class="custom-file">
        <input type="file" class="custom-file-input" name="Newsletter" id="exampleInputFile" accept="application/pdf , image/gif, image/jpeg ,image/gif, image/png" onchange="upload_check()">
        <label class="custom-file-label"  for="exampleInputFile">Choose file</label>
    </div>
    <div class="input-group-append">
        <span class="input-group-text" id="">Upload</span>
    </div>
</div>
</div>
</div>
  <div style="max-width: 200px; margin: auto; margin-bottom: 20px;">
    <a href="/NewsLetter" class="btn btn-primary">Cancel</a>
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