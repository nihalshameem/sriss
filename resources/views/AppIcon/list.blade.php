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
            <h3 class="title-head">App Icon</h3>
          </div>
          <div class="col-sm-3">
            
          </div>
          
        </div>
      </div>
      <div class="row">
        <div class="col-1">
        </div>
        <div class="col-10">
          <div class="table-responsive">
            <table id="example1" class="table" >
              <thead>
                <tr>
                  <th>Sl No</th>
                  <th>Default Language</th>
                  <th>2nd Language</th>
                  <th>3rd Language</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($AppIcon as $i => $appIcon)
                <tr>
                  <td>{{ $i+1 }}</td>
                  <td>{{ $appIcon->L1_text }}</td>
                  <td>{{ $appIcon->L2_text }}</td>
                  <td>{{ $appIcon->L3_text }}</td>
                  <td><img src="{{ $appIcon->AppIcon_image_path }}" width="120px" height="60px"></td>
                  <td><span class="badge bg-success">{{ $appIcon->AppIcon_visible }}</span></td>
                  
                  <td>
                   <a href="{{ route('edit.appIcon', ['AppIconId' => $appIcon->AppIcon_id]) }}"><span class="badge bg-danger"><i class="fa fa-edit fa-lg" style="text-align:center;"></i>&nbsp;&nbsp;Edit</span></a>
                 </td>
               </tr>
               @endforeach

               

             </tbody>
           </table>
         </div>

       </div>
       <!-- /.col -->
     </div>
   </div> 
 </section>
</div>

@endsection