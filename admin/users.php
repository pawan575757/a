
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
            <h1 class="h3 mb-0 text-gray-800">Users List</h1>
            <a href="add_user.php"  class="frt btn btn-success"> <i class="fa fa-plus"></i> Add User </a>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive" style="overflow:hidden;">
                
                 <?php
                  include "database/config.php"; // database configuration
                  /* Calculate Offset Code */
                  $limit = 10;
                  if(isset($_GET['page'])){
                    $page = $_GET['page'];
                  }else{
                    $page = 1;
                  }
                  $offset = ($page - 1) * $limit;
                  /* select query of user table with offset and limit */
                  $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit}";
                  $result = mysqli_query($conn, $sql) or die("Query Failed.");
                  if(mysqli_num_rows($result) > 0){
                ?>
                  <table class="content-table table-responsive table table-bordered ">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                          $serial = $offset + 1;
                          while($row = mysqli_fetch_assoc($result)) {
                        ?>
                          <tr>
                              <td class='id'><?php echo $serial; ?></td>
                              <td><?php echo $row['first_name'] . " ". $row['last_name']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td><?php echo $row ['email']; ?> </td>
                              <td><?php echo $row ['phone']; ?> </td>
                              
                              <td class='edit'><a href='update_user.php?id=<?php echo $row["user_id"]; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete_user.php?id=<?php echo $row["user_id"]; ?>'><i class='fa fa-trash'></i></a></td>
                          </tr>
                        <?php
                          $serial++;
                        } ?>
                      </tbody>
                  </table>
                  <?php
                }else {
                  echo "<h3>No Results Found.</h3>";
                }
                // show pagination
                $sql1 = "SELECT * FROM user";
                $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                if(mysqli_num_rows($result1) > 0){

                  $total_records = mysqli_num_rows($result1);

                  $total_page = ceil($total_records / $limit);

                  echo '<ul class="pagination admin-pagination">';
                  if($page > 1){
                    echo '<li><a href="users.php?page='.($page - 1).'">Prev</a></li>';
                  }
                  for($i = 1; $i <= $total_page; $i++){
                    if($i == $page){
                      $active = "active";
                    }else{
                      $active = "";
                    }
                    echo '<li class="'.$active.'"><a href="users.php?page='.$i.'">'.$i.'</a></li>';
                  }
                  if($total_page > $page){
                    echo '<li><a href="users.php?page='.($page + 1).'">Next</a></li>';
                  }

                  echo '</ul>';
                }
                  ?>
               
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
           url: 'delete_user.php',
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
































<?php include "header.php";
//if($_SESSION["user_role"] == '0'){
  //header("Location: {$hostname}/admin/post.php");
//}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add_user.php">add user</a>
              </div>
              <div class="col-md-12">
                <?php
                  include "database/config.php"; // database configuration
                  /* Calculate Offset Code */
                  $limit = 3;
                  if(isset($_GET['page'])){
                    $page = $_GET['page'];
                  }else{
                    $page = 1;
                  }
                  $offset = ($page - 1) * $limit;
                  /* select query of user table with offset and limit */
                  $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit}";
                  $result = mysqli_query($conn, $sql) or die("Query Failed.");
                  if(mysqli_num_rows($result) > 0){
                ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                          $serial = $offset + 1;
                          while($row = mysqli_fetch_assoc($result)) {
                        ?>
                          <tr>
                              <td class='id'><?php echo $serial; ?></td>
                              <td><?php echo $row['first_name'] . " ". $row['last_name']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td><?php echo $row ['email']; ?> </td>
                              <td><?php echo $row ['phone']; ?> </td>
                              
                              <td class='edit'><a href='update_user.php?id=<?php echo $row["user_id"]; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete_user.php?id=<?php echo $row["user_id"]; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                        <?php
                          $serial++;
                        } ?>
                      </tbody>
                  </table>
                  <?php
                }else {
                  echo "<h3>No Results Found.</h3>";
                }
                // show pagination
                $sql1 = "SELECT * FROM user";
                $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                if(mysqli_num_rows($result1) > 0){

                  $total_records = mysqli_num_rows($result1);

                  $total_page = ceil($total_records / $limit);

                  echo '<ul class="pagination admin-pagination">';
                  if($page > 1){
                    echo '<li><a href="users.php?page='.($page - 1).'">Prev</a></li>';
                  }
                  for($i = 1; $i <= $total_page; $i++){
                    if($i == $page){
                      $active = "active";
                    }else{
                      $active = "";
                    }
                    echo '<li class="'.$active.'"><a href="users.php?page='.$i.'">'.$i.'</a></li>';
                  }
                  if($total_page > $page){
                    echo '<li><a href="users.php?page='.($page + 1).'">Next</a></li>';
                  }

                  echo '</ul>';
                }
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
