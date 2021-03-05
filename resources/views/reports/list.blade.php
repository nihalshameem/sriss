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
        <div class="col-sm-3">
          <h3 class="title-head">Reports View & Download</h3>
        </div>
        <div class="col-sm-5">
        </div>
        
      </div>
    </div>
    <?php

    $user = App\Models\User::where('name',Session::get('name'))->first();
    $role = App\Models\UserRoles::where('user_id',$user->id)->first();
    ?>
    <!-- Info boxes -->
    <div class="row">
      @if($role->hasPermission('22',$role->role_id))
      <div class="col-12 col-sm-6 col-md-3">
        <a href="{{ route('MembersList') }}" style="color:black">
          <div class="info-box mb-3">
            <span class="info-box-icon"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Members</span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div></a>
          <!-- /.info-box -->
        </div>
        @endif
        @if($role->hasPermission('23',$role->role_id))
        <div class="col-12 col-sm-6 col-md-3">
         <a href="{{ route('ContributionDetailsSelf') }}" style="color:black">
          <div class="info-box mb-3">
            <span class="info-box-icon"><i class="fas fa-donate"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Online Contributions</span>
              <span class="info-box-number"><small></small></span>
            </div>


            <!-- /.info-box-content -->
          </div></a>

          <!-- /.info-box -->
        </div>
        @endif
        
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        @if($role->hasPermission('24',$role->role_id))
        <div class="col-12 col-sm-6 col-md-3">
         <a href="{{ route('OfflineCollection') }}" style="color:black">
          <div class="info-box mb-3">
            <span class="info-box-icon"><i class="fas fa-donate"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Offline Contributions</span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
        <!-- /.info-box -->
      </div>
      @endif
      @if($role->hasPermission('25',$role->role_id))
      <div class="col-12 col-sm-6 col-md-3">
        <a href="{{ route('reports.MemberDeactivation') }}" style="color:black">
          <div class="info-box mb-3">
            <span class="info-box-icon"><i class="fas fa-user-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Member Deactivation</span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
        <!-- /.info-box -->
      </div>
      @endif
      @if($role->hasPermission('26',$role->role_id))
      <div class="col-12 col-sm-6 col-md-3">
        <a href="{{ route('reports.DueReports') }}" style="color:black">
          <div class="info-box mb-3">
            <span class="info-box-icon"><i class="fas fa-user-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Due Reports</span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
        <!-- /.info-box -->
      </div>
      @endif
      @if($role->hasPermission('28',$role->role_id))
      <div class="col-12 col-sm-6 col-md-3">
        <a href="{{ route('karyakartha.reports') }}" style="color:black">
          <div class="info-box mb-3">
            <span class="info-box-icon"><i class="fas fa-user-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Karyakarthas Reports</span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
        <!-- /.info-box -->
      </div>
      @endif
       @if($role->hasPermission('27',$role->role_id))
      <div class="col-12 col-sm-6 col-md-3">
        <a href="{{ route('volunteer.reports') }}" style="color:black">
          <div class="info-box mb-3">
            <span class="info-box-icon"><i class="fas fa-user-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Volunteer Reports</span>
              <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
        <!-- /.info-box -->
      </div>
      @endif
      <!-- /.col -->
      
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- /.col -->
  </div>

  <!-- /.container-fluid -->
</section>
</div>
<br><br><br>
@endsection