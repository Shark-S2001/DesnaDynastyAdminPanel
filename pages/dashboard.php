<?php
  require_once("../includes/header.php");

  //Check if session has data
  if(!isset($_SESSION["user"])){
    //If Session is not Set, redirect back to Login Page
    header("Location:https://admin.desnadynastyagency.co.ke");
  }
 ?>
 
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="#"><img src="../assets/images/logo.jpeg" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="#"><img src="../assets/images/logo.jpeg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        
        <ul class="navbar-nav navbar-nav-right">
       
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
           <b>Current User: &nbsp;<span style="color:darkred;"><?php echo $_SESSION["user"] ?></span></b> &nbsp;&nbsp;&nbsp;<img src="../assets/images/user.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" >
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" id="logoutBtn">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
     
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="#">
            <i class="feather icon-grid"></i>
              <span class="menu-title">&nbsp;&nbsp;Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">
            <i class="feather icon-bag"></i>
              <span class="menu-title">&nbsp;&nbsp;About</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sliders.php">
              <i class="feather icon-globe"></i>
              <span class="menu-title">&nbsp;&nbsp;Sliders</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="model.php">
              <i class="feather icon-plus"></i>
              <span class="menu-title">&nbsp;&nbsp;Model</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="blog.php">
              <i class="feather icon-book"></i>
              <span class="menu-title">&nbsp;&nbsp;Blog</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="events.php">
              <i class="feather icon-camera"></i>
              <span class="menu-title">&nbsp;&nbsp;Events</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><!--model_photos.php-->
              <i class="feather icon-image"></i>
              <span class="menu-title">&nbsp;&nbsp;Upload Model Photos</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><!--promo_videos.php-->
              <i class="feather icon-video"></i>
              <span class="menu-title">&nbsp;&nbsp;Upload Promo Videos</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="testimonials.php">
              <i class="feather icon-eye"></i> 
              <span class="menu-title">&nbsp;&nbsp;Testimony</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="view_new_models.php">
              <i class="feather icon-plus"></i> 
              <span class="menu-title">&nbsp;&nbsp;Registered Models</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">



  <!-- plugins:js -->
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../assets/vendors/chart.js/Chart.min.js"></script>
  <script src="../assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="../assets/js/js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../assets/js/js/off-canvas.js"></script>
  <script src="../assets/js/js/hoverable-collapse.js"></script>
  <script src="../assets/js/js/template.js"></script>
  <script src="../assets/js/js/settings.js"></script>
  <script src="../assets/js/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../assets/js/js/dashboard.js"></script>
  <script src="../assets/js/js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
  <script type="text/javascript" src="../assets/js/customjs/auth.js"></script> 
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script type="text/javascript" src="../assets/js/notify.min.js"></script> 