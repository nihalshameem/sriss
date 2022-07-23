@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update </div>

                <div class="panel-body">
                    <form class="form-horizontal" action="/categoryUpdate" method="POST">
                             {{ csrf_field() }}
                        <input type="hidden" name="type" value="{{ $categories['type'] }}">
                        <input type="hidden" name="id" value="{{ $categories['id'] }}">



                        <div class="form-group">
                          <label class="control-label col-sm-3" for="type">Type:</label>
                          <div class="col-sm-5">
                            <select name="typeId" style="width: 250px;border-radius: 4px;background-color: white;height: 30px">
                              <option value="1" <?= ($categories['typeId'] == "1")?"selected":'' ?> >Donation</option>
                              <option value="2" <?= ($categories['typeId'] == "2")?"selected":'' ?> >Sanadhanam</option>
                              <option value="3" <?= ($categories['typeId'] == "3")?"selected":'' ?>>Shopping Cart</option>
                            </select>
                          </div>
                        </div>



                        <div class="form-group" >
                          <label class="control-label col-sm-3" for="category" <?= ( $categories['category'] =="" || $categories['category'] == null)?'hidden':'text' ?>>Category Name:</label>
                          <div class="col-sm-5">
                            <input type="<?= ( $categories['category'] =="" || $categories['category'] == null)?'hidden':'text' ?>" style="width: 250px" class="form-control" id="category" placeholder="Enter Category Name" name="category" value="{{ $categories['category'] }}" required>
                          </div>
                        </div>




                        <div class="form-group">
                          <label class="control-label col-sm-3" for="category" <?= ( $categories['sub_category'] =="" || $categories['sub_category'] == null)?'hidden':'' ?>>Sub Category Name:</label>
                          <div class="col-sm-5">
                            <input type="<?= ( $categories['sub_category'] =="" || $categories['sub_category'] == null)?'hidden':'text' ?>" style="width: 250px" class="form-control" id="subCategory" placeholder="Enter Category Name" name="subCategory" value="{{ $categories['sub_category'] }}" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="keyvalue" >Key Value:</label>
                          <div class="col-sm-5">
                            <input type="text" style="width: 250px" class="form-control" id="keyvalue" placeholder="Enter Category Name" name="keyvalue" value="{{ $categories['keyvalue'] }}">
                          </div>
                        </div>

                        <div class="form-group">        
                          <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default" name="submit">Submit</button>
                            <a class="btn btn-default btn-close" href="{{ redirect()->getUrlGenerator()->previous() }}">Cancel</a>
                          </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
