
  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{ asset('/dist/img/logo.png') }}" alt=""></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img style="margin-bottom: 30px;" src="{{ asset('/dist/img/logo.png') }}" alt=""><br><br></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown  "  >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {{Auth::user()->first_name}}  {{Auth::user()->last_name}} 
              <i class="fa fa-circle text-success"></i><span class="hidden-xs"></span><br>
            </a>
            <ul class="dropdown-menu user">
                
             
              <li class="user-header"  >
               
              
                      <a style="color:white !important;" role="button" href="{{ route('logout') }}" class="btn btn-danger">Sign out</a><br>
                      <a style="color:white !important;" href="mailto:manuel.aguilar2@hccs.edu?subject=Tutoring Payroll App Inquiry&cc=deborah.hardwick@hccs.edu" class="btn btn-success">Send an inquiry</a>
                  
              </li>
             
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>