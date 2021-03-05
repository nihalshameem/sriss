@extends('layouts.app')
@section('content')
 <div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
 
         <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="/User" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -10px;margin-left: -24px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
          </div>
          <div class="col-sm-3">
          </div>
          <div class="col-sm-5">
            <h3 class="title-head">Edit Permission</h3>
          </div>
          <div class="col-sm-2">
          </div>
        
      </div>
        </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
         
            <form role="form" method="post" class="col-md-6" action="{{ url('Privilleges/Update') }}" enctype="multipart/form-data" style="margin:0 auto;">
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

                      <label for="exampleInputPassword1">Role</label>
                      <input type="text" class="form-control"  value="{{$Roles->name}}" disabled>  
                     
                </div>
                <div class="row">
                @foreach($role_permissions as $role_permission) 

                      <?php
                          $permissionschecked  = App\Models\Permission::where('id',$role_permission->permission_id)->get();
                      ?>
                      @foreach($permissionschecked as $permissionschecked) 

                 <div class="col-md-4 form-group">
                     
                        <input type="checkbox" name="permission[]"  value="{{ $permissionschecked->id}}" id="permission" checked>&nbsp;&nbsp;{{ $permissionschecked->name}}<br>
                        <?php
                          $user  = App\Models\User::where('name',Session::get('name'))->first();
                      ?>
                        <input type="hidden" class="form-control"  value="{{$Roles->id}}" name="role_id[]">  
                      
                      
                     
                      
                </div>
                @endforeach
                          

                      @endforeach
                      <?php
                          $permissionsUnchecked  = App\Models\Permission::whereNotIn('id',$role_permissionspluck)->get();
                      ?>
                       @foreach($permissionsUnchecked as $permissions) 
                       <div class="col-md-4 form-group">
                      <input type="checkbox" name="permission[]"  value="{{ $permissions->id}}" id="permission" >&nbsp;&nbsp;{{ $permissions->name}}<br>
                      <?php
                          $user  = App\Models\User::where('name',Session::get('name'))->first();
                      ?>
                      <input type="hidden" class="form-control" name="user_id[]" value="{{$user->id}}">
                      <input type="hidden" class="form-control"  value="{{$Roles->id}}" name="role_id[]"> 
                      </div> 
                      @endforeach
                    </div>

               <div style="max-width: 200px; margin: auto;">
                      <a href="/User" class="btn btn-primary">Cancel</a>
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