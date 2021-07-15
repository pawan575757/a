<?php
  session_start();
  require_once('database/config.php');
  if(!isset($_SESSION['id'])){
    header("location:login.php");
    exit;
  }

  $sel_roomtype = "SELECT `typeID`, `typename`, `status` FROM `room_master_list` WHERE `status` = 1 order By typeID ASC";
  $res_roomtype = mysqli_query($conn,$sel_roomtype);

/*  if(isset($_POST['submit']) && isset($_GET['id'])){
    $typeID = $_POST['typeID'];
    $roomName = $_POST['roomName'];
    $room_set = $_POST['room_set'];
    $adults = $_POST['adults'];
    $price = $_POST['price'];
    $extra_bed = $_POST['extra_bed'];
    $description = $_POST['description'];
    $status = $_POST['status'];


    $qry_upd = "UPDATE `roomtype` SET `typename` = '".$typename."',`status` = '".$status."' WHERE `typeID` = '".$_GET['id']."'"; 
    mysqli_query($conn,$qry_upd);

    header("location:roomTypeMaster.php");

  }else*/ 

  if(isset($_POST['submit'])){

    $firstname =$_POST['firstname']; 
    $email =$_POST['email']; 
    $phone =$_POST['phone']; 

    $ins_qry = "INSERT INTO `customer_details`(`firstname`,`phone`, `email`) VALUES ('".$firstname."','".$phone."','".$email."')";
    mysqli_query($conn,$ins_qry);
    $guest_id = mysqli_insert_id($conn);

    $add_res_admin = '1';
    $txnId = date('ymdhis');
    $booked_rooms=$_POST['booked_rooms']; 
    $payable=$_POST['payable'] + $_POST['extra_bed_price']; 
    $adults=$_POST['adults']; 
    $arrival=date('d-m-Y',strtotime($_POST['arrival']));   
    $departure= date('d-m-Y',strtotime($_POST['departure'])); 
    $roomNo = $_POST['typeID'] ;

    $ins_res = "INSERT INTO `reservation_list`(`guest_id`, `booked_rooms`, `payable`, `adults`,`arrival`,`departure`,`roomNo`,`txnId`,`add_res_admin`) VALUES ('".$guest_id."','".$booked_rooms."','".$payable."','".$adults."','".$arrival."','".$departure."','".$roomNo."','".$txnId."','".$add_res_admin."')";
    mysqli_query($conn,$ins_res);
    header("location:reservationRoomList.php");
    
  }

  /*if(isset($_GET['id'])){
    $sel_room = "SELECT `typeID`, `typename`, `status` FROM `roomtype` WHERE typeID = '".$_GET['id']."' ";
    $res_room = mysqli_query($conn,$sel_room);
    $row_room = mysqli_fetch_array($res_room);
  }*/
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Room Type Master - Sai Krishna Resort</title>

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/admin.css" rel="stylesheet">

  <!--- Font Awesome -->
  <script src="https://kit.fontawesome.com/c8637a84cc.js"></script>

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">

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
            <h1 class="h3 mb-0 text-gray-800">Add Reservation</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <form class="form-horizontal" name="reserve_add" method="post" style="overflow:hidden;">

                  <div class="box-body">

                    <div class="form-group">
                      <div class="row">
                          <div class="col-md-6">          
                              <label for="name" class="col-md-4 control-label"> Room Type </label>
                            <div class="col-sm-9">
                              <select class="form-control required" name="typeID">
                                <option value=""> Select RoomType</option>
                                <?php
                                  while($row_roomtype = mysqli_fetch_array($res_roomtype)){
                                ?>
                                  <option value="<?php echo $row_roomtype['typeID']; ?>"><?php echo $row_roomtype['typename']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">          
                              <label for="name" class="col-md-4 control-label">Person Name </label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control  required" name="firstname" id="firstname" placeholder="Enter Person Name">
                            </div>
                          </div>
                          
                         </div>
                     </div>

                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                              <label for="type" class="col-md-4 control-label ">Email</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control  required" name="email" id="email" placeholder="Enter Email" value="<?php if(isset($record['email'])){echo $record['email'];}?>">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <label for="type" class="col-md-4 control-label ">Phone</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control required" name="phone" id="phone" placeholder="Enter Phone" value="<?php if(isset($record['phone'])){echo $record['phone'];}?>">
                              </div>
                            </div>

                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                              <label for="type" class="col-md-6 control-label ">No. of Room Booked</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control  required" name="booked_rooms" id="booked_rooms" placeholder="Enter No. of Room Booked"  value="<?php if(isset($record['booked_rooms'])){echo $record['booked_rooms'];}?>">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <label for="type" class="col-md-4 control-label ">Price</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control  required" name="payable" id="payable" placeholder="Enter Price" value="<?php if(isset($record['payable'])){echo $record['payable'];}?>">
                              </div>
                            </div>

                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                              <label for="type" class="col-md-4 control-label ">Arrival</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control  required datepicker" name="arrival" id="arrival" value="<?php if(isset($record['arrival'])){echo $record['arrival'];}?>">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <label for="type" class="col-md-4 control-label ">Departure</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control  required datepicker" name="departure" id="departure"  value="<?php if(isset($record['departure'])){echo $record['departure'];}?>">
                              </div>
                            </div>

                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                              <label for="type" class="col-md-4 control-label ">No. of Extra Bed</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control  required" name="extra_bed" id="extra_bed" placeholder="Enter No. of Extra Bed" value="<?php if(isset($record['extra_bed'])){echo $record['extra_bed'];}?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label for="type" class="col-md-4 control-label ">Extra Bed Price</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control  required" name="extra_bed_price" id="extra_bed_price" placeholder="Enter Extra Bed Price" value="<?php if(isset($record['extra_bed_price'])){echo $record['extra_bed_price'];}?>">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                              <label for="type" class="col-md-4 control-label ">Adults</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control  required" name="adults" id="adults" placeholder="Enter Adults" value="<?php if(isset($record['adults'])){echo $record['adults'];}?>">
                              </div>
                            </div>
                            
                        </div>
                      </div>

                      


          <?php /*        
                <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Room Type</label>
                      <div class="col-md-6">
                        <select class="form-control required" name="typeID">
                          <option value=""> Select RoomType</option>
                          <?php
                            while($row_roomtype = mysqli_fetch_array($res_roomtype)){
                          ?>
                            <option value="<?php echo $row_roomtype['typeID']; ?>"><?php echo $row_roomtype['typename']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Name</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="roomName" id="roomName" placeholder="Enter Room Type name" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Email</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="room_set" id="room_set" placeholder="Enter Room Type name" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Phone</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="adults" id="adults" placeholder="Enter Room Type name" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Room Booked</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="price" id="price" placeholder="Enter Room Type name" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Price</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="extra_bed" id="extra_bed" placeholder="Enter Room Type name" required>
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Arrival</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="extra_bed" id="extra_bed" placeholder="Enter Room Type name" required>
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Departure</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="extra_bed" id="extra_bed" placeholder="Enter Room Type name" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Extra Bed</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="extra_bed" id="extra_bed" placeholder="Enter Room Type name" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Extra Bed Price</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="extra_bed" id="extra_bed" placeholder="Enter Room Type name" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Adult</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="extra_bed" id="extra_bed" placeholder="Enter Room Type name" required>
                      </div>
                    </div>
                 
                    */ ?>
                    <div class="form-group">
                      <div class="row">         
                      <div class="col-md-6">     
                        <button type="submit" class="btn btn-info pull-right" name="submit" value="roomtype_add"><i class="fa fa-legal"></i> Submit</button>
                      </div>
                    </div>
                    </div>
                    </div>

                  </div>
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

    <script src="vendor/jquery/bootstrap-datepicker.min.js"></script>

  <script>
  $(function () {
     //Initialize Select2 Elements
    $('.select2').select2()
    
     //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    
  })

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
</script>
</body>

</html>
