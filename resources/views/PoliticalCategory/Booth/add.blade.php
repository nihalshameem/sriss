@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
        <div class="col-12">

            <div class="row mb-2">
              <div class="col-sm-2">
                <a href="/political/category/list" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -10px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
            </div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-5">
                <h3 class="title-head">Add Booth</h3>
            </div>
            <div class="col-sm-3">
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">

              <form role="form" method="post"   action="{{ route('Save.Booth') }}"  style="padding-top: 10px;padding-bottom:20px;padding-left: 10px">
                @csrf
                <div class="modal-body">

                  <div class="row">
                     
                    <div class="col-md-6 form-group">
                      <label for="exampleInputPassword1">Ward</label>
                      <select class="form-control" name="Ward_Id" id="Ward_Id" required>
                         <option value="">Select Ward</option>
                           @if(isset($Ward))
                          @foreach($Ward as $Wards) 
                          <option value="{{$Wards->Ward_Id}}">{{ $Wards->Ward_Name}}</option>
                          @endforeach
                          @endif
                      </select>
                      
                  </div>
                </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <input type="text" class="form-control" name="Booth_Desc" placeholder="Enter Description" value="" required>
                
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Booth Number</label>
                <input type="text" class="form-control" name="Booth_No" placeholder="Enter Booth Number" value="" required>
                
            </div>
            <div class="row">
            <div class="col-md-4 form-group">
               <label for="exampleInputPassword1">Polling Station No</label>
                <input type="text" class="form-control" name="Polling_Station_No" placeholder="Enter Polling Station No" value="" required>
            </div>
            <div class="col-md-4 form-group">
               <label for="exampleInputPassword1">Polling Station Location</label>
                <input type="text" class="form-control" name="Polling_Station_Location" placeholder="Enter Polling Station Location" value="" required>
            </div>
            <div class="col-md-4 form-group">
               <label for="exampleInputPassword1">Polling Station Area</label>
                <input type="text" class="form-control" name="Polling_Station_Area" placeholder="Enter Polling Station Area" value="" required>
            </div>
          </div>    
           
      
  </div>
  <div style="max-width: 200px; margin: auto;">
      <a href="/political/category/list" class="btn btn-primary">Cancel</a>
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