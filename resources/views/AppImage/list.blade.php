@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">

        <div class="col-12">

            <div class="row mb-2">
              <div class="col-sm-2">
                <a href="/home" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
            </div>
            <div class="col-sm-3">
                
            </div>
            <div class="col-sm-4">
                <h3 class="title-head">App Image</h3>
            </div>
            <div class="col-sm-3">
                
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-1">
        </div>
        <div class="col-10">
          
            <table id="example1" class="table table-borderless" >
              <thead>
                  <tr>
                    <th>Sl No</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($AppImage as $i => $appImage)
              <tr>
                  <td>{{ $i+1 }}</td>
                  <td>{{ $appImage->App_image_cat_name }}</td>
                  <td>
                   <a href="{{ route('list.appImage', ['imageId' => $appImage->App_image_cat_id]) }}"><span class="badge bg-danger"><i class="fa fa-edit fa-lg" style="text-align:center;"></i>&nbsp;&nbsp;Edit</span></a>
               </td>
               
           </tr>
           @endforeach

           

       </tbody>
   </table>

</div>
<!-- /.col -->
</div>
</div> 
</section>
</div>
@endsection