@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Polls</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="/add_poll_response" method="POST">
                             {{ csrf_field() }} 
                        
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="quet"> Question:</label> 

                        <div class="col-sm-5">

                            <textarea class="form-control" id="note" placeholder="" name="question" value="{{ $lastid->id }}" readonly>{{ $lastid->question }}</textarea>
                        </div>
                        
                         <div class="col-sm-5" style="display:none">
                            <input type="text" class="form-control" id="note" name="questionid" value="{{ $lastid->id }}" placeholder="{{ $lastid->id }}" readonly>
                        </div>
              </div>


                        <div class="form-group">
                          <label class="control-label col-sm-3" for="response">Responses :</label>

                          <div class="col-sm-5 input_fields_wrap"> 
                          <input type="text" class="form-control" id="response" placeholder="" name="responses[]" required>
                          </div>
                          <label><a href=""><i class="fa fa-plus fa-lg add_field_button" style=""></i></a></label>
                        </div>


                        <input type="hidden" name="rescount" value="">

                        <div class="form-group">        
                          <div class="col-sm-offset-3 col-sm-5"> 
                          <a class="btn btn-default btn-close" href="/pollquestiononly_delete/{{ $lastid->id }}">Back</a>
                          <button type="submit" class="btn btn-default" name="submit">Next</button>
                          </div>
                        </div>

                    </form>
                </div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
  $(document).ready(function() {
      var max_fields      = 50; //maximum input boxes allowed
      var wrapper       = $(".input_fields_wrap"); //Fields wrapper
      var add_button      = $(".add_field_button"); //Add button ID
  
      var x = 1; //initlal text box count
      $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
          x++; //text box increment


          $(wrapper).append('<div class="col-sm-15" style="margin-top:10px"><input type="text" class="form-control" name="responses[]"/><a href="" class="remove_field"><i class="fa fa-remove fa-lg " style="color:red;float:right;"></i></a></div>'); //add input box
        }
      });
      
      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
      })
  });
</script>

            </div>
        </div>
    </div>
</div>

@endsection
