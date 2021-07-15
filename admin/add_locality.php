<?php
  session_start();
  require_once('database/config.php');
  if(!isset($_SESSION['id'])){
    header("location:login.php");
    exit;
  }

  $msg = "";
  if(isset($_POST['submit']) && isset($_GET['id'])){
    $status = $_POST['status'];
    $name = $_POST['name'];
    $locality_city =$_POST['locality_city'];

    $qry_upd = "UPDATE `location_master` SET `name` = '".$name."',`locality_city` = '".$locality_city."',`status` = '".$status."' WHERE `locationid` = '".$_GET['id']."'"; 
    mysqli_query($conn,$qry_upd);

    header("location:locality_list.php");

  }else if(isset($_POST['submit'])){
    $status = $_POST['status'];
    $name = $_POST['name'];
    $locality_city =$_POST['locality_city'];


    $sel_location = "SELECT * FROM `location_master` WHERE `name` = '".$name."' ";
    $res_location = mysqli_query($conn,$sel_location);
    $num_room = mysqli_num_rows($res_location);

    if($num_room > 0){
      $msg = "location already exist.";
    }else{
      $qry_ins = "INSERT INTO `location_master` (`name`,`status`,`locality_city`) VALUES ('".$name."','".$status."','".$locality_city."')"; 
      mysqli_query($conn,$qry_ins);
      header("location:locality_list.php");
    }
  }

  if(isset($_GET['id'])){
    $sel_location = "SELECT `locationid`, `name`, `status`,`locality_city` FROM `location_master` WHERE locationid = '".$_GET['id']."' ";
    $res_location = mysqli_query($conn,$sel_location);
    $row_location = mysqli_fetch_array($res_location);
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
            <h1 class="h3 mb-0 text-gray-800">location Master</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <form class="form-horizontal" name="add_location" method="post" style="overflow:hidden;">
                <div class="box-body">
                    <?php if(isset($msg)){ echo "<p style='color:red;'>".$msg."</p>"; } ?>
                    <div class="form-group">
                      <div class="row">
                      <label for="inputEmail3" class="col-md-1 control-label ">Name</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control required" value="<?php if(isset($row_location['name'])){ echo $row_location['name']; } ?>" name="name" id="location" placeholder="Enter location name">
                      </div>
                    </div>
                    </div>

                     <div class="form-group">
                      <div class="row">
                          <label for="" class="col-md-1 control-label ">City</label>
                                                <div class="col-md-6">

                          <select name="locality_city" class="form-control">
                              <option> Select City</option>
                              <?php
                               
                                $sql = "SELECT * FROM city_master";

                                $result = mysqli_query($conn, $sql) or die("Query Failed.");

                                if(mysqli_num_rows($result) > 0){
                                  while($row = mysqli_fetch_assoc($result)){
                                    echo "<option value='{$row['name']}'>{$row['name']}</option>";
                                  }
                                }
                              ?>
                          </select>
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
                          <input type="radio" name="status" class="flat-red" value="1" <?php if(isset($row_location['status'])){ if($row_location['status'] == 1){ echo "checked"; }else{ echo ""; } } ?> checked>                            
                        </div>
                        <div class="col-md-6">
                          <label class="control-label"> Inactive </label>
                          <input type="radio" name="status" class="flat-red" value="2" <?php if(isset($row_location['status'])){ if($row_location['status'] == 2){ echo "checked"; }else{ echo ""; } } ?>>                           
                        </div>                                             
                      </div>                    
                    </div>
                 </div>
                    </div>
                 
                </div>
                <div class="box-footer">              
                  <button type="submit" class="btn btn-info pull-right" name="submit" value="add_location"><i class="fa fa-legal"></i> Submit</button>
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
