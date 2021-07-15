<?php
  session_start();
  require_once('database/config.php');
  if(!isset($_SESSION['id'])){
    header("location:login.php");
    exit;
  }

  define('ROOM_PATH','../upload/rooms/');

  $sel_roomtype = "SELECT `typeID`, `typename`, `status` FROM `room_master_list` WHERE `status` = 1 order By typeID ASC";
  $res_roomtype = mysqli_query($conn,$sel_roomtype);

  if(isset($_POST['submit']) && isset($_GET['id'])){
    $typeID = $_POST['typeID'];
    $roomName = $_POST['roomName'];
    $room_set = $_POST['room_set'];
    $adults = $_POST['adults'];
    $price = $_POST['price'];
    $extra_bed = $_POST['extra_bed'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // $target_file = $target_dir . basename($_FILES["roomImage"]["name"]);
    
    if($_FILES['roomImage']['name']){
      if (move_uploaded_file($_FILES["roomImage"]["tmp_name"], ROOM_PATH.basename($_FILES["roomImage"]["name"]))) {

      }

      $datetime = date("Y-m-d H:i:s");
      $qry_upd = "UPDATE `room_list` SET `typeID` = '".$typeID."', `roomName` = '".$roomName."', `room_set` = '".$room_set."', `Adults` = '".$adults."', `price` = '".$price."', `extra_bed` = '".$extra_bed."', `description` = '".$description."', `status` = '".$status."', `roomImage` = '".$_FILES["roomImage"]["name"]."', `add_date` = '".$datetime."' WHERE roomNo = '".$_GET['id']."' "; 
      mysqli_query($conn,$qry_upd);
    }else{
      $datetime = date("Y-m-d H:i:s");
      $qry_upd = "UPDATE `room_list` SET `typeID` = '".$typeID."', `roomName` = '".$roomName."', `room_set` = '".$room_set."', `Adults` = '".$adults."', `price` = '".$price."', `extra_bed` = '".$extra_bed."', `description` = '".$description."', `status` = '".$status."', `add_date` = '".$datetime."' WHERE roomNo = '".$_GET['id']."' "; 
      mysqli_query($conn,$qry_upd);
    }

    /*if (move_uploaded_file($_FILES["optional_image"]["tmp_name"], ROOM_PATH.basename($_FILES["optional_image"]["name"]))) {

    }*/
    // echo "hello";
    if($_FILES['optional_image']['name'][0]){

      $qry_del = "DELETE FROM `room_image` WHERE room_id = '".$_GET['id']."' ";
      mysqli_query($conn,$qry_del);

      foreach ($_FILES['optional_image']['tmp_name'] as $key => $image) {
          $imageTmpName = $_FILES['optional_image']['tmp_name'][$key];
          $imageName = $_FILES['optional_image']['name'][$key];
          $result = move_uploaded_file($imageTmpName,ROOM_PATH.$imageName);

         $ins_img = "INSERT INTO `room_image`(`room_id`, `image_name`, `add_date`) VALUES ('".$_GET['id']."','".$imageName."','".$datetime."')";
          mysqli_query($conn,$ins_img);
      }
    }
    header("location:roomList.php");

  }else if(isset($_POST['submit'])){
    $typeID = $_POST['typeID'];
    $roomName = $_POST['roomName'];
    $room_set = $_POST['room_set'];
    $adults = $_POST['adults'];
    $price = $_POST['price'];
    $extra_bed = $_POST['extra_bed'];
    $description = $_POST['description'];
    $status = $_POST['status'];

     if($_FILES['roomImage'])
    {
      if (move_uploaded_file($_FILES["roomImage"]["tmp_name"], ROOM_PATH.basename($_FILES["roomImage"]["name"]))) {

      }
      $datetime = date("Y-m-d H:i:s");
      $qry_ins = "INSERT INTO `room_list` (`typeID`, `roomName`, `room_set`, `Adults`, `price`, `extra_bed`, `description`, `status`, `roomImage`, `add_date`) VALUES ('".$typeID."','".$roomName."','".$room_set."','".$adults."','".$price."','".$extra_bed."','".$description."','".$status."','".$_FILES["roomImage"]["name"]."','".$datetime."')"; 
      mysqli_query($conn,$qry_ins);
    }else{
      $datetime = date("Y-m-d H:i:s");
      $qry_ins = "INSERT INTO `room_list` (`typeID`, `roomName`, `room_set`, `Adults`, `price`, `extra_bed`, `description`, `status`, `add_date`) VALUES ('".$typeID."','".$roomName."','".$room_set."','".$adults."','".$price."','".$extra_bed."','".$description."','".$status."','".$datetime."')"; 
      mysqli_query($conn,$qry_ins);
    }

    /*if (move_uploaded_file($_FILES["optional_image"]["tmp_name"], ROOM_PATH.basename($_FILES["optional_image"]["name"]))) {

    }*/
    

    $last_id = mysqli_insert_id($conn);

    if($_FILES['optional_image'])
    {
      foreach ($_FILES['optional_image']['tmp_name'] as $key => $image) {
          $imageTmpName = $_FILES['optional_image']['tmp_name'][$key];
          $imageName = $_FILES['optional_image']['name'][$key];
          $result = move_uploaded_file($imageTmpName,ROOM_PATH.$imageName);
          $datetime = date("Y-m-d H:i:s");
          $ins_img = "INSERT INTO `room_image`(`room_id`, `image_name`, `add_date`) VALUES ('".$last_id."','".$imageName."','".$datetime."')";
          mysqli_query($conn,$ins_img);
      }
    }

    header("location:roomList.php");
    
  }

  if(isset($_GET['id'])){
    $sel_room = "SELECT * FROM `room_list` WHERE roomNo = '".$_GET['id']."' ";
    $res_room = mysqli_query($conn,$sel_room);
    $record = mysqli_fetch_array($res_room);
  }
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
            <h1 class="h3 mb-0 text-gray-800">Add Room</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <form class="form-horizontal" name="service_add" method="post" enctype="multipart/form-data" _lpchecked="1"  style="overflow:hidden;">
                

                  <div class="box-body">

    <div class="form-group">
      <div class="row">
        <!-- ROOM TYPE -->
        <div class="col-md-6">          
          <label for="name" class="col-sm-3 control-label"> Room Type </label>
          <div class="col-sm-9">
            <select class="form-control required" name="typeID">
              <option value=""> Select RoomType</option>
              <?php
                while($row_roomtype = mysqli_fetch_array($res_roomtype)){
                  if($row_roomtype['typeID'] == $record['typeID']){
                    $selected = "selected";
                  }else{
                    $selected = "";
                  }
              ?>
                <option value="<?php echo $row_roomtype['typeID']; ?>" <?php echo $selected; ?>><?php echo $row_roomtype['typename']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <!-- ROOM NAME -->
        <div class="col-md-6">             
          <label for="uname" class="col-sm-3 control-label">Room Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control chkchr required" name="roomName" id="roomName" placeholder="Room Name" value="<?php if(isset($record['roomName'])){echo $record['roomName']; } ?>">
          </div>
        </div>
     </div>
   </div>

    <div class="form-group">
      <div class="row">
      <!-- NO. OF ROOMS -->
        <div class="col-md-6">          
          <label for="email" class="col-sm-3 control-label"> No. of Rooms </label>
          <div class="col-sm-9">
            <input type="text" class="form-control required chkint" name="room_set" id="room_set" placeholder="No. Of Rooms" value="<?php if(isset($record['room_set'])){echo $record['room_set']; }?>">
          </div>
        </div>
        
         <!-- MAX PERSON -->
        <div class="col-md-6">          
          <label for="email" class="col-sm-3 control-label"> Max Person  </label>
          <div class="col-sm-9">
            <input type="text" class="form-control required chkint" name="adults" id="adults" placeholder="Max Person" value="<?php if(isset($record['Adults'])){echo $record['Adults'];}?>">
          </div>
        </div>
      </div>
    </div>



    <div class="form-group">
      <div class="row">
      <!-- ROOM PRICE -->
    <div class="col-md-6">             
          <label for="phone" class="col-sm-3 control-label"> Room Price  </label>
          <div class="col-sm-9">
            <input type="text" class="form-control chkintfloat required" name="price" id="price" placeholder="Room Price" value="<?php if(isset($record['price'])){echo $record['price']; }?>">
            <input type="hidden" name="id" value="<?php if(isset($record['roomNo'])){echo $record['roomNo']; }?>">
          </div>
        </div>
        
        <!-- EXTRA BED CHARGES -->
        <div class="col-md-6">             
          <label for="uname" class="col-md-6 control-label">Extra Bed Price</label>
          <div class="col-sm-9">
            <input type="text" class="form-control required" placeholder="Extra Bed Charges" name="extra_bed" value="<?php if(isset($record['extra_bed'])){echo $record['extra_bed']; }?>">
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">

        <div class="col-md-6">          
          <label for="email" class="col-sm-3 control-label"> Main Image </label>
          <div class="col-sm-9">
             <input type="file" class="form-control" name="roomImage" id="main_image"  onchange="readURL(this)">
            <span class="main_img_file" style="display:none">
            <?php
            if(!empty($record['roomImage']))
            {
              ?>
               <input type="text" name="main_image" class="form-control" value="<?php echo $record['roomImage'];?>">
              <?php
            }             
            
            ?>
            </span>
          </div>
        </div>

        <div class="col-md-6">          
          <label for="email" class="col-md-6 control-label"> Optional Image </label>
          <div class="col-sm-9">
            <input type="file" name="optional_image[]" class="form-control"   onchange="readURLOptional(this)" multiple>
            <span class="optional_img_file" style="display:none"></span>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-md-12">          
          <label for="email" class="col-md-1 control-label">  </label>
          <div class="col-md-10" style="margin-left:11px">  

            <div class="col-md-12 preview_img">
              <!-- main image -->
              <?php
              if(!empty($record['roomImage']))
              {
              ?>
                <div class="col-md-2" style="margin-right: 11px; margin-bottom: 5px;" data-one="<?php echo $record['roomImage'] ; ?>" data-two="<?php echo $record['roomNo']?>">
                <img src="../upload/rooms/<?php echo $record['roomImage']?>" style="width: 150px; height:150px;">
                <span class="remove_img_single"  data-one="" style="position: absolute;color: red;margin-top: -10px;cursor: pointer;">
                <i class="fa fa-close" data-toggle="tooltip" title="" data-original-title="Remove"></i>
                </span>
                </div>
              <?php
              }
              ?>

              <!-- optional image -->

              <?php
              if(!empty($record['roomImage']))
              {

                $qry_del = "SELECT * FROM `room_image` WHERE room_id = '".$_GET['id']."' ";
                $res_img = mysqli_query($conn,$qry_del);
                $num = mysqli_num_rows($res_img);

                if($num > 0){
                  foreach ($res_img as $key => $optionvalue) 
                  {
                    
                      ?>
                      <div class="col-md-2" style="margin-right: 11px; margin-bottom: 5px;" data-one="<?php echo $optionvalue['id']?>">
                      <img src="../upload/rooms/<?php echo $optionvalue['image_name']?>" style="width: 150px; height:150px;">
                      <span class="remove_img_dataoptional"  data-one="<?php echo $optionvalue['id']?>" style="position: absolute;color: red;margin-top: -10px;cursor: pointer;">
                      <i class="fa fa-close" data-toggle="tooltip" title="" data-original-title="Remove"></i>
                      </span>
                      </div>
                      <?php

                  }
                }
              }
              ?>
       
            </div>

          </div>
        </div>
      </div>
    </div>


    <div class="form-group">
      <div class="row">
      <!-- ROOM DESCRIPTION -->
      <div class="col-md-6">             
          <label for="uname" class="col-md-6 control-label"> Room Description</label>
          <div class="col-sm-9">
            <textarea class="form-control required" rows="3" placeholder="Room Description" name="description"><?php if(isset($record['description'])){echo $record['description']; }?></textarea>
          </div>
        </div>  
    
        <div class="col-md-6">             
          <label for="gender" class="col-sm-3 control-label"> Status </label>
            <div class="col-sm-9">  
              <div class="row">
                <div class="col-md-6">
                  <label class="control-label"> Active </label> 
                  <input type="radio" name="status" class="flat-red" value="1" <?php if(isset($record['status'])){if($record['status']==1){ echo "checked";}}?> checked >                            
                </div>
                <div class="col-md-6">
                  <label class="control-label"> Inactive </label>
                  <input type="radio" name="status" class="flat-red" value="2" <?php if(isset($record['status'])){if($record['status']==2){ echo "checked";}}?> >                           
                </div>                                             
              </div>                    
            </div>
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
                      <label for="inputEmail3" class="col-md-2 control-label ">Room Name</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="roomName" id="roomName" placeholder="Enter Room Type name" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">No. of Rooms</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="room_set" id="room_set" placeholder="Enter Room Type name" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Max Person</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="adults" id="adults" placeholder="Enter Room Type name" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Room Price</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="price" id="price" placeholder="Enter Room Type name" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Extra Bed Charges</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control chkchr required" value="<?php if(isset($row_room['typename'])){ echo $row_room['typename']; } ?>" name="extra_bed" id="extra_bed" placeholder="Enter Room Type name" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Room Description</label>
                      <div class="col-md-6">
                        <textarea class="form-control required" rows="3" placeholder="Room Description" name="description"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Main Image</label>
                      <div class="col-md-6">
                        <input type="file" class="form-control required" name="roomImage" id="main_image" onchange="readURL(this)">
                        <span class="main_img_file" style="display:none"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-md-2 control-label ">Optional Image</label>
                      <div class="col-md-6">
                        <input type="file" name="optional_image[]" class="form-control" onchange="readURLOptional(this)" multiple="">
                        <span class="optional_img_file" style="display:none"></span>
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label ">Description</label>
                      <div class="col-sm-10">
                        <textarea class="form-control required" rows="3" placeholder="Enter Some Description Related to RoomType" name="Desp" value=""></textarea>
                      </div>
                    </div> -->
                    <div class="form-group">
                    <label for="gender" class="col-sm-3 control-label"> Status </label>
                    <div class="col-sm-9">  
                      <div class="row">
                        <div class="col-md-6">
                          <label class="control-label"> Active </label> 
                          <input type="radio" name="status" class="flat-red" value="1" <?php if(isset($row_room['status'])){ if($row_room['status'] == 1){ echo "checked"; }else{ echo ""; } } ?> checked>                            
                        </div>
                        <div class="col-md-6">
                          <label class="control-label"> Inactive </label>
                          <input type="radio" name="status" class="flat-red" value="2" <?php if(isset($row_room['status'])){ if($row_room['status'] == 2){ echo "checked"; }else{ echo ""; } } ?>>                           
                        </div>                                             
                      </div>                    
                    </div>
                 
                    </div>
                 
                </div>
                */ ?>
                <div class="box-footer">              
                  <button type="submit" class="btn btn-info pull-right" name="submit" value="roomtype_add"><i class="fa fa-legal"></i> Submit</button>
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
  
  $("#optional_image").on("change", function() {
    if ($("#optional_image")[0].files.length > 5) {
        alert("You can select only 5 images");
        $('#optional_image').val('');
    }
  });
  </script>


</body>

</html>
