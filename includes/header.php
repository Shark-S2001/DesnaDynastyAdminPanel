<?php	
  define("BASEPATH",true);
  defined('BASEPATH')OR exit('<h3>Nodirectscriptaccessallowed</h3>');

  require_once("../config/sessions.php");
  require_once("../config/database.php");
  require_once("../config/functions.php");

  $_SESSION['path']="/ddsharedvolume";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title style="text-align: center" class="d-sm-none">Admin Portal</title>
  <link rel="shortcut icon" href="https://www.domain.com/favicon.ico" />
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<body>
