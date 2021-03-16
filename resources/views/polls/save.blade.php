@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">

     <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="/Polls" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -12px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-5">
          <h3 class="title-head">Add Polls</h3>
        </div>
        <div class="col-sm-2">
        </div>
        
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="card card-primary">
          
          <form role="form" method="post" class="col-md-6" action="{{ route('save.polls') }}" enctype="multipart/form-data" onSubmit="return confirm('Please ensure that all the data has been entered properly');" style="margin:0 auto">
            @csrf

            
            <div class="form-group">
              <label for="exampleInputPassword1">Question&nbsp;<span style="color:red">*</span></label>
              <input type="text" class="form-control" name="question" placeholder="Enter question"  required>

            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">From Date&nbsp;<span style="color:red">*</span></label>
              <input type="date" class="form-control" id="from_date" name="from_date" required="Required" >

            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">To Date&nbsp;<span style="color:red">*</span></label>
              <input type="date" class="form-control" id="to_date" name="to_date" required="Required">

            </div>

            <div class="form-group">
              <div >
                <label>BroadCast Type</label>
              </div>
              <!-- checkbox -->
              <div class="form-group clearfix">
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary74" value="Y" name="broadtype" checked="">
                  <label for="checkboxPrimary74">Geo
                  </label>
                </div>
                
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary75" value="N"  name="broadtype" >
                  <label for="checkboxPrimary75">
                    Group
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Number Of Responses&nbsp;<span style="color:red">*</span></label>
              <input type="number" min="0" class="form-control" onfocus="this.oldvalue = this.value;"  onkeyup ="responses(this);this.oldvalue = this.value;"   id="response"  required>

            </div>

            <div id="link-list">
            </div>
            
            
            <div style="max-width: 200px; margin: auto;">
              <a href="/Polls" class="btn btn-primary">Cancel</a>
              <button type="submit" class="btn btn-primary">Next</button>
            </div><br>
          </div>
          
        </form>
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
    console.log(value,oldvalue);
    if(value!="")
    {
        if(value<=6)
        {
              for (i = 0; i < oldvalue; i++) 
              {
                $('#row'+oldvalue).remove(); 
              }
              for (i = 0; i < value; i++) 
              {
                j=i+1;
                $('<div id="row'+value+'">'+'<div class="form-group">'+'<label class="form-lable">Option'+j+'</label>'+
                  '<input class="form-control" name="Answer[]" type="text">'+
                  '</div></div>').appendTo('#link-list');
              }
        }
        else
        {
            document.getElementById('response').value='';
            ('#row'+value).remove(); 
            alert("Polls Response must be less than 6");
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