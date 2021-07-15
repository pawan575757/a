<?php 

echo " dbask";
  session_start();
  require_once('database/config.php');
  if(!isset($_SESSION['id'])){
    header("location:login.php");
    exit;
  }
if(isset($_POST['submit']))
{


//$id=$_POST['id'];
$img=$_POST['file'];
$bedroom=$_POST['bedroom'];
$bathroom=$_POST['bathroom'];
$hall=$_POST['hall'];
$kichan=$_POST['kitchan'];
$balcony=$_POST['balcony'];
$sqr_price=$_POST['sqr_price'];
$description=$_POST['description'];
$title=$_POST['title'];
$price=$_POST['price'];
$address=$_POST['address'];
$video=$_POST['video'];
$property_owner=$_POST['property_owner'];
$property_type=$_POST['property_type'];
$lot_size=$_POST['lot_size'];
$land_area=$_POST['land_area'];
$sold=$_POST['sold'];
// $address=$_POST['address'];
$map=$_POST['location'];

$file=$_FILES['file']['name'];



      $query = "INSERT INTO `property` ( `title`, `bedroom`, `hall`, `kichan`, `bathroom`, `balcony`,  `price`, `sqr_price`, `address`, `video`, `image`, `description`, `location`, `property_owner`, `property_type`, `lot_size`, `sold`, `land_area`) VALUES ('".$title."','".$bedroom."','".$hall."','".$kichan."','".$bathroom."','".$balcony."','".$price."','".$sqr_price."','".$address."','".$video."','".$img."','".$description."','".$map."','".$property_owner."','".$property_type."','".$lot_size."','".$sold."','".$land_area."')"; 

  
  //$query="insert into property values('','$title','$bedroom','$hall','$kitchan','$bathroom','$balcony','$price','$sqr_price','$add','$video','$file','$description','$location','$property_owner','$property_type','$lot_size','$sold','$land_area',now())";  
  $r=mysqli_query($conn,$query);
  move_uploaded_file($_FILES['file']['tmp_name'],"images/property_image/".$_FILES['file']['name']); 

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
        
}


?>  