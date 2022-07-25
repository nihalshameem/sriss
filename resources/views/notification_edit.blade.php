@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Notification</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="/notification_update" method="POST" enctype="multipart/form-data">
                             {{ csrf_field() }}
                             
                        @if(Session::has('date-error'))
                        <div class="form-group">
                          <label class="control-label col-sm-3" for=""></label>
                          <div class="col-sm-8"> 
                              <strong style="color:red">To Date must be greater than from date!!</strong> {{ Session::get('message', '') }}             
                          </div>
                        </div>
                        @endif
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="des">Description:</label> 
                          <div class="col-sm-5">
                          <input type="hidden" name="id" value="{{ $notification['id']}}">
                          <textarea class="form-control" id="des" placeholder="" name="description" value="{{ $notification['description']}}"  required>{{ $notification['description']}}</textarea>
                          </div>
                        </div>
                        
                         @if(Session::has('message'))
                        <div class="form-group">
                          <label class="control-label col-sm-3" for=""></label>
                          <div class="col-sm-8"> 
                              <strong style="color:red">Description Required!!</strong> {{ Session::get('message', '') }}             
                          </div>
                        </div>
                        @endif
                        

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="fdate">From Date:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control time" id="fdate" placeholder="" name="fdate" value="{{ $notification['from_date']}}" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="tdate">To Date:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control time" id="tdate" placeholder="" name="tdate" value="{{ $notification['to_date']}}" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="img">Image :</label>
                          <div class="col-sm-5">          
                            <input type="file" class="form-control" id="img" placeholder="Upload Image" name="image" >
                            <img src="" id="profile-img-tag" width="200px" />
                          </div>
                          <div class="col-sm-3">          
                             <span style="color:red">* Image size less than 500kb</span>
                          </div>
                        </div>
                        
                        <div class="form-group" id="existImg">
                          <label class="control-label col-sm-3" for="img"></label>
                          <div class="col-sm-5">          
                            <img src="/storage/app/public/upload/notifications/{{ $imagename }}" width="200px" height="200px" alt="No Image">
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


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> 
    
    <script>
        $('.time').datetimepicker({
            format: '20YY-MM-DD HH:mm:ss',
            //minDate: new Date(),
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
    
    
    <script type="text/javascript">
       $('#img').change( function()
        {
            var image = $(this).val();
        
                $('#existImg').hide();
           
        });
    </script>

@endsection
