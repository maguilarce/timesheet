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
      <li class="active">Home Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div>
      <h1>Welcome, <strong>  {{Auth::user()->first_name}}
        </strong></h1>
      <h3>Please navigate through left menu sidebar to select your options!</h3>

      @foreach ($allowable_hours as $hours )
      
      <h3 style="color: green;"><b>Allowable hours for this month: {{$hours->allowable_hours}}</b></h3>
     

@endforeach
    </div>


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper --> 
@endsection