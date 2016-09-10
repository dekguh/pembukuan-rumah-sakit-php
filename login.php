<?php
session_start();
include "config/config.php";

if($_POST["login"]){
  $user = $_POST["user"];
  $pass = $_POST["password"];
  if(empty($user) or empty($pass)){
    $status = '<div class="alert alert-info">
                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                        tidak boleh ada yang kosong.
                    </div>';
  }else{
    $query = "SELECT * FROM users WHERE username='{$user}' and password='{$pass}'";
    $cekid = mysql_query($query);
    $cekid = mysql_num_rows($cekid);

    if($cekid == 1){
      $_SESSION["username"] = $user;
      header("location: index.php");
    }else{
      $status = '<div class="alert alert-danger">
                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                        Cek username atau password anda kembali.
                    </div>';
    }
  }
}
?>
<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Login page | pembukuan rumah sakit</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">

        <!-- Custom styles -->
        <style type="text/css">
            .alert{
                margin: 0 auto 20px;
            }
        </style>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bootstrap-admin-without-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                   <?=$status?>
                    <form method="post" class="bootstrap-admin-login-form">
                        <h1>Login</h1>
                        <div class="form-group">
                            <input class="form-control" type="text" name="user" placeholder="username" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                        </div>
                        <input type="submit" name="login" class="btn btn-lg btn-primary" value="login" />
            <div class="form-group">
                            dont have account? <a href="./register.php">Register</a>
                        </div>
            
                    </form>
          
                </div>
            </div>
        </div>

        <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(function() {
                // Setting focus
                $('input[name="email"]').focus();

                // Setting width of the alert box
                var alert = $('.alert');
                var formWidth = $('.bootstrap-admin-login-form').innerWidth();
                var alertPadding = parseInt($('.alert').css('padding'));

                if (isNaN(alertPadding)) {
                    alertPadding = parseInt($(alert).css('padding-left'));
                }

                $('.alert').width(formWidth - 2 * alertPadding);
            });
        </script>
    </body>
</html>