@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">

     <div class="col-md-1">
     </div>

     <div class="col-md-6 col-md-offset-2">
        <div>

         <div>
                @if( Session::has( 'success' ))
                    <div class="alert alert-success alert-block" style="    border-color: #8ac38b;color: #388E3C;background-color: #cde0c4;">
                        <p style="font-weight:600">{{ Session::get('success') }}</p>
                    </div>
                @elseif( Session::has( 'warning' ))
                    <div class="alert alert-danger alert-block" style="border-color: #FFA07A;
              color: #388E3C;">
                        <p style="font-weight:600">{{ Session::get('warning') }}</p>
                    </div>

                @endif
                <form class="form-horizontal" method="POST" action="{{ route('admin.login') }}">
                    {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Email</label>

                    <div class="col-md-6">
                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                        <span class="help-block" style="color:white">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                        <span class="help-block" style="color:white">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                        <a class="btn" style="color: #555" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


</div>
</div>
@endsection
