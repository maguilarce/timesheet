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
      <li class="active">Download Tutor Report</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
          @if (session()->has("message"))
              <div class="alert alert-success">
                <p>{{ session("message") }}</p>
              </div>
          @endif

          @if (count($errors)>0)
          <div class="alert alert-danger">
            @foreach ($errors->all() as $error )
                <p>{{ $error  }}</p>
            @endforeach
          </div>
              
          @endif
            <div class="box-header with-border">
                <h3><strong>Download Tutor report</strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="frm-view-tutor-time" method="post"  action="{{ route('tutorexportreport') }}" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <div class="box-body">
                <div class="form-group">
                        <label for="datepicker1">Select Start Date</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" data-provide="datepicker" class="form-control pull-right" id="datepicker1" name="datepicker1">
                        </div>
                </div>
                <div class="form-group">
                        <label for="datepicker2">Select End Date</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" data-provide="datepicker" class="form-control pull-right" id="datepicker2" name="datepicker2">
                        </div>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Download Report</button> 
            </form>
          </div>
        </div>
    </div>


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper --> 

<script>
    $( function() {
      $( ".datepicker" ).datepicker();
    } );
    </script>


@endsection