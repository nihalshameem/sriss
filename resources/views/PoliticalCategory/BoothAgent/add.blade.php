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
                <h3 class="title-head">Add Booth Agent</h3>
            </div>
            <div class="col-sm-3">
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">

              <form role="form" method="post" class="col-md-6 "  action="{{ route('Save.BoothAgent') }}"  style="margin: 0 auto;padding-top: 10px;padding-bottom:20px">
                @csrf
                <div class="modal-body">

                <div class="form-group">
                       <label for="exampleInputPassword1">Booth</label>
                      <select class="form-control" name="booth_id" required > 
                          <option value="">Select Booth</option>
                          @if(isset($booth))
                          @foreach($booth as $booths) 
                          <option value="{{$booths->Booth_Id}}">{{ $booths->Booth_Desc}}</option>
                          @endforeach
                          @endif
                      </select>
                      
                  </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <input type="text" class="form-control" name="Booth_Agent_Desc" placeholder="Enter Description" value="" required>
                
            </div>
             <div class="form-group">
                <label for="exampleInputPassword1">Booth Agent Name</label>
                <input type="text" class="form-control" name="Booth_Agent_Name" placeholder="Enter Booth Agent Name" value="" required>
                
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