@extends('layouts.app')

@section('content')
 <div class="content-wrapper">

<section class="content" style="padding-top:25px">
  <div class="container-fluid">

         <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="/home" class="btn btn-back" style="float:left;border-radius: 3px;margin-top: -12px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
          </div>
          <div class="col-sm-3">
          </div>
          <div class="col-sm-3">
            <h3 class="title-head">Karyakartha Enrollment</h3>
          </div>
          <div class="col-sm-2">        
          </div>
        
      </div>
        </div>
    <div class="card" style="margin-bottom: 0;">
        <!-- /.card-header -->
        <div class="card-body" style="padding-top:0;">
          <div class="row">
            <div class="col-md-2">
              
            </div>
             <div class="col-md-3">
              <select name="volunteersearch" id="mobile_number" class="selectpicker form-control volunteersearch"  data-live-search="true" >
                  <option value="">Mobile Number</option>
                  @foreach ($Member as $member)
                      <option value="{{ $member->Mobile_No }}">{{ $member->Mobile_No }}</option>
                  @endforeach 
              </select>
            </div>
            <div class="col-md-3">
              <select name="volunteersearch" id="member_id" class="selectpicker form-control volunteersearch"  data-live-search="true">
                  <option value="">Email</option>
                    @foreach ($Member as $member)
                      <option value="{{ $member->Email_Id }}">{{ $member->Email_Id }}</option>
                    @endforeach 
                </select>
            </div>
            <div class="col-md-3">
              <select name="volunteersearch" id="member_id" class="selectpicker form-control volunteersearch"  data-live-search="true">
                          <option value="">Member Id</option>
                          @foreach ($Member as $member)
                          <option value="{{ $member->Member_Id }}">{{ $member->Member_Id }}</option>
                          @endforeach 
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body" style="padding-top:0;" id="volunteersearch">
            @include('volunteer.filters.volunteer_search_filter')
  </div>
</div>
<div class="card">
        <!-- /.card-header -->
        <div class="card-body" style="padding-top:0;">
           <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-5">
          </div>
          <div class="col-sm-5">
            <h3 class="title-head">Karyakarthas</h3>
          </div>
          <div class="col-sm-2">
          </div>
        
      </div>
        </div>
  <table id="example1" class="table table-borderless">
          <thead>
          <tr>
            <th>Sl.No</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Member Id</th>
            <th>Make as Volunteer</th>
          </tr>
        </thead>
         <tbody>
          @foreach($Volunteer as $i =>$demember)
            <tr>
          <td>{{ $i+1 }}</td>
          <td>{{ $demember->First_Name }} {{ $demember->Last_Name }}</td>
          <td>{{ $demember->Email_Id }} </td>  
          <td>{{ $demember->Mobile_No }}</td>   
          <td>{{ $demember->Member_Id }}</td>  
         <td> <a href="/RemoveVolunteer/{{$demember->Member_Id}}" onclick="return  confirm('Are you sure want to remove volunteer?')"><span class="badge bg-danger">Remove</span></a>  </td>               
        
      </tr>
          @endforeach

        


    </tbody>
  </table>
  
      </div>
</div>
</section>
</div>
@endsection