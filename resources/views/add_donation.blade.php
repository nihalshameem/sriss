@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 100px">
    <div class="row">
        <div class="col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#F3F8FA;">Add Donation</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('add_donation') }}" method="POST">
                             {{ csrf_field() }}

                        <input type="hidden" name="type" value="donation">

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
                          <label class="control-label col-sm-3" for="amount">Amount Per Day:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="amount" placeholder="" name="amountPerDay">
                          </div><span style="color: red" id="errmsg"></span>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="noOfDays">No Of Days:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="noOfDays" placeholder="" name="noOfDays">
                          </div><span style="color: red" id="errmssg"></span>
                        </div>
                        
                        
                         <div class="form-group">
                          <label class="control-label col-sm-3" for="noOfPersons">No Of Person:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="noOfPersons" placeholder="" name="noOfPersons"  required>
                          </div><span style="color: red" id="errrmssg"></span>
                        </div>
                        
                        
                        
                         <div class="form-group">
                          <label class="control-label col-sm-3" for="amount_1">Amount 1:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="amount_1" placeholder="" name="amount_1">
                          </div><span style="color: red" id="error1"></span>
                        </div>
                        
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="amount_2">Amount 2:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="amount_2" placeholder="" name="amount_2">
                          </div><span style="color: red" id="error2"></span>
                        </div>
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="amount_3">Amount 3</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="amount_3" placeholder="" name="amount_3">
                          </div><span style="color: red" id="error3"></span>
                        </div>
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="amount_4">Amount 4:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="amount_4" placeholder="" name="amount_4">
                          </div><span style="color: red" id="error4"></span>
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
   
    $("#noOfPersons").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errrmssg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
   
   
   
   
   
   
   $("#amount_1").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#error1").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
   
   
   $("#amount_2").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#error2").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
   
   
   $("#amount_3").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#error3").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
   
   
   $("#amount_4").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#error4").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });

});
</script>


@endsection
