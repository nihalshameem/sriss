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
                <h3 class="title-head">Edit Ward</h3>
            </div>
            <div class="col-sm-3">
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">

              <form role="form" method="post" class="col-md-6 "  action="{{ route('Update.Ward') }}"  style="margin: 0 auto;padding-top: 10px;padding-bottom:20px">
                @csrf
                <div class="modal-body">
                   <input type="hidden" class="form-control" name="id" placeholder="Enter Name" value="{{$Ward->Ward_Id}}" required>

              <div class="form-group">
                <label for="exampleInputPassword1">Ward Name</label>
                <input type="text" class="form-control" name="Ward_Name" placeholder="Enter Ward Name" value="{{$Ward->Ward_Name}}" required>
                
            </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Ward Number</label>
                <input type="text" class="form-control" name="Ward_No" placeholder="Enter Ward Number" value="{{$Ward->Ward_No}}" required>
                
            </div>
            <div class="form-group">
                      <label for="exampleInputPassword1">State</label>
                      <select class="form-control" name="State_Id" required>
                          <option value="">Select State</option>
                          @if(isset($State))
                          @foreach($State as $State) 
                          <option value="{{$State->State_id}}" @if($State->State_id == $Ward->State_Id) selected @endif>{{ $State->State_desc}}</option>
                          @endforeach
                          @endif
                      </select>
                      
                  </div>
           <div class="form-group">
                      <label for="exampleInputPassword1">District</label>
                      <select class="form-control" name="Dist_Id" required>
                          <option value="">Select Zone</option>
                          @if(isset($District))
                          @foreach($District as $District) 
                          <option value="{{$District->District_id}}" @if($District->District_id == $Ward->Dist_Id) selected @endif>{{ $District->District_desc}}</option>
                          @endforeach
                          @endif
                      </select>
                      
                  </div>
           
                   <div class="form-group">
                      <label for="exampleInputPassword1">Assembly</label>
                      <select class="form-control" name="Assembly_Const_Id" required>
                          <option value="">Select Assembly</option>
                          @if(isset($AssemblyConsituency))
                          @foreach($AssemblyConsituency as $AssemblyConsituency) 
                          <option value="{{$AssemblyConsituency->Assembly_Id}}"@if($AssemblyConsituency->Assembly_Id == $Ward->Assembly_Const_Id) selected @endif>{{ $AssemblyConsituency->Assembly_Constituency_Desc}}</option>
                          @endforeach
                          @endif
                      </select>
                      
                  </div>
                   <div class="form-group">
                      <label for="exampleInputPassword1">Partliament</label>
                      <select class="form-control" name="Parliament_Const_Id" required>
                          <option value="">Select Partliament</option>
                          @if(isset($ParliamentConsituency))
                          @foreach($ParliamentConsituency as $ParliamentConsituency) 
                          <option value="{{$ParliamentConsituency->Parliament_Id}}" @if($ParliamentConsituency->Parliament_Id == $Ward->Parliament_Const_Id) selected @endif>{{ $ParliamentConsituency->Parliament_Constituency_Desc}}</option>
                          @endforeach
                          @endif
                      </select>
                      
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