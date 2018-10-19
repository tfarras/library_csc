@extends('auth.auth')

@section('content')

    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">Register an Account</div>
            <div class="card-body">
                <form method="POST" action="{{route('register')}}">
                    {{@csrf_field()}}
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" id="firstName" name="first_name" value="{{old('first_name')}}" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="First name" required="required" autofocus="autofocus">
                                    <label for="firstName">First name</label>
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" id="lastName" name="last_name" value="{{old('last_name')}}" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="Last name" required="required">
                                    <label for="lastName">Last name</label>
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="email" id="inputEmail" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email')}}" placeholder="Email address" required="required">
                            <label for="inputEmail">Email address</label>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="username" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{old('username')}}" placeholder="Username" required="required">
                            <label for="username">Username</label>
                            @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="password" id="inputPassword" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required="required">
                                    <label for="inputPassword">Password</label>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="password" id="confirmPassword" class="form-control"  name="password_confirmation" placeholder="Confirm password" required="required">
                                    <label for="confirmPassword">Confirm password</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" >Register</button>
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="{{route('login')}}">Login Page</a>
                <!--<a class="d-block small" href="{{route('password.request')}}">Forgot Password?</a>-->
                </div>
            </div>
        </div>
    </div>

@endsection
