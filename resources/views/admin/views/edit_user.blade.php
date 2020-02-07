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
      <li class="active">Edit User</li>
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
              <h3><strong>Edit User</strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="frm-add-user" method="post" action="{{ route('editsuserdata') }}" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <input type="hidden" value="{{$user->id }}" name="update_id" />
              <div class="box-body">
                <div class="form-group">
                  <label for="first_name">First Name</label>
                    <input value="{{$user->first_name}}" type="text" name="first_name" id="first_name" class="form-control" placeholder="Type User's First Name...">        
                </div>
                <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input value="{{$user->last_name}}" type="text" name="last_name" id="last_name" class="form-control" placeholder="Type User's Last Name...">        
                </div>
                <div class="form-group">
                    <label for="email">HCC Email</label>
                    <input value="{{$user->email}}" type="email" name="email" id="email" class="form-control" placeholder="Type User's HCC Email">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                            @if ($user->isAdmin == '1' )
                            <option value="1" selected>Admin</option>
                            <option value="0">Tutor</option>
                            @else
                            <option value="1" >Admin</option>
                            <option value="0" selected>Tutor</option>
                            @endif
                    </select>
                </div>
                <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status"class="form-control">
                                @if ($user->status === 'Active' )
                                <option value="Active" selected>Active</option>
                                <option value="Inactive">Inactive</option>
                                @else
                                <option value="Active" >Active</option>
                                <option value="Inactive" selected>Inactive</option>
                                @endif
                        </select>
                </div>
              
                
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update User</button>
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