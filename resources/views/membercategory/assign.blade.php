@extends('layouts.app')
@section('content')
 <div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
 
         <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="/MemberCategory" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -10px;margin-left: -24px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
          </div>
          <div class="col-sm-3">
          </div>
          <div class="col-sm-5">
            <h3 class="title-head">Assign App Icon</h3>
          </div>
          <div class="col-sm-2">
          </div>
        
      </div>
        </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
         
            <form role="form" method="post" class="col-md-8" action="{{ route('Assign.MemberCategory.Update') }}" enctype="multipart/form-data" style="margin:0 auto;">
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
                 <div class="form-group">

                      <label for="exampleInputPassword1">Member Category</label>
                      <input type="text" class="form-control"  value="{{$membercategory->Category}}" disabled>  
                     
                </div>
                <div class="row">

                      <?php
                          $AppIconschecked  = App\Models\MemberCategoryAppIcon::where('Category_id',$membercategory->MemberCategory_id)->pluck('AppIcon_Id');

                          $AppIcon  = App\Models\AppIcon::whereIn('AppIcon_id',$AppIconschecked)->get();
                      ?>
                      @foreach($AppIcon as $AppIconschecked) 
                         <div class="col-md-4 form-group">
                                <input type="checkbox" name="AppIcon[]"  value="{{ $AppIconschecked->AppIcon_id}}" id="permission" checked>&nbsp;&nbsp;{{ $AppIconschecked->L1_text}}<br>
                        </div>
                        <input type="hidden" class="form-control"  name="categoryId[]" value="{{$membercategory->MemberCategory_id}}"> 
                      @endforeach
                      <?php
                        $AppIconsUnchecked  = App\Models\MemberCategoryAppIcon::where('Category_id',$membercategory->MemberCategory_id)
                        ->pluck('AppIcon_id');
                         $AppIcon  = App\Models\AppIcon::whereNotIn('AppIcon_id',$AppIconsUnchecked)->get();

                      ?>
                       @foreach($AppIcon as $AppIconsUnchecked) 

                
                       <div class="col-md-4 form-group">
                      <input type="checkbox" name="AppIcon[]"  value="{{ $AppIconsUnchecked->AppIcon_id}}" id="permission" >&nbsp;&nbsp;{{ $AppIconsUnchecked->L1_text}}<br>
                      </div> 
                      <input type="hidden" class="form-control"  name="categoryId[]" value="{{$membercategory->MemberCategory_id}}"> 
                      @endforeach
                    </div>

               <div style="max-width: 200px; margin: auto;">
                      <a href="/MemberCategory" class="btn btn-primary">Cancel</a>
                      <button type="submit" class="btn btn-primary">Submit</button>
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