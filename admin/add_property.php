<?php 

  session_start();
  require_once('database/config.php');
  if(!isset($_SESSION['id'])){
    header("location:login.php");
    exit;

  }

$date1 = date("d M, Y");
//  $srt="select phone from user where user_id =" .$_SESSION["id"];
// $qry1 = $conn->query($srt);
// $record = $qry1->fetch_array(MYSQLI_ASSOC);
// $contact = $record['phone'];



if(isset($_POST['submit']))
{

  if (isset($_FILES['file']['tmp_name'])) {
 
  // print_r($_FILES['file']);
  foreach ($_FILES['file']['tmp_name'] as $key => $val ) {
$name = $_FILES['file']['name'][$key];
  $target_path = "images/".$_FILES['file']['name'][$key];
 move_uploaded_file($_FILES['file']['tmp_name'][$key], $target_path); 
  }
  $name = implode('++',$_FILES['file']['name']);
  }

  else{
    $name="";
  }
  foreach ($_POST['feature'] as $key => $val ) {
    $features = $_POST['feature'][$key];
    
   }



  
  $features=implode('++',$_POST['feature']);


}

  if(isset($_POST['submit']) && isset($_GET['id'])){
//$id=$_POST['id'];
$catid=$_POST['catid'];
$email=$_POST['email'];
$title=$_POST['title'];
$agent=$_POST['agent'];
$whatsapp=$_POST['whats'];
$lot_size=$_POST['lot_size'];
$developer=$_POST['developer'];
$cityid=$_POST['cityid'];
$locationid=$_POST['locationid'];
$address=$_POST['address'];
$typeid=$_POST['typeid'];
$price=$_POST['price'];
$view=$_POST['view'];
$permit=$_POST['permit'];
$description=$_POST['description'];
$bedroom=$_POST['bedroom'];
$bathroom=$_POST['bathroom'];
$video=$_POST['video'];
$status = $_POST['status'];
$featured = $_POST['featured'];
$verified = $_POST['verified'];
$phone=$_POST['phone'];

foreach ($_FILES['filec']['tmp_name'] as $key => $val ) {
  $namec = $_FILES['filec']['name'][$key];
  $target_path = "images/".$_FILES['filec']['name'][$key];
 move_uploaded_file($_FILES['filec']['tmp_name'][$key], $target_path); 

  }

  $sssql = "SELECT * FROM property WHERE proid= {$_GET['id']}";
  $ssresult = mysqli_query($conn, $sssql);
  $ssrow = mysqli_fetch_array($ssresult);
 if ($name!="") {
  $name= $ssrow['image']."++".$name; 
  
 }
  else{
  $name= $ssrow['image'];
  }  
 
 
$features=implode('++',$_POST['feature']);



$query_upd = "UPDATE `property` SET 
`catid` = '".$catid."',
`email` = '".$email."',
`agent` = '".$agent."',   
`title` = '".$title."',
`developer` = '".$developer."',
`cityid` = '".$cityid."',
`locationid` = '".$locationid."',
`typeid` = '".$typeid."',
`bedroom` = '".$bedroom."',
`bathroom` = '".$bathroom."',
`price` = '".$price."',
`view` = '".$view."',
`permit` = '".$permit."',
`address` = '".$address."',
`video` = '".$video."',
`image` = '".$name."',
`description` = '".$description."' ,
`lot_size` = '".$lot_size."',
`featureid` = '".$features."',
`status` = '".$status."' ,
`featured` = '".$featured."',
`verified` = '".$verified."',
`phone` = '".$phone."'
 WHERE `proid` = '".$_GET['id']."'"; 
 mysqli_query($conn,$query_upd);

    // header("location:property_list.php");

  }
  else if(isset($_POST['submit']))
  {
 $catid=$_POST['catid'];
$email=$_POST['email'];
$title=$_POST['title'];
$whatsapp=$_POST['whats'];
$lot_size=$_POST['lot_size'];
$developer=$_POST['developer'];
$cityid=$_POST['cityid'];
$locationid=$_POST['locationid'];
$address=$_POST['address'];
$typeid=$_POST['typeid'];
$price=$_POST['price'];
$view=$_POST['view'];
$permit=$_POST['permit'];
$whatsapp=$_POST['whats'];
$description=$_POST['description'];
$bedroom=$_POST['bedroom'];
$bathroom=$_POST['bathroom'];
$agent=$_POST['agent'];
$video=$_POST['video'];
$status = $_POST['status'];
$featured = $_POST['featured'];
$verified = $_POST['verified'];
$phone=$_POST['phone'];
$name = implode('++',$_FILES['file']['name']);
$features=implode('++',$_POST['feature']);






      $query = "INSERT INTO `property` (
      `catid`,
       `title`,
       `cityid`,
       `locationid`,
       `typeid`,
       `bedroom`,
       `bathroom`,
       `price`,
       `address`,
       `video`,
       `image`,
       `description`,
       `lot_size`,
       `featureid`,
       `date`,
       `status`,
       `featured`,
       `verified`,
       `author`,
       `phone`,
       `email`,
       `agent`,
       `whatsapp`,
       `developer`,
       `view`,
       `permit`) 
       VALUES (
       '".$catid."',
       '".$title."',
       '".$cityid."',
       '".$locationid."',
       '".$typeid."',
       '".$bedroom."',
       '".$bathroom."',
       '".$price."',
       '".$address."',
       '".$video."',
       '".$name."',
       '".$description."',
       '".$lot_size."',
       '".$features."',
       '".$date1."',
       '".$status."',
       '".$featured."',
       '".$verified."',
       '".$phone."',
       '".$phone."',
       '".$email."',
        '".$agent."',
       '".$whatsapp."',
       '".$developer."',
       '".$view."',
       '".$permit."')"; 


      

     

  $r=mysqli_query($conn,$query)or die(mysql_error($conn));
       header("location:property_list.php");

 
