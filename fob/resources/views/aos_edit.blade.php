@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Aos</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="/aos_update" method="POST">
                             {{ csrf_field() }}
                        
                        @if(Session::has('date-error'))
                        <div class="form-group">
                          <label class="control-label col-sm-3" for=""></label>
                          <div class="col-sm-8"> 
                              <strong style="color:red">To Date must be greater than from date!!</strong> {{ Session::get('message', '') }}             
                          </div>
                        </div>
                        @endif
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="slogam">Slogam:</label> 
                          <div class="col-sm-5">
                          <input type="hidden" name="id" value="{{ $aos['id']}}">
                        
                          <textarea class="form-control" id="slogam" placeholder="" name="slogam" value="{{ $aos['slogam']}}" required>{{ $aos['slogam']}}</textarea>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="fdate">From Date:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="fdate" placeholder="" name="fdate" value="{{ $aos['from_date']}}" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="tdate">To Date:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="tdate" placeholder="" name="tdate" value="{{ $aos['to_date']}}" required>
                          </div>
                        </div>

                       <div class="form-group">
                      
                      <label class="control-label col-sm-3" for="active">Active:</label>
                      
                        <div class="col-sm-5">          
                          <label class="radio-inline">
                          <input type="radio" name="active" value="yes" checked>Yes
                          </label>
                          <label class="radio-inline">
                          <input type="radio" name="active" value="no">No
                          </label>
                          </div>

                      </div>

                        <div class="form-group">        
                          <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default" name="submit">Submit</button>
                            <a class="btn btn-default btn-close" href="{{ url('aos_details') }}">Cancel</a>
                          </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/redmond/jquery-ui.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.js"></script>

<script type="text/javascript">
$("#fdate").datepicker({
  dateFormat: "yy-mm-dd",
  minDate: 0,
  onSelect: function(date) {
    $("#tdate").datepicker('option', 'minDate', date);
  }
});

$("#tdate").datepicker({
    dateFormat: "yy-mm-dd",
    minDate: 0,
      onSelect: function(date) {
      $("#fdate").datepicker('option', 'minDate', date);
  }
});
</script>


@endsection
