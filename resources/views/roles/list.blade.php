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
            <h3 class="title-head">Add User</h3>
          </div>
          <div class="col-sm-2">
          
          </div>
        
      </div>
        </div>
     <!-- ./row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary ">
         
         
        <div class="row">
        <div class="col-2 col-sm-2 col-lg-2">
        </div>
        
          <div class="col-12 col-sm-6 col-lg-8">
            <div class="card card-primary">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist" style="border-top:1px solid #ffffb7">
                  <li class="nav-item">
                    <a class="nav-link active" id="statedivision-tabs-tab" data-toggle="pill" href="#statedivision-tabs" role="tab" aria-controls="statedivision-tabs" aria-selected="true" style="color:#8f3319;font-weight:bold">Add Roles</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="greater-zones-tabs" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false" style="color:#8f3319;font-weight:bold">Add Permissions</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-user" data-toggle="pill" href="#custom-tabs-users" role="tab" aria-controls="custom-tabs-user" aria-selected="false" style="color:#8f3319;font-weight:bold">Add Users</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-role" data-toggle="pill" href="#custom-tabs-roles" role="tab" aria-controls="custom-tabs-roles" aria-selected="false" style="color:#8f3319;font-weight:bold">Assign Permissions</a>
                  </li>
                 
                  
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="statedivision-tabs" role="tabpanel" aria-labelledby="statedivision-tabs-tab">

                      <div class="row">
            <div class="col-1">
            </div>
             <div class="col-10">
              <a  class="btn btn-primary btn-md" data-toggle="modal" data-target="#AddRole" style="float:right; margin-bottom: 20px" ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add Role
              </a>

                <div class="table-responsive">
                <table id="example1" class="table" >
                  <thead>
                  <tr>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th colspan="2">Action</th>
                  </tr>
                </thead>
                <tbody>
            @foreach ($Roles as $i => $role)
            <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $role->name }}</td>
             <td>
                <a href="{{ route('edit.role', ['RoleId' => $role->id]) }}" ><span class="badge bg-danger"><i class="fas fa-edit"></i>&nbsp;</span></a>
              </td>
               <td>
                <a style="cursor: pointer;" onclick="DeleteRole('{{$role->id}}')"><span class="badge bg-danger"><i class="fas fa-trash"></i>&nbsp;</span></a>
            </td> 
             
             
         </tr>
        @endforeach

          

      </tbody>
    </table>
  </div>

  </div>
  <!-- /.col -->
  </div>
    <div class="modal fade" id="AddRole" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="text-align:left">Add Roles</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form role="form" method="post" action="{{ route('add.roles') }}" enctype="multipart/form-data" >
              @csrf
        <div class="modal-body">
                <div class="form-group">
                      <label for="exampleInputPassword1">Role</label>
                      <input type="text" class="form-control" name="role" placeholder="Enter Description" value="{{ old('role') }}" required>
                     
                </div>    
            
        </div>
        <div class="modal-footer">
          <button type="submit"  class="btn btn-primary" value="Submit">Submit</button>
          <button type="button"  class="btn btn-primary" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
                   
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="greater-zones-tabs">


                      <div class="row">
            <div class="col-1">
            </div>
             <div class="col-10">
              <a  class="btn btn-primary btn-md" data-toggle="modal" data-target="#Addpermission" style="float:right; margin-bottom: 20px;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add Permission
              </a>
                <div class="table-responsive">
                <table id="example1" class="table" >
                  <thead>
                  <tr>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th colspan="2">Action</th>
                  </tr>
                </thead>
                <tbody>
            @foreach ($permissions as $i => $permission)
            <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $permission->name }}</td>
            <td><a  href="{{ route('edit.Permission', ['PermissionId' => $permission->id]) }}"><span class="badge bg-danger"><i class="fas fa-edit"></i>&nbsp;</span></a></td>
            <td>
                <a style="cursor: pointer;" onclick="DeletePermission('{{$permission->id}}')"><span class="badge bg-danger"><i class="fas fa-trash"></i>&nbsp;</span></a>
            </td> 
             
            
         </tr>
        @endforeach

          

      </tbody>
    </table>
  </div>

  </div>
  <!-- /.col -->
  </div>

   <!-- Modal -->
  <div class="modal fade" id="Addpermission" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="text-align:left">Add Permissions</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form role="form" method="post" action="{{ route('add.permission') }}" enctype="multipart/form-data" >
              @csrf
        <div class="modal-body">
        
                <div class="form-group">
                      <label for="exampleInputPassword1">Permission</label>
                      <input type="text" class="form-control" name="permission" placeholder="Enter Permission" value="{{ old('permission') }}" required>
                     
                </div>    
            
        </div>
        <div class="modal-footer">
          <button type="submit"  class="btn btn-primary" value="Submit">Submit</button>
          <button type="button"  class="btn btn-primary" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
                   
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-users" role="tabpanel" aria-labelledby="custom-tabs-user">
                      <div class="row">
            <div class="col-1">
            </div>
             <div class="col-12">
              
                  <div class="add-button" >
            
              <a  class="btn btn-primary btn-md" href="{{route('add.user')}}" style="float:right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add 
            </a>
            </div>
            
                <table id="example1" class="table" >
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Role</th>
                    <th>Action</th>
                     <th>Remove Role</th>
                  </tr>
                </thead>
                <tbody>
            @foreach ($Members as $i => $Member)
            <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $Member->users->name }}</td>
            <td>{{ $Member->users->email }}</td>
            <td>{{ $Member->users->mobile_number }}</td>
            <?php
              $user_role = App\Models\Role::where('id',$Member->role_id)->first();
            ?>
            @if($user_role!=null)
            <td>{{$user_role->name}}</td>
            @else
            <td></td>
            @endif
             <td>
                        <a href="{{ route('edit.user', ['UserId' => $Member->users->id]) }}"><span class="badge bg-danger"><i class="fas fa-edit"></i>&nbsp;</span></a>
                    </td>
            <td>
               <a style="cursor: pointer;" onclick="RemoveRole('{{$Member->users->id}}')"><span class="badge bg-danger"><i class="fas fa-trash"></i>&nbsp;</span></a>
            </td>
             
         </tr>
        @endforeach

          

      </tbody>
    </table>

  </div>
  <!-- /.col -->
  </div>

                      <!--- add User-->

 
  </div>
  <div class="tab-pane fade" id="custom-tabs-roles" role="tabpanel" aria-labelledby="custom-tabs-roles">
      <div class="table-responsive">
                <table id="example1" class="table" >
                  <thead>
                  <tr>
                    <th>Sl No</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
            @foreach ($Roles as $i => $role)
            <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $role->name }}</td>
             <td>
                <a href="{{ route('edit.Privilleges', ['PrivillegeId' => $role->id]) }}"><span class="badge bg-danger"><i class="fas fa-edit"></i>&nbsp;</span></a>
              </td>
             
         </tr>
        @endforeach

          

      </tbody>
    </table>
  </div>

  </div>
</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
</div>

<script>
function DeletePermission (value) {
  if (confirm("Are your sure you want to delete the permission")) {
    $.ajax({
                type : 'get',
                url : '{{URL::to('Permission/Delete')}}',
                data : {'permissionId':value},
                success:function(data){
                  window.location.reload();
                } 
              });

  } else {
   
  }
}
</script>
<script>
function DeleteRole (value) {
  if (confirm("Are your sure you want to delete the role")) {
    $.ajax({
                type : 'get',
                url : '{{URL::to('Role/Delete')}}',
                data : {'RoleId':value},
                success:function(data){
                  window.location.reload();
                } 
              });

  } else {
   
  }
}
</script>
<script>
function RemoveRole (value) {
  if (confirm("Are your sure you want to remove the user role")) {
    $.ajax({
                type : 'get',
                url : '{{URL::to('User/RemoveRole')}}',
                data : {'RoleId':value},
                success:function(data){
                  window.location.reload();
                } 
              });

  } else {
   
  }
}
</script>
@endsection