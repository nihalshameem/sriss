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
            <h3 class="title-head">Member Category</h3>
          </div>
          <div class="col-sm-3">
            
          </div>
          
        </div>
      </div>

      <div class="row">
               <div class="col-md-2">
               </div>
               

               <div class="col-md-3">
              </div>
              <div class="col-md-3">
              </div>
              <div class="col-md-2">
                <a class="btn btn-primary btn-md" style="float:right; font-family: sans-serif;" href="{{ route( 'MemberCategory.Add' ) }}" ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add</a>                
            </div>
            <div class="col-md-2">
                
            </div>
        </div><br>
           <div class="row"> 
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
      @if($errors->any())
      <div class="alert alert-danger" role="alert">
  <h6>{{$errors->first()}}</h6>
</div>

@endif
</div>
<div class="col-md-3">
</div>
</div><br>
      <div class="row">
        <div class="col-1">
        </div>
        <div class="col-10">
          <div class="table-responsive">
            <table id="example1" class="table" >
              <thead>
                <tr>
                  <th>Sl No</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th>Assign</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($membercategory as $i => $membercategory)
                <tr>
                  <td>{{ $i+1 }}</td>
                  <td>{{ $membercategory->Category }}</td> 
                  <td><span class="badge bg-danger">{{ $membercategory->Category_active }}</span>
                  </td> 
                  <td>
                   <a href="{{ route('Assign.MemberCategory.Edit', ['CategoryId' => $membercategory->MemberCategory_id]) }}"><span class="badge bg-success"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;&nbsp;App Icon</span></a>
                 </td>                
                  <td>
                   <a href="{{ route('MemberCategory.Edit', ['CategoryId' => $membercategory->MemberCategory_id]) }}"><span class="badge bg-success"><i class="fa fa-edit fa-lg" style="text-align:center;"></i>&nbsp;&nbsp;Edit</span></a>
                 </td>
                 
                 <td>
                   <a href="{{ route('MemberCategory.Delete', ['CategoryId' => $membercategory->MemberCategory_id]) }}"><span class="badge bg-danger"><i class="fa fa-trash fa-lg" style="text-align:center;"></i>&nbsp;&nbsp;Delete</span></a>
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