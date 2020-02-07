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
      <li class="active">View Global Time</li>
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
            <h3><strong>View Recently Input Times</strong></h3>
        </div>

        <table id="viewglobal" class="table tablebordered table-responsive">
          <thead>
            <tr>
              <th>Tutor ID</th>
              <th>Date</th>
              <th>Type</th>
              <th>Hours</th>
              <th>Explanation</th>
              <th>Status</th>
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