if($r)
{
  $msg='<div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Property Data Add successful.
  </div>';    
}
else
{
$msg='<div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Property Data Add Not successful.
  </div>';

}
        
header("location:property_list.php");
  }



?>  


<?php  
 
 if(isset($_GET['id'])){
    $sel_pro = "SELECT * FROM `property` WHERE proid = '".$_GET['id']."' ";
    $res_pro = mysqli_query($conn,$sel_pro);
    $row_pro = mysqli_fetch_array($res_pro);
   
  }

  $sel_city = "SELECT * FROM `city_master` order By name asc";
  $res_city = mysqli_query($conn,$sel_city);

  $sel_cat = "SELECT * FROM `cat_master` order By name asc";
  $res_cat = mysqli_query($conn,$sel_cat);

  
  $sel_agent_master = "SELECT * FROM `agent_master` order By name asc";
  $res_agent_master = mysqli_query($conn,$sel_agent_master);
  $agarry = array();
  while ($ag =mysqli_fetch_array($res_agent_master))
  {
      $agarry[] = $ag;
  }
  
  $sel_feature = "SELECT * FROM `feature_master` order By name asc";
  $res_feature = mysqli_query($conn,$sel_feature);



 $sel_developer = "SELECT * FROM `developer_master` order By name asc";
  $res_developer = mysqli_query($conn,$sel_developer);



  $sel_city = "SELECT * FROM `city_master` order By name asc";
  $res_city = mysqli_query($conn,$sel_city);

   $sel_location = "SELECT * FROM `location_master` order By name asc";
  $res_location = mysqli_query($conn,$sel_location);

   $sel_type = "SELECT * FROM `type_master` order By name asc";
  $res_type = mysqli_query($conn,$sel_type);


   $sel_cat = "SELECT * FROM `cat_master` order By name asc";
  $res_cat = mysqli_query($conn,$sel_cat);

   $sel_feature = "SELECT * FROM `feature_master` order By name asc";
  $res_feature = mysqli_query($conn,$sel_feature);


 ?>
    <!-- Header -->
          
       <!-- Left Sidebar -->

        <!-- #END# Left Sidebar -->

        <html>
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
            <h1 class="h3 mb-0 text-gray-800">Property Master</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                            <form method="post"  enctype="multipart/form-data">

                                        <div class="col-lg-3 ">  
                                  <h3 class="form-head">Property Details</h3>

                                </div>


                      <!---category Type Started -------------->

