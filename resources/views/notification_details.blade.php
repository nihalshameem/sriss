@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;">Notification Details
                <a href="{{ url( 'add_notification' ) }}"><i class="fa fa-plus-square fa-lg" style="float:right"></i></a>
                <a href="{{ url( 'notification_mass_delete' ) }}"  title="Mass Deletion"><i class="fa fa-trash fa-lg " style="float:right;padding-right: 12px"></i></a>
                </div>
                <div class="panel-body" style="text-align: left;">
                    
                    
                <div class="col-md-3 form-group">
                  <input type="date" name="search" id="search" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                  <input type="date" name="search1" id="search1" class="form-control">
                </div>
                    
                    
                <table class="table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Description</th>
                      <th>From Date</th>
                      <th>To Date</th>
                      <th>Image</th>
                      <th>Active</th>
                      <th>Approval</th>
                      <th>Update</th>
                      <th>Receipt Update</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($notifications as $notification)
                        <tr>
                          <td>{{ $notification['id'] }}</td>
                          
                          <td>{{ substr($notification['description'],0,80) }}</td>
                          
                          <td>{{ $notification['from_date'] }}</td>
                          <td>{{ $notification['to_date'] }}</td>
                          
                          @if($notification->image != "" && $notification->image != NULL)
                          <td>Yes</td>
                          @else
                           <td>No</td>
                          @endif
                          
                          <td>{{ $notification['active'] }}</td>
                          
                          
                          <!--@if($notification->active =='yes')-->
                          <!--<td><a href="/notification_approval/{{ $notification['id'] }}" ><i class="fa fa-check fa-lg" style="text-align:cenetr;"></i></a></td>-->
                          <!-- @else-->
                          <!-- <td><a href="/notification_approval/{{ $notification['id'] }}" ><i class="fa fa-remove fa-lg" style="text-align:cenetr;color:red;"></i></a></td>-->
                          <!-- @endif-->
                          
                          
                          
                          
    @if($notification->active =='yes')
        <td><i class="fa fa-check fa-lg" style="text-align:cenetr;color:blue;" onclick="Approve({{ $notification['id'] }})" ></i></td>
    @else
        <td><i class="fa fa-remove fa-lg" style="text-align:cenetr;color:blue;" onclick="Approve({{ $notification['id'] }})" ></i></td>
    @endif                    
                          
                           
                           
                          <td><a href="/notification_edit/{{ $notification['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td><a href="/notification_receipt_edit/{{ $notification['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          
                          @if($notification->active =='yes')
                          <td><a href="" onclick="return alert('Active notifiactions cannot be deleted!!')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
                          @else
                          <td><a href="/notification_delete/{{ $notification['id'] }}" onclick="return confirm('Are you sure,You want to delete?')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
                          @endif
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
    $('#search').on('change',function(){
      $value=$(this).val();
      $('#search1').on('change',function(){
      $value1=$(this).val();
      $.ajax({
        type : 'get',
        url : '{{URL::to('search1')}}',
        data : {'search':$value , 'search1':$value1},
        success:function(data){
          $('tbody').html(data);
        } 
      });
    })
    })
</script>


<script type="text/javascript">
    
   function Approve(id) {

        $.ajaxSetup({
               headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
               }
        });

        if( id !=""){

            $.ajax({
                 method: "POST",
                 url: "/AjaxApproveNotif/"+id,
                 data: { id:id, }
                 }).done(function(data){  
                    console.log(data);
                    if(data.status==true)
                       {
                          location.reload(true);
                       }      
                       else
                       {
                          alert('Try Again!');
                          location.reload(true);
                       }     
                 });         
        }else{
            alert('Fill the required field');
        }

    }

</script>

@endsection
