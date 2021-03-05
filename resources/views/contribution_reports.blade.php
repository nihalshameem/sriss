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
        <div class="col-sm-2">
        </div>
        <div class="col-sm-4">
          <h3 class="title-head">{{$contributions}}</h3>
        </div>
        <div class="col-sm-4">
        </div>
        
      </div>
    </div>
    <br>
    <div class="row">
     <div class="col-12">
       <div class="card">
         <!-- /.card-header -->
         <div >
          <div class="add-button" >
           
          </div>
          
          <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-2">
             <div class="info-box">
              <div class="info-box-content">
                <span class="info-box-text">Today</span>
                <span class="info-box-number" style="text-align:left">&#8377; {{$today_contributions}}.00<small></small></span>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="info-box">
              <div class="info-box-content">
                <span class="info-box-text">Yesterday</span>
                <span class="info-box-number" style="text-align:left">&#8377; {{$yesterday_contributions}}.00<small></small></span>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="info-box">
              <div class="info-box-content">
                <span class="info-box-text">This Week</span>
                <span class="info-box-number" style="text-align:left">&#8377; {{$thisWeek_contributions}}.00<small></small></span>
              </div>
            </div>
          </div>
          <div class="col-md-2">
           <div class="info-box">
            <div class="info-box-content">
              <span class="info-box-text">This Month</span>
              <span class="info-box-number" style="text-align:left">&#8377; {{$thisMonth_contributions}}.00<small></small></span>
            </div>
          </div>
        </div>
        <div class="col-md-2">
         <div class="info-box">
          <div class="info-box-content">
            <span class="info-box-text">Last Month</span>
            <span class="info-box-number" style="text-align:left">&#8377; {{$lastMonth_contributions}}.00<small></small></span>
          </div>
        </div>
      </div>
      <div class="col-md-1">
      </div>
      <div class="col-md-1">
      </div>
      <div class="col-md-2">
       <div class="info-box">
        <div class="info-box-content">
          <span class="info-box-text">This Year</span>
          <span class="info-box-number" style="text-align:left">&#8377; {{$thisYear_contributions}}.00<small></small></span>
        </div>
      </div>
    </div>
  </div>
  
  
  
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
<br><br><br>
@endsection