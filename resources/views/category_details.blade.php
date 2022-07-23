@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:100px ">
    <div class="row">

<div class="col-md-offset-2">


    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif


          <div style="margin-bottom: 20px">
            <a href="/addCategory" class="btn btn-success" style="margin-left: 1px">Add Category</a><a href="/addSubCategory" class="btn btn-success" style="margin-left: 10px">Add SubCategory</a>
          </div>
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;"><b>Categories</b> 
                </div>
                
                <div class="panel-body" style="text-align: left;">
                <table class="table">
                  <thead>
                    <tr>
                      <td>Id</td>
                      <th>Type</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($categories as $category)
                        <tr>
                            <td>{{ $category['id'] }}</td>
                          <td><?= ($category['type_id'] == "1")?"Donation":'' ?> <?= ($category['type_id'] == "2")?"Sanadhanam":'' ?>
                            <?=($category['type_id'] == "3")?"Shopping Cart":'' ?></td>
                          <td>{{ $category['category'] }}</td>
                          <td>{{ $category['sub_category'] }}</td>
                          
                          <td><a href="/categoryEdit/{{ $category['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>

                          <td><a href="/categoryDelete/{{ $category['id'] }}" onclick="return confirm('Are you sure,You want to delete?')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
                        
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
