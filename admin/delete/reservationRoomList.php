<?php
  session_start();
  require_once('database/config.php');
  if(!isset($_SESSION['id'])){
    header("location:login.php");
    exit;
  }
  if(isset($_GET['sle_date'])){
    $data=$_GET['sle_date'];
  }
  
if(empty($data))
{ 
  $date=date("Y-m-d");
  $final_dt = date('d-m-Y',strtotime($date));
}else{
  $date= $data; 
  $final_dt = date('d-m-Y',strtotime($date));
} 

 $sel_room = "SELECT reservation_list.*,customer_details.*,room_master_list.typename as room_type_name FROM reservation_list 
  LEFT JOIN customer_details ON customer_details.guest_id = reservation_list.guest_id 
  LEFT JOIN room_master_list ON room_master_list.typeID=reservation_list.roomNo where 1=1 AND reservation_list.arrival 
  LIKE '%$final_dt%' OR reservation_list.departure LIKE '%$final_dt%'";
  $res_room = mysqli_query($conn,$sel_room);
?>
<input type="hidden" id="c_dt" name="c_dt" value="<?php echo $date; ?>">
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Reservation Room List Master - Sai Krishna Resort</title>

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
            <h1 class="h3 mb-0 text-gray-800">Reservation Room List Master</h1>
            <!-- <a href="room-add.php"  class="frt btn btn-success"> <i class="fa fa-plus"></i> Add Room</a> -->
            <a href="reservation-add.php" class="frt btn btn-success"> <i class="fa fa-plus"></i> Add Reservation</a>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">

           <!--  <form class="formsearch_date" id="formsearch_date" style="width: 100%;float: left;">
              <div class="form-group col-md-12">
                <div style="font-size: 14px;padding-top: 12px;" class="col-md-2 srch-lb"> Search BY</div>  
                  <div class="col-md-3">
                    <input name="sle_date" id="sle_date" class="form-control datepicker" placeholder="select date to propercheck" >
                  </div>
                  <div class="col-md-2">
                    <button class="form-control search-btn" style="background: gray;color: #fff;font-size: 16px;"> <span class="glyphicon glyphicon-search"></span> Search</button>
                  </div>
              </div>
              </form> -->

              <form class="formsearch_date" id="formsearch_date" style="width: 100%;float: left;">
              <div class="form-group" style="margin-top: 12px; margin-left:10px;">
                <div class="row">
                <div style="font-size: 14px;margin-top: 12px;" class="col-md-1 srch-lb"> Search By</div>  
                  <div class="col-md-3">
                    <input name="sle_date" id="sle_date" value="" class="form-control datepicker" placeholder="select date to propercheck" >
                  </div>
                  <div class="col-md-2">
                    <button class="form-control search-btn" style="background: gray;color: #fff;font-size: 16px;"> <span class="glyphicon glyphicon-search"></span> Search</button>
                  </div>
                </div>
              </div>
              </form>


            <div class="card-body">
              <div class="table-responsive">
                <form name="lform" id="lform" method="post" action="submit/listing.php">
                  <input type="hidden" name="page" value="RoomType">
                  <input type="hidden" name="typeID" value="typeID">
                  <input type="hidden" name="button" value="" class="chk_btnclick" value="">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <tr>
                          <th>Resv no.</th>
                          <th>Trnx ID</th> 
                          <th>Name</th>                         
                          <th>Email</th>
                          <th>Phone</th>                        
                          <th>Check-In</th>                          
                          <th>Check-Out</th>
                          <th>Room Type</th> 
                          <th>Room Booked</th> 
                          <th>Adult</th>                          
                          <th>Price</th>          
                          <th>Date</th> 
                          <th>Action</th>     
                        </tr>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i=1 ;
                      foreach ($res_room as $key => $value)

                          {

                            //$value['url_id']=$value['roomNo'];

                            ?>

                              <tr class="tr" data-one="<?php echo $value['roomNo'];?>">

                               

                                <td><?php echo $value['reservation_id'];?></td>

                                <td><?php echo $value['txnId'];?></td>

                                <td><?php echo ucfirst($value['firstname']).ucfirst($value['lastname']);?></td>

                                <td><?php echo $value['email'];?></td>

                                 <td><?php echo $value['phone'];?></td>
                                 
                                 <td><?php echo $value['arrival'];?></td>
                                 
                                 <td><?php echo $value['departure'];?></td>

                                <td><?php echo $value['room_type_name'];?></td>

                                 <td><?php echo $value['booked_rooms'];?></td>

                                <td><?php echo $value['adults'];?></td>

                                <td><?php echo $value['payable'];?></td>

                                <td><?php echo $value['add_date'];?></td>                    

                                <td class="action_btn">

                                  <?php //if($value['add_res_admin']!=1){ ?>

                                      <a href="../invoice/booking/<?php echo $value['txnId'].'.pdf'?>" target="_blank" class="label label-info point">

                                        <i class="fa fa-eye" data-toggle="tooltip" title="View Pdf"></i></a>

                                  <?php //}else{  echo '-';?>

                                  <?php //} ?>                                                               

                                </td>

                              </tr>

                            <?php

                          }
                          ?>
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
