<?php
/*--------------   sSCRIPT FOR ONLY PERMISSION ASSIGN TO CLICK  BUTTON  ON  PAGE  AND SOME PORTION OF THE PAGE   ------------------*/
  $admin_button_access=array(
                          
                           /* -----   SETTING MASTER  -------*/                     
                          /* -----  END  SETTING MASTER  -------*/

                          /* -----  USER  MASTER  -------*/
                           'user_active',
                           'user_inactive',
                           'add_user',
                           'edit_user',
                           'target_add',
                           'report_vendor',
                           'support_details',
                           'save_card',
                           'sell_distribution',
                           'charge_back' ,
                           'search_customer', 
                           'pay_incentive_on_list' ,  
                           'incentive-pay-edit',                  
                          /* -----  END USER  MASTER  -------*/

                          /* -----  CUSTOMER  MASTER  -------*/
                            'customer-active',
                            'customer_inactive',                           
                          /* ----- END CUSTOMER  MASTER  -------*/

                          /* -----  VENDOR  MASTER  -------*/                                                   
                          /* ----- END VENDOR  MASTER  -------*/

                           /* -----  TASK  MASTER  -------*/
                            'payment_on_assign','close_task',
                            'view_order_no','view_customer_name',
                            'assign_to_another',
                          /* ----- END TASK  MASTER  -------*/

                          /* -----  REPORT  MASTER  -------*/                                           
                          /* ----- END REPORT  MASTER  -------*/

                      );

  $master_button_access=array(
                          
                           /* -----   SETTING MASTER  -------*/                    
                          /* -----  END  SETTING MASTER  -------*/

                          /* -----  USER  MASTER  -------*/                                           
            							'report_vendor',
            							'support_details',
            							'sell_distribution',
            							'search_customer', 
                          /* -----  END USER  MASTER  -------*/

                          /* -----  CUSTOMER  MASTER  -------*/                           
                          /* ----- END CUSTOMER  MASTER  -------*/

                           /* -----  VENDOR  MASTER  -------*/                       
                          /* ----- END VENDOR  MASTER  -------*/

                           /* -----  TASK  MASTER  -------*/
                          'payment_on_assign','close_task', 
                          'view_order_no','view_customer_name', 
                          'assign_to_another',                        
                          /* ----- END TASK  MASTER  -------*/

                          /* -----  REPORT  MASTER  -------*/                                                  
                          /* ----- END REPORT  MASTER  -------*/



                      );
   $agent_button_access=array(
                           
                           
                          /* -----   SETTING MASTER  -------*/                    
                          /* -----  END  SETTING MASTER  -------*/

                          /* -----  USER  MASTER  -------*/   
                           'support_details',
                           'customer_form_without_addclickbtn',
                           
                          /* -----  END USER  MASTER  -------*/

                          /* -----  CUSTOMER  MASTER  -------*/                           
                          /* ----- END CUSTOMER  MASTER  -------*/

                           /* -----  VENDOR  MASTER  -------*/                       
                          /* ----- END VENDOR  MASTER  -------*/

                           /* -----  TASK  MASTER  -------*/                                         
                          /* ----- END TASK  MASTER  -------*/

                          /* -----  REPORT  MASTER  -------*/                                                  
                          /* ----- END REPORT  MASTER  -------*/



                      );
   $technician_button_access=array(
                          
                          /* -----   SETTING MASTER  -------*/                    
                          /* -----  END  SETTING MASTER  -------*/

                          /* -----  USER  MASTER  -------*/
                            'customer_form_without_addclickbtn',                                    
                          /* -----  END USER  MASTER  -------*/

                          /* -----  CUSTOMER  MASTER  -------*/                           
                          /* ----- END CUSTOMER  MASTER  -------*/

                          /* -----  VENDOR  MASTER  -------*/                       
                          /* ----- END VENDOR  MASTER  -------*/

                          /* -----  TASK  MASTER  -------*/                                                   
                          /* ----- END TASK  MASTER  -------*/

                          /* -----  REPORT  MASTER  -------*/                                                  
                          /* ----- END REPORT  MASTER  -------*/

                      );



  $access_type=$_SESSION[SESSION_LOGIN]['logger_type']; 
  // $access_url_id=$_SESSION[SESSION_LOGIN]['url_id']; 
  // check button permission
  if($access_type =='admin')
  {
    $button_array=$admin_button_access;
  }else if($access_type =='master')
  {
     $button_array=$master_button_access;
  }else if($access_type =='agent') {
     $button_array=$agent_button_access;
  }else if($access_type =='technician'){
     $button_array=$technician_button_access; 
  } 
?>