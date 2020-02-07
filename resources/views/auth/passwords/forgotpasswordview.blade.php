@extends('admin.layouts.auth_layout')

@section('title','HCC Online Tutoring Services - Login')

@section('content')
    

<div class="login-box-body" style="background-color:#fcba03; color:black !important;">
        <p class="login-box-msg"><b>HCC Online Tutoring</b><br>Timesheet Management System</b></p>
        <p class="login-box-msg">Forgotten Password</p>
        @if (session()->has("message"))
        <div class="alert alert-danger">
          <p>{{ session("message") }}</p>
        </div>
    @endif
        <form class="form-horizontal" method="POST" action="{{ route('forgotpassword') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
               

               
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="HCC Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
               
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
               

                
                    <input id="password" type="password" class="form-control" name="password" required placeholder="New Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                    <input id="password_confirm" type="password" class="form-control" name="password_confirm" required placeholder="Confirm New Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password_confirm'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirm') }}</strong>
                        </span>
                    @endif
                
            </div>

            

            <div class="form-group">
                <div style="text-align:center;">
                    <button type="submit" class="btn btn-primary">
                        Send
                    </button><br>

                </div>
            </div>
        </form>
        
            <!-- /.col -->
          </div>
        </form>
    
      </div>
@endsection