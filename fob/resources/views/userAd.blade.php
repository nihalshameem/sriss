@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top:50px">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#F3F8FA;">Add Users</div>

                <div class="panel-body">
                    
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                    <form class="form-horizontal" action="{{ url('userAdd') }}" method="POST" enctype="multipart/form-data">
                             {{ csrf_field() }}
                       
                      
                    <div class="form-group row">
                        <label for="file" class="col-sm-2 col-form-label">Choose File</label>
                        <div class="col-sm-4">
                        <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <div class="col-sm-4">
                        <button class="btn btn-primary">
                            <i class="fa fa-upload"></i>Upload
                        </button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
