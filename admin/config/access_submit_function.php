<?php 
session_start();
/*-------------------------------     SCRIPT FOR ONLY PERMISSION ASSIGN  FUNCTION ON SUBMIT  PAGE               ------------------------------*/
  $admin_function_access=array(
                          
                           /* -----   SETTING MASTER  -------*/                      
                           'roomtype_add','roomtype_edit',
                           'usertype_add','usertype_edit',
                          
                          /* -----  END  SETTING MASTER  -------*/

                          /* -----  USER  MASTER  -------*/
                           'user_add','user_edit','user-edit.php',                       
                           
                          /* -----  END USER  MASTER  -------*/

                           /* -----  ROOM  MASTER  -------*/
                           'room_add','room_edit','room-edit.php',
                           'blockroom_add',  'reservation_add'                     
                           
                          /* -----  END ROOM  MASTER  -------*/

                      );

  $subadmin_function_access=array(
                          
                            /* -----   SETTING MASTER  -------*/                      
                           'roomtype_add','roomtype_edit',
                           'usertype_add','usertype_edit',
                          
                          /* -----  END  SETTING MASTER  -------*/

                          /* -----  USER  MASTER  -------*/
                           'user_add','user_edit','user-edit.php',                         
                           
                          /* -----  END USER  MASTER  -------*/

                            /* -----  ROOM  MASTER  -------*/
                           'room_add','room_edit','room-edit.php', 
                           'blockroom_add'     ,  'reservation_add'                   
                           
                          /* -----  END ROOM  MASTER  -------*/



                      );


/*-------------------------------   END   SCRIPT FOR ONLY PERMISSION ASSIGN FOR PAGE               ------------------------------*/



function chk_login_oncallfunction()
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
    //header("location:$path?$url_value");
    	?>
	<script>
			 window.location ="<?php echo $path."?".$url_value ; ?>";
		</script>
	 <?php
  }else{
   // header("location:$path");
   	?>
<script>
			 window.location ="<?php echo $path ; ?>";
		</script>  
	 <?php
  }

  exit ;
}

function  chk_function_acess($current_function,$logger_type)
{
  global $admin_function_access,$master_function_access,$agent_function_access,$technician_function_access ;
  
  if($logger_type=='admin')
  { 

    $chk_in_array=in_array($current_function, $admin_function_access,TRUE);
    
    if($chk_in_array)
    {
      return true;
    }else{
      redirect_page(PROJECT_PATH);
    }
  }

  else if($logger_type=='subadmin')
  {
    $chk_in_array=in_array($current_function, $master_function_access,TRUE);
    if($chk_in_array)
    {
      return true;
    }else{
      redirect_page(PROJECT_PATH);
    }
  }

}

// check function access


$current_function=$submit;
$current_function; 
if($current_function!=='user_login')
{
   $logger_type=$_SESSION[SESSION_LOGIN]['logger_type']; 
   $chk_access_function=chk_function_acess($current_function,$logger_type);
   $chk_login=chk_login_oncallfunction();
}

?>