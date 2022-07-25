@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Area</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('add_taluk') }}" method="POST">
                             {{ csrf_field() }}
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="taluk">Area:</label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control" id="taluk" placeholder="Enter Taluk Name" name="taluk" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="pincode">Pincode:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="pincode" placeholder="Enter Pincode" maxlength="6" name="pincode" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="des">District:</label>
                          <div class="col-sm-5">          
                            <select name="distid" id="district" class="selectpicker form-control"  data-live-search="true" required="">
                                <option value="">Select District</option>
                                  @foreach ($districts as $district)
                                  <option value="{{ $district->id }}">{{ $district->district }}</option>
                                  @endforeach
                            </select>
                          </div>
                        </div>
                        
                        
                        <input type="hidden" name="zoneid" value="">
                                                  
                        <div class="form-group">        
                          <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default" name="submit">Submit</button>
                            <a class="btn btn-default btn-close" href="{{ redirect()->getUrlGenerator()->previous() }}">Cancel</a>
                          </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
  //called when key is pressed in textbox
  $("#pincode").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});
</script>

@endsection
