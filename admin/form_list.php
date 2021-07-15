<?php
  session_start();
  require_once('database/config.php');
  if(!isset($_SESSION['id'])){
    header("location:login.php");
    exit;
  }

  // if(isset($_POST['active'])){
  //   if(isset($_POST['chkbox'])){
  //     foreach ($_POST['chkbox'] as $key => $value) {
  //       $upd = "UPDATE `property_form` SET `status`= '1' WHERE formid = ".$value; 
  //       mysqli_query($conn,$upd);
  //     }
  //   }/*else{
  //     echo "<script>alert('Please select atleast one.');</script>"; 
  //   }*/
  // }

  // if(isset($_POST['inactive'])){
  //     if(isset($_POST['chkbox'])){
  //     foreach ($_POST['chkbox'] as $key => $value) {
  //       $upd = "UPDATE `property_form` SET `status`= '2' WHERE formid = ".$value;
  //       mysqli_query($conn,$upd);
  //     }
  //   }/*else{
  //     echo "<script>alert('Please select atleast one.');</script>"; 
  //   }*/
  // }

  $sel_form = "SELECT * FROM `property_form` order By id desc";
  $res_form = mysqli_query($conn,$sel_form);
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
            <h1 class="h3 mb-0 text-gray-800">form Master</h1>
            <a href="add_form.php"  class="frt btn btn-success"> <i class="fa fa-plus"></i> Add form</a>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive" style="overflow:hidden;">
                <form name="lform" id="lform" method="post">
                  <input type="hidden" name="page" value="name">
                  <input type="hidden" name="formid" value="formid">
                  <input type="hidden" name="button" value="" class="chk_btnclick" value="">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>
                        <label>
                          <input type="checkbox" class="minimal chk_all" id="checkall">
                        </label>
                      </th>
                      <th>S.No</th>
                      <th> Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Message</th>
                      <th>Property Id</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody id="checkboxes">
                    <?php
                      foreach ($res_form as $key => $value){
                    ?>
                    <tr>
                      <td>  
                        <?php
                          if(!empty($value['id']))
                          {
                            //var_dump($value['formid']);die();
                             $id=$value['id'] ;
                          }
                          //var_dump($value['formid']);die();
                          ?>
                        <label>
                          <input type="checkbox" class="minimal checking" name="chkbox[]" value="<?php echo $id ;?>">
                        </label>
                      </td>
                      <td><?php echo ucfirst($value['id']);?></td>
                      <td><?php echo ucfirst($value['name']);?> </td> 
                      <td><?php echo ucfirst($value['phone']);?> </td> 
                      <td><?php echo ucfirst($value['email']);?> </td> 
                      <td><?php echo ucfirst($value['message']);?> </td> 
                      <td><?php echo ucfirst($value['iid']);?> </td> 
                     <td><?php echo ucfirst($value['date']);?> </td> 




                      
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
               
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
           url: 'delete_form.php',
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
