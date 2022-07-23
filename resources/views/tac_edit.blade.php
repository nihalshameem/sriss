@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Terms and Conditions</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="/tac_update" method="POST">
                             {{ csrf_field() }}
                        
                         <div class="form-group">
                          <label class="control-label col-md-2" for="tamil">Tamil:</label> 
                          <div class="col-md-10">
                          <input type="hidden" name="id" value="{{ $vision['id']}}">
                          <textarea class="form-control" id="tamil" placeholder="" rows="10" name="tamil" value="{{ $vision['text_tamil']}}"  required>{{ $vision['text_tamil']}}</textarea>
                          </div>
                        </div>
                        
                         <div class="form-group">
                          <label class="control-label col-md-2" for="english">English:</label> 
                          <div class="col-sm-10">
                          <textarea class="form-control" id="english" placeholder="" rows="10" name="english" value="{{ $vision['text_english']}}"  required>{{ $vision['text_english']}}</textarea>
                          </div>
                        </div>
                        
                         <div class="form-group">
                          <label class="control-label col-md-2" for="hindi">Hindi:</label> 
                          <div class="col-md-10">
                          <textarea class="form-control" id="hindi" placeholder="" rows="10" name="hindi" value="{{ $vision['text_hindi']}}"  required>{{ $vision['text_hindi']}}</textarea>
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
