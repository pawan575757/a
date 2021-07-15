<?php
session_start();

/*-------------------------------     SCRIPT FOR ONLY PERMISSION ASSIGN  FUNCTION ON SUBMIT  PAGE               ------------------------------*/
  $admin_function_access=array(
                          
                           /* -----   SETTING MASTER  -------*/                      
                           'paymentmode_add','paymentmode_edit',                          
                           'service_add','service_edit',
                           'usertype_add','usertype_edit',
                           'vendortype_add','usertype_edit',
                           'vendortype_add','vendortype_edit',
                           'country_add','country_edit',
                           'currency_add','currency_edit',
                          /* -----  END  SETTING MASTER  -------*/

                          /* -----  USER  MASTER  -------*/
                           'user_add','user_edit','user-edit.php',                         
                           'vendorreport_add','dis_sell','charge_back','pay_incentive',
                          /* -----  END USER  MASTER  -------*/

                          /* -----  CUSTOMER  MASTER  -------*/
                          'assign_technisian',                           
                          /* ----- END CUSTOMER  MASTER  -------*/

                           /* -----  VENDOR  MASTER  -------*/
                           'vendor_add','vendor_edit','pay_vendor','editpay_vendor',                           
                          /* ----- END VENDOR  MASTER  -------*/

                           /* -----  TASK  MASTER  -------*/
                           'close_task',                          
                          /* ----- END TASK  MASTER  -------*/

                          /* -----  REPORT  MASTER  -------*/                          
                           'expense_add','expense_edit',                          
                          /* ----- END REPORT  MASTER  -------*/

                      );

  $master_function_access=array(
                          
                           /* -----   SETTING MASTER  -------*/                    
                          /* -----  END  SETTING MASTER  -------*/

                          /* -----  USER  MASTER  -------*/                                           
                           'vendorreport_add','dis_sell',
                          /* -----  END USER  MASTER  -------*/

                          /* -----  CUSTOMER  MASTER  -------*/ 
                          'assign_technisian',                          
                          /* ----- END CUSTOMER  MASTER  -------*/

                           /* -----  VENDOR  MASTER  -------*/                       
                          /* ----- END VENDOR  MASTER  -------*/

                           /* -----  TASK  MASTER  -------*/
                           'close_task',                          
                          /* ----- END TASK  MASTER  -------*/

                          /* -----  REPORT  MASTER  -------*/                                                  
                          /* ----- END REPORT  MASTER  -------*/



                      );
   $agent_function_access=array(
                           
                           
                          /* -----   SETTING MASTER  -------*/                    
                          /* -----  END  SETTING MASTER  -------*/

                          /* -----  USER  MASTER  -------*/                                         
                          /* -----  END USER  MASTER  -------*/

                          /* -----  CUSTOMER  MASTER  -------*/ 
                          'assign_technisian',                          
                          /* ----- END CUSTOMER  MASTER  -------*/

                           /* -----  VENDOR  MASTER  -------*/                       
                          /* ----- END VENDOR  MASTER  -------*/

                           /* -----  TASK  MASTER  -------*/
                           'close_task',                          
                          /* ----- END TASK  MASTER  -------*/

                          /* -----  REPORT  MASTER  -------*/                                                  
                          /* ----- END REPORT  MASTER  -------*/



                      );
   $technician_function_access=array(
                          
                          /* -----   SETTING MASTER  -------*/                    
                          /* -----  END  SETTING MASTER  -------*/

                          /* -----  USER  MASTER  -------*/                                         
                          /* -----  END USER  MASTER  -------*/

                          /* -----  CUSTOMER  MASTER  -------*/                           
                          /* ----- END CUSTOMER  MASTER  -------*/

                           /* -----  VENDOR  MASTER  -------*/                       
                          /* ----- END VENDOR  MASTER  -------*/

                           /* -----  TASK  MASTER  -------*/
                           'close_task',                          
                          /* ----- END TASK  MASTER  -------*/

                          /* -----  REPORT  MASTER  -------*/                                                  
                          /* ----- END REPORT  MASTER  -------*/


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

  else if($logger_type=='master')
  {
    $chk_in_array=in_array($current_function, $master_function_access,TRUE);
    if($chk_in_array)
    {
      return true;
    }else{
      redirect_page(PROJECT_PATH);
    }
  }

  else if($logger_type=='agent')
  {
    
    $chk_in_array=in_array($current_function, $agent_function_access,TRUE);
    if($chk_in_array)
    {
      return true;
    }else{
      redirect_page(PROJECT_PATH);
    }
  }

  if($logger_type=='techinician')
  {
    $chk_in_array=in_array($current_function, $technician_function_access,TRUE);
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
if($current_function!=='user_login')
{
   $logger_type=$_SESSION[SESSION_LOGIN]['logger_type']; 
   $chk_access_function=chk_function_acess($current_function,$logger_type);
   $chk_login=chk_login_oncallfunction();
}

?>