<?php
session_start();
require_once('config/constant.php');  
require_once('config/table_variable.php');
// require_once('function/function.php');
// require_once('database/database.php');
require_once('database/config.php');
$msg = "";
if(isset($_POST['user_login'])){

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $qry_user = "SELECT * FROM `admin_user` WHERE email = '".$email."' AND pwd = '".$password."' AND status = 1 ";
  $res_user = mysqli_query($conn,$qry_user);
  $count_record=mysqli_num_rows($res_user);

  if(!empty($count_record))
  { 
    $row_user = mysqli_fetch_array($res_user);
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $row_user['id'];
    header("location:index.php");
    exit;
  }else{
    $msg = "Username or password is incorrect";
  }
  //exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login - Admin Console</title>

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/admin.css" rel="stylesheet">

  <!--- Font Awesome -->
  <script src="https://kit.fontawesome.com/c8637a84cc.js"></script>

</head>

<body class="bg-dark">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block "><img src="../logo.png" width="100%"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" method="post">

                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" required id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" required id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <!-- <label class="custom-control-label" for="customCheck">Remember Me</label> -->
                      </div>
                    </div>
                    <input type="submit" name="user_login" class="btn btn-dark btn-user btn-block" value="Login"> 
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