<div class="form-group">
                      <label  class="col-md-2 control-label ">For</label>
                      <div class="col-md-6">
                        <select class="form-control  required" name="typeid">
                          <option>Select</option>
                          <?php 
                            foreach ($res_type as $key => $type) {
                              $sel = "";
                              if(isset($row_pro['typeid'])){
                              if($row_pro['typeid'] == $type['typeid']){
                                $sel = "selected";
                              }}
                          ?>
                            <option <?php echo $sel; ?> value="<?php echo $type['typeid']; ?>" ><?php echo $type['name']; ?></option>
                          <?php
                            }
                          ?>


                        </select>
                      
                    </div>
                    </div>



                                    <div class="form-group">
                      
                      <div class="col-lg-6 form-group">
                        <select class="form-control  required" id="cat-dropdown" name="catid">
                          <option>Select Property Type</option>
                          <?php 
                            foreach ($res_cat as $key => $cat) {                         
                              $sel = "";
                                if(isset($row_pro['catid']))
                                {
                              if($row_pro['catid'] == $cat['catid']){
                                $sel = "selected";
                              }}
                          ?>
                            <option <?php echo $sel; ?> value="<?php echo $cat['catid']; ?>"  ><?php echo $cat['name']; ?></option>
                          <?php
                            }
                          ?>


                        </select>
                      </div>




                      <!---category Type End -------------->
          

                                  

                                
<!------------------------------------Title Started----------------------------------------------->


 <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                  <label class="form-label">Property Title</label>

                                                <input required type="text" name="title" class="form-control"  value ="<?php if(isset($row_pro['title'])){ echo $row_pro['title']; } ?>">
                                            </div>
                                        </div>
                                    </div>

                     



                        <!-------------------------------Property Size Started ------------------------------------>


  <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                              <label class="form-label">Property Size</label>
                                                <input required type="text" name="lot_size" class="form-control"  value ="<?php if(isset($row_pro['lot_size'])){ echo $row_pro['lot_size']; } ?>" placeholder=".sqft">
                                                
                                            </div>
                                        </div>
                                     </div>




<!---------------------------------------------Property Size Endedd------------------------------------------->


                       



    <!------------------------------------ Locality Details ----------------------------->
    
<h3 class="form-head">Locality details</h3>

             <!-------------------- City Started ------------------->


 <div class="form-group">
                     
                      <label for="inputEmail3" class="col-md-2 control-label ">City</label>
                      <div class="col-md-6">
                        <select class="form-control  required" name="cityid" required>
                          <option>Select City</option>
                          
                       <?php 
                            foreach ($res_city as $k => $city) {
                              $sel = "";
                              if(isset($row_pro['cityid'])){
                              if($row_pro['cityid'] == $city['cityid']){
                                $sel = "selected";
                              }}
                          ?>
                            <option <?php echo $sel; ?> value="<?php echo $city['cityid']; ?>" ><?php echo $city['name']; ?></option>
                          <?php
                            }
                          ?>


                        </select>
                      </div>
                  
                    </div>

             <!------------------------- City Ended ---------------------------->


<!----------------------------------------Locality Started -------------------------------------------->


<div class="form-group">
                      <label for="inputlocality" class="col-md-2 control-label ">Property Locality</label>
                      <div class="col-md-6">
                        <select class="form-control  required" name="locationid">
                          <option>Select Property Locality</option>
                          <?php 
                            foreach ($res_location as $key => $location) {
                              $sel = "";
                              if(isset($row_pro['locationid'])){
                              if($row_pro['locationid'] == $location['locationid']){
                                $sel = "selected";
                              }}
                          ?>
                            <option <?php echo $sel; ?> value="<?php echo $location['locationid']; ?>" ><?php echo $location['name']; ?></option>
                          <?php
                            }
                          ?>


                        </select>
                      
                    </div>
                    </div>



