@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:100px ">
    <div class="row">
        <div class="col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;"><b>Sanadhanam</b><a href="{{ url( 'add_sanadhanam' ) }}"><i class="fa fa-plus-square fa-lg" style="float:right"></i></a> 
                </div>
                
                <div class="panel-body" style="text-align: left;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Type</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      <th>Tamil</th>
                      <th>Amount</th>
                      <th>Link</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($sanadhanams as $sanadhanam)
                      
                      
                    <?php    
        
            $cate = App\Category::where('id',$sanadhanam['category'])->first();
            
            $subCate = App\Category::where('id',$sanadhanam['subcategory'])->first();

                        
                    ?>
                        
                        <tr>
                          <td>{{ $sanadhanam['type'] }}</td>
                          <td>{{ $cate['category'] }}</td>
                          <td>{{ $subCate['sub_category'] }}</td>
                          <td>{{ $sanadhanam['tamil'] }}</td>
                          <td>{{ $sanadhanam['amount'] }}</td>
                          <td>{{ $sanadhanam['link'] }}</td>
                          <td><a href="/sanadhanam_edit/{{ $sanadhanam['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td><a href="/sanadhanam_delete/{{ $sanadhanam['id'] }}" onclick="return confirm('Are you sure,You want to delete?')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
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
