@extends('layouts.app')

@section('content')
<div class="content-wrapper">

 <!-- Main content -->
 <section class="content" style="padding-top:25px">
     <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="/home" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -12px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-3">
            
        </div>
        <div class="col-sm-2">
            <h3 class="title-head">About us</h3>
        </div>
        <div class="col-sm-5">
            
        </div>
        
    </div>
</div>
<form method="post" class="was-validated" action="{{ route('save.aboutus') }}" style="margin:0 auto;">
    @csrf
    <div class="row">
     <input type="hidden" name="AboutUsId" value="{{$AboutUs->Aboutus_id}}" enctype="multipart/form-data">
     <div class="col-md-12">
         
      <div class="box">
        <div class="box-header">
           
            <!-- /.box-header -->
            <div class="box-body pad">
                <textarea class="textarea form-control"  name="description"  placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{!! html_entity_decode($AboutUs->Aboutus_description) !!}</textarea>
                <div class="invalid-feedback" style="font-size:25px;font-weight: bold">
                    Please enter  description
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>
<div style="padding: 1.75rem 24.25rem">
    <a href="/home" class="btn btn-primary">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>

<!-- ./row -->
</section>
<!-- /.content -->
</div>
@endsection
