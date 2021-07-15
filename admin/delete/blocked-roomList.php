<?php
  session_start();
  require_once('database/config.php');
  if(!isset($_SESSION['id'])){
    header("location:login.php");
    exit;
  }

  if(isset($_POST['delete'])){
    if(isset($_POST['chkbox'])){
      foreach ($_POST['chkbox'] as $key => $value) {
        $del = "DELETE FROM `block_list` WHERE id = ".$value; 
        mysqli_query($conn,$del);
      }
    }
  }

 /* if(isset($_POST['inactive'])){
      if(isset($_POST['chkbox'])){
      foreach ($_POST['chkbox'] as $key => $value) {
        $upd = "UPDATE `room_list` SET `status`= 2 WHERE roomNo = ".$value;
        mysqli_query($conn,$upd);
      }
    }
  }*/

  $sel_room = "SELECT * FROM block_list";
  $res_room = mysqli_query($conn,$sel_room);
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Room List Master - Sai Krishna Resort</title>

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/admin.css" rel="stylesheet">

  <!--- Font Awesome -->
  <script src="https://kit.fontawesome.com/c8637a84cc.js"></script>

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style type="text/css">
      thead th { white-space: nowrap; }
    </style>

</head>

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
            <h1 class="h3 mb-0 text-gray-800">Blocked Room List</h1>
            <!-- <a href="room-add.php"  class="frt btn btn-success"> <i class="fa fa-plus"></i> Add Room</a> -->
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <form name="lform" id="lform" method="post" name="blockroomfrm" id="blockroomfrm" style="overflow:hidden;">
                  <input type="hidden" name="page" value="RoomType">
                  <input type="hidden" name="typeID" value="typeID">
                  <input type="hidden" name="button" value="" class="chk_btnclick" value="">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>
                        <label>
                          <input type="checkbox" class="minimal chk_all" id="checkall">
                        </label>
                      </th>
                      <th style="width:100px;">Date</th>
                      <th style="width:100px;">Room Type</th>
                      <th style="width:25px;">Total Rooms</th>
                      <th style="width:25px;">No. of Blocked Rooms</th>
                      <th style="width:150px;">Blocked On</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="checkboxes">
                    <?php
                      foreach ($res_room as $key => $value){
                    ?>
                    <tr>
                      <td>  
                        <?php
                          if(!empty($value['id']))
                          {
                            //var_dump($value['id']);die();
                             $id=$value['id'] ;
                          }
                          //var_dump($value['typeID']);die();
                          ?>
                        <label>
                          <input type="checkbox" class="minimal checking" name="chkbox[]" value="<?php echo $id ;?>">
                        </label>
                      </td>
                      <td><?php echo date("d-m-Y",strtotime($value['date']));?></td>
                      <td><?php echo ucfirst($value['room_type']);?></td>
                      <td><?php echo ucfirst($value['total_rooms']);?></td>
                      <td><?php echo ucfirst($value['nob_rooms']);?></td>
                      <td><?php echo date("d-m-Y H:i:s",strtotime($value['blocked_on']));?></td>                    
                      <td>
                        <!-- <a href="delete_unblock_room.php?id=<?php //echo $value['id']?>&action=delete_unblock_delete" class="label label-danger point">
                            <i class="fa fa-trash" data-toggle="tooltip" title="Delete Record"></i></a> -->

                         <a href="#"><i class="fa fa-trash delete" data-toggle="tooltip"  id='del_<?= $value['id'] ?>' data-id='<?= $value['id'] ?>'  title="Delete Record"></i></a>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <div class="row"> 
                  <?php
                  // if($room_list!='no data'){
                     ?>
                      <div class="col-sm-12">
                        <span><input class="btn  btn-success active-list" type="submit" id="delete" name="delete" value="Unblock Room" /></span>
                      </div>  
                     <?php
                  //}
                  ?>
                 
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
           url: 'delete_unblock_room.php',
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

  </script>


  <script type="text/javascript">
   /* function setDeleteAction() {
      if(confirm("Are you sure want to unblock these rooms?")) {
        document.blockroomfrm.action = "delete_multiple_unblock_room.php?action=delete_multiple_unblock_delete";
        document.blockroomfrm.submit();
      }
    }*/

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

     $("#delete").click(function() {
      var count_checked = $("[name='chkbox[]']:checked").length; // count the checked rows
        if(count_checked == 0) 
        {
            alert("Please select any record to delete.");
            // bootbox.alert('Please select any record to delete.');
            return false;
        }
  });
  </script>

</body>

</html>
