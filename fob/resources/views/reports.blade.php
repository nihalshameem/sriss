@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-sm-offset-2 col-md-3" >
            <div class="panel panel-default">                
                <div class="panel-body">
                <table class="table" style="background-color:#09bbe2">
                  <thead>
                    <tr>
                      <th style="background-color:#5656f8;color:white;text-align:center">Total Members Count</th>
                    </tr>
                  </thead>
                  <tbody>  
                        <tr>
                          <td style="font-size: 25px;text-align:center">{{ $totalmembers }}</td>
                        </tr>
                  </tbody> 
                </table>
                </div>
            </div>
        </div>
        
         <div class=" col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                <table class="table" style="background-color:#09bbe2">
                  <thead>
                    <tr>
                      <th style="background-color:#5656f8;color:white;text-align:center">Total Poll Responses</th>
                    </tr>
                  </thead>
                  <tbody>  
                        <tr>
                          <td style="font-size: 25px;text-align:center">{{ $totalpolls }}</td>
                        </tr>
                      
                  </tbody> 
                </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
