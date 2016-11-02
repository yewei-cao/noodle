@extends('frontend.master')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">

    <div class="main-login">

      <h3>Please Log In, or <a href="{{ url('/auth/register') }}">Sign Up</a></h3>
      <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
          <a href="#" class="btn btn-lg btn-primary btn-block">Facebook</a>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
          <a href="#" class="btn btn-lg btn-info btn-block">Google</a>
        </div>
      </div>
      <div class="login-or">
        <hr class="hr-or">
        <span class="span-or">or</span>
      </div>

      <form class="form-horizontal" role="form" method="POST" action="/auth/login">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <label for="inputUsernameEmail">Username or email</label>
          <input type="email" class="form-control" name="email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
          <a class="pull-right" href="/password/email">Forgot password?</a>
          <label for="inputPassword">Password</label>
          <input type="password" class="form-control" name="password">
        </div>
        <div class="checkbox pull-right">
            <label>
				<input type="checkbox" name="remember"> Remember Me
			</label>
            
        </div>
        <button type="submit" class="btn btn redbtn">
          Log In
        </button>
      </form>
    
    </div>
    
  </div>
  </div>


@endsection
