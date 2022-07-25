@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Advertisement</div>

                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('add_advertisement') }}" method="POST">
                             {{ csrf_field() }}

                        @if(Session::has('date-error'))
                        <div class="form-group">
                          <label class="control-label col-sm-3" for=""></label>
                          <div class="col-sm-8"> 
                              <strong style="color:red">To Date must be greater than from date!!</strong> {{ Session::get('message', '') }}             
                          </div>
                        </div>
                        @endif
                        
                         @if(Session::has('image-error'))
                        <div class="form-group">
                          <label class="control-label col-sm-3" for=""></label>
                          <div class="col-sm-8"> 
                              <strong style="color:red">Image size must be less than 500kb!!</strong> {{ Session::get('message', '') }}             
                          </div>
                        </div>
                        @endif
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="des">Description:</label>
                          <div class="col-sm-8"> 
                             <textarea class="form-control" id="des" rows="5" cols="50" name="description" placeholder="Enter Description" maxlength="3000" required></textarea>             
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="company">Company:</label>
                          <div class="col-sm-8">          
                            <input type="text" class="form-control" id="company" placeholder="Enter Company Name" name="company" maxlength="200" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="img">Image Path:</label>
                          <div class="col-sm-6">          
                            <input type="file" class="form-control" id="img" placeholder="Upload Image" name="img" >
                            <img src="" id="profileImgPrev" width="200px" />
                          </div>
                         </div>
                          <div class="col-md-offset-3">          
                             <span style="color:red">* Image size must be less than 500kb</span>
                          </div>
                        
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="bannerimg">Banner  Image:</label>
                          <div class="col-sm-6">          
                            <input type="file" class="form-control" id="bannerimg" placeholder="Upload Image" name="bannerimg" >
                            <img src="" id="bannerImgPrev" width="200px" />
                          </div>
                         </div>
                          <div class="col-md-offset-3">          
                             <span style="color:red">* Image size must be less than 500kb</span><br>
                             <span style="color:red">* Image height must be 50dp</span>
                          </div>
                        

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="link">Link:</label>
                          <div class="col-sm-8">          
                            <input type="text" class="form-control" id="link" placeholder="Enter Link" name="link" maxlength="300" >
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="fdate">From Date:</label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control time" id="fdate" placeholder="Select From Date" name="fdate" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="tdate">To Date:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control time" id="tdate" placeholder="Enter To Date " name="tdate" required>
                          </div>
                        </div>

                        <input type="hidden" name="active" value="no">

                        <div class="form-group">        
                          <div class="col-sm-offset-3 col-sm-5">
                            
                            <a class="btn btn-default btn-close" href="{{ url('advertisement_details') }}">Back</a>

                            <button type="submit" class="btn btn-default" name="submit">Next</button>

                          </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> 
    
    <script>
        $('.time').datetimepicker({
            format: '20YY-MM-DD HH:mm:ss',
            minDate: new Date(),
        });
    </script>
    
    
    <script type="text/javascript">
        function readURL(input,prevId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                //console.log(reader);
                reader.onload = function (e) {
                    $('#'+prevId).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#img").change(function(){
          //console.log(this);
            readURL(this,'profileImgPrev');
        });
        $("#bannerimg").change(function(){
            readURL(this,'bannerImgPrev');
        });
    </script>


@endsection
