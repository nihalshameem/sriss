@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top:40px;">
        <div class="col-md-10 col-md-offset-2">
            
          
            
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif    
            
            
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;"><b>Visions</b><a href="{{ url( 'cfgVisionAdd' ) }}"><i class="fa fa-plus-square fa-lg" style="float:right"></i></a>
                </div>
                
                <div class="panel-body" style="text-align: left;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Vision</th>
                      <th>Update</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>  

                <?php $i =1; ?>
                    @foreach($cfgvisions as $vision)
                       <tr>
                         <td>{{ $i++ }}</td>
                         <td>{{ $vision->vision }}</td> 
                         <td><a href="/fob/cfgVisionEdit/{{ $vision->id }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                         <td><a href="/fob/cfgVisionDelete/{{ $vision->id }}" onclick="return confirm('Are you sure,You want to delete?')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
                       </tr>
                     @endforeach
                  </tbody> 
                </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >


@endsection
