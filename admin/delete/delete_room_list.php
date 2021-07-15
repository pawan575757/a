<?php 
session_start();
require_once('database/config.php');
if(!isset($_SESSION['id'])){
	header("location:login.php");
	exit;
}

if(isset($_POST['id'])){
   $id=  $_POST['id'];  
	mysqli_query($conn,"delete from room_list where roomNo = ".$id);
	//header("location:roomList.php");
	//die();
	echo 1;
}else{
	echo 0;
}

?>