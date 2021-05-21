@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
        <div class="col-12">

            <div class="row mb-2">
              <div class="col-sm-2">
                <a href="/caste/list" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -10px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
            </div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-5">
                <h3 class="title-head">Edit Caste</h3>
            </div>
            <div class="col-sm-3">
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">

              <form role="form" method="post" class="col-md-6 "  action="{{ route('Update.Caste') }}"  style="margin: 0 auto;padding-top: 10px;padding-bottom:20px">
                @csrf
                <div class="modal-body">
<input type="hidden" name="id" value="{{$CasteLeader->Caste_Id}}">
              <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <input type="text" class="form-control" name="Description" placeholder="Enter Description" value="{{$CasteLeader->Caste_Desc}}" required>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$CasteLeader->Caste_name}}" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Enter email" value="{{$CasteLeader->Caste_email}}" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="Enter Phone no" value="{{$CasteLeader->Caste_phone}}" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Date of Birth</label>
                <input type="date" class="form-control" name="dob" placeholder="Enter Date of Birth" value="{{$CasteLeader->Caste_birth_date}}" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Date of Death</label>
                <input type="date" class="form-control" name="dod" placeholder="Enter Date of Death" value="{{$CasteLeader->Caste_death_date}}" >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Organization Name</label>
                <input type="text" class="form-control" name="organization" placeholder="Enter Organization Name" value="{{$CasteLeader->Caste_organization}}" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Whatsapp No</label>
                <input type="text" class="form-control" name="whatsapp" placeholder="Enter Whatsapp No" value="{{$CasteLeader->Caste_whatsapp_no}}" >
            </div>   
     
      
      
  </div>
  <div style="max-width: 200px; margin: auto;">
      <a href="/caste/list" class="btn btn-primary">Cancel</a>
      <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>
</div>
</div>


</div>
<!-- /.container-fluid -->
</section>
</div>
@endsection