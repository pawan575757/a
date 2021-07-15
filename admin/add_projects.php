<?php
  session_start();
  require_once('database/config.php');
  if(!isset($_SESSION['id'])){
    header("location:login.php");
    exit;
  }



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

   $name=$_POST['name'];
 

$developer=$_POST['developer'];
$tagline=$_POST['tagline'];

// $type=$_POST['type'];

$location=$_POST['location'];

$price=$_POST['price'];

$compdate=$_POST['comp-date'];

$titletype=$_POST['title-type'];

$plan=$_POST['plan'];
//$startingprice=$_POST['starting-price'];
$lifestyle=$_POST['lifestyle'];
$firstinstallment=$_POST['first-installment'];
$underconstruction=$_POST['under-construction'];
$handover=$_POST['handover'];
$posthandover=$_POST['post-handover'];
$video=$_POST['video'];
$size=$_POST['size'];
$description=$_POST['description'];
 $status = $_POST['status'];


 foreach ($_FILES['file']['tmp_name'] as $key => $val ) {
  $namec = $_FILES['file']['name'][$key];
  $target_path = "images/".$_FILES['file']['name'][$key];
 move_uploaded_file($_FILES['file']['tmp_name'][$key], $target_path); 

  }

  $sssql = "SELECT * FROM projects WHERE projid= {$_GET['id']}";
  $ssresult = mysqli_query($conn, $sssql);
  $ssrow = mysqli_fetch_array($ssresult);
 if ($name1!="") {
  $name1= $ssrow['image']."++".$name1; 
  
 }
  else{
  $name1= $ssrow['image'];
  }  
 
 
$features=implode('++',$_POST['feature']);
$agents=implode('++',$_POST['agent']);
$nearby=implode('++',$_POST['nearby']);
$view=implode('++',$_POST['view']);

$catid=implode('++',$_POST['catid']);


$query_upd = "UPDATE `property` SET 

`catid` = '".$catid."',
`email` = '".$email."',
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
`featured` = '".$features."',
`verified` = '".$verified."',
`phone` = '".$phone."',
`agent` = '".$agents."'

 WHERE `proid` = '".$_GET['id']."'"; 
 mysqli_query($conn,$query_upd);

    // header("location:projects_list.php");
 
                        } 

                        

  else if(isset($_POST['submit']))
  {

$name=$_POST['name'];
 

$developer=$_POST['developer'];
$tagline=$_POST['tagline'];

// $type=$_POST['type'];

$location=$_POST['location'];

$price=$_POST['price'];

$compdate=$_POST['comp-date'];

$titletype=$_POST['title-type'];

$plan=$_POST['plan'];
//$startingprice=$_POST['starting-price'];
$lifestyle=$_POST['lifestyle'];
$firstinstallment=$_POST['first-installment'];
$underconstruction=$_POST['under-construction'];
$handover=$_POST['handover'];
$posthandover=$_POST['post-handover'];
$video=$_POST['video'];
$size=$_POST['size'];
$description=$_POST['description'];
 $status = $_POST['status'];
$name1 = implode('++',$_FILES['file']['name']);
$features=implode('++',$_POST['feature']);

$agents=implode('++',$_POST['agent']);
$nearby=implode('++',$_POST['nearby']);
$view=implode('++',$_POST['view']);
$catid=implode('++',$_POST['catid']);


 


      $query = "INSERT INTO `projects` (`name`,`agent`, `developer`, `tagline`, `location`, `catid`,`price`,`completion-date`, `title-type`, `plan`, `lifestyle`,`first-installment`,`under-construction`, `handover`, `post-handover`,`video`, `size`,`description`,`features`,`image`,`nearby`,`view`,`status` ) VALUES ('".$name."','".$agents."','".$developer."','".$tagline."','".$location."','".$catid."','".$price."','".$compdate."','".$titletype."','".$plan."','".$lifestyle."','".$firstinstallment."','".$underconstruction."','".$handover."','".$posthandover."','".$video."','".$size."','".$description."','".$features."','".$name1."','".$nearby."','".$view."','".$status."')"; 

      
// echo $query;
// die();
  $r=mysqli_query($conn,$query);


if($r)
{
  $msg='<div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> project Data Add successful.
  </div>';    
}
else
{
$msg='<div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> project Data Add Not successful.
  </div>';

}
        
header("location:projects_list.php");
  }


