@extends('layouts.app')

@section('content')
<div class="content-wrapper">

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
           <?php

                          $permission = App\Models\Permission::where('id','11')->first();
                      ?> 
                      <h3 class="title-head">{{$permission->name}}</h3>
        </div>
        <div class="col-sm-3">
          
        </div>
        
      </div>
    </div>
    
    <!-- /.card-header -->
    <div class="card-body" style="padding-top: 0;">
      <div class="row">
       
        <div class="col-md-3">
          <select name="membersearch" id="mobile_number" class="selectpicker form-control membersearch"  data-live-search="true" >
            <option value="">Mobile Number</option>
            @foreach ($Member as $member)
            <option value="{{ $member->Mobile_No }}">{{ $member->Mobile_No }}</option>
            @endforeach 
          </select>
        </div>
        <div class="col-md-3">
          <select name="membersearch" id="Email_Id" class="selectpicker form-control membersearch"  data-live-search="true">
            <option value="">Email</option>
            @foreach ($Member as $member)
            <option value="{{ $member->Email_Id }}">{{ $member->Email_Id }}</option>
            @endforeach 
          </select>
        </div>
        <div class="col-md-3">
          <select name="membersearch" id="member_id" class="selectpicker form-control membersearch"  data-live-search="true">
            <option value="">Member Id</option>
            @foreach ($Member as $member)
            <option value="{{ $member->Member_Id }}">{{ $member->Member_Id }}</option>
            @endforeach 
          </select>
        </div>
         <div class="col-md-3">
          <select name="membercategory" id="membercategory" class="form-control membercategory" onchange="MemberCategory(this.value)">
            <option value="">Member Category</option>
            @foreach ($MemberCategory as $MemberCategory)
            <option value="{{ $MemberCategory->MemberCategory_id }}">{{ $MemberCategory->Category }}</option>
            @endforeach 
          </select>
        </div>
       
      </div>
    </div>
    
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body" style="padding-top: 0;">
        <table id="example1" class="table table-borderless">
          <thead>
            <tr>
              
              <th>First Name</th>
              <th>Email</th>
              <th>Mobile Number</th>
              <th>Member Id</th>
              <th>Pincode</th>
              <th>Reg Date</th>
              <th>Address</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="membersearch">
            @foreach($Member as $i =>$member)
            <tr>
              
              <td>{{ $member->First_Name }} {{ $member->Last_Name }}</td>
              
              <td >{{ $member->Email_Id }} </td>  
              <td>{{ $member->Mobile_No }}</td>   
              <td>{{ $member->Member_Id }}</td>  
              <td>{{ $member->Pincode }}</td> 
              <td>{{ $member->created_at->toDateString() }} </td> 
              <?php
              $value = str_replace( ',', '<br />', $member->Address1 )
              ?>
              <td>{!! html_entity_decode($value) !!}</td>
                     <td>@if($member->active_flag=='Y')<span class="right badge badge-success">Yes</span>@else<span class="right badge badge-danger">No</span>@endif</td>           
              
            </tr>
            @endforeach
            

          </tbody>
        </table>
        
      </div>
    </div>
  </section>
</div>
@endsection