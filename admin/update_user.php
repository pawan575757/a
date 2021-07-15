<?php include "header.php";
include 'database/config.php';
//if($_SESSION["user_role"] == '0'){
  //header("Location: {$hostname}/admin/post.php");
//}
if(isset($_POST['submit'])){
  include "/database/config.php";

  $userid =mysqli_real_escape_string($conn,$_POST['user_id']);
  $fname =mysqli_real_escape_string($conn,$_POST['f_name']);
  $lname = mysqli_real_escape_string($conn,$_POST['l_name']);
  $user = mysqli_real_escape_string($conn,$_POST['username']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);

  //$role = mysqli_real_escape_string($conn,$_POST['role']);

  $sql = "UPDATE user SET first_name = '{$fname}', last_name = '{$lname}', username = '{$user}',email = '{$email}',phone = '{$phone}' WHERE user_id = {$userid}";

    if(mysqli_query($conn,$sql)){
      header("Location: users.php");
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
     <h2>   Update User</h2>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive" style="overflow:hidden;">
                  <!-- Form Start -->
                 <?php
                //include "database/config.php";
                $user_id = $_GET['id'];
                $sql = "SELECT * FROM user WHERE user_id = {$user_id}";
                $result = mysqli_query($conn, $sql) or die("Query Failed.");
                if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
                ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id'];  ?>">
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'];  ?>" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'];  ?>" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username'];  ?>" placeholder="" required>
                      </div>
                       <div class="form-group">
                          <label>Email</label>
                          <input type="text" name="email" class="form-control" value="<?php echo $row['email'];  ?>" placeholder="" required>
                      </div>
                      
                       <div class="form-group">
                          <label>Phone</label>
                          <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'];  ?>" placeholder="" required>
                      </div>
                      
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                   <!-- Form End-->
               </div></div></div></div></div></div></div></body></html>
<?php include "footer.php"; ?>

                
                  <!-- /Form -->
                  <?php
                }
              }
                   ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
