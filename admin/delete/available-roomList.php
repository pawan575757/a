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
  }else{
    $date=date("Y-m-d",strtotime($data));  
  }

  $sel_room = "SELECT room.*,room_master_list.typename FROM room_list INNER JOIN room_master_list ON room_master_list.typeID = room.typeID ";
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

  <title>Available Room List Master - Sai Krishna Resort</title>

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
            <h1 class="h3 mb-0 text-gray-800">Available Room List Master</h1>
            <!-- <a href="room-add.php"  class="frt btn btn-success"> <i class="fa fa-plus"></i> Add Room</a> -->
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">

            <form class="formsearch_date" id="formsearch_date" style="width: 100%;float: left;" style="overflow:hidden;">
              <div class="form-group" style="margin-top: 12px; margin-left:10px;">
                <div class="row">
                <div style="font-size: 14px;margin-top: 12px;" class="col-md-1 srch-lb"> Search By</div>  
                  <div class="col-md-3">
                    <input name="sle_date" id="sle_date" class="form-control datepicker" placeholder="select date to propercheck" >
                  </div>
                  <div class="col-md-2">
                    <button class="form-control search-btn" style="background: gray;color: #fff;font-size: 16px;"> <span class="glyphicon glyphicon-search"></span> Search</button>
                  </div>
                </div>
              </div>
              </form>

            <div class="card-body">
              <div class="table-responsive">
                <form name="lform" id="lform" method="post" action="submit/listing.php" style="overflow:hidden;">
                  <input type="hidden" name="page" value="RoomType">
                  <input type="hidden" name="typeID" value="typeID">
                  <input type="hidden" name="button" value="" class="chk_btnclick" value="">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="width:10%;">
                        No
                      </th>
                      <th style="width:30%;">Type</th>
                      <th style="width:20%;">Set</th>
                      <th style="width:20%;">Blocked</th>
                      <th style="width:20%;">Available</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i=1 ;
                      foreach ($res_room as $key => $value)
                      { 

                        //$value['url_id']=$value['roomNo'];
                        $room_id=$value['roomNo'];
                        $order=" order by reservation_id  desc ";
                        $create_query=" SELECT COUNT(reservation_id) as count FROM reservation_list WHERE roomNo='".$room_id."' AND ( '".$date."' >= arrival and '".$date."' <= departure)";                            
                        $get=mysqli_query($conn,$create_query);

                        // $create_query_block = array('room_id' => $value['typeID'] , 'date' => $date);

                        $qry_block = "SELECT * FROM block_list WHERE room_id='".$value['typeID']."' AND date='".$date."' order by id desc";   
                        $res_block = mysqli_query($conn,$qry_block);  
                        $get_block = mysqli_fetch_array($res_block);              
                        // $get_block=$obj->select_single_record('block_list',$create_query_block);

                        $bk_rm = 0;
                        
                        if($bk_rm==0)
                        {
                          $bk_rm = $get_block['nob_rooms'];
                        }else{
                          $bk_rm += $get_block['nob_rooms'];
                        }

                        if($bk_rm=='n' || $bk_rm==""){
                          $bk_rm = 0 ;
                        }
                    


                        ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo ucfirst($value['typename']);?></td>
                      <td><?php echo ucfirst($value['room_set']);?></td>
                      <td><?php echo $bk_rm;?></td> 
                      <td><?php echo $value['room_set'] - $bk_rm;?></td>
                    </tr>
                    <?php $i++; } ?>
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
