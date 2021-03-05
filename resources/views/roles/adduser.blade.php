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
            <h3 class="title-head">Add user</h3>
          </div>
          <div class="col-sm-2">
          </div>
        
      </div>
        </div>
        <form role="form" method="post" action="{{ route('add.admin') }}" enctype="multipart/form-data" >
              @csrf 
    <div class="card">
        <!-- /.card-header -->

        <div class="card-body">
          <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-3">
              <select name="usersearch" id="mobile_number" class="selectpicker form-control usersearch"  data-live-search="true" >
                  <option value="">Mobile Number</option>
                  @foreach ($Member as $member)
                
                     <option value="{{ $member->Mobile_No }} ">{{ $member->Mobile_No }}
                     </option>
                  @endforeach 
              </select>
            </div>
            <div class="col-md-3">
              <select name="usersearch" id="member_id" class="selectpicker form-control usersearch"  data-live-search="true">
                  <option value="">Email</option>
                    @foreach ($Member as $member)
                  
                     <option value="{{ $member->Email_Id }} " >{{ $member->Email_Id }} 
                     </option>
                    @endforeach 
                </select>
            </div>
            <div class="col-md-3">
              <select name="usersearch" id="member_id" class="selectpicker form-control usersearch"  data-live-search="true">
                          <option value="">Member Id</option>
                          @foreach ($Member as $member)
                        
                           <option value="{{ $member->Member_Id }} ">{{ $member->Member_Id }}
                           </option>

                          @endforeach 
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-2">
              
            </div>
            <div class="col-md-3">
                <div class="form-group" id="memname">
                  <div id="label">
                      <label class="control-label" for="membername">Member Name :</label>
                  </div>
                  <div id="membername" >
                      <input type="text" class="form-control" name="membername" value="" readonly>
                  </div>
                  <input type="hidden" class="form-control" name="memberid" value="">
                </div>
              </div>
              <div class="col-md-3">
                 <div class="form-group">
                      <label for="exampleInputPassword1">Roles</label>
                       <select class="form-control" name="roles" required>
                            <option value="">Select Role</option>
                            @if($Roles)
                                 @foreach($Roles as $Role) 
                                  <option value="{{$Role->id}}">{{ $Role->name}}</option>
                                 @endforeach
                            
                             @endif
                      </select>
                </div>
              </div>
              <div class="col-md-3" style="margin-top:33px">
                 <div class="form-group">
                      <input class="btn btn-primary" type="Submit" name="submit" value="Submit">
                </div>
              </div>
            </div>
        </div>
    </div>
  </form>

</section>
</div>
@endsection