@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Notification Approval</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="/notification_approval_update" method="POST">
                             {{ csrf_field() }}
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="slogam">Notification:</label> 
                          <div class="col-sm-5">
                          <input type="hidden" name="id" value="{{ $notification['id']}}">
                          <textarea class="form-control" id="slogam" placeholder="" name="slogam" value="{{ $notification['description']}}" >{{ $notification['description']}}</textarea>
                          </div>
                        </div>
                        
                        
                        <div class="form-group">
                      <label class="control-label col-sm-3" for="des">Active:</label>
                        <div class="col-sm-5">          
                          <label class="radio-inline">
                          <input type="radio" name="active" value="yes" checked>Yes
                          </label>
                          <label class="radio-inline">
                          <input type="radio" name="active" value="no">No
                          </label>
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
