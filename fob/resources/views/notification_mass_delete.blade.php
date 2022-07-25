@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">Notification Mass Delete</div>

          <div class="panel-body">
              
          <form class="form-horizontal" action="{{ url('notification_mass_delete') }}" method="POST">
                             {{ csrf_field() }}

            <div class="form-group">
              <label class="control-label col-sm-3" for="notification">Select :</label>

              <div class="col-sm-5">
              <input type="checkbox" class="parent" data-group=".group1"
              data-group=".group1" /> Select All<br>
              @foreach($notifications as $notification)
              <input type="checkbox" class="group1" name="notification[]" value="{{ $notification->id }}">{{ $notification->id}}.{{ substr($notification->description,0,40) }}<br>
              @endforeach
              </div>

          </div>

            
          <div class="form-group">        
            <div class="col-sm-offset-3 col-sm-5">
              <button type="submit" class="btn btn-default" name="submit">Submit</button>
             <a class="btn btn-default btn-close" href="{{ redirect()->getUrlGenerator()->previous() }}">Back</a>
            </div>
          </div>

            </form>
            </div>
            
<script>
  $(".parent").each(function(index){
    var group = $(this).data("group");
    var parent = $(this);

    parent.change(function(){
         $(group).prop('checked', parent.prop("checked"));
    });
    $(group).change(function(){ 
        parent.prop('checked', false);
        if ($(group+':checked').length == $(group).length ){
            parent.prop('checked', true);
        }
    });
});
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection
