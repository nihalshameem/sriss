@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 100px">
    <div class="row">
        <div class="col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#F3F8FA;">Add Sub Category</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="/addSubCategory" method="POST">
                             {{ csrf_field() }}
         
<input type="hidden" name="type" value="2">

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="type">Type:</label>
                          <div class="col-sm-5">
                            <select name="typeId" style="width: 250px;border-radius: 4px;background-color: white;height: 30px">
                              <option value="1">Donation</option>
                              <option value="2">Sanadhanam</option>
                              <option value="3">Shopping Cart</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="category">Category Name:</label>
                          <div class="col-sm-5">
                            <input type="text" style="width: 250px" class="form-control" id="category" placeholder="Enter Category Name" name="category" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="keyvalue">Key value:</label>
                          <div class="col-sm-5">
                            <input type="text" style="width: 250px" class="form-control" id="keyvalue" placeholder="Enter Key value" name="keyvalue" required>
                          </div>
                        </div>

                        <div class="form-group">        
                          <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default" name="submit">Submit</button>
                            <a class="btn btn-default btn-close" href="/category">Cancel</a>
                          </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
