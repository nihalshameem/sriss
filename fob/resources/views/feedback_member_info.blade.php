@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;">Feedback Details</div>

                <div class="panel-body" style="text-align: left;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Member Id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile No.</th>
                      <th>Whatsapp No.</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($feed_member as $fmember)
                        <tr>
                          <td>{{ $fmember->member_id }}</td>
                          <td>{{ $fmember->name }}</td>
                          <td>{{ $fmember->email }}</td>
                          <td>{{ $fmember->mobile_number }}</td>
                          <td>{{ $fmember->whatsapp_number }}</td>
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
