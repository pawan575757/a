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
    $primcat = $_POST['primcat'];


    $qry_upd = "UPDATE `subcat_master` SET `name` = '".$name."',`status` = '".$status."' ,`primcat` = '".$primcat."' WHERE `subcatid` = '".$_GET['id']."'"; 
    mysqli_query($conn,$qry_upd);

    header("location:subcat_list.php");

  }else if(isset($_POST['submit'])){
    $status = $_POST['status'];
    $name = $_POST['name'];
    $primcat = $_POST['primcat'];

    $sel_subcat = "SELECT * FROM `subcat_master` WHERE `name` = '".$name."' ";
    $res_subcat = mysqli_query($conn,$sel_subcat);
    $num_subcat = mysqli_num_rows($res_subcat);

    if($num_subcat > 0){
      $msg = "Subcat already exist.";
    }else{
      $qry_ins = "INSERT INTO `subcat_master` (`name`,`status`,`primcat`) VALUES ('".$name."','".$status."','".$primcat."')"; 
      mysqli_query($conn,$qry_ins);
      header("location:subcat_list.php");
    }
  }

  if(isset($_GET['id'])){
    $sel_subcat = "SELECT `subcatid`, `name`, `status` , `primcat` FROM `subcat_master` WHERE subcatid = '".$_GET['id']."' ";
    $res_subcat = mysqli_query($conn,$sel_subcat);
    $row_subcat = mysqli_fetch_array($res_subcat);
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
            <h1 class="h3 mb-0 text-gray-800">Sub Category Master</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <form class="form-horizontal" name="add_cat" method="post" style="overflow:hidden;">
                <div class="box-body">
                    <?php if(isset($msg)){ echo "<p style='color:red;'>".$msg."</p>"; } ?>
                    <div class="form-group">
                      <div class="row">
                      <label for="inputEmail3" class="col-md-1 control-label ">Name</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control required" value="<?php if(isset($row_cat['name'])){ echo $row_cat['name']; } ?>" name="name" id="name" placeholder="Enter category name">
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
                          <label for="" class="col-md-1 control-label ">Category</label>
                                                <div class="col-md-6">

                          <select name="primcat" class="form-control">
                              <option> Select Primary Category</option>


                              <?php
                               
       $result = mysqli_query($conn, "SELECT * FROM cat_master where status='1'");
while ($row = mysqli_fetch_array($result)) {
    ?>
<option value="<?php echo $row['catid']; ?>"><?php echo $row["name"]; ?></option>
                               
                                  
                                <?php
}
?>
                          </select>
                        </div>
                        </div>
                      </div>


                      

                    <div class="form-group">
                      <div class="row">
                    <label for="gender" class="col-md-1 control-label"> Status </label>
                    <div class="col-md-4">  
                      <div class="row">
                        <div class="col-md-6">
                          <label class="control-label"> Active </label> 
                          <input type="radio" name="status" class="flat-red" value="1" <?php if(isset($row_cat['status'])){ if($row_cat['status'] == 1){ echo "checked"; }else{ echo ""; } } ?> checked>                            
                        </div>
                        <div class="col-md-6">
                          <label class="control-label"> Inactive </label>
                          <input type="radio" name="status" class="flat-red" value="2" <?php if(isset($row_cat['status'])){ if($row_cat['status'] == 2){ echo "checked"; }else{ echo ""; } } ?>>                           
                        </div>                                             
                      </div>                    
                    </div>
                 </div>
                    </div>
                 
                </div>
                <div class="box-footer">              
                  <button type="submit" class="btn btn-info pull-right" name="submit" value="add_cat"><i class="fa fa-legal"></i> Submit</button>
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
