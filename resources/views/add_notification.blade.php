@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Notification</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('add_notification') }}" enctype="multipart/form-data" method="POST">
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
                          <div class="col-sm-9"> 
                             <textarea class="form-control" id="des" rows="5" cols="50" name="description" placeholder="Enter Description" required></textarea>             
                          </div>
                        </div>
                        
                        
                         @if(Session::has('message'))
                        <div class="form-group">
                          <label class="control-label col-sm-3" for=""></label>
                          <div class="col-sm-8"> 
                              <strong style="color:red">Description Required</strong> {{ Session::get('message', '') }}             
                          </div>
                        </div>
                        @endif
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="fdate">From Date:</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control time" id="fdate" placeholder="Select From Date" name="fdate" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="tdate">To Date:</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control time" id="tdate" placeholder="Enter To Date " name="tdate" required>
                          </div>
                        </div>
                        
                         <div class="form-group">
                          <label class="control-label col-sm-3" for="img">Image :</label>
                          <div class="col-sm-6">          
                            <input type="file" class="form-control" id="img" placeholder="Upload Image"  name="image" >
                            <img src="" id="profile-img-tag" width="200px" />
                          </div>
                          <div class="col-sm-3">          
                             <span style="color:red">* Image size less than 500kb</span>
                          </div>
                        </div>

                        <input type="hidden" name="active" value="no">

                        <div class="form-group">        
                          <div class="col-sm-offset-3 col-sm-5"> 
                          <a class="btn btn-default btn-close" href="{{ redirect()->getUrlGenerator()->previous() }}">Back</a>
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#profile-img-tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#img").change(function(){
            readURL(this);
        });
    </script>


@endsection
