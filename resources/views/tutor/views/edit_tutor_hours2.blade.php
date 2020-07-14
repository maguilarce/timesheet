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
            <form role="form" id="frm-edit-tutor-time" method="post" action="{{ route('edittutorentry2') }}" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <input type="hidden" value="{{$time->id }}" name="update_id" />
              <div class="box-body">
              
                <div class="form-group">
                  <label for="hours">Select Worked Hours</label>
                  <select id="hours" name="quantity" class="form-control">
                    @if ($time->quantity == "0.5" )
                    <option value="0.5" selected>0.5 hour</option>
                    @else
                    <option value="0.5">0.5 hour</option>
                    @endif
                    @if ($time->quantity == "1" )
                    <option value="1" selected>1 hour</option>
                    @else
                    <option value="1">1 hour</option>
                    @endif
                    @if ($time->quantity == "1.5" )
                    <option value="1.5" selected>1.5 hour</option>
                    @else
                    <option value="1.5">1.5 hour</option>
                    @endif 
                    @if ($time->quantity == "2" )
                    <option value="2" selected>2 hours</option>
                    @else
                    <option value="2">2 hours</option>
                    @endif
                    @if ($time->quantity == "2.5" )
                    <option value="2.5" selected>2.5 hours</option>
                    @else
                    <option value="2.5">2.5 hours</option>
                    @endif
                    @if ($time->quantity == "3" )
                    <option value="3" selected>3 hours</option>
                    @else
                    <option value="3">3 hours</option>
                    @endif
                    @if ($time->quantity == "3.5" )
                    <option value="3.5" selected>3.5 hours</option>
                    @else
                    <option value="3.5">3.5 hours</option>
                    @endif
                    @if ($time->quantity == "4" )
                    <option value="4" selected>4 hours</option>
                    @else
                    <option value="4">4 hours</option>
                    @endif
                    @if ($time->quantity == "4.5" )
                    <option value="4.5" selected>4.5 hours</option>
                    @else
                    <option value="4.5">4.5 hours</option>
                    @endif
                    @if ($time->quantity == "5" )
                    <option value="5" selected>5 hours</option>
                    @else
                    <option value="5">5 hours</option>
                    @endif
                    @if ($time->quantity == "5.5" )
                    <option value="5.5" selected>5.5 hours</option>
                    @else
                    <option value="5.5">5.5 hours</option>
                    @endif
                    @if ($time->quantity == "6" )
                    <option value="6" selected>6 hours</option>
                    @else
                    <option value="6">6 hours</option>
                    @endif
                    @if ($time->quantity == "6.5" )
                    <option value="6.5" selected>6.5 hours</option>
                    @else
                    <option value="6.5">6.5 hours</option>
                    @endif
                    @if ($time->quantity == "7" )
                    <option value="7" selected>7 hours</option>
                    @else
                    <option value="7">7 hours</option>
                    @endif
                    @if ($time->quantity == "7.5" )
                    <option value="7.5" selected>7.5 hours</option>
                    @else
                    <option value="7.5">7.5 hours</option>
                    @endif
                    @if ($time->quantity == "8" )
                    <option value="8" selected>8 hours</option>
                    @else
                    <option value="8">8 hours</option>
                    @endif
                  </select>
              </div>  

               
                <div class="form-group">
                  <label for="datepicker">Select Date</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" value="{{date('m/d/Y',strtotime($time->date))}}" data-provide="datepicker" class="form-control pull-right" id="datepicker1" name="date">
                  </div>
                </div>
                <div class="form-group">
                        <label for="type">Type</label>
                        <select id="type" name="type"class="form-control">
                                @if ($time->type === 'Upswing' )
                                <option value="Upswing" selected>Upswing</option>
                                <option value="Special Projects">Special Projects</option>
                                @else
                                <option value="Upswing" >Upswing</option>
                                <option value="Special Projects" selected>Special Projects</option>
                                @endif
                        </select>
                </div>
                <div class="form-group" name="explain" id="explain" >
                  <label for="explanation">If special project, please explain</label>
                <input class="form-control" type="text" name="explanation" id="explanation" value="{{$time->explanation}}">
              </div>

          
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update Time Entry</button>
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