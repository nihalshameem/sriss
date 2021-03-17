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
            <h3 class="title-head">Edit Polls</h3>
          </div>
          <div class="col-sm-2">
          </div>
          
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="add-button" >
            <div class="row">
              <div class="col-md-4">
                
              </div>
              <div class="col-md-4">
              </div>
              <div class="col-md-2">
                
              </div>
              <div class="col-md-2">
                
              </div>
            </div>
            
          </div>

          <div class="card card-primary">
           
            <form role="form" method="post" class="col-md-6" action="{{ route('update.question') }}" enctype="multipart/form-data" style="margin:0 auto;">
              @csrf

              
              <div class="form-group">
                <label for="exampleInputPassword1">Question&nbsp;<span style="color:red">*</span></label>
                <input type="hidden" name="PollsQuestions_id" value="{{$PollsQuestions->id}}">
                <input type="text" class="col-md-11  form-control" name="question" placeholder="Enter question"  value="{{ $PollsQuestions->Polls_Questions}}" required>

              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="exampleInputPassword1">From Date&nbsp;<span style="color:red">*</span></label>
                  <input type="date" class="col-md-11 form-control" name="from_date"   value="{{ $PollsQuestions->Polls_Questions_From_date}}" required>

                </div>
                <div class="col-md-6 form-group">
                  <label for="exampleInputPassword1">To Date&nbsp;<span style="color:red">*</span></label>
                  <input type="date" class="col-md-11  form-control" name="to_date"  value="{{ $PollsQuestions->Polls_Questions_To_date}}" required>

                </div>
              </div>

              <div class="form-group">
              <div >

                <label>BroadCast Type</label>
                }
              </div>
              <!-- checkbox -->
              <div class="form-group clearfix">
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary74" value="Y" name="broadtype"  {{ ($is_group == "N") ? 'checked' : '' }} >
                  <label for="checkboxPrimary74">Geo
                  </label>
                </div>

                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary75" value="N"  name="broadtype"  {{ ($is_group == "Y") ? 'checked' : '' }}>
                  <label for="checkboxPrimary75">
                    Group
                  </label>
                </div>
              </div>
            </div>

              @foreach($PollsAnswers as $PollsAnswer)
              <div class="form-group">
               <input type="hidden" class="form-control" name="Answer_id[]"  value="{{ $PollsAnswer->Polls_Answers_id}}" required>
               <label for="exampleInputPassword1">answers</label>

               <div class="row">
                <input type="text" class="col-md-11 form-control" name="Answer[]"  value="{{ $PollsAnswer->Polls_Answers_Options}}" required>
                <a class="col-md-1" style="cursor: pointer;margin-top:3px" onclick="Delete('{{$PollsAnswer->Polls_Answers_id}}')"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
              </div>
            </div>
            @endforeach
            <input type="hidden" class="form-control" id="count"  value="{{ $PollsAnswerCount}}" required>

            <div class="form-group">
              <label for="exampleInputPassword1">Number Of Responses</label>
              <input type="number" class="col-md-11  form-control" onfocus="this.oldvalue = this.value;"     onkeyup ="responses(this);this.oldvalue = this.value;"  id="response">

            </div>

            <div id="link-list">
            </div>
            
            <div style="margin: auto; max-width: 200px;">
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
    
    if(value!="")
    {
        if(value<=6)
        {
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
<script>
  function Delete (value) {
    if (confirm("Are your sure you want to delete the answer")) {
      $.ajax({
        type : 'get',
        url : '{{URL::to('deleteanswer')}}',
        data : {'AnswerId':value},
        success:function(data){
          window.location.reload();
        } 
      });

    } else {
     
    }
  }
</script>
@endsection