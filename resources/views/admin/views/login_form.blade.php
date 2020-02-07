@extends('admin.layouts.auth_layout')

@section('title','HCC Online Tutoring Services - Login')

@section('content')
    

<div class="login-box-body" style="background-color:#fcba03; color:black !important;">
        <p class="login-box-msg"><b>HCC Online Tutoring</b><br>Timesheet Management System</b></p>
        <p class="login-box-msg">Sign in to start your session</p>
    
        <form action="../../index2.html" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
         
            <div style="text-align:center;">
              <button type="submit" class="btn btn-primary ">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
    
      </div>
@endsection


