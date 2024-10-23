<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3"> Project Idea Submit</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{ url('admin/dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('admin/assign-course') }}">
      <i class="bi bi-journal-text"></i>
      <span>Assign Course</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ url('admin/enrollment') }}">
      <i class="bi bi-grid"></i>
      <span>Enrollment Requests</span>
    </a>
  </li>

@if(Session::has('user_role') && Session::get('user_role')=="Super_Admin")
<hr class="sidebar-divider">

<li class="nav-item">
    <a class="nav-link" href="{{ url('admin/pending-users') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>pending Users</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('admin/admin-list') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>admin List</span></a>
</li>
@endif

@if(Session::has('user_role') && Session::get('user_role')=="Super_Admin" or "Admin")
<hr class="sidebar-divider">

<li class="nav-item">
    <a class="nav-link" href="{{ url('admin/student-register') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Add Student</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('admin/student-list') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Student List</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('admin/teacher-register') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Add Teacher</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('admin/teacher-list') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Teacher List</span></a>
</li>
@endif

@if(Session::has('user_role') && Session::get('user_role')=="Student")
<li class="nav-item">
    <a class="nav-link" href="{{ url('admin/student-enroll') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Enroll</span></a>
</li>
@endif


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Tables</span>

    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">All Tables:</h6>
            <a class="collapse-item" href="{{ url('admin/all-students') }}">All Students</a>
            <a class="collapse-item" href="{{ url('admin/all-teachers') }}">All Teachers</a>
            <a class="collapse-item" href="{{ url('admin/all-sessions') }}">All Sessions</a>
            <a class="collapse-item" href="{{ url('admin/all-courses') }}">All Courses</a>

        
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Creation</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">All Creation:</h6>
            <a class="collapse-item" href="{{ url('admin/create-teacher') }}">Teacher</a>
            <a class="collapse-item" href="{{ url('admin/create-student') }}">Student</a>
            <a class="collapse-item" href="{{ url('admin/create-course') }}">Course</a>
            <a class="collapse-item" href="{{ url('admin/create-session') }}">Session</a>
            <a class="collapse-item" href="{{ url('admin/create-section') }}">Section</a> 


        </div>
    </div>
</li>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Extra
</div>


<li class="nav-item">
    <a class="nav-link" href="{{ url('admin/project_idea') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Project Submit</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('admin/projectsub') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>All Projects</span></a>
</li>


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Addons
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Pages</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="{{ url('admin/login') }}">Login</a>
            <a class="collapse-item" href="{{ url('admin/register') }}">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
    </div>
</li>

<!-- Nav Item - Charts -->

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>

<!-- Sidebar Message -->
<!--<div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
    <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
</div>-->