<!--------------------------------- Locality Ended -------------------------------------------------->

<!-----------------------------------Address Started ----------------------------------->

                        <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                             <label class="form-label">Street/Area</label>

                                                <input type="text" name="address" class="form-control"  value ="<?php if(isset($row_pro['address'])){ echo $row_pro['address']; } ?>" required>
                                            </div>
                                        </div>
                                    </div>

<!------------------------------- Address ended-------------------------------------->


<!----------------------- Rental Details ------------------------------------------------>

<h3 class="form-head">  Pricing Details</h3>



                    <!---------------------------- price Started ------------------------------>




                                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <label class="form-label"> Expected Price</label>

                                                <input required type="text" name="price" class="form-control"  value ="<?php if(isset($row_pro['price'])){ echo $row_pro['price']; } ?>">
                                                
                                            </div>
                                        </div>
                                    </div>



                    <!----------------------- price ended ------------------------------------>


                   
                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                            <select class="form-control" required name="agent">
                                  <option>Select agent</option>
                                   
                                            <?php
                            foreach($agarry as $ag){
                                ?>
                                <option <?php if(isset($row_pro['agent'])) 
                                { $se="";
                                if($row_pro['agent'] == $ag['id']) {
                                  $se="selected";}
                                else $se="";}else{
                                  $se="";
                                }
          
       
                                echo$se; ?> value="<?php echo $ag['id'];?>"><?php echo $ag['name'];?></option>
                                <?php
                            }
                            ?>





  </select>   
                                            </div>
                                        </div>
                                     </div>

 

                   
 <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                              <label class="form-label">Phone</label>
                                                <input required type="text" name="phone" class="form-control"  value ="<?php if(isset($row_pro['phone'])){ echo $row_pro['phone']; } ?>" placeholder="Phone">
                                                
                                            </div>
                                        </div>
                                     </div>

            


 <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                              <label class="form-label">Whatsapp</label>
                                                <input required type="text" name="whats" class="form-control"  value ="<?php if(isset($row_pro['whatsapp'])){ echo $row_pro['whatsapp']; } ?>" placeholder="Entern Whatsapp No With Country Code">
                                                
                                            </div>
                                        </div>
                                     </div>
                                     <!----------------email----------------->

                                      <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                              <label class="form-label">Email</label>
                                                <input required type="text" name="email" class="form-control"  value ="<?php if(isset($row_pro['email'])){ echo $row_pro['email']; } ?>" placeholder="Email">
                                                
                                            </div>
                                        </div>
                                     </div>

                                     <!----------whtasap -------------------->

                                     
                    <!------------ Description Started ------------------------->


                                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                       <label class="form-label">Description</label>

                                                <input type="text" required name="description" class="form-control"  value ="<?php if(isset($row_pro['description'])){ echo $row_pro['description']; } ?>">
                                            </div>
                                        </div>
                                    </div>


                    <!------------------ Description Ended ------------------------>


                                   <div class="form-group">
                      <label for="inputlocality" class="col-md-2 control-label ">Property Developer</label>
                      <div class="col-md-6">
                        <select class="form-control  required" name="developer">
                          <option>Select Property Developer</option>
                          <?php 
                            foreach ($res_developer as $key => $developer) {
                              $sel = "";
                              if(isset($row_pro['developerid'])){
                              if($row_pro['developerid'] == $developer['developerid']){
                                $sel = "selected";
                              }}
                          ?>
                            <option <?php echo $sel; ?> value="<?php echo $developer['developerid']; ?>" ><?php echo $developer['name']; ?></option>
                          <?php
                            }
                          ?>


                        </select>
                      
                    </div>
                    </div>







                                     <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                       <label class="form-label">View</label>

                                                <input type="text" required name="view" class="form-control"  value ="<?php if(isset($row_pro['view'])){ echo $row_pro['view']; } ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                       <label class="form-label">Permit No</label>

                                                <input type="text" required name="permit" class="form-control"  value ="<?php if(isset($row_pro['permit'])){ echo $row_pro['permit']; } ?>">
                                            </div>
                                        </div>
                                    </div>




