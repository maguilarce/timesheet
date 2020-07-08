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
            <form role="form" id="frm-edit-tutor-time" method="post" action="{{ route('editsuserdata') }}" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <input type="hidden" value="{{$time->id }}" name="update_id" />
              <div class="box-body">
              
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input value="{{$time->quantity}}" type="text" name="quantity" id="quantity" class="form-control">        
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

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status"class="form-control">
                            @if ($time->status === 'Approved' )
                            <option value="Approved" selected>Approved</option>
                            <option value="Denied">Denied</option>
                            @else
                            <option value="Approved" >Approved</option>
                            <option value="Denied" selected>Denied</option>
                            @endif
                    </select>
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