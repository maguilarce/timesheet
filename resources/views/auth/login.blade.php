@extends('admin.layouts.auth_layout')

@section('title','HCC Online Tutoring Services - Login')

@section('content')
    

<div class="login-box-body" style="background-color:#fcba03; color:black !important;">
        <p class="login-box-msg"><b>HCC Online Tutoring</b><br>Timesheet Management System</b></p>
        <p class="login-box-msg">Sign in to start your session</p>
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
               

               
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus autocomplete="off" placeholder="HCC Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
               
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
               

                
                    <input id="password" type="password" class="form-control" name="password" autocomplete="off" required placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                
            </div>

            

            <div class="form-group">
                <div style="text-align:center;">
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button><br>

                    <a class="btn btn-link" href="{{ route('forgotpasswordview') }}">
                        Forgot Your Password?
                    </a>
                </div>
            </div>
        </form>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
            <!-- /.col -->
          </div>
        </form>
    
      </div>
@endsection