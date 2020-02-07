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
      <li class="active">View Tutor Time</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

        <div class="col-md-12 table-responsive">
                <div class="box box-primary table-responsive">
                  <div class="box-header with-border">
                        <h3><strong>View Tutor Time</strong></h3>
                  </div>
                  <div>
                    <div style="float:left;">
                    @foreach ($tutor_info as $tutor )
                              <p>&nbsp;<b>Tutor: </b>{{$tutor->first_name." ".$tutor->last_name}}</p>
                              <p>&nbsp;<b>Tutor Email: </b>{{$tutor->email}}</p>
                              <p>&nbsp;<b>Tutor ID: </b>{{$tutor->username}}</p>
                              <p >&nbsp;<b>Date Range:</b>   {{$date_from." - ".$date_to}}</p>
                              
      
                      @endforeach
                      </div>
                      <div style="float:right;">
                    @foreach ($total_times as $item)
                    <p>&nbsp;<b>Upswing Hours: </b>{{$item->Upswing}}</p>
                    <p>&nbsp;<b>Special Project Hours: </b>{{$item->SpecialProjects}}</p>
                    <p>&nbsp;<b>Total Hours in Given Range: </b>{{$item->TotalHours}}</p>
                    <br>
                    @endforeach
                      </div>
                      
                    </div>
                    <br><br>
                    
                    <table id="tutor_time" class="table tablebordered table-responsive">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Explanation</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                                @foreach ($hours as $entry )
                                    <tr>
                                        <td>{{$entry->date}}</td>
                                        <td>{{$entry->type}}</td>
                                        <td>{{$entry->quantity}}</td>
                                        <td>{{$entry->explanation}}</td>
                                        <td>{{$entry->status}}</td>
                                    </tr>
                                    
                                @endforeach
                              
                            
                  
                          </table>
                          <p style="color:red;">Notice: This Report is based on Approved Time Only</p>
                </div>
        </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper --> 




@endsection