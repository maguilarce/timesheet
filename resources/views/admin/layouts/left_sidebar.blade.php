<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          
  
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
  
  
  
            <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> <span>Home</span></a></li>


            <!-- Admin Menu -->
            @if (Auth::user()->isAdmin)
            <li><a href="{{ route('viewpendingapprovals') }}"><i class="fa fa-clock-o"></i> <span>Pending Approvals</span></a></li>
            <li class=" treeview">
                <a href="#">
                  <i class="fa fa-user "></i> <span>Tutor Time</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('addtutortime') }}"><i class="fa fa-calendar-plus-o"></i> <span>Add Tutor Time</span></a></li>
                    <li><a href="{{ route('viewtutortime') }}"><i class="fa fa-table"></i> <span>View Tutor Time</span></a></li>
                    <li><a href="{{ route('generatetutorreport') }}"><i class="fa  fa-download"></i> <span>Download Tutor Report</span></a></li>
                </ul>
              </li>
              <li class=" treeview">
                  <a href="#">
                    <i class="fa fa-users "></i> <span>Global Tutoring Time</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                      <li><a href="{{ route('viewglobaltime') }}"><i class="fa fa-table"></i> <span>View Recently Input Times</span></a></li>
                      <li><a href="{{ route('generateglobalreport') }}"><i class="fa fa-files-o"></i> <span>Generate Global Report</span></a></li>
                      <li><a href="{{ route('downloadglobalreport') }}"><i class="fa  fa-download"></i> <span>Download Global Report</span></a></li>
                  </ul>
                </li>


            <li class=" treeview">
                <a href="#">
                  <i class="fa fa-address-card "></i> <span>Manage Users</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{ route('manageusers') }}"><i class="fa fa-users"></i> View/Manage Users</a></li>
                  <li><a href="{{ route('adduser') }}"><i class="fa fa-user-plus"></i> Add a New User</a></li>
                 
                </ul>
              </li>
              <!-- Tutor Menu -->
            @else
            <li class=" treeview">
                <a href="#">
                  <i class="fa fa-user "></i> <span>Tutor Time</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('tutoraddtime') }}"><i class="fa fa-calendar-plus-o"></i> <span>Add Tutor Time</span></a></li>
                    <li><a href="{{ route('tutorviewtime') }}"><i class="fa fa-table"></i> <span>View Tutor Time</span></a></li>
                    <li><a href="{{ route('tutorgeneratereport') }}"><i class="fa  fa-download"></i> <span>Download Tutor Report</span></a></li>
                </ul>
              </li>
            @endif

            
  
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>