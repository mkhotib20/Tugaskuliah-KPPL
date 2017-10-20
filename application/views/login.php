<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Greent Rent | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css') ?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><img style="height: 80px" src="<?php echo base_url('assets/img/logo.png') ?>"></a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <?php echo $this->session->flashdata('pesan'); ?>
    <?php echo form_open('login/prosesLogin'); ?>
      <div class="form-group has-feedback">
        <input 
            <?php 
              if (!$this->session->flashdata('login')) {
                echo 'autofocus';
              }
            ?> 
         type="text" value="<?php echo $this->session->flashdata('login'); ?>" class="form-control" placeholder="Username" name="username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input 
            <?php 
              if ($this->session->flashdata('login')) {
                echo 'autofocus';
              }
             ?> 
         type="password" class="form-control" placeholder="Password" name="password">

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <input type="submit" class="btn btn-green pull-right" value="Login">
    </form>

    
  </div>
</div>

<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js') ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' 
  });
</script>
</body>
</html>
