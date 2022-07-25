@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 100px">
    <div class="row">
        <div class="col-md-offset-2">
            <div class="panel panel-default">
                
    <?php
    $cate = App\Category::where('id',$donations['category'])->first();
    $subCate = App\Category::where('id',$donations['subcategory'])->first();
    ?>
    
                <div class="panel-heading">Update {{ $cate['category']}} - {{ $subCate['sub_category']}}</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="/donation_update" method="POST">
                             {{ csrf_field() }}
                        
                        <input type="hidden" name="id" value="{{ $donations['id'] }}">


                        <div class="form-group">
                          <label class="control-label col-sm-3" for="category">Category:</label>
                          <div class="col-sm-5">
                           <select class="form-control" id="category" placeholder="Enter Category" name="category" required>
                            @foreach($categories as $key=>$value)
                              <option value="{{ $value['id']}}"  <?= ($donations['category'] == $value['id'])?"selected":"" ?>  >{{ $value['category']}}</option>
                            @endforeach
                            </select>        
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="subcategory">Sub Category:</label>
                          <div class="col-sm-5">
                            <select class="form-control" id="subcategory" name="subcategory" required>
                            @foreach($subcategories as $key=>$value)
                              <option value="{{ $value['id']}}" val1="{{ $value['keyvalue']}}" <?= ($donations['subcategory'] == $value['id'])?"selected":"" ?> >{{ $value['sub_category']}}</option>
                            @endforeach
                            </select>         
                          </div>
                        </div>
                        
                        
                        
                        <div class="form-group" id="keyval">
                          <label class="control-label col-sm-3" for="keyval">Key Value:</label>
                          <div class="col-sm-5">
                            <select class="form-control" id="keyval" name="keyval"  disabled="true">
                            @foreach($subcategories as $key=>$value)
                              <option value="{{ $value['id']}}"  <?= ($donations['subcategory'] == $value['id'])?"selected":"" ?> >{{ $value['keyvalue']}}</option>
                            @endforeach
                            </select>         
                          </div>
                        </div>
                        
                        
                        <div class="form-group" id="keyval1" style="display:none">
                            <label class="control-label col-sm-3" for="keyval12">Key Value:</label>
                          <div class="col-sm-5 ">
                            <input type="text" name="keyval" id="keyval" value="" readonly>
                          </div>
                        </div>




                        <div class="form-group">
                          <label class="control-label col-sm-3" for="des1">Tamil:</label>
                          <div class="col-sm-5">
                            <textarea class="form-control" rows="4" id="des1" name="tamil">{{ $donations['tamil']}}</textarea>          
                          </div>
                        </div>
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="des2">English:</label>
                          <div class="col-sm-5">
                            <textarea class="form-control" rows="5" id="des2" name="english">{{ $donations['english']}}</textarea>          
                          </div>
                        </div>
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="des3">Hindi:</label>
                          <div class="col-sm-5">
                            <textarea class="form-control" rows="5" id="des3" name="hindi">{{ $donations['hindi']}}</textarea>          
                          </div>
                        </div>
                        
                        
                        
                        
                        
                        

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="amount">Amount Per Day:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="amount" placeholder="" name="amountPerDay" value="{{ $donations['amount_per_day']}}">
                          </div><span style="color: red" id="errmsg"></span>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="noOfDays">No Of Days:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="noOfDays" placeholder="" name="noOfDays" value="{{ $donations['no_of_days']}}">
                          </div><span style="color: red" id="errmssg"></span>
                        </div>
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="noOfPersons">No Of Persons:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="noOfPersons" placeholder="" name="noOfPersons" value="{{ $donations['noOfPersons']}}">
                          </div><span style="color: red" id="errrmssg"></span>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="amount_1">Amount 1:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="amount_1" placeholder="" name="amount_1" value="{{ $donations['amount_1']}}">
                          </div><span style="color: red" id="error1"></span>
                        </div>
                        
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="amount_2">Amount 2:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="amount_2" placeholder="" name="amount_2" value="{{ $donations['amount_2']}}">
                          </div><span style="color: red" id="error2"></span>
                        </div>
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="amount_3">Amount 3</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="amount_3" placeholder="" name="amount_3" value="{{ $donations['amount_3']}}">
                          </div><span style="color: red" id="error3"></span>
                        </div>
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="amount_4">Amount 4:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="amount_4" placeholder="" name="amount_4" value="{{ $donations['amount_4']}}">
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
<script type="text/javascript">
    $('#subcategory').on('change',function(){
        //var value = $(this).attr("val1");
      $value=$(this).find('option:selected').attr("val1");
      $('#keyval').hide();
      $('#keyval1').show();
      $('input[id="keyval"]').val($value);
    })
</script>

@endsection
