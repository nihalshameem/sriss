@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;">Member Id Format</div>

                <div class="panel-body" style="text-align: left;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Format</th>
                      <th>Update</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($memberid as $member)
                        <tr>
                          <td>{{ $member['id'] }}</td>
                          <td>{{ $member['memberIdFormat'] }}</td>
                          <td><a href="/memberIdFormatEdit/{{ $member['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
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