?> 
  <?php
  if(isset($_GET['id'])){
    $sel_proj = "SELECT * FROM `projects` WHERE projid = '".$_GET['id']."' ";
    $res_proj = mysqli_query($conn,$sel_proj);
    $row_proj = mysqli_fetch_array($res_proj);
   
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

$sel_view_master = "SELECT * FROM `view_master` order By name asc";
  $res_view_master = mysqli_query($conn,$sel_view_master);


   $sel_location = "SELECT * FROM `location_master` order By name asc";
  $res_location = mysqli_query($conn,$sel_location);

   $sel_type = "SELECT * FROM `type_master` order By name asc";
  $res_type = mysqli_query($conn,$sel_type);


  


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
            <h1 class="h3 mb-0 text-gray-800">Project Master</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <form class="form-horizontal" name="add_feature" method="post" style="overflow:hidden;">
                <div class="box-body">
                    <?php if(isset($msg)){ echo "<p style='color:red;'>".$msg."</p>"; } ?>


                    <div class="form-group">
                      <div class="row"> 
                      <label for="inputEmail3" class="col-md-1 control-label ">Name</label>
                      <div class="col-md-6">
                        <input type="text" class="form-control required" value="<?php if(isset($row_proj['name'])){ echo $row_proj['name']; } ?>" name="name" id="name" placeholder="Enter Project name">
                      </div>
                    </div>
                    </div><!-----------form-group------------->  



                                          <!----------agent------------>


                                     <div class="form-group">
                      
                      <div class="col-lg-6 form-group">
                        
                         <label>Choose Project Specialist</label>
                       </br>


                          <?php 
                         if(isset($row_proj['agent'])){
                        $rrr= explode("++",$row_proj['agent']);

                       
                         }


                            foreach ($res_agent_master as $key => $agent) {
                              // if($row_pro['id'] == $feature['id']){
                              //   $sel = "selected='selected'";
                              // }
                          ?>
                         
                            <input type="checkbox" name="agent[]" 
                            


                            value="<?php $rcheck=""; echo $agent['id'];
                            if(isset($row_proj['agent'])){
                            foreach ($rrr as $key1 => $val1)
                            {
                          $rrr[$key1];
if($rrr[$key1]==$agent['id']){
  $rcheck="checked"; 
  break;
}}


                            }
   


                            
                            ?>" 
                            
                            <?php
                            echo$rcheck;             
                            ?>
                            
                            
                            style="cursor: pointer;"> <?php echo $agent['name']; ?> </br> 
                         <?php
                            }
                            ?>

 

                       
                      </div>


<!------------------------------------- Developer------------------------->
<div class="form-group">
                     
                      <label for="inputEmail3" class="col-md-2 control-label ">Developer</label>
                      <div class="col-md-6">
                        <select class="form-control  required" name="developer" required>
                          <option>Select developer</option>
                          
                       <?php 
                            foreach ($res_developer as $k => $developer) {
                              $sel = "";
                              if($row_doc['developer'] == $developer['developer']){
                                $sel = "selected='selected'";
                              }
                          ?>
                            <option <?php if(isset($row_proj['developer'])) { if($row_proj['developer'] == $developer['developerid']) { ?> selected <?php }}?> value="<?php echo $developer['developerid']; ?>"<?php echo $sel; ?> ><?php echo $developer['name']; ?></option>
                          <?php
                            }
                          ?>


                        </select>
                      </div>
                  
                    </div>

                    <!---------------tagline-------------------->
                     <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                  <label class="form-label">Property Tagline</label>

                                                <input required type="text" name="tagline" class="form-control"  value ="<?php if(isset($row_proj['tagline'])){ echo $row_proj['tagline']; } ?>">
                                            </div>
                                        </div>
                                    </div>


                                                   
                                                        <!---------------type-------------------->
                    <div class="form-group">
                      
                      <div class="col-lg-6 form-group">
                        
                         <label>Choose Property Type</label>
                       </br>


                          <?php 
                         if(isset($row_proj['catid'])){
                        $rrr= explode("++",$row_proj['catid']);

                       
                         }


                            foreach ($res_cat as $key => $catid) {
                              // if($row_pro['id'] == $feature['id']){
                              //   $sel = "selected='selected'";
                              // }
                          ?>
                         
                            <input type="checkbox" name="catid[]" 
                            


                            value="<?php $rcheck=""; echo $catid['name'];
                            if(isset($row_proj['catid'])){
                            foreach ($rrr as $key1 => $val1)
                            {
                          $rrr[$key1];
if($rrr[$key1]==$catid['name']){
  $rcheck="checked"; 
  break;
}}


                            }
   


                            
                            ?>" 
                            
                            <?php
                            echo$rcheck;             
                            ?>
                            
                            
                            style="cursor: pointer;"> <?php echo $catid['name']; ?> </br> 
                         <?php
                            }
                            ?>

 

                       
                      </div>


  <!---------------location-------------------->
                   <div class="form-group">
                      <label for="inputlocality" class="col-md-2 control-label ">Property Locality</label>
                      <div class="col-md-6">
                        <select class="form-control  required" name="location">
                          <option>Select Property Locality</option>
                          <?php 
                            foreach ($res_location as $key => $location) {
                              $sel = "";
                              if(isset($row_proj['location'])){
                              if($row_proj['location'] == $location['locationid']){
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

                    <!------------------Nearby Location---------------->

                    <div class="form-group">
                      
                      <div class="col-lg-6 form-group">
                        
                         <label>Choose Nearby Locations</label>
                       </br>


                          <?php 
                         if(isset($row_proj['nearby'])){
                        $rrr= explode("++",$row_proj['nearby']);

                       
                         }


                            foreach ($res_location as $key => $nearby) {
                              // if($row_pro['id'] == $feature['id']){
                              //   $sel = "selected='selected'";
                              // }
                          ?>
                         
                            <input type="checkbox" name="nearby[]" 
                            


                            value="<?php $rcheck=""; echo $nearby['name'];
                            if(isset($row_proj['nearby'])){
                            foreach ($rrr as $key1 => $val1)
                            {
                          $rrr[$key1];
if($rrr[$key1]==$nearby['name']){
  $rcheck="checked"; 
  break;
}}


                            }
   


                            
                            ?>" 
                            
                            <?php
                            echo$rcheck;             
                            ?>
                            
                            
                            style="cursor: pointer;"> <?php echo $nearby['name']; ?> </br> 
                         <?php
                            }
                            ?>

 

                       
                      </div>

  <!---------------price-------------------->
                     <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                  <label class="form-label">Property price</label>

                                                <input required type="text" name="price" class="form-control"  value ="<?php if(isset($row_proj['price'])){ echo $row_proj['price']; } ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <!---------------date-------------------->
                     <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                  <label class="form-label">Property Completion date</label>

                                                <input required type="text" name="comp-date" class="form-control"  value ="<?php if(isset($row_proj['comp-date'])){ echo $row_proj['comp-date']; } ?>">
                                            </div>
                                        </div>
                                    </div>

                             <!-------------view-------------->

                              <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                  <label class="form-label">Choose:</label><br>

                                             <input type="radio" id="off" name="plan" value="1" checked style="cursor:pointer;">
                                          <label for="off" style="cursor:pointer;">Off Plan</label><br>

                                           <input type="radio" id="ready" name="plan" value="2" style="cursor:pointer;"> 
                                          <label for="ready" style="cursor:pointer;">Ready To Move</label><br>
                                            </div>
                                        </div>
                                    </div>


                                          <!----------agent------------>


                                     <div class="form-group">
                      
                      <div class="col-lg-6 form-group">
                        
                         <label>Choose View</label>
                       </br>


                          <?php 
                         if(isset($row_proj['view'])){
                        $rrr= explode("++",$row_proj['view']);

                       
                         }


                            foreach ($res_view_master as $key => $view) {
                              // if($row_pro['id'] == $feature['id']){
                              //   $sel = "selected='selected'";
                              // }
                          ?>
                         
                            <input type="checkbox" name="view[]" 
                            


                            value="<?php $rcheck=""; echo $view['name'];
                            if(isset($row_proj['view'])){
                            foreach ($rrr as $key1 => $val1)
                            {
                          $rrr[$key1];
if($rrr[$key1]==$view['name']){
  $rcheck="checked"; 
  break;
}}


                            }
   


                            
                            ?>" 
                            
                            <?php
                            echo$rcheck;             
                            ?>
                            
                            
                            style="cursor: pointer;"> <?php echo $view['name']; ?> </br> 
                         <?php
                            }
                            ?>

 

                       
                      </div>       
                  

                                        <!---------------title-type-------------------->
                     <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                  <label class="form-label">Property title-type</label>

                                                <input required type="text" name="title-type" class="form-control"  value ="<?php if(isset($row_proj['title-type'])){ echo $row_proj['title-type']; } ?>">
                                            </div>
                                        </div>
                                    </div>

                                       
                     

                                        <!---------------starting-price-------------------->
                    <!--  <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                  <label class="form-label">Property starting-price</label>

                                                <input required type="text" name="starting-price" class="form-control"  value ="<?php //if(isset($row_proj['starting-price'])){ echo $row_proj['starting-price']; } ?>">
                                            </div>
                                        </div>
                                    </div> -->

                                        <!---------------lifestyle-------------------->
                     <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                  <label class="form-label">Property lifestyle</label>

                                                <input required type="text" name="lifestyle" class="form-control"  value ="<?php if(isset($row_proj['lifestyle'])){ echo $row_proj['lifestyle']; } ?>">
                                            </div>
                                        </div>
                                    </div>



             <div><h2>Payment Plans</h2></div>
                                        <!---------------first-installment-------------------->
                     <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                  <label class="form-label">Property first-installment</label>

                                                <input required type="text" name="first-installment" class="form-control"  value ="<?php if(isset($row_proj['first-installment'])){ echo $row_proj['first-installment']; } ?>">
                                            </div>
                                        </div>
                                    </div>


                                     <!---------------under-construction-------------------->
                     <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                  <label class="form-label">Property under-construction</label>

                                                <input required type="text" name="under-construction" class="form-control"  value ="<?php if(isset($row_proj['under-construction'])){ echo $row_proj['under-construction']; } ?>">
                                            </div>
                                        </div>
                                    </div>


                                     <!---------------handover-------------------->
                     <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                  <label class="form-label">Property handover</label>

                                                <input required type="text" name="handover" class="form-control"  value ="<?php if(isset($row_proj['handover'])){ echo $row_proj['handover']; } ?>">
                                            </div>
                                        </div>
                                    </div>


                                     <!---------------post-handover-------------------->
                     <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                  <label class="form-label">Property post-handover</label>

                                                <input required type="text" name="post-handover" class="form-control"  value ="<?php if(isset($row_proj['post-handover'])){ echo $row_proj['post-handover']; } ?>">
                                            </div>
                                        </div>
                                    </div>


                                       <!---------------video-------------------->
                     <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                  <label class="form-label">Property video</label>

                                                <input required type="text" name="video" class="form-control"  value ="<?php if(isset($row_proj['video'])){ echo $row_proj['video']; } ?>">
                                            </div>
                                        </div>
                                    </div>


                                      <!---------------size-------------------->
                     <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                  <label class="form-label">Property size</label>

                                                <input required type="text" name="size" class="form-control"  value ="<?php if(isset($row_proj['size'])){ echo $row_proj['size']; } ?>">
                                            </div>
                                        </div>
                                    </div>



                                      <!---------------size-------------------->
                     <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                               <label class="form-label">Property description</label>
<textarea required type="text" id="editor" name="description" class="form-control"  value ="<?php if(isset($row_proj['description'])){ echo $row_proj['description']; } ?>"  style="height: 300px;"></textarea>
                                            
                                            </div>
                                        </div>
                                    </div>

<!----------------------------featurees---------------------------->


<div class="form-group">
                      
                      <div class="col-lg-6 form-group">
                        
                         <label>Select Features</label>
                       </br>


                          <?php 
                         if(isset($row_proj['features'])){
                        $rrr= explode("++",$row_proj['features']);

                       
                         }


                            foreach ($res_feature as $key => $feature) {
                              // if($row_pro['features'] == $feature['features']){
                              //   $sel = "selected='selected'";
                              // }
                          ?>
                         
                            <input type="checkbox" name="feature[]" 
                            


                            value="<?php $rcheck=""; echo $feature['name'];
                            if(isset($row_proj['features'])){
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



        

                                     <!---------------Property Image-------------------->
                    
                                    <?php 
if(isset($row_proj['image'])){
  $rrrimg= explode("++",$row_proj['image']);

  foreach ($rrrimg as $key2 => $val2)
  {
  ?>

<div class="col-lg-6 col-md-3 col-sm-3 col-xs-6 " style="border:2px solid green">
                                        <div class="form-group form-float" >
                                            <div class="form-line">
                                               <label class="form-label">Change This image Must File name <?php echo$rrrimg[$key2]; ?></label>
                                               <div class="custom-file"><input type="file" name="file[]"   accept="image/gif, image/jpeg, image/png" /></div>                           
                                               
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
                      <div class="row">
                    <label for="gender" class="col-md-1 control-label"> Status </label>
                    <div class="col-md-4">  
                      <div class="row">
                        <div class="col-md-6">
                          <label class="control-label"> Active </label> 
                          <input type="radio" name="status" class="flat-red" value="1" <?php if(isset($row_proj['status'])){ if($row_proj['status'] == 1){ echo "checked"; }else{ echo ""; } } ?> checked>                            
                        </div>
                        <div class="col-md-6">
                          <label class="control-label"> Inactive </label>
                          <input type="radio" name="status" class="flat-red" value="2" <?php if(isset($row_proj['status'])){ if($row_proj['status'] == 2){ echo "checked"; }else{ echo ""; } } ?>>                           
                        </div>                                             
                      </div>                    
                    </div>
                 </div>
                    </div>
                 
                </div>
                <div class="box-footer">              
                  <button type="submit" class="btn btn-info pull-right" name="submit" value="add_proj"><i class="fa fa-legal"></i> Submit</button>
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

 

</body>


</html>
