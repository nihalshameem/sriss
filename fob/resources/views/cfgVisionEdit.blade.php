
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top:40px">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#F3F8FA;">Update</div>

                <div class="panel-body">
                    
                    <form class="form-horizontal" action="{{ url('cfgVisionUpdate') }}" method="POST">
                             {{ csrf_field() }}
                        
                        <input type="hidden" name="id" value="{{ $visionData['id'] }}">


                        <div class="form-group">
                          <label class="control-label col-md-3" for="cfgVision">Vision:</label> 
                          <div class="col-md-4">
                          <input type="text" class="form-control" id="cfgVision" placeholder="Enter Vision" name="cfgVision" required value="{{ $visionData['vision'] }}" >
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
g