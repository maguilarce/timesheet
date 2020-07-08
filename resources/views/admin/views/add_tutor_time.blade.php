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
      <li class="active">Add Tutor Time</li>
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
                <h3><strong>Add Tutor Time</strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="frm-add-tutor-time" method="post" action="{{ route('savetutortime') }}">
              {!! csrf_field() !!}
              <div class="box-body">
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
                  <label for="datepicker">Select Date</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" data-provide="datepicker" class="form-control pull-right" id="datepicker" name="datepicker">
                  </div>
                </div>
                <div class="form-group">
                    <label for="activity">Select Activity</label>
                    <select id="activity" name="activity"class="form-control">
                        <option value="Upswing">Upswing</option>
                        <option value="Special Projects">Special Projects</option>
                    </select>
                </div>
                <div class="form-group" name="explain" id="explain" style="display:none;">
                    <label for="explanation">If special project, please explain</label>
                    <input class="form-control" type="text" name="explanation" id="explanation">
                </div>
                <div class="form-group">
                        <label for="hours">Select Worked Hours</label>
                        <select id="hours" name="hours"class="form-control">
                            <option value="0.5">0.5 hour</option>
                            <option value="1">1 hour</option>
                            <option value="1.5">1.5 hours</option>
                            <option value="2">2 hours</option>
                            <option value="2.5">2.5 hours</option>
                            <option value="3">3 hours</option>
                            <option value="3.5">3.5 hours</option>
                            <option value="4">4 hours</option>
                            <option value="4.5">4.5 hours</option>
                            <option value="5">5 hours</option>
                            <option value="5.5">5.5 hours</option>
                            <option value="6">6 hours</option>
                            <option value="6.5">6.5 hours</option>
                            <option value="7">7 hours</option>
                            <option value="7.5">7.5 hours</option>
                            <option value="8">8 hours</option>
                        </select>
                    </div>
                
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add time</button>
              </div>
            </form>
          </div>
        </div>
    </div>


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper --> 
@endsection