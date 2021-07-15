<?php
  session_start();
  require_once('database/config.php');
  if(!isset($_SESSION['id'])){
    header("location:login.php");
    exit;
  }

  if(isset($_POST['active'])){
    if(isset($_POST['chkbox'])){
      foreach ($_POST['chkbox'] as $key => $value) {
        $upd = "UPDATE `projects` SET `status`= '1' WHERE projid = ".$value; 
        mysqli_query($conn,$upd);
      }
    }/*else{
      echo "<script>alert('Please select atleast one.');</script>"; 
    }*/
  }

  if(isset($_POST['inactive'])){
      if(isset($_POST['chkbox'])){
      foreach ($_POST['chkbox'] as $key => $value) {
        $upd = "UPDATE `projects` SET `status`= '2' WHERE projid = ".$value;
        mysqli_query($conn,$upd);
      }
    }/*else{
      echo "<script>alert('Please select atleast one.');</script>"; 
    }*/
  }

  $sel_proj = "SELECT * FROM `projects` order By projid desc";
  $res_proj = mysqli_query($conn,$sel_proj);

   $sel_developer = "SELECT * FROM `developer_master` order By developerid desc";
  $res_developer = mysqli_query($conn,$sel_developer);
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
            <h1 class="h3 mb-0 text-gray-800">projects Master</h1>
            <a href="add_projects.php"  class="frt btn btn-success"> <i class="fa fa-plus"></i> Add projects</a>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="" >
                <form name="lform" id="lform" method="post">
                  <input type="hidden" name="page" value="name">
                  <input type="hidden" name="projid" value="projid">
                  <input type="hidden" name="button" value="" class="chk_btnclick" value="">
                <table class="table  table-responsive" id="dataTable"  cellspacing="0" style="">
                  <thead>
                    <tr>
                      <th>
                        <label>
                          <input type="checkbox" class="minimal chk_all" id="checkall">
                        </label>
                      </th>
                      <th>Name</th>
                      <th>Developer</th>

                      <th>Location</th>
                      <th>Property Type</th>
                     <th>Starting Price</th>

                      
                      <th>Status</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="checkboxes">
                    <?php
                      foreach ($res_proj as $key => $value){

                        // $sel_city = "SELECT * FROM `city_master` WHERE cityid = ".$value['cityid'];
                        // $res_city = mysqli_query($conn,$sel_city);
                        // $row_city = mysqli_fetch_array($res_city);


                        $sel_location = "SELECT * FROM `location_master` WHERE locationid = ".$value['location'];
                        $res_location = mysqli_query($conn,$sel_location);
                        $row_location = mysqli_fetch_array($res_location);

                        // $sel_type = "SELECT * FROM `type_master` WHERE typeid = ".$value['typeid'];
                        // $res_type = mysqli_query($conn,$sel_type);
                        // $row_type = mysqli_fetch_array($res_type);


                        $sel_developer = "SELECT * FROM `developer_master` WHERE developerid = ".$value['developer'];
                        $res_developer = mysqli_query($conn,$sel_developer);
                        $row_developer = mysqli_fetch_array($res_developer);

                      // $sel_cat = "SELECT * FROM `cat_master` WHERE catid = ".$value['catid'];
                      //   $res_cat = mysqli_query($conn,$sel_cat);
                      //   $row_cat = mysqli_fetch_array($res_cat);

                        // $sel_agent = "SELECT * FROM `agent_master` WHERE id = ".$value['agent'];
                        // $res_agent = mysqli_query($conn,$sel_agent);
                        // $row_agent = mysqli_fetch_array($res_agent);

                        
                        

                    ?>
                    <tr>
                      <td>  
                        <?php
                          if(!empty($value['projid']))
                          {
                            //var_dump($value['docid']);die();
                             $id=$value['projid'] ;
                          }
                          //var_dump($value['docid']);die();
                          ?>
                        <label>
                          <input type="checkbox" class="minimal checking" name="chkbox[]" value="<?php echo $id ;?>">
                        </label>
                      </td>
                      <td><?php echo ucfirst($value['name']);?></td>
                      <td><?php echo ucfirst($row_developer['name']);?></td>
                      <td><?php echo ucfirst($row_location['name']);?></td>
                                  
                                  <td>
                                   <?php  $cat=explode('++',$value['catid']);
                                    foreach ($cat as $prtype) {
                                 

                            ?>   
                                <?php echo $prtype; ?>,

                          <?php } ?>
                     
                     <td><?php echo $value['price']; ?> AED</td>
                      <td><?php
                          if($value['status'])
                          {
                            if($value['status']==1)
                            {
                              ?>
                              <span class="btn btn-success">Active</span>
                              <?php
                            }else if($value['status']==2) {
                              ?>
                              <span class="btn btn-danger">Inactive</span>
                              <?php
                            } 
                          }
                          ?> </td> 
                      <td><?php echo date("d-m-Y H:i:s",strtotime($value['date']));?></td>                    
                      <td>
                      <a href="add_projects.php?id=<?php echo $value['projid']?>" class="label label-info point"><i class="fa fa-edit" data-toggle="tooltip" title="Edit Record"></i></a>  
                      <!-- <a href="delete_room_type.php?id=<?php //echo $value['docid']?>&action=roomtype_delete" class="label label-danger point">
                      <i class="fa fa-trash" data-toggle="tooltip" title="Delete Record"></i></a> -->

                      <a href="#"><i class="fa fa-trash delete" data-toggle="tooltip"  id='del_<?= $value['projid'] ?>' data-id='<?= $value['projid'] ?>'  title="Delete Record"></i></a>

                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <div class="row">
                      <div class="col-sm-12">
                        <button type="submit" name="active" id="active" class="btn  btn-success active-list"> <i class="fa fa-check"></i> Active </button>
                        <button type="submit" name="inactive" id="inactive" class="btn  btn-warning inactive-list">  <i class="fa fa-ban"></i> Inactive </button>
                      </div>   
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

  <script type="text/javascript">
    $(document).ready(function() {
  $('#checkall').click(function() {
    var checked = $(this).prop('checked');
    $('#checkboxes').find('input:checkbox').prop('checked', checked);
  });
})

// click active in active
$('.active-list').click(function(){
  $('.chk_btnclick').val('active');
  $('#lform').submit();
})
$('.inactive-list').click(function(){
  $('.chk_btnclick').val('inactive');
  $('#lform').submit();
})
  </script>


  <script src="vendor/jquery/bootbox.min.js"></script>


  <script type="text/javascript">
  $(document).ready(function(){

  // Delete 
  $('.delete').click(function(){
    var el = this;
  
    // Delete id
    var deleteid = $(this).data('id');

    // Confirm box
    event.preventDefault();
    bootbox.confirm("Do you really want to delete record?", function(result) {
       if(result){
         // AJAX Request
         $.ajax({
           url: 'delete_projects.php',
           type: 'POST',
           data: { id:deleteid },
           success: function(response){
             // Removing row from HTML Table
             if(response == 1){
              window.location.reload();
             }else{
                bootbox.alert('Record not deleted.');
             }

           }
         });
       }
 
    });
 
  });
});

  $("#active").click(function() {
    var count_checked = $("[name='chkbox[]']:checked").length; // count the checked rows
        if(count_checked == 0) 
        {
            alert("Please select any record to active.");
            // bootbox.alert('Please select any record to delete.');
            return false;
        }
  });

  $("#inactive").click(function() {
    var count_checked = $("[name='chkbox[]']:checked").length; // count the checked rows
        if(count_checked == 0) 
        {
            alert("Please select any record to inactive.");
            // bootbox.alert('Please select any record to delete.');
            return false;
        }
  });

  </script>
</body>

</html>
