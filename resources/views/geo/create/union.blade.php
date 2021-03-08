@extends('layouts.app')

@section('content')
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content" style="padding-top:20px">
    <div class="container-fluid">
      <div class="col-12">
        <div class="col-12">

          <div class="row mb-2">
            <div class="col-sm-2">
              <a href="/geo" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -10px;margin-left: -24px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
            </div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-5">
              <h3 class="title-head">Add Area</h3>
            </div>
            <div class="col-sm-3">
            </div>
            
          </div>
        </div>
        <div class="row">
         <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body" >
              
              
              <form role="form" method="post" id="unionForm"  class="col-md-6 was-validated"  action="{{ route('AddUnion') }}" enctype="multipart/form-data" style="margin: 0 auto;padding-top: 10px;padding-bottom:20px">
                @csrf
                <div class="form-group">
                  <label for="exampleInputPassword1">Districts</label>
                  <select class="form-control" name="DistrictId" required>
                    <option value="">Select District</option>
                    @if(isset($Districts))
                    @foreach($Districts as $District) 
                    <option value="{{$District->District_id}}">{{ $District->District_desc}}</option>
                    @endforeach
                    @endif
                  </select>
                  
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Number Of Area</label>
                  <input type="Number" class="form-control" onfocus="this.oldvalue = this.value;"     onkeyup ="responses(this);this.oldvalue = this.value;"  id="response" required>

                </div>
                <div id="link-list">
                </div>
                <div class="form-group">
                  <label >Status</label><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="checkboxPrimary11" value="Y" name="Status" checked>
                    <label for="checkboxPrimary11">Yes
                    </label>
                  </div>
                  
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="checkboxPrimary12" value="N"  name="Status">
                    <label for="checkboxPrimary12">
                      No
                    </label>
                  </div>
                </div>
                
                
                <div style="max-width: 200px; margin: auto;">
                  <a href="/geo" class="btn btn-primary">Cancel</a>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<script>
  function responses(textbox){
    var i;
    var value  = textbox.value;
    var oldvalue = textbox.oldvalue;
    if(value!="")
    {
      for (i = 0; i < value; i++) 
      {
        j=i+1;
        $('<div id="row'+value+'">'+'<div class="form-group">'+'<label class="form-lable">Area Name</label>'+
          '<input class="form-control" name="name[]" type="text">'+
          '</div></div>').appendTo('#link-list');
      }
      
    }
    else
    {
      for (i = 0; i < oldvalue; i++) 
      {
        $('#row'+oldvalue).remove(); 
      }
      
    }
    
  }
  
  
  
</script>
@endsection