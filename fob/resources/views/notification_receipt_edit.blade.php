@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">Update Notification Receipts</div>

          <div class="panel-body">
              
          <form class=" form-horizontal" action="/fob/notification_receipt_update"  method="POST">
                             {{ csrf_field() }}

            <div class="col-md-6 form-group">
                <label class="control-label col-sm-6" for="note">Notification Id:</label> 
                
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="note" name="notifications" value="{{ $notification['id']}}" placeholder="{{ $notification['id']}}" readonly>
                </div>
                  
                @if(Session::has('alert-select'))
                <div>
                <strong style="color:red">Select minimum one district!</strong> {{ Session::get('message', '') }}
                </div>
                @endif
                  
            </div>
            
            <div class="col-md-6 form-group">
                <label class="control-label col-sm-6" for="notification">Notification:</label> 
                <div class="col-sm-6">
              
                <textarea class="form-control" id="notification" placeholder=""  value="{{ $notification['description']}}"    readonly>{{ $notification['description']}}</textarea>
                </div>
            </div>
            
   
            <?php 
                $zonename = DB::table('zones')->pluck('zone');
                $no_of_zones=count($zones);        
            ?>
            
            @for ($i = 0; $i <$no_of_zones; $i++)
                <div class="col-sm-6 form-group">
                    <label class="control-label col-sm-6" for="zone">{{ $zonename[$i] }} :</label>
    
                <div class="col-sm-6">
                    <input type="checkbox" class="parent" data-group=".group{{ $i }}" data-group=".group{{ $i }}" /> Select All<br>
                @foreach($zones[$i] as $zone)
                    <input type="checkbox" class="group{{ $i }}" name="zones[]" value="{{ $zone->id }}"  <?=(in_array($zone->id, $sentDistricts))?'checked':''?> >{{ $zone->district }}<br>
                @endforeach
                </div>
                </div>
            @endfor
            
            <div class="form-group">        
                          <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default" name="submit">Submit</button>
                            
                            <a class="btn btn-default btn-close" href="{{ redirect()->getUrlGenerator()->previous() }}">Cancel</a>
                          </div>
            </div>

            </form>
            </div>
            
<script>
  $(".parent").each(function(index){
    var group = $(this).data("group");
    var parent = $(this);

    parent.change(function(){  //"select all" change 
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
