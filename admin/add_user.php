<?php include "header.php";
//if($_SESSION["user_role"] == '0'){
  //header("Location: {$hostname}/admin/post.php");
//}
if(isset($_POST['save'])){
  include "database/config.php";

  $fname =mysqli_real_escape_string($conn,$_POST['fname']);
  $lname = mysqli_real_escape_string($conn,$_POST['lname']);
  $user = mysqli_real_escape_string($conn,$_POST['user']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
        $phone = mysqli_real_escape_string($conn,$_POST['phone']);


  $password = mysqli_real_escape_string($conn,md5($_POST['password']));
  //$role = mysqli_real_escape_string($conn,$_POST['role']);

  $sql = "SELECT username FROM user WHERE username = '{$user}'";

  $result = mysqli_query($conn, $sql) or die("Query Failed.");

  if(mysqli_num_rows($result) > 0){
    echo "<p style='color:red;text-align:center;margin: 10px 0;'>UserName already Exists.</p>";
  }else{
    $sql1 = "INSERT INTO user (first_name,last_name, username,email, password,phone)
              VALUES ('{$fname}','{$lname}','{$user}','{$email}','{$password}','{$phone}')";
    if(mysqli_query($conn,$sql1)){
      header("Location:users.php");
    }else{
      echo "<p style='color:red;text-align:center;margin: 10px 0;'>Can't Insert User.</p>";
    }
  }
}

?>

  <html lang="en">

<?php include("header.php"); ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php 
      require_once('sidebar.php');
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php require_once('topbar.php'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
     <h2>   Add User</h2>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive" style="overflow:hidden;">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
                      <div class="form-group col-md-6">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group col-md-6">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                         <div class="form-group col-md-6">
                          <label>Email</label>
                          <input type="text" name="email" class="form-control" placeholder="Email" required>
                      </div>

                       <div class="form-group col-md-6">
                          <label>Phone</label>
                          <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                      </div>

                      <div class="form-group col-md-6">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                   
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div></div></div></div></div></div></div></body></html>
<?php include "footer.php"; ?>
