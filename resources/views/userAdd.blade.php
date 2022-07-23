@extends('layouts.app')

@section('content')
<div class="container">
    
    
                
    <div class="row">
        <div class="col-md-8 col-md-offset-2"><br><br>
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#F3F8FA;">Add Users
                @if ($errors->any())
                    <span style="color:red;font-size:20px;float:right">Alert! You can only upload the csv file!</span>
                @endif
                
                </div>
                
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('userAdd') }}" method="POST" enctype="multipart/form-data">
                             {{ csrf_field() }}
                       
                      <div class="form-group">
                        <label for="file">Select a file to import</label>
                        <input type="file" id="file" name="file" class="form-control" required>
                      </div>

                      <div class="form-group">
                        <button class="btn btn-primary">
                            <i class="fa fa-upload"></i>Upload
                        </button>
                      </div>

                    </form>
                </div>
            </div>
            <p style="color:red;font-size:20px;">INSTRUCTIONS :</p>
            <ul style="font-size:18px">
                <li>Upload only csv file Seperated by comma.</li>
                <li>Name , email and mobile fields are upload.</li>
                <li>Email field is optional.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
