@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Volunteer Approval</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="/volunteer_approval_update" method="POST">
                             {{ csrf_field() }}
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="memberid">Member Id:</label> 
                          <div class="col-sm-5">
                          <input type="hidden" name="id" value="{{ $volunteers['id']}}">
                          <input type="hidden" name="url" value="{{ $url }}">
                          <input type="text" class="form-control" id="memberid" name="memberid" value="{{ $volunteers['member_id']}}" readonly="">
                          </div>
                        </div>
                    
                        <div class="form-group">
                        <label class="control-label col-sm-3" for="active">Active:</label>
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
