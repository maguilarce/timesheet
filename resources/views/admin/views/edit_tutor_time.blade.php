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
      <li class="active">Edit Tutor Time</li>
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
                <h3><strong>Edit Tutor Time</strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="frm-edit-tutor-time" method="post"  action="{{ route('edittutortimedata') }}">
              {!! csrf_field() !!}
              <div class="box-body">
                
                <div class="form-group">
                    <label for="tutor">Select a tutor</label>
                    <select name="tutor" id="role" class="form-control">
                            @if(count($tutors)>0)
                                @foreach ($tutors as $index => $tutor)
                                    <option value="{{$tutor->username}}">{{$tutor->last_name.", ".$tutor->first_name}}</option>
                                @endforeach
                            @endif

                    </select>
                </div>
                <div class="form-group">
                        <label for="datepicker1">Select From Date</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" data-provide="datepicker" class="form-control pull-right" id="datepicker1" name="datepicker1">
                        </div>
                </div>
                <div class="form-group">
                        <label for="datepicker2">Select To Date</label>
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
                <button type="submit" class="btn btn-primary">View Tutor Time</button>
              </div>
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