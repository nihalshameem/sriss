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
                      <th>Id</th>
                      <th>Member</th>
                      <th>Feedback</th>
                      <th>Date</th>
                      <th>Response</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($feedbacks as $feedback)
                        <tr>
                          <td>{{ $feedback['id'] }}</td>
                          <td><a style="text-decoration:none;" href="/fob/feedback_info/{{ $feedback['member_id'] }}">{{ $feedback['member_id'] }}</a></td>
                          <td>{{ $feedback['description'] }}</td>
                          <td>{{ $feedback['date'] }}</td>
                          <td><a href="/fob/feedbackMail/{{ $feedback['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
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
