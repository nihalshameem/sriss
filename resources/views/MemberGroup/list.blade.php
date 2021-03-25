@extends('layouts.app')

@section('content')
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content" style="padding-top:25px">
   <div class="container-fluid">

     <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="/home" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -12px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-5">
          <h3 class="title-head">Member Group</h3>
        </div>
        <div class="col-sm-2">
          
        </div>
        
      </div>
    </div>
    
    <div class="row">
     <div class="col-12">
       <div class="card">
         <!-- /.card-header -->
         
         <div class="card-body" style="padding-top: 0px;">
          <div class="row">
           <div class="col-md-2 form-group" style="display: flex; justify-content: flex-start;">
             
           </div>
           
           <div class="col-md-3 form-group">
            
          </div>
          <div class="col-md-3 form-group">
            
          </div>
          <div class="col-md-2 form-group">
           <!--- <a  class="btn btn-primary btn-md" href="{{ route('truncate.polls') }}"  style="float:right"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete All</a>-->
         </div>

         <div class="col-md-2">
           <div class="add-button" >
            <a class="btn btn-primary btn-md" style="float:right" href="{{ route('add.memberGroup') }}" ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add Group</a> 
          </div>
        </div>
      </div>
      
      <table id="example1" class="table table-borderless">
        <thead>
         <tr>
           <th>Sl No</th>
           <th>Group Name</th>
           <th>Active</th>
           <th colspan="3">Action</th>
           
         </tr>
       </thead>
       <tbody>
        @foreach ($membersGroup as $i => $membersGroup)
        <tr>
         <td>{{ $i+1 }}</td>
         <td><a href="{{ route('list.groupMembers', ['GroupId' => $membersGroup->Group_id]) }}">{{ $membersGroup->Group_name }}</a></td>
         <td>{{ $membersGroup->active }}</td>
         <td>
          <a href="{{ route('edit.memberGroup', ['memberGroupId' => $membersGroup->Group_id]) }}"><span class="badge bg-danger"><i class="fa fa-edit fa-lg" style="text-align:center;"></i></span></a>
        </td>
        <td>
          <a onclick="Delete('{{$membersGroup->Group_id}}')" style="cursor: pointer;"><span class="badge bg-danger"><i class="fa fa-trash fa-lg" style="text-align:center;cursor: pointer;"></i></span></a>
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
<br>
<script>
  function Delete	(value) {
    if (confirm("Are your sure you want to delete the Group ?")) {
      $.ajax({
        type : 'get',
        url : '{{URL::to('DeleteMemberGroup')}}',
        data : {'Group_id':value},
        success:function(data){
          window.location.reload();
        } 
      });

    } else {
     
    }
  }
</script>

@endsection