<!-----------------------Amenities Started ---------------------------------------->

<h3 class="form-head">Amenities</h3>

   <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                             <label class="form-label">Bedroom</label>

                                                <input required type="number" name="bedroom" class="form-control"  value ="<?php if(isset($row_pro['bedroom'])){ echo $row_pro['bedroom']; } ?>">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                              <label class="form-label">Bathroom</label>
                                                <input required type="number" name="bathroom" class="form-control"  value ="<?php if(isset($row_pro['bathroom'])){ echo $row_pro['bathroom']; } ?>">
                                                
                                            </div>
                                        </div>
                                    </div>

                                  
                    
<div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                               <label class="form-label">Add Video Link</label>
                                                <input type="text" class="form-control"  value ="<?php if(isset($row_pro['video'])){ echo $row_pro['video']; } ?>" required name="video">
                                               
                                            </div>
                                        </div>
                                    </div>


                           
 
    

                                    <?php 
if(isset($row_pro['image'])){
  $rrrimg= explode("++",$row_pro['image']);

  foreach ($rrrimg as $key2 => $val2)
  {
  ?>

<div class="col-lg-6 col-md-3 col-sm-3 col-xs-6 " style="border:2px solid green">
                                        <div class="form-group form-float" >
                                            <div class="form-line">
                                               <label class="form-label">Change This image Must File name <?php echo$rrrimg[$key2]; ?></label>
                                               <div class="custom-file"><input type="file" name="filec[]"   accept="image/gif, image/jpeg, image/png" /></div>                           
                                               
                                            </div>
                                            <img src="images/<?php echo$rrrimg[$key2]; ?>" alt="Girl in a jacket" width="100" height="auto">

                                        </div>
                                    </div>

  
<?php 
  }
}
?><div id="mainphotos">
<label class="form-label">Add Property Image</label>

                                    </div> 

                                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
 <div class="add_field_button" style="display: inline-block;">
<img  style=" cursor: pointer;  margin:30px 8px; padding: 4px; width :80px" src="images/plus.png">
</div>
                                    </div>


                               <div class="form-group">
                    <label for="status" class="col-md-2 control-label"> Status </label>
                   
                        <div class="col-md-4">
                          <label class="control-label" for="active"> Active </label> 
                          <input type="radio"  id="active" name="status" class="flat-red" value="1" <?php if(isset($row_pro['status'])){ if($row_pro['status'] == 1){ echo "checked"; }else{ echo ""; } } ?> checked>                            
                        </div>
                        <div class="col-md-4">
                          <label class="control-label" for="inactive"> Inactive </label>
                          <input type="radio" id="inactive" name="status" class="flat-red" value="2" <?php if(isset($row_pro['status'])){ if($row_pro['status'] == 2){ echo "checked"; }else{ echo ""; } } ?>>                           
                        </div>                                             
                                         
                    </div>

                    <!--------------features ------------------------>

                    <div class="form-group">
                      
                      <div class="col-lg-6 form-group">
                        
                         <label>Select Features</label>
                       </br>


                          <?php 
                         if(isset($row_pro['featureid'])){
                        $rrr= explode("++",$row_pro['featureid']);

                       
                         }


                            foreach ($res_feature as $key => $feature) {
                              // if($row_pro['featureid'] == $feature['featureid']){
                              //   $sel = "selected='selected'";
                              // }
                          ?>
                         
                            <input type="checkbox" name="feature[]" 
                            


                            value="<?php $rcheck=""; echo $feature['name'];
                            if(isset($row_pro['featureid'])){
                            foreach ($rrr as $key1 => $val1)
                            {
                          $rrr[$key1];
if($rrr[$key1]==$feature['name']){
  $rcheck="checked"; 
  break;
}}


                            }
   


                            
                            ?>" 
                            
                            <?php
                            echo$rcheck;             
                            ?>
                            
                            
                            style="cursor: pointer;"> <?php echo $feature['name']; ?> </br> 
                         <?php
                            }
                            ?>

 

                       
                      </div>


                    <!------------ featured --------------------->
 <div class="form-group">
                    <label for="featured" class="col-md-2 control-label"> Featured </label>
                   
                        <div class="col-md-4">
                          <label class="control-label" for="active"> Featured </label> 
                          <input type="radio"  id="active" name="featured" class="flat-red" value="1" <?php if(isset($row_pro['featured'])){ if($row_pro['featured'] == 1){ echo "checked"; }else{ echo ""; } } ?> checked>                            
                        </div>
                        <div class="col-md-4">
                          <label class="control-label" for="inactive"> No </label>
                          <input type="radio" id="inactive" name="featured" class="flat-red" value="2" <?php if(isset($row_pro['featured'])){ if($row_pro['featured'] == 2){ echo "checked"; }else{ echo ""; } } ?>>                           
                        </div>                                             
                                         
                    </div>



                    <!------------------------- Verified ---------------------------->


