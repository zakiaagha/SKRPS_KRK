<?php
include_once 'includes/config.php';

$config = new Config();
$db = $config->getConnection();
	
if($_POST){	
	include_once 'includes/login.inc.php';
	$login = new Login($db);

	if ($_POST['username'] == "" || $_POST['password'] == "") {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Enter username or password fields";
  } else {
    $login->userid = trim($_POST['username']);
		$login->passid = trim(md5($_POST['password']));

		if($login->login()){
      $_SESSION["errorType"] = "success";
      $_SESSION["errorMsg"] = "You have successfully logged in.";
      header('location:index.php');
		} else {
			$_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = "wrong username or password";
		}
  }    
}
?>
<!DOCTYPE html>
<html style="height: auto;">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Perizinan | KRK Online</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" type="image/png" href="dist/img/favicon.png">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="dist/css/font.css">
</head>
<body class="hold-transition login-page"  style="background-image:url(dist/img/bg2.jpg); background-size: cover;">
<div class="login-box">
  <div class="login-logo">
    <img src="dist/img/Lambang_Kota_Batam.png" style="position: center; width: 65px; margin-bottom: 10px;"/><br/>
    <p style="font-size: 20px; margin-bottom: -2px;"><b>SISTEM INFORMASI PERIZINAN</b></p>
    <p style="font-size: 15px; margin-bottom: -2px;">KETERANGAN RENCANA KOTA</p>
    <p style="font-size: 15px; margin-bottom: -7px;">KOTA BATAM</p>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    
    <?php if ($_SESSION["errorMsg"] <> "") { ?>
        <div class="alert alert-<?php echo $_SESSION["errorType"] ?> alert-dismissable"><?php echo $_SESSION["errorMsg"]; ?></div>
    <?php } ?>

    <form method="post">
      <div class="form-group">
				<label for="InputUsername1">Username</label>
			  <input type="text" class="form-control" name="username"  id="username" placeholder="Username" autofocus="">
			</div>
			<div class="form-group">
			  <label for="InputPassword1">Password</label>
				<input type="password" class="form-control" name="password" id="password" placeholder="Password">
			</div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
	<br/>

    <!--<a href="#">I forgot my password</a><br>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  $("#username").focus();
</script>
</body>

</html>