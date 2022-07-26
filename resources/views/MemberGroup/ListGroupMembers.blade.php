@extends('layouts.app')

@section('content')
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content" style="padding-top:25px">
   <div class="container-fluid">

     <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="/memberGroup" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -12px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-5">
          <h3 class="title-head">List Group Members</h3>
        </div>
        <div class="col-sm-2">
          
        </div>
        
      </div>
    </div>
    <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-5">
          <h5 class="title-head">Group Name : {{$memberGroups->Group_name}}</h5>
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

      
      <table id="example1" class="table table-borderless">
        <thead>
         <tr>
           <th>Sl No</th>
           <th>Name</th>  
           <th>Member Id</th>
           <th>Mobile No.</th>
           <th>Delete</th>
                    
         </tr>
       </thead>
       <tbody>
        @foreach ($members as $i => $member)
        
        <tr>
         <td>{{ $i+1 }}</td>
         <td>{{ $member->First_Name }} {{ $member->Last_Name}}</td>
         <td>{{ $member->Member_Id }}</td>
         <td>{{ $member->Mobile_No }}</td>
         <td>
            <a style="cursor: pointer;" onclick="Delete('{{ $member->Member_Id }}','{{$memberGroups->Group_id}}')"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
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
    function Delete (value1,value2) {

      if (confirm("Are your sure you want to delete this member?")) {
        $.ajax({
            type : 'get',
            url : '{{URL::to('groupMemberOnly_delete')}}',
            data : {'member_id':value1,'group_id':value2,},
            success:function(data){

              window.location.reload();
          } 
      });

    } else {
     
    }
}
</script>

@endsection