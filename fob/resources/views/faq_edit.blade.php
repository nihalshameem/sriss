@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update FAQ</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="/faq_update" method="POST">
                             {{ csrf_field() }}
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="faq">FAQ:</label> 
                          <div class="col-sm-5">
                          <input type="hidden" name="id" value="{{ $vision['id']}}">
                          
                          <textarea class="form-control" id="faq" placeholder="" name="vision" value="{{ $vision['vision']}}" >{{ $vision['vision']}}</textarea>
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
