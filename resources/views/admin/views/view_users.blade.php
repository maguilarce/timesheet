@extends('admin.layouts.layout')
@section('title','HCC Online Tutoring Services')
    
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      HCC Online Tutoring Services
      <small>Tutor Timesheet Management System</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">View/Manage Users</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div>
      
    </div>
    <div class="col-md-12 table-responsive">
      <div class="box box-primary table-responsive">
        <div class="box-header with-border">
            <h3><strong>View/Manage Users</strong></h3>
        </div>

        <table id="users" class="table tablebordered table-responsive">
          <thead>
            <tr>
              <th>Record ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Is Admin?<br>1-Yes <br>0-No <br>2-Needs to log in for the First Time</th>
              <th>Status</th>
              <th>Created at</th>
              <th>Action</th>
            </tr>
          </thead>

        </table>
      </div>
    </div>


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper --> 



@endsection