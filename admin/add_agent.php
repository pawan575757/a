<?php
  session_start();
  require_once('database/config.php');
  if(!isset($_SESSION['id'])){
    header("location:login.php");
    exit;
  }


if(isset($_POST['submit']) && isset($_GET['id'])){

$imgg=$_FILES['photo']['name'];
    $qry_upd = "UPDATE `agent_master` SET `name` = '".$_POST['name']."',`status` = '".$_POST['status']."',`role` = '".$_POST['role']."',`phoneno` = '".$_POST['phoneno']."',`email` = '".$_POST['email']."',`developer` = '".$_POST['developer']."',`photo` = '".$imgg."',`languagespeaks` = '".$_POST['languagespeaks']."' WHERE `id` = '".$_GET['id']."'"; 
    mysqli_query($conn,$qry_upd);

    header("location:agent_list.php");

  }

else if(isset($_POST['submit'])){
 

  $sql = "INSERT INTO `agent_master`(`name`,`role`,`languagespeaks`,`phoneno`,`email`,`developer`,`photo`,`status`) 
     VALUES (
    '".$_POST['name']."',
    '".$_POST['role']."',
    '".$_POST['languagespeaks']."',
    '".$_POST['phoneno']."',
    '".$_POST['email']."',
    '".$_POST['developer']."',
    '".$_FILES['photo']['name']."',
    '".$_POST['status']."')";
  $target_path = "img/".$_FILES['photo']['name'];
  move_uploaded_file($_FILES['photo']['tmp_name'], $target_path);   
  $conn->query($sql) or die(mysql_error($conn));
  header("location:agent_list.php");
  // $msg = "submit data";

}
  if(isset($_GET['id'])){
    $sel_agent = "SELECT * FROM `agent_master` WHERE id = '".$_GET['id']."' ";
    $res_agent = mysqli_query($conn,$sel_agent);
    $row_agent = mysqli_fetch_array($res_agent);
  }

?>
<!DOCTYPE html>
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
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Agent Master</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <form class="form-horizontal" name="add_agent" method="post" style="overflow:hidden;" enctype="multipart/form-data">
                <div class="box-body">
                    <?php if(isset($msg)){ echo "<p style='color:red;'>".$msg."</p>"; } ?>
                    <div class="form-group">
                      <div class="row">
                      <label for="inputEmail3" class="col-md-1 control-label ">Name</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control required"  value="<?php if(isset($row_agent['name'])){ echo $row_agent['name']; } ?>"  name="name" id="name" placeholder="Enter agent name" require>
                      </div>
                    </div>
                    </div>

<div class="form-group">
                      <div class="row">
                      <label for="inputEmail3" class="col-md-1 control-label ">Role</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control required" value="<?php if(isset($row_agent['role'])){ echo $row_agent['role']; } ?>"  name="role" id="role" placeholder="Enter agent role" required>
                      </div>
                    </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                      <label for="inputEmail3" class="col-md-1 control-label ">Language Speaks</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control required"  value="<?php if(isset($row_agent['languagespeaks'])){ echo $row_agent['languagespeaks']; } ?>" name="languagespeaks" id="lang" placeholder="Enter agent language" required>
                      </div>
                    </div>
                    </div>

                     <div class="form-group">
                      <div class="row">
                      <label for="inputEmail3" class="col-md-1 control-label ">Phone No</label>
                      <div class="col-md-6">
                        <input type="number" class="form-control required" value="<?php if(isset($row_agent['phoneno'])){ echo $row_agent['phoneno']; } ?>"  name="phoneno" id="phoneno" placeholder="Enter agent phone" required>
                      </div>
                    </div>
                    </div>

                     <div class="form-group">
                      <div class="row">
                      <label for="inputEmail3" class="col-md-1 control-label ">Email</label>
                      <div class="col-md-6">
                        <input type="email" class="form-control required" value="<?php if(isset($row_agent['email'])){ echo $row_agent['email']; } ?>"  name="email" id="email" placeholder="Enter agent email" required>
                      </div>
                    </div>
                    </div>


                      <div class="form-group">
                      <div class="row">
                          <label for="" class="col-md-1 control-label ">Developer</label>
                                                <div class="col-md-6">

                          <select name="developer" class="form-control">
                              <option> Select Developer</option>
                              <?php
                               
                                $sql = "SELECT * FROM developer_master";

                                $result = mysqli_query($conn, $sql) or die("Query Failed.");

                                if(mysqli_num_rows($result) > 0){
                                  while($row = mysqli_fetch_assoc($result)){
                                    echo "<option value='{$row['developerid']}'>{$row['name']}</option>";
                                  }
                                }
                              ?>
                          </select>
                        </div>
                        </div>
                      </div>



                     <div class="form-group">
                      <div class="row">
                      <label for="inputEmail3" class="col-md-1 control-label ">Photo</label>
                      <div class="col-md-6">
                        <input type="file" class="form-control required"  name="photo" id="photo" placeholder="Enter agent pic"  value="<?php if(isset($row_agent['photo'])){ echo $row_agent['photo']; } ?>" required>
                      </div>
                    </div>
                    </div>



                    <!-- <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label ">Description</label>
                      <div class="col-sm-10">
                        <textarea class="form-control required" rows="3" placeholder="Enter Some Description Related to RoomType" name="Desp" value=""></textarea>
                      </div>
                    </div> -->
                    <div class="form-group">
                      <div class="row">
                    <label for="gender" class="col-md-1 control-label"> Status </label>
                    <div class="col-md-4">  
                      <div class="row">
                        <div class="col-md-6">
                          <label class="control-label"> Active </label> 
                          <input type="radio" name="status" class="flat-red" value="1"  checked>                            
                        </div>
                        <div class="col-md-6">
                          <label class="control-label"> Inactive </label>
                          <input type="radio" name="status" class="flat-red" value="2" >                           
                        </div>                                             
                      </div>                    
                    </div>
                 </div>
                    </div>
                 
                </div>
                <div class="box-footer">              
                  <button type="submit" class="btn btn-info pull-right" name="submit" value="add_agent"><i class="fa fa-legal"></i> Submit</button>
                </div>
              </form> 
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php 
        require_once('footer.php');
      ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div> -->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/custom.js"></script>
  <script src="js/form_validation.js"></script>

</body>

</html>
