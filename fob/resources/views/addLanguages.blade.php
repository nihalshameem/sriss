@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top:40px">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#F3F8FA;">Add</div>

                <div class="panel-body">
                    



                    <form class="form-horizontal" action="{{ url('languageAdd') }}" method="POST">
                             {{ csrf_field() }}
     

                        <div class="form-group">
                          <label class="control-label col-md-3" for="language">Language:</label> 
                          <div class="col-md-4">
                          <input type="text" class="form-control" id="language" placeholder="Enter Language" name="language" required>
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
