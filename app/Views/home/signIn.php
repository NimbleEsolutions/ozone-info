<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ozone Sales | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicons -->
  <link rel="shortcut icon" href="<?= base_url(); ?>/public/dist/img/WA-logo.jpg" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  
  <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/public/dist/css/style.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">
    .input__text {
        padding-right: 0.5rem;
        padding-left: 0.5rem;
        padding-top: 0.95rem;
        padding-bottom: 0.95rem;
        border: none;
        box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        color: #888888;
    }
    .login__form-input {
        margin-top: 0.5rem;
        box-sizing: border-box;
        width: 100%;
    }
    .login__form-label {
        color: #ffffff;
        font-weight: 700 !important;
        width: 100%;
        font-size: larger;
    }
    .login__forgot-link {
        float: right;
        color: #696767;
        text-decoration: underline;
        cursor: pointer;
    }
    .btn-primary,.btn-primary:hover,.btn-primary:active{
      background-color: #a9e050!important;
      border-color: #a9e050 !important;
      color: #000000;
      border-radius: 2px;
    }
    .input-group>.form-control:focus {
        border: 2px solid #000000;
    }
    .img-panel{
      /*background-image: linear-gradient(140deg,#004872 0%,rgba(41,17,96,0.8) 100%),url(http://ozoneinfo.in/Oz0ne/wp-content/uploads/2021/03/it-services-04.jpg)!important;*/
      background-size: cover;
      background-repeat: no-repeat;
      text-align: center;
    }
    .login-panel{
      padding: 5%;padding-top: 10%;
    }
    .login__box{
      margin: 0px;
      height: 730px ;
          background-image: linear-gradient(140deg,#004872 0%,rgb(253 253 255 / 92%) 100%),url(http://ozoneinfo.in/Oz0ne/wp-content/uploads/2021/03/it-services-04.jpg)!important;
    }
    .company-details{
      position: absolute;
      bottom: 2rem;
      right: 1rem;
      font-size: larger;
      color: #000000;
    }
    @media only screen and (max-width: 600px) {
    .img-panel {
      display: none !important;
    }
    .title-icon{
      width: 13% !important;
      padding: .9% !important;
      margin: 1%;
    }
    .company-details {
      position: absolute;
      bottom: 8.5rem;
      right: 1rem;
      font-size: medium;
      color: #000000;
    }
    .login__box{
      overflow: hidden;
      width: 100%;
    }
  }
  </style>
</head>
<body class="hold-transition" style="overflow: hidden;">
  <div class="row" style="border-bottom: 1px solid #cccccc;vertical-align: middle;margin: 0px;">
    <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
      <img class="title-icon" src="<?= base_url(); ?>/public/dist/img/WA-logo.png" style="width: 5%;padding: .4%;">
      <i class="fa fa-angle-right fa-lg"></i>
      <span style="font-size: large;font-weight: 600;padding-left: 1%;">Login</span>
    </div>
  </div>
  <div class="row login__box">
    <div class="col-sm-8 col-lg-8 col-md-8 col-xs-8 img-panel">
      <img src="http://ozoneinfo.in/Oz0ne/wp-content/uploads/2021/03/it-services-03.png" style="padding-top: 6.5%;mix-blend-mode: overlay;">
    </div>
    <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4 login-panel">
      <form class="form-horizontal" id="apply_for_course" action="<?php echo site_url('login') ?>" method="post">
          <div class="input-group">
            <label class="login__form-label">Email</label>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control input__text .login__form-label" placeholder="example@domain.com" name="user_email" required="" value="<?= set_value('user_email') ?>">
          </div>
          <div class="input-group mb-3"></div>
          <div class="input-group">
            <label class="login__form-label">Password <span class="login__forgot-link">Forgot?</span></label>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control input__text" name="user_password" required="">
          </div>
          <div class="row">
            <div class="form-group col-sm-12"> 
              
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="company-details" style="position: absolute;">Ozone Info Engineering Pvt. Ltd.</p>
    </div>
  </div>
</div>
<!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url(); ?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/public/dist/js/adminlte.min.js"></script>

<script src="<?= base_url(); ?>/public/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
  <?php if(isset($validation)): ?>
    toastr.error("Email or Password don't match");
  <?php endif; ?>
  <?php if(isset($info)): ?>
    toastr.info("<?php echo $info; ?>");
  <?php endif; ?>
  <?php if(isset($error)): ?>
    toastr.error("<?php echo $error; ?>");
  <?php endif; ?>
</script>
</body>
</html>
