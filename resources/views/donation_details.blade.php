@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:100px ">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;"><b>Donations</b><a href="{{ url( 'add_donation' ) }}"><i class="fa fa-plus-square fa-lg" style="float:right"></i></a> 
                </div>
                
                <div class="panel-body" style="text-align: left;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Type</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      <th>Tamil</th>
                      <!--<th>English</th>-->
                      <!--<th>Hindi</th>-->
                      <th>Amount Per Day</th>
                      <th>Amount</th>
                      <th>No Of Persons</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>  
                      @foreach($donations as $donation)
                      
                      
                      
        <?php    
        
        $category = DB::table('categories')->where('id', $donation['category'])->pluck('category')->toArray();
        
        $subCategory = DB::table('categories')->where('id', $donation['subcategory'])->pluck('sub_category')->toArray();
                      
        ?>             
                      
                        <tr>
                          <td>{{ $donation['type'] }}</td>
                          <td>{{ $category[0] }}</td>
                          <td>{{ $subCategory[0] }}</td>
                          <td>{{ $donation['tamil'] }}</td>
                          <!--<td>{{ $donation['english'] }}</td>-->
                          <!--<td>{{ $donation['hindi'] }}</td>-->
                          <td>{{ $donation['amount_per_day'] }}</td>
                          <td>{{ $donation['no_of_days'] }}</td>
                          <td>{{ $donation['noOfPersons'] }}</td>
                          <td><a href="/donation_edit/{{ $donation['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td><a href="/donation_delete/{{ $donation['id'] }}" onclick="return confirm('Are you sure,You want to delete?')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
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
