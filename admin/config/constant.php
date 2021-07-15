<?php
 //ini_set("display_errors", "1");
 error_reporting(0);

  


  define('VALID_LOGIN',TRUE);
  define('SESSION_LOGIN','hotelSessLcrm');
  define('CREATE_ID', 'hotel_dp');
  define('CREATE_ORDERID', 'stro');
 
 // http://www.aawasatmadhai.com
  
  define('ROOM_PATH',$_SERVER["DOCUMENT_ROOT"].'/upload/rooms/');
  
  define('PROJECT_PATH','http://localhost/aawasatmadhai/admin/');
  define('PROJECT_SUBADMIN','http://localhost/aawasatmadhai/admin/');
  define('PROJECT_ADMIN','http://localhost/aawasatmadhai/admin/');

  
  define('ADMIN_LOGIN','http://localhost/aawasatmadhai/admin/dashboard.php');
  define('SUBADMIN_LOGIN','http://localhost/aawasatmadhai/admin/dashboard.php');
  
  
  // left_side_bar
  define('ADMIN_LEFT_SIDEBAR','includes/left_side/@123admin@32/left_side_menu.php');
  define('SUBADMIN_LEFT_SIDEBAR','includes/left_side/@s@subadmin/left_side_menu.php'); 

 

  define("SUBADMIN_LOGOT_PATH",PROJECT_SUBADMIN."logout.php");
  define("ADMIN_LOGOT_PATH",PROJECT_ADMIN."logout.php");

  
  define("ROOMTYPE_LIST",PROJECT_PATH."roomtype-list.php");
  define("USERTYPE_LIST",PROJECT_PATH."usertype-list.php");
  define("USER_LIST",PROJECT_PATH."user-list.php");
  define("ROOM_LIST",PROJECT_PATH."roomList.php");
  define("RESERVATION_LIST",PROJECT_PATH."reservation-list.php");
  
  
  

?>