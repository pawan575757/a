<?php
session_start();
//ini_set("display_errors",1);
error_reporting(0);

/*-------------------------------     SCRIPT FOR ONLY PERMISSION ASSIGN FOR PAGE                       ------------------------------*/
  $admin_page_access=array(
                           
                           /* -----   SETTING MASTER  -------*/                           
                           'dashboard.php',
                           'roomtype-list.php','roomtype-add.php','roomtype-edit.php',
                           'usertype-list.php','usertype-add.php','usertype-edit.php',
                           
                          /* -----  END  SETTING MASTER  -------*/


                          /* -----  USER  MASTER  -------*/
                           'user-list.php','user-add.php','user-edit.php',                           
                          /* -----  END USER  MASTER  -------*/

                           /* -----  ROOM  MASTER  -------*/
                           'room-list.php','room-add.php','room-edit.php', 
                           'blockroom-list.php',                 
                           'availableroom-list.php',                                   
                          /* -----  END ROOM  MASTER  -------*/
                          
                          /* -----  RESERVATION  MASTER  -------*/
                           'reservation-list.php', 'reservation-add.php',
                                                           
                          /* -----  END RESERVATION  MASTER  -------*/
                      );

  $subadmin_page_access=array(
                          
                           /* -----   SETTING MASTER  -------*/                           
                           'dashboard.php',
                           'roomtype-list.php','roomtype-add.php','roomtype-edit.php',
                           'usertype-list.php','usertype-add.php','usertype-edit.php',
                           
                          /* -----  END  SETTING MASTER  -------*/

                          /* -----  USER  MASTER  -------*/
                           'user-list.php','user-add.php','user-edit.php',                           
                          /* -----  END USER  MASTER  -------*/

                            /* -----  ROOM  MASTER  -------*/
                           'room-list.php','room-add.php','room-edit.php', 
                           'blockroom-list.php',                 
                           'availableroom-list.php',                           
                          /* -----  END ROOM  MASTER  -------*/


                      );
  

  
  
/*-------------------------------   END   SCRIPT FOR ONLY PERMISSION ASSIGN FOR PAGE               ------------------------------*/
/*echo "<pre>";
print_r($_SERVER);*/

function chk_login()
{   
    
    if($_SESSION)
    {  

    if(!empty($_SESSION[SESSION_LOGIN]['url_id']) && !empty($_SESSION[SESSION_LOGIN]['email']) && !empty($_SESSION[SESSION_LOGIN]['uname']) )
    {
        return true ;
    }else{
       redirect_page(PROJECT_PATH);
    }
    }else{
       redirect_page(PROJECT_PATH);
    }
    
}

function redirect_page($path,$url_value=null)
{   
  if(!empty($url_value))
  {
    // header("location:$path?$url_value");
    	?>
	<script>
			 window.location ="<?php echo $path."?".$url_value ; ?>";
		</script>
	 <?php
  }else{
   ?>
   <script>
			 window.location ="<?php echo $path ; ?>";
		</script>
   <?php
  }

  exit ;
}

function  chk_pages_acess($current_page,$logger_type)
{
  global $admin_page_access,$master_page_access ;
 
  if($logger_type=='admin')
  {
    
    $chk_in_array=in_array($current_page, $admin_page_access,TRUE);
    if($chk_in_array)
    {
      return true;
    }else{
      redirect_page(PROJECT_PATH);
    }
  }

  else if($logger_type=='submaster')
  {
    $chk_in_array=in_array($current_page, $subadmin_page_access,TRUE);
    if($chk_in_array)
    {
      return true;
    }else{
      redirect_page(PROJECT_PATH);
    }
  }

}

// check page access
$current_page=$_SERVER['PHP_SELF'];
$explode= explode('/',$current_page); 


if(count($explode)==4)
{
 $current_page=$explode[3];  
}
else if(count($explode)==3){
  $current_page=$explode[2]; 
}



$logger_type=$_SESSION[SESSION_LOGIN]['logger_type']; 
$chk_access_page=chk_pages_acess($current_page,$logger_type);
$chk_login=chk_login();
?>