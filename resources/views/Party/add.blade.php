@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
        <div class="col-12">

            <div class="row mb-2">
              <div class="col-sm-2">
                <a href="/party" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -10px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
            </div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-5">
                <h3 class="title-head">Add Party</h3>
            </div>
            <div class="col-sm-3">
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">

              <form role="form" method="post" class="col-md-6 "  action="{{ route('Save.Party') }}"  style="margin: 0 auto;padding-top: 10px;padding-bottom:20px">
                @csrf
                <div class="modal-body">

              <div class="form-group">
                <label for="exampleInputPassword1">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" value="" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Phone</label>
                <input type="number" class="form-control" name="phone" placeholder="Enter Phone no" value="" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Date of Birth</label>
                <input type="date" class="form-control" name="dob" placeholder="Enter Date of Birth" value="" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Date of Death</label>
                <input type="date" class="form-control" name="dod" placeholder="Enter Date of Death" value="" >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Organization Name</label>
                <input type="text" class="form-control" name="organization" placeholder="Enter Organization Name" value="" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Address</label>
                <textarea class="form-control" name="address" placeholder="Enter Address" required="" ></textarea> 
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Whatsapp No</label>
                <input type="number" class="form-control" name="whatsapp" placeholder="Enter Whatsapp No" value="" >
            </div> 
     
      
      
  </div>
  <div style="max-width: 200px; margin: auto;">
      <a href="/party" class="btn btn-primary">Cancel</a>
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