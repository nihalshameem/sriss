@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;">Advertisement Details<a href="{{ url( 'add_advertisement' ) }}"><i class="fa fa-plus-square fa-lg" style="float:right"></i></a>
                <a href="{{ url( 'advertisement_mass_delete' ) }}" title="Mass Deletion"><i class="fa fa-trash fa-lg " style="float:right;padding-right: 12px"></i></a></div>

                <div class="panel-body" style="text-align: left;">
                    
                    
                <table class="table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Booked Date</th>
                      <th>Description</th>
                      <th>Company</th>
                      <!--<th>Image Path</th>
                      <th>Link</th>-->
                      <th>From Date</th>
                      <th>To Date</th>
                      <th>Active</th>
                      <th>Approval</th>
                      <th>Update</th>
                      <th>Receipt Update</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($advertisements as $advertisement)
                        <tr>
                          <td>{{ $advertisement['id'] }}</td>
                          <td>{{ $advertisement['created_at'] }}</td>
                          <td>{{ $advertisement['description'] }}</td>
                          <td>{{ $advertisement['company'] }}</td>
                          <!--<td>{{ $advertisement['image_path'] }}</td>
                          <td>{{ $advertisement['link'] }}</td>-->
                          <td>{{ $advertisement['from_date'] }}</td>
                          <td>{{ $advertisement['to_date'] }}</td>
                          <td>{{ $advertisement['active'] }}</td>
                          
                          
                          
                          
                          
                          
                          
                          <!--@if($advertisement->active =='yes')-->
                          <!--<td><a href="/fob/advertisement_approval/{{ $advertisement['id'] }}" ><i class="fa fa-check fa-lg" style="text-align:cenetr;"></i></a></td>-->
                          <!--@else-->
                          <!--<td><a href="/fob/advertisement_approval/{{ $advertisement['id'] }}" ><i class="fa fa-remove fa-lg" style="text-align:cenetr;color:red"></i></a></td>-->
                          <!--@endif-->
                          
                          
    @if($advertisement->active =='yes')
        <td><i class="fa fa-check fa-lg" style="text-align:cenetr;color:blue;" onclick="Approve({{ $advertisement['id'] }})" ></i></td>
    @else
        <td><i class="fa fa-remove fa-lg" style="text-align:cenetr;color:blue;" onclick="Approve({{ $advertisement['id'] }})" ></i></td>
    @endif                   
                          
                          
                          
                          
                          
                          
                          <td><a href="/fob/advertisement_edit/{{ $advertisement['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td><a href="/fob/advertisement_receipt_edit/{{ $advertisement['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          
                          @if($advertisement->active =='yes')
                          <td><a href="" onclick="return alert('Active advertisements cannot be deleted!!')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
                          @else
                          <td><a href="/fob/advertisement_delete/{{ $advertisement['id'] }}" onclick="return confirm('Are you sure,You want to delete?')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
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
    $('#advertisementsearch').on('change',function(){
      $value=$(this).val();
      $('#advertisementsearch1').on('change',function(){
      $value1=$(this).val();
      $.ajax({
        type : 'get',
        url : '{{URL::to('advertisementsearch')}}',
        data : {'advertisementsearch':$value , 'advertisementsearch1':$value1},
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
                 url: "/fob/AjaxApproveAdver/"+id,
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
