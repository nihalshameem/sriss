@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-left:-60px">
        <div class="col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;">Notification Details
                <a href="{{ url( 'add_notification' ) }}"><i class="fa fa-plus-square fa-lg" style="float:right"></i></a>
                <a href="{{ url( 'notification_mass_delete' ) }}" title="Mass Deletion"><i class="fa fa-trash fa-lg " style="float:right;padding-right: 12px"></i></a>
                </div>
                <div class="panel-body" style="text-align: left;">
                    
                    
                <div class=" col-md-offset-3 col-md-3 form-group">
                  <input type="date" name="#search" id="search" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                  <input type="date" name="search1" id="search1" class="form-control">
                </div>
            </div>
            </div>
            </div>
                    
                <table class=" col-md-offset-2" width="100%" border="1" style="border:1px solid grey;text-align:center">
                  <thead style="background-color:#edf0f4;height:50px;border:1px solid grey;">
                    <tr>
                      <th style="text-align:center">Id</th>
                      <th style="text-align:center;width:250px;padding:10px">Description</th>
                      <th style="text-align:center">From Date</th>
                      <th style="text-align:center">To Date</th>
                      <th style="text-align:center">Image</th>
                      <th style="text-align:center">Active</th>
                      <th style="text-align:center">Approval</th>
                      <th style="text-align:center">Update</th>
                      <th style="text-align:center">Receipt Update</th>
                      <th style="text-align:center">Delete</th>
                    </tr>
                  </thead>
                  <tbody>  
                  <?php $id=1; ?>
                      @foreach($notifications as $notification)
                        <tr>
                          <td style="padding:10px">{{ $id++ }}</td>
                          
                          <td style="padding:10px">{{ $notification['description'] }}</td>
                          
                          <td style="padding:10px">{{ $notification['from_date'] }}</td>
                          <td style="padding:10px">{{ $notification['to_date'] }}</td>
                          
                          @if($notification->image != "" && $notification->image != NULL)
                          <td style="padding:10px">Yes</td>
                          @else
                           <td style="padding:10px">No</td>
                          @endif
                          
                          <td style="padding:10px">{{ $notification['active'] }}</td>
                          
                          
                          
                          <!--@if($notification->active =='yes')-->
                          <!--<td style="padding:10px"><a href="/fob/notification_approval/{{ $notification['id'] }}" ><i class="fa fa-check fa-lg" style="text-align:cenetr;"></i></a></td>-->
                          <!-- @else-->
                          <!-- <td style="padding:10px"><a href="/fob/notification_approval/{{ $notification['id'] }}" ><i class="fa fa-remove fa-lg" style="text-align:cenetr;color:red;"></i></a></td>-->
                          <!-- @endif-->
                           
    @if($notification->active =='yes')
        <td><i class="fa fa-check fa-lg" style="text-align:cenetr;color:blue;" onclick="Approve({{ $notification['id'] }})" ></i></td>
    @else
        <td><i class="fa fa-remove fa-lg" style="text-align:cenetr;color:blue;" onclick="Approve({{ $notification['id'] }})" ></i></td>
    @endif             
                           
                           
                           
                          <td style="padding:10px"><a href="/fob/notification_edit/{{ $notification['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td style="padding:10px"><a href="/fob/notification_receipt_edit/{{ $notification['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          
                          @if($notification->active =='yes')
                          <td style="padding:10px"><a href="" onclick="return alert('Active notifiactions cannot be deleted!!')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
                          @else
                          <td style="padding:10px"><a href="/fob/notification_delete/{{ $notification['id'] }}" onclick="return confirm('Are you sure,You want to delete?')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
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
                 url: "/fob/AjaxApproveNotif/"+id,
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
