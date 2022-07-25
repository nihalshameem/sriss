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
            <h3 class="title-head">Add Ward</h3>
          </div>
          <div class="col-sm-3">
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">

            <form role="form" method="post" class="col-md-6 "  action="{{ route('Save.Ward') }}"  style="margin: 0 auto;padding-top: 10px;padding-bottom:20px">
              @csrf
              <div class="modal-body">

                <div class="form-group">
                  <label for="exampleInputPassword1">Assembly</label>
                  <select class="form-control" name="Assembly_Const_Id" id="Assembly_Const_Id" required>
                    <option value="">Select Assembly</option>
                    @if(isset($AssemblyConsituency))
                    @foreach($AssemblyConsituency as $AssemblyConsituency) 
                    <option value="{{$AssemblyConsituency->Assembly_Id}}">{{ $AssemblyConsituency->Assembly_Constituency_Desc}}</option>
                    @endforeach
                    @endif
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Ward Name</label>
                  <input type="text" class="form-control" name="Ward_Name" placeholder="Enter Ward Name" value="" required>

                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Ward Number</label>
                  <input type="text" class="form-control" name="Ward_No" placeholder="Enter Ward Number" value="" required>

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

<script>

 function loadAssembly(select){
  var result = select.value;
  $.ajax({
    type : 'get',
    url : '{{URL::to('LoadAssembly')}}',
    data : {'state_id': result},
    success:function(response){
     $('#Assembly_Const_Id').empty();
     var options = response.forEach( function(iassembly, index){
      $('#Assembly_Const_Id').append('<option value="'+iassembly.Dist_id+'">'+iassembly.Assembly_Constituency_Desc+'</option>');
      
    });
   } 
 });


}
</script>
@endsection