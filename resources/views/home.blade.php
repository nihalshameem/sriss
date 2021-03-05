@extends('layouts.app')

@section('content')
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content" style="padding-top:25px">
   <div class="container-fluid">
     <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-5">
        </div>
        <div class="col-sm-2">
          <h3 class="title-head">Dashboard</h3>
        </div>
        <div class="col-sm-5">
        </div>
        
      </div>
    </div><br>
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Members</span>
            <span class="info-box-number">{{$members_count}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon "><i class="fas fa-bell"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Notifications</span>
            <span class="info-box-number">
             {{$Notification_count}}
           </span>
         </div>
         <!-- /.info-box-content -->
       </div>
       <!-- /.info-box -->
     </div>
     <!-- /.col -->
     <div class="col-12 col-sm-6 col-md-3">
       <a href="{{ route('OnlineContributions') }}" style="color:black">
        <div class="info-box mb-3">
          <span class="info-box-icon"><i class="fas fa-donate"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Online Contributions</span>
            <span class="info-box-number">{{$online_amount}}<small></small></span>
          </div>


          <!-- /.info-box-content -->
        </div></a>

        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
       <a href="{{ route('OfflineContributions') }}" style="color:black">
        <div class="info-box mb-3">
          <span class="info-box-icon"><i class="fas fa-donate"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Offline Contributions</span>
            <span class="info-box-number">{{$offline_amount}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </a>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <!-- /.col -->
</div>

<!-- /.container-fluid -->
</section>
</div>
@endsection