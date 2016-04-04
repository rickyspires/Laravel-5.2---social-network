@extends('layouts.master')
<!-- meta title -->
@section('title')
    home page
@endsection

@section('content')
    
    @include('partials.errors')
    
    <div class="row">

        <div class="col-md-6">
            <h3>Sign up</h3>


            <form action="{{ route('signup') }}" method="post" role="form"> <!-- conent to the signup route -->
            
      
                <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                    <label for="email">Your E-mail</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{ Request::old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="name">Your Name</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ Request::old('name') }}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}" >
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password" value="{{ Request::old('password')}}">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <input type="hidden" name="action" value="signup">
                <button type="submit" class="btn btn-primary">Signup</button>    
                <input type="hidden" name="_token" value="{{ Session::token() }}">




            </form>
        </div>     

        <div class="col-md-6">
            <h3>Login</h3>
            <form action="{{ route('signin') }}" method="post" role="form">
           
                <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                    <label for="email">Your E-mail</label>
                    <input class="form-control" type="email" name="email" id="email" value="{{ Request::old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password" value="{{ Request::old('password') }}">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
                <input type="hidden" name="action" value="signin">

                <button type="submit" name="signin" class="btn btn-primary">Login</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">

            </form>
        </div>   

    </div>

@endsection