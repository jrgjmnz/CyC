@extends('layouts.appLogin')

@section('content')
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">{{ __('Login') }}</div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <div class="form-label-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email address" name="email" required="required" autofocus="autofocus">
                        <!-- <input id="inputEmail" type="email" class="form-control" placeholder="Email address" required="required" autofocus="autofocus"> -->
                            <label for="email">{{ __('E-Mail Address') }}</label>
                        <!-- <label for="inputEmail">Email address</label> -->
                            
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label-group">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required="required">
                            <!-- <input id="inputPassword" type="password" class="form-control" placeholder="Password" required="required"> -->
                            <label for="password">{{ __('Password') }}</label>
                            <!-- <label for="inputPassword">Password</label> -->
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!--
                        <div class="form-group">
                        <div class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me">
                            Remember Password
                        </label>
                        </div>
                    </div> 
                    -->

                    <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
