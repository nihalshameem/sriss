@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:100px ">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;"><b>Shopping Cart</b><a href="{{ url( 'add_shopping' ) }}"><i class="fa fa-plus-square fa-lg" style="float:right"></i></a> 
                </div>
                
                <div class="panel-body" style="text-align: left;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Type</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      <th>Description</th>
                      <th>Quantity</th>
                      <th>Amount</th>
                      <th>Link</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($shoppings as $shopping)
                        <tr>
                          <td>{{ $shopping['type'] }}</td>
                          <td>{{ $shopping['category'] }}</td>
                          <td>{{ $shopping['subcategory'] }}</td>
                          <td>{{ $shopping['description'] }}</td>
                          <td>{{ $shopping['quantity'] }}</td>
                          <td>{{ $shopping['amount'] }}</td>
                           <td>{{ $shopping['link'] }}</td>
                          <td><a href="/shopping_edit/{{ $shopping['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td><a href="/shopping_delete/{{ $shopping['id'] }}" onclick="return confirm('Are you sure,You want to delete?')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
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
