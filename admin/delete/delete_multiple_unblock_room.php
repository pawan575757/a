<?php 
session_start();
require_once('database/config.php');
if(!isset($_SESSION['id'])){
	header("location:login.php");
	exit;
}

if(@$_GET['action']=="delete_multiple_unblock_delete")
{  

$rowCount = count($_POST["del_id"]);
for($i=0;$i<$rowCount;$i++) {
	mysqli_query($conn,"delete from block_list where id = ".$_REQUEST['del_id'][$i]);
}
header("location:blocked-roomList.php");
 die();
}

?>