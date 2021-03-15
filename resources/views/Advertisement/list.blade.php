@extends('layouts.app')

@section('content')
<div class="content-wrapper">

    <!-- Main content -->
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
                <h3 class="title-head">Advertisements</h3>
            </div>
            <div class="col-sm-3">
            </div>
            
        </div>
    </div>
    
    <div class="row">
     <div class="col-12">
       <div class="card"  style="margin-bottom: 0;">
        
        <div class="card-body" style="text-align: left; padding-top: 0;">
            <div class="row">
               <div class="col-md-2">
               </div>
               

               <div class="col-md-3">
                  <input type="date" name="#search" id="search" class="form-control">
              </div>
              <div class="col-md-3">
                  <input type="date" name="search1" id="search1" class="form-control">
              </div>
              <div class="col-md-2">
                <a class="btn btn-primary btn-md" style="float:right; font-family: sans-serif;" href="{{ route( 'add.advertisement' ) }}" ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add</a>         			  
            </div>
            <div class="col-md-2">
                <a  class="btn btn-primary btn-md"   style="float:right; font-family: sans-serif;" onclick="DeleteAll ()"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete All</a>
            </div>
        </div>
        
    </div>
</div>
<div class="card">
   <!-- /.card-header -->
   <div class="card-body"  style="padding-top: 0;">

       <table id="example1" class="table table-borderless">
          <thead>
           <tr>
             <th>Sl No</th>
             <th>Description</th>
             <th>Company</th>
             <th>Img</th>
             <th>Link</th>
             <th>Fr_Dt</th>
             <th>To_Dt</th>
             <th>Active</th>
             <th colspan="2">Action</th>
         </tr>
     </thead>

     <tbody>
        @foreach ($Advertisements as $i => $Advertisement)
        
        <tr>
         <td>{{ $i+1 }}</td>
         <td>{{ $Advertisement->description}}</td>
         <td>{{ $Advertisement->company }}</td> 
         @if($Advertisement->image_path!=null)
         <td>Yes</td> 
         @else
         <td>No</td> 
         @endif 

         @if($Advertisement->link!=null)
         <td>Yes</td> 
         @else
         <td>No</td> 
         @endif 

         <td>{{ $Advertisement->from_date}}</td>
         <td>{{ $Advertisement->to_date}}</td>

         @if($Advertisement->active=='Y')
         <td><span class="right badge badge-success">Yes</span></td>
         @else
         <td><span class="right badge badge-danger">No</span></td>
         @endif
         <td>
            <a href="{{ route( 'edit.advertisement', ['Advertisement' => $Advertisement->id]) }}"><span class="badge bg-danger"><i class="fas fa-edit"></i></span></a>
        </td>  
        
        <td>
            <a style="cursor: pointer;" onclick="Delete('{{$Advertisement->id}}')"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
        </td>

        
        
    </tr>
    @endforeach

</tbody>
</table>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
</div>
<script>
    function Delete	(value) {
      if (confirm("Are your sure you want to delete the notification?")) {
        $.ajax({
            type : 'get',
            url : '{{URL::to('notificationonly_delete')}}',
            data : {'notificationId':value},
            success:function(data){
              window.location.reload();
          } 
      });

    } else {
     
    }
}
</script>
<script>
    function DeleteAll() {
      if (confirm("Are your sure you want to delete all the record?")) {
        $.ajax({
            type : 'get',
            url : '{{URL::to('NotificationMassDelete')}}',
            data : {'notificationId':''},
            success:function(data){
              window.location.reload();
          } 
      });

    } else {
     
    }
}
</script>
@endsection