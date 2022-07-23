@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Volunteer</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('zone_volunteer') }}" method="POST">
                             {{ csrf_field() }}
                        

  
                        <input type="hidden" class="form-control" name="type" value="z" >
                        <input type="hidden" class="form-control" name="type_id" value="{{ $zone['id']}}" >

            		
            		<div class="form-group">
                        <label class="control-label col-sm-3" for="memberid">Member Id :</label>
                        <div class="col-sm-5">
                        <select name="member_id" id="member_id" class="selectpicker form-control" data-live-search="true">
                          <option value=""> Member ID</option>
                          @foreach ($members as $member)
                          <option value="{{ $member->member_id }}">{{ $member->member_id }}</option>
                          @endforeach 
                        </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div id="label">
                            <label class="control-label col-sm-3" for="memberid">Member Name :</label>
                        </div>
                        <div id="membername" class="col-sm-5">
                            <input type="text" class="form-control" name="membername" value="" readonly>
                        </div>
                    </div>

            	
					
					<div class="form-group">
                       	<label class="control-label col-sm-3" for="fdate">From Date:</label>
                       	<div class="col-sm-5">
                        <input type="date" class="form-control" id="fdate" placeholder="Select From Date" name="fdate" required>
                       	</div>
                    </div>

                    <div class="form-group">
                      	<label class="control-label col-sm-3" for="tdate">To Date:</label>
                      	<div class="col-sm-5">          
                        <input type="date" class="form-control" id="tdate" placeholder="Enter To Date " name="tdate" required>
                      	</div>
                    </div>

                    <input type="hidden" class="form-control" name="active" value="yes" >

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


<script>
$(document).ready(function() {

$('#member_id').change(function(){
var member_id = $(this).val();
if(member_id){
$.ajax({
type:"GET",
url:"{{url('getMember')}}?member_id="+member_id,
success:function(res){
if(res){
$("#membername").empty();

$.each(res,function(key,value){


$("#membername").append('<input type="text" class="form-control" name="membername" value="'+value+'" readonly>');
});

}else{
$("#membername").empty();
}
}
});
}else{
$("#membername").empty();
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
@endsection
