<?php 
session_start();
require_once('database/config.php');
if(!isset($_SESSION['id'])){
	header("location:login.php");
	exit;
}

if(isset($_POST['id'])){
   $id=  $_POST['id'];  

mysqli_query($conn,"delete from block_list where id = ".$id);
//header("location:blocked-roomList.php");
// die();
	echo 1;
}else{
	echo 0;
}
?>