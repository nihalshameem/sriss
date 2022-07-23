@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;">Poll Details<a href="{{ url( 'add_poll_questions' ) }}"><i class="fa fa-plus-square fa-lg" style="float:right"></i></a>
                <a href="{{ url( 'poll_mass_delete' ) }}" title="Mass Deletion"><i class="fa fa-trash fa-lg " style="float:right;padding-right: 12px"></i></a>
                
                </div>

                <div class="panel-body" style="text-align: left;">
                    
                <div class="col-md-3 form-group">
                  <input type="date" name="pollsearch" id="pollsearch" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                  <input type="date" name="pollsearch1" id="pollsearch1" class="form-control">
                </div>
                    
                <table class="table">
                  <thead>
                    <tr>
                      
                      <th>Id</th>
                      <th>Question</th>
                      <th>From Date</th>
                      <th>To Date</th>
                      <th>Q Update</th>
                      <th>Receipt Update</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($pollquestions as $pollquestion)
                        <tr>
                          <td>{{ $pollquestion['id'] }}</td>
                          <td>{{ $pollquestion['question'] }}</td>
                          <td>{{ $pollquestion['from_date'] }}</td>
                          <td>{{ $pollquestion['to_date'] }}</td>
                          <td><a href="/fob/pollquestion_edit/{{ $pollquestion['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                         <td><a href="/fob/poll_receipt_edit/{{ $pollquestion['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                        <td><a href="/fob/poll_delete/{{ $pollquestion['id'] }}"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"  onclick="return confirm('Are you sure, You want to delete?')"></i></a></td>
                        </tr>
                      @endforeach
                  </tbody> 
                </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#pollsearch').on('change',function(){
      $value=$(this).val();
      $('#pollsearch1').on('change',function(){
      $value1=$(this).val();
      $.ajax({
        type : 'get',
        url : '{{URL::to('pollsearch')}}',
        data : {'pollsearch':$value , 'pollsearch1':$value1},
        success:function(data){
          $('tbody').html(data);
        } 
      });
    })
    })
</script>

<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure?');
}
</script>

@endsection
