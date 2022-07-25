@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center"><a href="{{url('district_details')}}"><i class="fa fa-arrow-left fa-lg" style="float:left"></i></a><b>{{ $district['district']}} Districts </b><a href="/add_district_taluk/{{ $district['id'] }}"><i class="fa fa-plus-square fa-lg" style="float:right" ></i></a></div>

                <div class="panel-body" style="text-align: left;">
                <table class="table">
                    
                    <?php
                        $i=1;
                    ?>
                    
                  <thead>
                    <tr>
                      <th>SI NO</th>
                      <th>Taluk</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>  
                    @foreach($taluks as $taluk)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $taluk['taluk'] }}</td>
                        <td>{{ $taluk['description'] }}</td>
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
