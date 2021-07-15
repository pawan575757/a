<?php 
session_start();
require_once('database/config.php');
if(!isset($_SESSION['id'])){
	header("location:login.php");
	exit;
}

// if(@$_GET['action']=="roomtype_delete")
// {
if(isset($_POST['id'])){
   $id=  $_POST['id'];  
	mysqli_query($conn,"delete from property where proid = ".$id);
	//header("location:roomTypeMaster.php");
	//die();
	echo 1;
}else{
	echo 0;
}

?>