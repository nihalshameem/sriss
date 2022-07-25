@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;">Terms And Conditions</div>

                <div class="panel-body" style="text-align: left;">
               <table class="table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Tamil</th>
                      <th>English</th>
                      <th>Update</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($tacs as $tac)
                        <tr>
                          <td>{{ $tac['id'] }}</td>
                          <td>{{ $tac['config_name'] }}</td>
                          <td>{{ $tac['text_tamil'] }}</td>
                          <td>{{ $tac['text_english'] }}</td>
                          <td><a href="/tac_edit/{{ $tac['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
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
