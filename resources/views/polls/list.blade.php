@extends('layouts.app')

@section('content')
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content" style="padding-top:25px">
   <div class="container-fluid">

     <div class="col-12">

      <div class="row mb-2">
        <div class="col-sm-2">
          <a href="/home" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -12px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-5">
          <h3 class="title-head">Polls</h3>
        </div>
        <div class="col-sm-2">
          
        </div>
        
      </div>
    </div>
    
    <div class="row">
     <div class="col-12">
       <div class="card">
         <!-- /.card-header -->
         
         <div class="card-body" style="padding-top: 0px;">
          <div class="row">
           <div class="col-md-2 form-group" style="display: flex; justify-content: flex-start;">
             
           </div>
           
           <div class="col-md-3 form-group">
            <input type="date" name="pollsearch" id="pollsearch" class="form-control">
          </div>
          <div class="col-md-3 form-group">
            <input type="date" name="pollsearch1" id="pollsearch1" class="form-control">
          </div>
          <div class="col-md-2 form-group">
           <!--- <a  class="btn btn-primary btn-md" href="{{ route('truncate.polls') }}"  style="float:right"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete All</a>-->
         </div>

         <div class="col-md-2">
           <div class="add-button" >
            <a class="btn btn-primary btn-md" style="float:right" href="{{ route('add.polls') }}" ><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add Polls</a> 
          </div>
        </div>
      </div>
      
      <table id="example1" class="table table-borderless">
        <thead>
         <tr>
           <th>Sl No</th>
           <th>Question</th>
           <th>From Date</th>
           <th>To Date</th>
           <th>Broadcast</th>
           <th colspan="3">Action</th>
           
         </tr>
       </thead>
       <tbody>
        @foreach ($PollsQuestions as $i => $PollsQuestions)
        <tr>
         <td>{{ $i+1 }}</td>
         <td>{{ $PollsQuestions->Polls_Questions }}</td>
         <td>{{ $PollsQuestions->Polls_Questions_From_date }}</td>
         <td>{{ $PollsQuestions->Polls_Questions_To_date }}</td>
         <?php
         $BroadcastGeo  = App\Models\PollsBroadcast::where('Polls_id',$PollsQuestions->id)->count();
        $BroadcastGroup  = App\Models\PollsGroupBroadcast::where('Polls_id',$PollsQuestions->id)->count();
        $type="Empty";
        if($BroadcastGeo!=0){
          $type="Geo";
        }else if($BroadcastGroup!=0){
          $type="Group";
        }
         ?>
         <td>{{$type}}</td>
         <td>
          <a href="{{ route('edit.question', ['QuestionId' => $PollsQuestions->id]) }}"><span class="badge bg-danger"><i class="fa fa-edit fa-lg" style="text-align:center;"></i></span></a>
        </td>
        <td>
          <a onclick="Delete('{{$PollsQuestions->id}}')" style="cursor: pointer;"><span class="badge bg-danger"><i class="fa fa-trash fa-lg" style="text-align:center;cursor: pointer;"></i></span></a>
        </td> 
        <td>
          <a href="{{ route('response', ['question' => $PollsQuestions->id]) }}" style="cursor: pointer;"><span class="badge bg-danger">Results</span></a>
        </td>           
      </tr>
      @endforeach

    </tbody>
  </table>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
</div>
<br>
<script>
  function Delete	(value) {
    if (confirm("Are your sure you want to delete the poll ?")) {
      $.ajax({
        type : 'get',
        url : '{{URL::to('deletePoll')}}',
        data : {'Questions_id':value},
        success:function(data){
          window.location.reload();
        } 
      });

    } else {
     
    }
  }
</script>
<script>
  function DeleteAll() {
    if (confirm("Are your sure you want to delete all the record ?")) {
      $.ajax({
        type : 'get',
        url : '{{URL::to('TruncatePolls')}}',
        data : {'PollId':''},
        success:function(data){
          window.location.reload();
        } 
      });

    } else {
     
    }
  }
</script>
@endsection