<div class="form-group">
                    <label for="verified" class="col-md-2 control-label"> Verified Listing </label>
                   
                        <div class="col-md-4">
                          <label class="control-label" for="active"> Verified </label> 
                          <input type="radio"  id="active" name="verified" class="flat-red" value="1" <?php if(isset($row_pro['verified'])){ if($row_pro['verified'] == 1){ echo "checked"; }else{ echo ""; } } ?> checked>                            
                        </div>
                        <div class="col-md-4">
                          <label class="control-label" for="inactive"> No </label>
                          <input type="radio" id="inactive" name="verified" class="flat-red" value="2" <?php if(isset($row_pro['verified'])){ if($row_pro['verified'] == 2){ echo "checked"; }else{ echo ""; } } ?>>                           
                        </div>                                             
                                         
                    </div>



                                 

                                    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" style="text-align: center;">
                             
                                     
                                        <input type="submit" name="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" value="Submit">
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script></head>


  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/custom.js"></script>
  <script src="js/form_validation.js"></script>

 <script>

 $('#cat-dropdown').on('change', function() {
                                       var id = this.value;
                                       $.ajax({
                                       url: "ajax/cat-subcat.php",
                                       type: "POST",
                                       data: {
                                       id: id
                                       },
                                       cache: false,
                                       success: function(result){
                                       $("#subcat-dropdown").html(result);

                                       }
                                       });
                                       });
                                       $('#subcat-dropdown').on('change', function() {
                                       $('#form-date').prop('disabled', false);
                                       var catid = this.value;
                                       $.ajax({
                                       url: "record.php",
                                       type: "POST",
                                       data: {
                                       catid: catid
                                       },

                                       });
                                       });
                                    
                                      
</script>


</body>
<script>
  
    $(document).ready(function() {
    var max_fields      = 20; //maximum input boxes allowed
    var wrapper         = $("#mainphotos"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var x = 1; 
   $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
             //text box increment
            $(wrapper).append('<div class="col-lg-6 col-md-3 col-sm-3 col-xs-6"><div class="form-group form-float"> <div class="custom-file"><input type="file" name="file[]"   accept="image/gif, image/jpeg, image/png" /></div></div><a style="position: relative;bottom:13px;left: 0px;" href="#" class="remove_field"><img id="image'+x+'" style="cursor: pointer; width :20px;" src="images/close.jpg"></a></div>'); //add input box
      
        }
        x++; 
      });
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
       
        e.preventDefault(); 
        $(this).parent('div').remove(); 
        x--;
    });
});
    
    </script>
</html>
