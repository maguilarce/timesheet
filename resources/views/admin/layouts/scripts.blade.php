<!-- jQuery 3 -->
  <script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ url('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ url('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ url('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ url('dist/js/adminlte.min.js') }}"></script>
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <!-- jQuery Validation Plugin -->
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
  <!-- SweetAlert -->
  <script src="{{ url('js/sweetalert.min.js') }}"></script>
  <!-- Custom Script File -->
  <script src="{{ url('js/custom_script.js') }}"></script>
  <!-- DataTable Pending Approvals-->
  <script>
    $(function(){
      if($('#pending-approvals'.length >0)) {
      $('#pending-approvals').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('listpendingapprovals') }}",
        columns: [
          {data: 'id',name:'id'},
          {data: 'user_id',name:'user_id'},
          {data: 'date',name:'date'},
          {data: 'type',name:'type'},
          {data: 'quantity',name:'quantity'},
          {data: 'explanation',name:'explanation'},
          {data: 'status',name:'status'},
          {data: 'action_btns',name:'action_btns'}
       
        ]
      });
    }
    });
    </script>
    <!-- DataTable Tutor Time-->
    <script>
        $(document).ready( function () {
          $('#tutor_time').DataTable();
      } );
    </script>
    <!-- DataTable View Global-->
  <script>
    $(function(){
      if($('#viewglobal'.length >0)) {
      $('#viewglobal').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('viewglobaltimedata') }}",
        columns: [
          {data: 'user_id',name:'user_id'},
          {data: 'date',name:'date'},
          {data: 'type',name:'type'},
          {data: 'quantity',name:'quantity'},
          {data: 'explanation',name:'explanation'},
          {data: 'status',name:'status',className:'status'},       
        ],
        "createdRow": function( row, data, dataIndex ) {
              if(data.status==="Pending Approval")
              {
                $('td',row).addClass('status-pending');
              }
              if(data.status==="Approved")
              {
                $('td',row).addClass('status-approved');
              }
              if(data.status==="Denied")
              {
                $('td',row).addClass('status-denied');
              }
            }

 
      });
    }
   
    });
  


    </script>
    <!-- Script for Explanation field for Special Projects-->
    <script>
      $(function(){

        $('#activity').change(function(){
          
          if($(this).val()==="Special Projects")
          {
            $('#explain').css("display","block");
            console.log("Special Projects");
          }
          else {
            $('#explain').css("display","none");
            console.log("Upswing");
          }
        });
        
      });


    </script>
    <!-- Script for Denials-->
    <script>
        $(function(){
          $(document).on("click",".pending-approvals-deny",function(){
            var conf = confirm("Are you sure you want to approve this time?");
            if(conf)
            {
              var deny_id = $(this).attr("data-id");

            var postdata = {
              "_token" : "{{ csrf_token() }}",
              "deny_id":deny_id
            }

            $.post("{{ route('denytime') }}",postdata,function(response){
              var data = $.parseJSON(response);
                if(data.status == 1)
                {
                  location.reload();
                }
                else
                {
                  alert(data.message);
                }
            });
            }
          });
      
        });
      </script>

      <!-- Script for Approvals-->
    <script>
        $(function(){
          $(document).on("click",".pending-approvals-approve",function(){
            var conf = confirm("Are you sure you want to approve this time?");
            if(conf)
            {
              var approve_id = $(this).attr("data-id");

              var postdata = {
                "_token" : "{{ csrf_token() }}",
                "approve_id":approve_id
              }
  
              $.post("{{ route('approvetime') }}",postdata,function(response){
                var data = $.parseJSON(response);
                if(data.status == 1)
                {
                  location.reload();
                }
                else
                {
                  alert(data.message);
                }
                
              });
            }
            
          });
      
        });
      </script>
      <!-- DataTable Manage Users-->
      <script>
        $(function(){
          if($('#users'.length >0)) {
          $('#users').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('manageusersdata') }}",
            columns: [
              {data: 'id',name:'id'},
              {data: 'first_name',name:'first_name'},
              {data: 'last_name',name:'last_name'},
              {data: 'email',name:'email'},
              {data: 'isAdmin',name:'isAdmin'},
              {data: 'status',name:'status'},
              {data: 'created_at',name:'created_at'},
              {data: 'action_btns',name:'action_btns'}
           
            ]
          });
        }

        $(document).on("click",".delete-user", function(){
          //ajax call functions
          var conf = confirm("Are you sure you want to delete this user?");
          if(conf)
          {
            var delete_id= $(this).attr("data-id");

          var postdata = {
            "_token":"{{ csrf_token() }}",
            "delete_id":delete_id
          }
          $.post("{{ route('deleteuser') }}",postdata,function(response){
            var data = $.parseJSON(response);

            if(data.status == 1)
            {
              location.reload();
            }
            else{
              alert(data.message);
            }
          });
          }

        });
        });
        </script>
        <script>
           

        </script>
   