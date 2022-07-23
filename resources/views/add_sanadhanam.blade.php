@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 100px">
    <div class="row">
        <div class="col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#F3F8FA;">Add Sanadhanam</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('add_sanadhanam') }}" method="POST">
                             {{ csrf_field() }}

                        
                        <input type="hidden" name="type" value="sanadhanam">
                        

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="category">Category:</label>
                          <div class="col-sm-5">
                            <select class="form-control" id="category" placeholder="Enter Category" name="category" required>
      @foreach($categories as $key=>$value)
        <option value="{{ $value['id']}}">{{ $value['category']}}</option>
      @endforeach
      </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="subcategory">Sub Category:</label>
                          <div class="col-sm-5">
                            <select class="form-control" id="subcategory" placeholder="Enter Category" name="subcategory" required>
                            @foreach($subcategories as $key=>$value)
                              <option value="{{ $value['id']}}">{{ $value['sub_category']}}</option>
                            @endforeach
                            </select>
                          </div>
                        </div>

                        
                        
                        
                        
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="des1">Tamil:</label>
                          <div class="col-sm-5">   
                            <textarea rows="4" class="form-control" id="des1" placeholder="Enter Tamil Description" name="tamil"></textarea>       
                          </div>
                        </div>
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="des2">English:</label>
                          <div class="col-sm-5">   
                            <textarea rows="4" class="form-control" id="des2" placeholder="Enter English Description" name="english"></textarea>       
                          </div>
                        </div>
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="des3">Hindi:</label>
                          <div class="col-sm-5">   
                            <textarea rows="4" class="form-control" id="des3" placeholder="Enter Hindi Description" name="hindi"></textarea>       
                          </div>
                        </div>
                        
                        
                        
                        
                        
                        

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="amount">Amount :</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="amount" placeholder="" name="amount">
                          </div><span style="color: red" id="errmsg"></span>
                        </div>
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="link">Link :</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="link" placeholder="" name="link">
                          </div><span style="color: red" id=""></span>
                        </div>
                        
          
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

  $("#amount").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
   
   $("#noOfDays").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmssg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
   
});
</script>


@endsection
