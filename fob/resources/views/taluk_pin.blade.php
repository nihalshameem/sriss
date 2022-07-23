@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center"><a href="{{ url('taluk_details') }}"><i class="fa fa-arrow-left fa-lg" style="float:left"></i></a>Taluk{{ $taluk['id']}} Pin Codes<a href="/add_taluk_pin/{{ $taluk['id'] }}"><i class="fa fa-plus-square fa-lg" style="float:right" ></i></a></div>

                <div class="panel-body" style="text-align: left;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Taluk</th>
                      <th>Description</th>
                      <th>Volunteer</th>
                     
                    </tr>
                  </thead>
                  <tbody>  
                    @foreach($pins as $pin)
                      <tr>
                        <td>{{ $pin['id'] }}</td>
                        <td>{{ $pin['pin'] }}</td>
                        <td>{{ $pin['description'] }}</td>
                        <td>{{ $pin['volunteer'] }}</td>
                       
                    @endforeach
                  </tbody> 
                </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
