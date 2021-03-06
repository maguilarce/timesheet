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

        <div class="col-md-12 table-responsive">
                <div class="box box-primary table-responsive">
                 
                  <div class="box-header with-border">
                        <h3><strong>Edit Tutor Time</strong></h3>
                  </div>
                  <div>
                    <div style="float:left;">

                              <p>&nbsp;<b>Tutor: </b>{{Auth::user()->first_name." ".Auth::user()->last_name}}</p>
                              <p>&nbsp;<b>Tutor Email: </b>{{Auth::user()->email}}</p>
                              <p>&nbsp;<b>Tutor ID: </b>{{Auth::user()->user_id}}</p>
                              <p >&nbsp;<b>Date Range:</b>   {{$date_from." - ".$date_to}}</p>
                              
      

                      </div>
                      
                      
                    </div>
                    <br><br>
                    
                    <table id="tutor_time" class="table tablebordered table-responsive">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                                @foreach ($hours as $entry )
                                    <tr>
                                        <td>{{$entry->id}}</td>
                                        <td>{{$entry->date}}</td>
                                        <td>{{$entry->type}}</td>
                                        <td>{{$entry->quantity}}</td>
                                        <td>{{$entry->status}}</td>
                                        <td>
                                            <a href="{{url('edit-tutor-hours2/'.$entry->id)}}" class="btn btn-warning">Edit</a>
                                            <a href="{{url('delete-tutor-entry/'.$entry->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this time entry?');">Delete</a>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                              
                            
                  
                          </table>
                          
                </div>
        </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper --> 




@endsection