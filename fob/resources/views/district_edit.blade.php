@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update {{ $district['district']}}</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="/fob/district_update" method="POST">
                             {{ csrf_field() }}
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="district">District:</label> 
                          <div class="col-sm-5">
                          <input type="hidden" name="id" value="{{ $district['id']}}">
                          <input type="text" class="form-control" id="district" placeholder="Enter Zone Name" name="district" value="{{ $district['district']}}" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="des">Description:</label>
                          <div class="col-sm-5">          
                            <input type="text" class="form-control" id="des" placeholder="Enter District Description" name="description" value="{{ $district['description']}}">
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
