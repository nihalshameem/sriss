@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:30px">
    <div class="container-fluid">
     <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-1">
          <a href="/NewsLetter" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <h3 class="title-head">Newsletter</h3>
        </div>
        <div class="col-sm-3">
        </div>
        
      </div>
    </div><br>

    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
         
          <form role="form" method="post" class="col-md-6" action="{{ route('save.newsletter') }}" enctype="multipart/form-data" style="margin: 0 auto;">
            @csrf
            

            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <input type="text" class="form-control" name="description" placeholder="Enter Description" value="{{ old('description') }}" required>
              @error('description') <span style="color:red;">{{ $message }}</span> @enderror 
              
            </div>
            <div class="form-group">
              
             <label for="rank" class="cols-sm-2 control-label">Date</label>
             <div class="cols-sm-10">
              <div class="input-group">
               <input type="date"  id="txtDate" required="Required" class="form-control" name="Newsletter_date"/>
             </div>
           </div>

           
         </div>
         <div class="form-group">
          <label for="exampleInputFile2">Newsletter Path</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="Newsletter" id="exampleInputFile" accept="application/pdf , image/gif, image/jpeg ,image/gif, image/png" onchange="upload_check()" required>
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