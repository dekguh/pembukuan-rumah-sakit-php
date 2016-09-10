<?php
include "config/config.php";

if($_POST["register"]){
	$nama1 = $_POST["fname"];
	$nama2 = $_POST["lname"];
	$user = $_POST["user"];
	$email = $_POST["email"];
	$pass = $_POST["password"];

  ///////// cekid //////////////
  $query = "SELECT max(id) as maxID FROM users";
  $ekse = mysql_query($query);
  $noid = mysql_fetch_array($ekse);
  $noid = $noid["maxID"];
  $noid++;
  //////////////////////////////

	if(empty($nama1) or empty($nama2) or empty($user) or empty($email) or empty($pass)){
		$status = "form Tidak boleh ada yang kosong";
	}else{
    $query = "SELECT * FROM users WHERE username='{$user}'";
    $check = mysql_query($query);
    $cekname = mysql_num_rows($check);

    if($cekname <> 0){
      $status = '<div class="alert alert-info">
                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                        username sudah digunakan.
                    </div>';
    }else{
      $query = "INSERT INTO users VALUES ('{$noid}','{$nama1} {$nama2}','{$email}','{$pass}','{$user}')";
      $injek = mysql_query($query);

      if($injek){
        $status = '<div class="alert alert-success">
                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                        berhasil mendaftar, silahkan login.
                    </div>';
      }else{
        $status = '<div class="alert alert-danger">
                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                        tidak berhasil mendaftar.
                    </div>';
      }

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
                            <input class="form-control" type="text" name="user" value="<?=$_POST["user"]?>" placeholder="username" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="fname" value="<?=$_POST["fname"]?>" placeholder="first name" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="lname" value="<?=$_POST["lname"]?>" placeholder="last name" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="email" value="<?=$_POST["email"]?>" placeholder="e-mail" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                        </div>
                        <input type="submit" name="register" class="btn btn-lg btn-primary" value="register" />
            <div class="form-group">
                            you have account? <a href="./login.php">login</a>
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