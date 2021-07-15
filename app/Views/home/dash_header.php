<?php $uri = service('uri'); 
use \App\Models\HomeModel;
$role = (new HomeModel())->getData(array('role_id'=>session()->get('role_id')),'sales_user_role');
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link rel="shortcut icon" href="<?= base_url(); ?>/public/dist/img/WA-logo.jpg" type="image/x-icon">
  <title>Ozone Sales | <?= ($uri->getSegment(1) == 'dashboard' ? 'Dashboard' : null)?> <?= ($uri->getSegment(1) == 'sales' ? 'Sales Details' : null)?><?= ($uri->getSegment(1) == 'master' ? 'Master Data' : null)?><?= ($uri->getSegment(1) == 'bid' ? 'Bid Details' : null)?></title>

  <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/public/dist/css/adminlte.min.css">
  
  <!-- Vendor CSS Files -->
  <link href="<?= base_url(); ?>/public/frontEnd/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>/public/frontEnd/vendor/icofont/icofont.min.css" rel="stylesheet">

  
  <style type="text/css">
  .container{
    max-width: 100%;
  }
  table thead tr th{
    color:#1b518a;
  }
  .card-title{
    margin-bottom: 0rem !important;
    font-size: 1.5rem;
  }
  .layout-top-nav .wrapper .main-header .brand-image {
    margin-top: 0rem;
    margin-right: .2rem;
    height: 33px;
  }
  .navbar-brand .img-circle {
    border-radius: 0px; 
  }
  .navbar-brand{
    margin-left: 1rem;
  }
  .navbar-brand img{
    width: 2.5rem;
  }
  .elevation-3{
    box-shadow: none !important;
  }
  .navbar-light .navbar-nav .nav-link.active{
    color: #a4db52;
    font-weight: bold;
  }
  .navbar-light .navbar-nav .nav-link:hover{
    color: #a4db52;
    font-weight: 600;
  }
  .navbar-light .navbar-nav .nav-link{
    font-weight: 600;
    color: #000000;
  }
  .navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 150px;
    font-weight: bold;
  }
  .card-primary .card-header, .btn-primary{
    background-color: #007bff !important;
    border-color: #007bff !important;
  }
  .mandatory{
    color: red;
  }
  .dropdown-toggle::after{
    vertical-align: middle;
    border-top: .4em solid;
  }
  .btn-icon{
    background-color: #5b76d7;
    color: #ffffff;
  }
  .main-footer{
    padding: 5px 9px;
  }
  .hidden {
    display: none;
  }
  .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('<?=base_url()?>/public/dist/img/loader.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
  }
  .table thead th,.table tbody td{
    vertical-align: middle;
  }
  .small-box p {
    font-size: 1.5rem;
    margin-bottom: 0.2rem;
  }
  .user-menu .user-image{
    display: none;
  }
  label.error{
    color: #ff0000b5;
  }
  input.error,textarea.error,select.error{
    border: 2px solid #ff0000b5;
  }
  .pagination{
    padding: .8rem .3rem 0rem;
  }
  .pagination li{
    border: 1px solid;
    margin: 0 .2rem;
    padding: 0 .4rem;
    border-radius: .2rem;      
  }
  .pagination li.active{
    background-color: #a4db52;
    color: black;
  }
  @media (max-width: 767.98px){
    .small-box p {
      font-size: 25px;
    }
    .user-menu .user-image{
      display: block;
    }
    .user-menu i{
      display: none;
    }
  }
</style>
</head>
<body class="hold-transition layout-top-nav">
  <div class="loader"></div>
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="" class="navbar-brand">
          <img src="<?= base_url(); ?>/public/dist/img/WA-logo.png" alt="Ozone Logo" >
          <!-- <span class="brand-text font-weight-light">AdminLTE 3</span> -->
        </a>       

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="<?= site_url('home');?>" class="nav-link <?= ($uri->getSegment(1) == 'dashboard' ? 'active' : null)?>">Dashboard</a>
            </li>
            <?php if(session()->get('role_id') == '1' || session()->get('role_id') == '2'){ ?>
              <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle <?= ($uri->getSegment(1) == 'user' ? 'active' : null)?>">User Profiles</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                  <li><a href="<?= site_url('user/create_user');?>" class="dropdown-item">Create Profiles </a></li>            
                </ul>
              </li>
            <?php } ?>
            <?php if(session()->get('role_id') == '3' || session()->get('role_id') == '2' || session()->get('role_id') == '4'){ ?>
              <li class="nav-item">
                <a href="<?= site_url('bid/bid_details'); ?>" class="nav-link <?= ($uri->getSegment(1) == 'bid' ? 'active' : null)?>">Bid Details</a>
              </li>
            <?php } ?>
            <?php if(session()->get('role_id') == '3' || session()->get('role_id') == '2'){ ?>
              <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle <?= ($uri->getSegment(1) == 'sales' ? 'active' : null)?>">Sales Details</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                  <li><a href="<?= site_url('sales/pre-sales');?>" class="dropdown-item">Pre Sales </a></li>            
                  <li><a href="<?= site_url('sales/post-sales');?>" class="dropdown-item">Post Sales </a></li>            
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle <?= ($uri->getSegment(1) == 'master' ? 'active' : null)?>">Masters</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  <li><a href="<?= site_url('master/clients');?>" class="dropdown-item">Clients</a></li>            
                  <li><a href="<?= site_url('master/departments');?>" class="dropdown-item">Departments </a></li>           
                  <li><a href="<?= site_url('master/products');?>" class="dropdown-item">Products </a></li>   
                  <li><a href="<?= site_url('master/terms');?>" class="dropdown-item">Terms & Conditions </a></li>           
                  <li><a href="<?= site_url('master/eligibility');?>" class="dropdown-item">Eligibility Criteria </a></li>           				  
                </ul>
              </li>

            <?php } ?>
          </ul>

        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- Messages Dropdown Menu -->
          
          <li class="nav-item dropdown user-menu" style="text-align: center;">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="    padding: 0rem 1rem;">
              <img src="<?= base_url(); ?>/public/dist/img/profile_logo.png" class="user-image img-circle elevation-2" alt="User Image">
              <div class="row">
                <div class="col-lg-10" style="text-align: center;">
                  <span class="d-none d-md-inline"><?= $user[0]['user_firstName']." ".$user[0]['user_lastName']; ?><br>(<?= $role[0]['role_name']; ?>)</span>                
                </div>
                <div class="col-sm-2" style="padding: .7rem 1px;">                
                  <i class="fas fa-angle-down fa-lg"></i>
                </div>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <!-- User image -->
              <li class="user-header bg-primary" style="background-color: #ffffff!important;color: #a4db52!important">
                <img src="<?= base_url(); ?>/public/dist/img/profile_logo.png" class="img-circle elevation-2" alt="User Image">
                <p>
                  <?= $user[0]['user_firstName']." ".$user[0]['user_lastName']; ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer" style="background-color: #1b518a!important;">
                <?php if(session()->get('role_id') == '5'){ ?>
                  <a href="#" class="btn btn-default btn-flat">User Profile</a>
                <?php } ?>
                <a href="<?= site_url('logout'); ?>" class="btn btn-default btn-flat float-right" style="background: white;font-weight: 700;color: black;">Sign out</a>
              </li>
            </ul>
          </li>
        </ul>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>
  <!-- /.navbar -->