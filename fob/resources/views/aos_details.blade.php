@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;">ACT Details<a href="{{ url( 'add_aos' ) }}"><i class="fa fa-plus-square fa-lg" style="float:right"></i></a></div>

                <div class="panel-body" style="text-align: left;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Slogam</th>
                      <th>From Date</th>
                      <th>To Date</th>
                      <th>Active</th>
                      <th>Approval</th>
                      <th>Update</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($aoss as $aos)
                        <tr>
                          <td>{{ $aos['id'] }}</td>
                          <td>{{ $aos['slogam'] }}</td>
                          <td>{{ $aos['from_date'] }}</td>
                          <td>{{ $aos['to_date'] }}</td>
                          <td>{{ $aos['active'] }}</td>
                          <td><a href="/aos_approval/{{ $aos['id'] }}" ><i class="fa fa-check fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td><a href="/aos_edit/{{ $aos['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          
                          @if($aos->active =='yes')
                          <td><a href="" onclick="return alert('Active act are not able to delete!!')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
                          @else
                          <td><a href="/aos_delete/{{ $aos['id'] }}" onclick="return confirm('Are you sure, You want to delete?')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
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
@endsection
