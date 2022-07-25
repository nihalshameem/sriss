@extends('layouts.app')
@section('content')
 <div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
 
         <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="/User" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -12px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
          </div>
          <div class="col-sm-3">
          </div>
          <div class="col-sm-5">
            <h3 class="title-head">Edit User</h3>
          </div>
          <div class="col-sm-2">
          </div>
        
      </div>
        </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
         
            <form role="form" method="post" class="col-md-6" action="{{ url('Update') }}" enctype="multipart/form-data" style="margin:0 auto;">
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
         <input type="hidden" class="form-control" name="Id" placeholder="Enter Name" value="{{ $User->id }}" required>
                 <div class="form-group">
                      <label for="exampleInputPassword1">Name</label>

                      <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $User->name }}" required>
                     
                </div>
                <div class="form-group">
                      <label for="exampleInputPassword1">Email</label>
                      <input type="text" class="form-control" name="email" placeholder="Enter Email" value="{{$User->email}}" required>
                     
                </div>
                <div class="form-group">
                      <label for="exampleInputPassword1">Mobile Number</label>
                      <input type="text" class="form-control" name="mobile_number" placeholder="Enter Mobile" value="{{$User->mobile_number}}" required>
                     
                </div>
             
                 
                <div class="form-group">
                      <label for="exampleInputPassword1">Roles</label>
                       <select class="form-control" name="roles" required>
                            <option value="">Select Role</option>
                            @if($Roles)
                               @if(isset($Role))
                                 @foreach($Role as $Role) 
                                  <option value="{{$Role->id}}" {{ ($Role->id == $Roles->role_id) ? 'selected' : '' }}>{{ $Role->name}}</option>
                                 @endforeach
                             @endif
                             @else
                             @if(isset($Role))
                                 @foreach($Role as $Role) 
                                  <option value="{{$Role->id}}">{{ $Role->name}}</option>
                                 @endforeach
                             @endif
                             @endif
                      </select>
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