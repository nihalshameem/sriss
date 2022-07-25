@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Advertisement</div>

                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" action="/fob/advertisement_update" method="POST">
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
                          <input type="hidden" name="id" value="{{ $advertisement['id']}}">
                          <textarea class="form-control" id="des" placeholder="" name="description" value="{{ $advertisement['description']}}" maxlength="1000" required>{{ $advertisement['description']}}</textarea>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="company">Company:</label> 
                          <div class="col-sm-5">
                          <input type="text" class="form-control" id="company" placeholder="" name="company" value="{{ $advertisement['company']}}" maxlength="200" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="img">Image Path:</label> 
                          <div class="col-sm-5">
                          <input type="file" class="form-control" id="img" placeholder="" name="img" value="{{ $advertisement['image_path']}}">
                          </div>
                          <div class="col-md-offset-3">          
                             <span style="color:red">* Image size must be less than 500kb</span><br>
                          </div>
                        </div>
                        
                         <div class="form-group">
                          <label class="control-label col-sm-3" for="bannerimg">Banner Image:</label> 
                          <div class="col-sm-5">
                          <input type="file" class="form-control" id="bannerimg" placeholder="" name="bannerimg" value="{{ $advertisement['banner_image']}}">
                          <img src="" id="bannerImgPrev" width="200px" />
                          </div>
                          <div class="col-md-offset-3">          
                             <span style="color:red">* Image size must be less than 500kb</span><br>
                             <span style="color:red">* Image height must be 50dp</span>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="link">link:</label> 
                          <div class="col-sm-5">
                          <input type="text" class="form-control" id="link" placeholder="" name="link" value="{{ $advertisement['link']}}" maxlength="300">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="fdate">From Date:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control time" id="fdate" placeholder="" name="fdate" value="{{ $advertisement['from_date']}}" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="tdate">To Date:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control time" id="tdate" placeholder="" name="tdate" value="{{ $advertisement['to_date']}}" required>
                          </div>
                        </div>


                        <div class="form-group">        
                          <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default" name="submit">Submit</button>
                            <a class="btn btn-default btn-close" href="{{ url('advertisement_details') }}">Back</a>
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
           // minDate: new Date(),
        });
    </script>


@endsection
