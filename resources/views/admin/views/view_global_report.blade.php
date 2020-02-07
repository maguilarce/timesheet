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
      <li class="active">Generate Global Report</li>
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
              <h3><strong>Global Report</strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="frm-view-tutor-time" method="post" action="{{ route('downloadglobalreport') }}" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <div class="box-body ">
                  <div >
                    
                                <p >&nbsp;<b>Date Range:</b>   {{$date_from." - ".$date_to}}</p>
                                <br>
                               
        
                      
                        </div>
                <table class="table tablebordered table-responsive">
                    <thead>
                      <tr>
                        <th>Tutor</th>
                        <th>Username</th>
                        <th>Date</th>
                        <th>Type of Hour</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>
                    @foreach ($report as $item)
                    <tr>
                        <td>{{$item->Tutor }}</td>
                        <td>{{$item->UserID }}</td>
                        <td>{{$item->Date }}</td>
                        <td>{{$item->Type }}</td>
                        <td>{{$item->Quantity }}</td>
                        
                       
                    </tr>
                    
                    @endforeach
                  </table>
                  <p style="color:red;">Notice: This Report is based on Approved Time Only</p>
                
                
              </div>
              <!-- /.box-body -->

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