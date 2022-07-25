@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 100px">
    <div class="row">
        <div class="col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#F3F8FA;">Add Shopping</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('add_shopping') }}" method="POST" enctype="multipart/form-data">
                             {{ csrf_field() }}

                        
                        <input type="hidden" name="type" value="shoppingcart">
                        

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="category">Category:</label>
                          <div class="col-sm-5">
                            <select class="form-control" id="category" placeholder="Enter Category" name="category" required>
      @foreach($categories as $key=>$value)
        <option value="{{ $value['id']}}">{{ $value['category']}}</option>
      @endforeach
      </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="subcategory">Sub Category:</label>
                          <div class="col-sm-5">
                            <select class="form-control" id="subcategory" placeholder="Enter Category" name="subcategory" required>
                            @foreach($subcategories as $key=>$value)
                              <option value="{{ $value['id']}}">{{ $value['sub_category']}}</option>
                            @endforeach
                            </select>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="name">Product Name:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="name" placeholder="" name="productName" required>
                          </div><span style="color: red" id="errmssg"></span>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="des">Description:</label>
                          <div class="col-sm-5">   
                            <textarea rows="5" class="form-control" id="des" placeholder="Enter Description" name="description"></textarea>       
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="amount">Amount :</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="amount" placeholder="" name="amount" value="0">
                          </div><span style="color: red" id="errmsg"></span>
                        </div>
                        
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="quantity">Quantity :</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="quantity" placeholder="" name="quantity" value="0">
                          </div><span style="color: red" id="errmssg"></span>
                        </div>
                        
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="image">Image:</label>
                          <div class="col-sm-5">          
                            <input type="file" class="form-control" id="image" placeholder="Upload Image"  name="image" >
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3"  ></label>
                          <div class="col-sm-6">          
                            <p style="color:red">* Image size must be less than 500kb</p>
                            <p style="color:red">* Image height must be 50dp</p>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="link">Link :</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="link" placeholder="Enter Link Address" name="link" value="">
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


<script type="text/javascript">
  $(document).ready(function () {

  $("#amount").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
   
   $("#quantity").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmssg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
   
});
</script>


@endsection
