@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;"><a href="{{ redirect()->getUrlGenerator()->previous() }}"><i class="fa fa-arrow-left fa-lg" style="float:left"></i></a>{{ $district['district']}} &nbsp Volunteers</div>

                <div class="panel-body" style="text-align: left;">
                <table class="table">
                 <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile Number</th>
                      <th>Member Id</th>
                      <th>Active</th>
                      <th>De Act</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>  
                    @foreach($districtvolunteers as $volunteer)
                      <tr>
                        <td>{{ $volunteer->name }}</td>
                        <td>{{ $volunteer->email }}</td>
                        <td>{{ $volunteer->mobile_number }}</td>
                        <td>{{ $volunteer->member_id }}</td>
                        <td>{{ $volunteer->active }}</td>
                        <td><a href="/fob/volunteer_approval/{{ $volunteer->id }}" ><i class="fa fa-check fa-lg" style="text-align:cenetr;"></i></a></td>
                        <td><a href="/fob/volunteer_destroy/{{ $volunteer->id }}"   onclick="return confirm('Are you sure,You want to delete?')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
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
