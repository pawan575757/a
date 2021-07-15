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
        $upd = "UPDATE `room_list` SET `status`= 1 WHERE roomNo = ".$value; 
        mysqli_query($conn,$upd);
      }
    }
  }

  if(isset($_POST['inactive'])){
      if(isset($_POST['chkbox'])){
      foreach ($_POST['chkbox'] as $key => $value) {
        $upd = "UPDATE `room_list` SET `status`= 2 WHERE roomNo = ".$value;
        mysqli_query($conn,$upd);
      }
    }
  }

  $sel_room = "SELECT room_list.*,room_master_list.typename FROM room_list INNER JOIN room_master_list ON room_master_list.typeID = room_list.typeID ";
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

  <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">

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
            <h1 class="h3 mb-0 text-gray-800">Room List Master</h1>
            <a href="room-add.php"  class="frt btn btn-success"> <i class="fa fa-plus"></i> Add Room</a>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <form name="lform" id="lform" method="post" style="overflow:hidden;">
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
                      <th style="width:100px;">Type</th>
                      <th style="width:100px;">Room Name</th>
                      <th style="width:25px;">Set</th>
                      <th style="width:25px;">Adult</th>
                      <th style="width:150px;">Extra Bed Price</th>
                      <th style="width:25px;">Price</th>
                      <th>Status</th>
                      <th style="width:200px;">Add Date</th>
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
                          if(!empty($value['typeID']))
                          {
                            //var_dump($value['typeID']);die();
                             $id=$value['typeID'] ;
                          }
                          //var_dump($value['typeID']);die();
                          ?>
                        <label>
                          <input type="checkbox" class="minimal checking" name="chkbox[]" value="<?php echo $value['roomNo'] ;?>">
                        </label>
                      </td>
                      <td><?php echo ucfirst($value['typename']);?></td>
                      <td><?php echo ucfirst($value['roomName']);?></td>
                      <td><?php echo ucfirst($value['room_set']);?></td>
                      <td><?php echo ucfirst($value['Adults']);?></td>
                      <td><?php echo ucfirst($value['extra_bed']);?></td>
                      <td><?php echo ucfirst($value['price']);?></td>

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
                      <td><?php echo date("d-m-Y H:i:s",strtotime($value['add_date']));?></td>                    
                      <td>
                                  <a href="room-add.php?id=<?php echo $value['roomNo']?>" class="label label-info point">
                                   <i class="fa fa-edit" data-toggle="tooltip" title="Edit Record"></i></a>
                                   <a href="#" onClick="return false" class="label label-danger point blockroom" data-one="<?php echo $value['typeID']?>">
                                    <i class="fa fa-lock" data-toggle="tooltip" title="Block Room"></i></a>   
                                     <!-- <a href="delete_room_list.php?id=<?php //echo $value['roomNo']?>&action=roomlist_delete" class="label label-danger point">
                                  <i class="fa fa-trash" data-toggle="tooltip" title="Delete Record"></i></a> -->

                                   <a href="#"><i class="fa fa-trash delete" data-toggle="tooltip"  id='del_<?= $value['roomNo'] ?>' data-id='<?= $value['roomNo'] ?>'  title="Delete Record"></i></a>
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

<div class="modal fade" id="blocking_roompop" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title"> Blocking Room 
          <span id="customer_name"></span>
          <span id="order_no"></span> </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <span id="title_payment_id"  style="display:none"></span>
      </div>
      <form action="submit/submit.php" method="post" id="blockingroom_form">
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">          
                  <label for="name" class="col-sm-3 control-label"> From Date </label>
                  <div class="col-sm-9">
                    <input type="text" id="block_from" name="block_from" class="form-control datepicker">                      
                  </div>
                </div>  
              </div>                          
            </div>

              <div class="form-group">
              <div class="row">
                <div class="col-md-12">          
                  <label for="name" class="col-sm-3 control-label"> To Date </label>
                  <div class="col-sm-9">
                    <input type="text" id="block_to" name="block_to" class="form-control datepicker">                      
                  </div>
                </div>    
              </div>                          
            </div> 

            <div class="form-group">
              <div class="row">
                <div class="col-md-12">          
                  <label for="name" class="col-sm-3 control-label"> Block room. </label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control chkint required" name="block_set" placeholder="Block Number Of Rooms" value="">
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="room_set" value="">
                    
                  </div>
                </div>  
              </div>
            </div>  
            
          </div>
          <div class="box-footer">              
            <button type="submit" class="btn btn-info pull-right" name="submit" value="blockroom_add"><i class="fa fa-legal"></i> Submit</button>
          </div>
        </div>
      </form>
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

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/custom.js"></script>
  <script src="js/form_validation.js"></script>

   <script src="vendor/jquery/bootstrap-datepicker.min.js"></script>

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
           url: 'delete_room_list.php',
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

  <script>
  var c_dt = $('#c_dt').val();
  var rev_c_dt = $('#rev_c_dt').val();

   $('.datepicker').datepicker({
     minDate:0,
     dateFormat: 'dd/mm/yyyy',
     autoclose: true
    })
  
    $('#block_from').datepicker("setDate", new Date() );
    $('#block_to').datepicker("setDate", new Date() );


    $('#arrival').datepicker("setDate", new Date() );
    $('#departure').datepicker("setDate", new Date() );
  
   $('#sle_date').datepicker("setDate", new Date(c_dt) );

    $('.datepicker_rev').datepicker({
        minViewMode: 1})

   $('#rev_sle_date').datepicker("setDate", new Date(rev_c_dt) );

   $('.incentive_datepicker').datepicker({
      format: 'yyyy/mm',
      autoclose: true
    })

   $('.search-inctive_date').datepicker({
      format: 'yyyy/mm',
      autoclose: true
    })

  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

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
