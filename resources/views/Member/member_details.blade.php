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
          <h3 class="title-head">Search Members</h3>
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
          <select name="membersearch" id="member_id" class="selectpicker form-control membersearch"  data-live-search="true">
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

           <div class="form-group clearfix">
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary1" value="M" name="approve" checked="">
                  <label for="checkboxPrimary1">Member
                  </label>
                </div>
                
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary2" value="V"  name="approve" >
                  <label for="checkboxPrimary2">
                    Karyakarthas
                  </label>
                </div>
              </div>
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
              <td class="col-sm-2">{{ $member->created_at->toDateString() }} </td> 
              <?php
              $value = str_replace( ',', '<br />', $member->Address1 )
              ?>
              <td>{!! html_entity_decode($value) !!}</td>
                                
              
            </tr>
            @endforeach
            

          </tbody>
        </table>
        
      </div>
    </div>
  </section>
</div>
@endsection