<?php

require_once('../config/constant.php');

require_once('../config/table_variable.php');

require_once('../function/function.php');

require_once('../database/database.php');



$obj=new database_query();

$conn=$obj->mysqli;

$chk_page =array('user_login','roomtype_add','roomtype_edit','usertype_add','usertype_edit','user_add','user_edit','room_add','room_edit','blockroom_add','reservation_add');



$submit =$_POST['submit'] ; 



//require_once('../config/access_submit_function.php');



/*----     check function access       -------*/



// check call page by form submit is valid or not 

$chk_submit= in_array($submit, $chk_page) ;

if($chk_submit)

{

	switch ($submit) 

	{

		case 'user_login';

		user_login($tbl_user);

		break;

		

		case 'usertype_add';

		usertype_add($tbl_usertype);

		break;

		case 'usertype_edit';

		usertype_edit($tbl_usertype);

		break;



		case 'roomtype_add';

		roomtype_add($tbl_roomtype);

		break;

		case 'roomtype_edit';

		roomtype_edit($tbl_roomtype);

		break;



		case 'user_add';

		user_add($tbl_user);

		break;

		case 'user_edit';

		user_edit($tbl_user);

		break;





		case 'room_add';

		room_add($tbl_room);

		break;

		case 'room_edit';

		room_edit($tbl_room);

		break;



		case 'blockroom_add';

		blockroom_add($tbl_room);

		break;



		case 'reservation_add';

		reservation_add($tbl_reservation);

		break;



	



		default:



		break;

	}

}else{





}







/*=========== script for add edit   =============*/



function user_login($table)

{   

   

   

	global $conn,$obj,$tbl_usertype ;

	$valid_login=VALID_LOGIN ;

	unset($_POST['submit']);

	$chk_req=chk_mandatory($_POST);

	if(empty($chk_req))

	{

		redirect(PROJECT_PATH);

	}

	$data=prevent_inject($conn,$_POST);

	$data['pwd']=md5($data['password']);



	if($valid_login===true)

	{

		// check user name and email

		$record=$obj->select_single_record($table,array('email'=>$data['email'],'pwd'=>$data['pwd'],'status'=>1));



		if($record!=='no data' )

		{

			// create session

			$session=create_lsession($record);           

			if($session)

			{   

		        // get type of the logger

				$type=$record['type'] ;

				$record=$obj->select_single_required($tbl_usertype,array('type'),array('url_id'=>$type));

				$fetch_type=$record['type'];

				if($fetch_type==='admin')

				{   

					create_lsession(array('left_side_bar'=>ADMIN_LEFT_SIDEBAR));

					create_lsession(array('logger_type'=>$fetch_type));

					redirect(ADMIN_LOGIN);

				}else if($fetch_type==='subadmin')

				{   

					create_lsession(array('left_side_bar'=>SUBADMIN_LEFT_SIDEBAR));

					create_lsession(array('logger_type'=>$fetch_type));

					redirect(SUBADMIN_LOGIN);

				}

				

				

			}   	



		}else{

			redirect(PROJECT_PATH);

		}

	}else{

		$session=create_lsession($data);

		if($session)

		{

			redirect(ADMIN_LOGIN);

		}   

	}





}











function usertype_add($table)

{   

    

	global $conn,$obj ;

	unset($_POST['submit']);	

	$data=prevent_inject($conn,$_POST);

	$data=lower($data);

     

    

	// check valid formate

    $chk_chr_int[]=check_character($data['type']);    

    $vin_array =in_array('false',$chk_chr_int);

    if($vin_array)

    {

    	dis_msg_red('error','Please fill correct',USERTYPE_LIST);

    }

    //check unique 

    $chk_array =array('type'=>$data['type']);

    $chk_unique['Type']=$obj->chk_unique($table,$chk_array) ;

    $chk_in_array=in_array('false', $chk_unique,TRUE);

    if($chk_in_array)

    {

        $return_string=uek_sep_strng($chk_unique);

        dis_msg_red('error',$return_string.' must be unique',USERTYPE_LIST);

    }else{

    	    $last_id =$obj->insert_record($table,$data); // insert record 

			if($last_id)

			{   

				// update  insert id 

				$wh_conditions=array('id'=>$last_id);

				$update_data=array('url_id'=>md5(CREATE_ID.$last_id));

				$obj->update_record($table,$update_data,$wh_conditions);

				dis_msg_red('success','Inserted successfully',USERTYPE_LIST);

			}else{

				dis_msg_red('error','Oops ! Database problem',USERTYPE_LIST);

			}

    }

   

}



function usertype_edit($table)

{   

	global $conn,$obj ;

	$url_id=$_POST['id'];	

	if($_SESSION['url_id']!=$url_id)

	{

		// logout

	}

	unset($_POST['submit']);

	unset($_POST['id']);		

	$data=prevent_inject($conn,$_POST);

	$update_data=lower($data);

     

     // check valid formate

    $chk_chr_int[]=check_character($update_data['type']);    

    $vin_array =in_array('false',$chk_chr_int);

    if($vin_array)

    {

    	dis_msg_red('error','Please fill correct',USERTYPE_LIST);

    }

    //check unique 

    $chk_array =array('type'=>$update_data['type'],'url_id !'=>$url_id);

    $chk_unique['Type']=$obj->chk_unique($table,$chk_array) ;

    $chk_in_array=in_array('false', $chk_unique,TRUE);

    if($chk_in_array)

    {

        $return_string=uek_sep_strng($chk_unique);

        dis_msg_red('error',$return_string.' must be unique',USERTYPE_LIST);

    }else{  

            $wh_conditions=array('url_id'=>$url_id);

	        $chk_update =$obj->update_record($table,$update_data,$wh_conditions);  

			if($chk_update)

			{   

				dis_msg_red('success','Updated successfully',USERTYPE_LIST);

			}else{

				dis_msg_red('error','Oops ! Database problem',USERTYPE_LIST);

			}	

                

    }

   

}



function roomtype_add($table)

{   

    

	global $conn,$obj ;

	unset($_POST['submit']);	

	$data=prevent_inject($conn,$_POST);

	$data=lower($data);

     

    

	// check valid formate

    $chk_chr_int[]=check_character($data['typename']);    

    $vin_array =in_array('false',$chk_chr_int);

    if($vin_array)

    {

    	dis_msg_red('error','Please fill correct',ROOMTYPE_LIST);

    }

    //check unique 

    $chk_array =array('type'=>$data['typename']);

    $chk_unique['Type']=$obj->chk_unique($table,$chk_array) ;

    $chk_in_array=in_array('false', $chk_unique,TRUE);

    if($chk_in_array)

    {

        $return_string=uek_sep_strng($chk_unique);

        dis_msg_red('error',$return_string.' must be unique',ROOMTYPE_LIST);

    }else{

    	    $last_id =$obj->insert_record($table,$data); // insert record 

			if($last_id)

			{   

				// update  insert id 

				$wh_conditions=array('id'=>$last_id);

				$update_data=array('url_id'=>md5(CREATE_ID.$last_id));

				$obj->update_record($table,$update_data,$wh_conditions);

				dis_msg_red('success','Inserted successfully',ROOMTYPE_LIST);

			}else{

				dis_msg_red('error','Oops ! Database problem',ROOMTYPE_LIST);

			}

    }

   

}



function roomtype_edit($table)

{   

	global $conn,$obj ;

	$url_id=$_POST['id'];	



	unset($_POST['submit']);

	unset($_POST['id']);		

	$data=prevent_inject($conn,$_POST);

	$update_data=lower($data);

    

     // check valid formate

    $chk_chr_int[]=check_character($update_data['typename']);    

    $vin_array =in_array('false',$chk_chr_int);

    if($vin_array)

    {

    	dis_msg_red('error','Please fill correct data',ROOMTYPE_LIST);

    }

    //check unique 

    $chk_array =array('type'=>$update_data['type'],'typeID !'=>$url_id);

    $chk_unique['Type']=$obj->chk_unique($table,$chk_array) ;

    $chk_in_array=in_array('false', $chk_unique,TRUE);

    if($chk_in_array)

    {

        $return_string=uek_sep_strng($chk_unique);

        dis_msg_red('error',$return_string.' must be unique',ROOMTYPE_LIST);

    }else{  

            $wh_conditions=array('typeID'=>$url_id);

	        $chk_update =$obj->update_record($table,$update_data,$wh_conditions);  

			if($chk_update)

			{   

				dis_msg_red('success','Updated successfully',ROOMTYPE_LIST);

			}else{

				dis_msg_red('error','Oops ! Database problem',ROOMTYPE_LIST);

			}	

                

    }

   

}


function user_add($table)

{   

   

	global $conn,$obj ;

	unset($_POST['submit']);	

	$data=prevent_inject($conn,$_POST);

	$data['pwd']=md5($data['pwd']);

	$data=lower($data);

	

   

    // check valid formate    

    $chk_user[]=check_character($data['name']);

    $chk_user[]=check_character($data['uname']);

    $chk_user[]=check_integer($data['phone']);



    $vin_array =in_array('false',$chk_user,TRUE);

    if($vin_array)

    {

    	dis_msg_red('error','Please fill correct data',USER_LIST);

    }

    //check unique 

    $chk_array =array('uname'=>$data['uname']);

    $chk_unique['User name']=$obj->chk_unique($table,$chk_array) ;



    $chk_array =array('phone'=>$data['phone']);

    $chk_unique['Phone']=$obj->chk_unique($table,$chk_array) ;



    $chk_array =array('email'=>$data['email']);

    $chk_unique['Email']=$obj->chk_unique($table,$chk_array) ;



    $chk_in_array=in_array('false', $chk_unique,TRUE);

    if($chk_in_array)

    {

    	$return_string=uek_sep_strng($chk_unique);

    	dis_msg_red('error',$return_string.' must be unique',USER_LIST);

    }else{

		$last_id =$obj->insert_record($table,$data); // insert record 

		if($last_id)

		{   

			$wh_conditions=array('id'=>$last_id);

			$update_data=array('url_id'=>md5(CREATE_ID.$last_id));

			$obj->update_record($table,$update_data,$wh_conditions);

			dis_msg_red('success','Inserted successfully',USER_LIST);

		}else{

			dis_msg_red('error','Oops ! Database problem',USER_LIST);

		}	

    }

  

   

}



function user_edit($table)

{   

	global $conn,$obj ;

	$url_id=$_POST['id'];

	unset($_POST['submit']);

	unset($_POST['id']);		

	$data=prevent_inject($conn,$_POST);

	$update_data=lower($data);

    

    // check valid formate    

    $chk_user[]=check_character($update_data['name']);

    $chk_user[]=check_character($update_data['uname']);

    $chk_user[]=check_integer($update_data['phone']);



    $vin_array =in_array('false',$chk_user,TRUE);

    if($vin_array)

    {

    	dis_msg_red('error','Please fill correct data',USER_LIST);

    }

    //check unique 



    $chk_array =array('uname'=>$update_data['uname'],'url_id !'=>$url_id);

    $chk_unique['User name']=$obj->chk_unique($table,$chk_array) ;



    $chk_array =array('phone'=>$update_data['phone'],'url_id !'=>$url_id);

    $chk_unique['Phone']=$obj->chk_unique($table,$chk_array) ;



    $chk_array =array('email'=>$data['email'],'url_id !'=>$url_id);

    $chk_unique['Email']=$obj->chk_unique($table,$chk_array) ;



    $chk_in_array=in_array('false', $chk_unique,TRUE);

    if($chk_in_array)

    {

    	$return_string=uek_sep_strng($chk_unique);

    	dis_msg_red('error',$return_string.' must be unique',USER_LIST);

    }else{  

    	

		    $wh_conditions=array('url_id'=>$url_id);

		   

		    if($update_data['change_pwd']=="yes")

		    { 

		      unset($update_data['change_pwd']);

		      $update_data['pwd']=	md5($data['pwd']);

		      

		    }

			$chk_update =$obj->update_record($table,$update_data,$wh_conditions);  

			if($chk_update)

			{   

				dis_msg_red('success','Updated successfully',USER_LIST);

			}else{

				dis_msg_red('error','OOps ! Database problem',USER_LIST);

			}		

    }

   

   

}


function Save_CDoc($table)

{

	 global $conn,$obj ;

     $tmpName = $_FILES['uploadcdoc']['tmp_name'];

     $name=$_FILES['uploadcdoc']['name'];

     $size=$_FILES['uploadcdoc']['size'];

     $type=$_FILES['uploadcdoc']['type'];

     $error=$_FILES['uploadcdoc']['error'];

     $id=$_POST['id'];



     if($error==0 && $name!='')

     {

		/*-- read pdf to save database ----*/

		$fp = fopen ($tmpName, 'r');

		$content = fread($fp, filesize($tmpName));

		$content = addslashes ($content);

		

		// remove all previous document from table

        $obj->delete($table,array('customer_id'=>$id));



		$insert_data=array('customer_id'=>$id,'name'=>$name,'size'=>$size,'type'=>$type,'content'=>$content);

		$last_id =$obj->insert_record($table,$insert_data); // insert record 

		if($last_id)

		{   

			$wh_conditions=array('id'=>$last_id);

			$update_data=array('url_id'=>md5(CREATE_ID.$last_id));

			$obj->update_record($table,$update_data,$wh_conditions);



			dis_msg_red('success','Upload document successfully',CUSTOMER_LIST);



		}else{

			dis_msg_red('error','Oops ! Database problem',CUSTOMER_LIST);

		}

     }else{

     	dis_msg_red('error','Please select a correct file',CUSTOMER_LIST);

     }





	

}


function room_add($table)

{   

   

	global $conn,$obj,$tbl_optional_image ;

	unset($_POST['submit']);

 

	

	unset($_POST['main_image']);

	unset($_POST['roomImage']);

	



	$optional_image=$_FILES['optional_image'];	

	unset($_POST['optional_image'])	;

	$data=prevent_inject($conn,$_POST);

	$data=lower($data);

	if(!empty($_FILES['optional_image']))

	{

		$option_multi_image=multi_image_formate($optional_image);

	}

	

   

    // check valid formate    

    // $chk_room[]=check_character($data['roomName']);

    $chk_room[]=check_integer($data['adults']);

    // $chk_room[]=check_integer($data['Children']);



  

    $vin_array =in_array('false',$chk_room,TRUE);

    if($vin_array)

    {

    	dis_msg_red('error','Please fill correct data',ROOM_LIST);

    }



    //check unique 

    $chk_array =array('typeID'=>$data['typeID'],'roomName'=>$data['typename']);

    $chk_unique['Room name']=$obj->chk_unique($table,$chk_array) ;



    



    $chk_in_array=in_array('false', $chk_unique,TRUE);

    if($chk_in_array)

    {

    	$return_string=uek_sep_strng($chk_unique);

    	dis_msg_red('error',$return_string.' must be unique',ROOM_LIST);

    }else{

        //pr($_FILES['roomImage']);

    	$move= upload_file('',$_FILES['roomImage'],ROOM_PATH);

		if($move)

		{   

			$data['roomImage']=$move;

			$last_id =$obj->insert_record($table,$data); // insert record

			if($last_id)

			{   

              if(!empty($option_multi_image))

              {

              	    

              	    foreach ($option_multi_image as $key => $value) 

              	    {

              	 	

              	 	$optionl_move= upload_file('',$value,ROOM_PATH);

              	 	if($optionl_move)

              	 	{   

              	 		$optional_data['room_id']=$last_id;

              	 		$optional_data['image_name']=$optionl_move;              	 		

              	 		$obj->insert_record($tbl_optional_image,$optional_data);

              	 	}

              	 }

              }

			dis_msg_red('success','Inserted successfully',ROOM_LIST);

			}else{

			dis_msg_red('error','Oops ! Database problem',ROOM_LIST);

			} 

		}	

    }

  

   

}


function room_edit($table)

{   

	global $conn,$obj ,$tbl_optional_image;

	$url_id=$_POST['id'];

	unset($_POST['submit']);

	unset($_POST['id']);

	unset($_POST['optional_image']);

	unset($_POST['main_image']);

	unset($_POST['roomImage']);		

	$data=prevent_inject($conn,$_POST);



	$update_data=lower($data);

	

	

   

    // check valid formate    

   // $chk_room[]=check_character($data['roomName']);

    $chk_room[]=check_integer($data['adults']);

 //   $chk_room[]=check_integer($data['Children']);



  

    $vin_array =in_array('false',$chk_room,TRUE);

    if($vin_array)

    {

    	dis_msg_red('error','Please fill correct data',ROOM_LIST);

    }



    //check unique 

    $chk_array =array('typeID'=>$data['typeID'],'roomName'=>$data['roomName'],'roomNo !'=>$url_id);

    $chk_unique['Room name']=$obj->chk_unique($table,$chk_array) ;



    



    $chk_in_array=in_array('false', $chk_unique,TRUE);

    if($chk_in_array)

    {

    	$return_string=uek_sep_strng($chk_unique);

    	dis_msg_red('error',$return_string.' must be unique',ROOM_LIST);

    }else{  

    	    // image uploading script

    	if(!empty($_FILES['roomImage']))

    	{   



    		$move= upload_file('',$_FILES['roomImage'],ROOM_PATH);

    		if($move)

    		{

    			$update_data['roomImage']	=$move;

    		}

    	}

    	   



    	    $wh_conditions=array('roomNo'=>$url_id);

			if(!empty($_FILES['optional_image']))

			{    

				 

				 $optional_image=$_FILES['optional_image'];

			     $option_multi_image=multi_image_formate($optional_image);

				foreach ($option_multi_image as $key => $value) 

				{



					$optionl_move= upload_file('',$value,ROOM_PATH);

					if($optionl_move)

					{   

						$optional_data['room_id']=$url_id;

						$optional_data['image_name']=$optionl_move;              	 		

						$obj->insert_record($tbl_optional_image,$optional_data);

					}

				}

			}

		    

			$chk_update =$obj->update_record($table,$update_data,$wh_conditions);  

			if($chk_update)

			{   

				dis_msg_red('success','Updated successfully',ROOM_LIST);

			}else{

				dis_msg_red('error','OOps ! Database problem',ROOM_LIST);

			}	

    }

  

   

}


function blockroom_add($table)

{   

    

    global $conn,$obj ;

	$url_id=$_POST['id']; 

	$room_set=$_POST['room_set']; 

	unset($_POST['submit']);

	unset($_POST['room_set']);

	unset($_POST['id']);		

	$data=prevent_inject($conn,$_POST);

	$update_data=lower($data);

    

    // check valid formate   

    $chk_user[]=check_integer($update_data['block_set']);

    $chk_user[]=check_integer($url_id);

   

  // pr($chk_user);

    $vin_array =in_array('false',$chk_user,TRUE);

    if($vin_array)

    {

    	

    }

    /*if($update_data['block_set']>$room_set)

    {

    	dis_msg_red('error','Please check block room set',ROOM_LIST);

    }*/



	//$wh_conditions=array('roomNo'=>$url_id);

	$chk_update =$obj->insert_blocked_room($table,$update_data,$url_id);  

	if($chk_update == "true")

	{   

		dis_msg_red('success','Updated successfully',ROOM_LIST);

	}

	else if($chk_update == 'no_room'){

		dis_msg_red('error',"You can't block more than total number of your rooms!!",ROOM_LIST);

	}

	else{

		dis_msg_red('error','OOps ! Database problem',ROOM_LIST);

	}		



   

}





// function blockroom_add($table)

// {   

    

//     global $conn,$obj ;

// 	$url_id=$_POST['id']; 

// 	$room_set=$_POST['room_set']; 

// 	unset($_POST['submit']);

// 	unset($_POST['room_set']);



// 	unset($_POST['id']);		

// 	$data=prevent_inject($conn,$_POST);

// 	$update_data=lower($data);

// 	//pr($update_data);die;

    

//     // check valid formate   

//     $chk_user[]=check_integer($update_data['block_set']);

//     $chk_user[]=check_integer($url_id);

   

//   // pr($chk_user);

//     $vin_array =in_array('false',$chk_user,TRUE);

//     if($vin_array)

//     {

    	

//     }

//     if($update_data['block_set']>$room_set)

//     {

//     	dis_msg_red('error','Please check block room set',ROOM_LIST);

//     }



// 	$wh_conditions=array('roomNo'=>$url_id);

// 	$chk_update =$obj->update_record($table,$update_data,$wh_conditions);  

// 	if($chk_update)

// 	{   

// 		dis_msg_red('success','Updated successfully',ROOM_LIST);

// 	}else{

// 		dis_msg_red('error','OOps ! Database problem',ROOM_LIST);

// 	}		



   

// }





function reservation_add($table)

{

    global $conn,$obj ;

	$firstname =$_POST['firstname']; 

	$email =$_POST['email']; 

	$phone =$_POST['phone']; 





	$guest_field = 'firstname,email,phone';

	$guest_data = "'".$firstname."','".$email."','".$phone."'";



	$guest_id =$obj->insert_guest('customer_details',$guest_field,$guest_data); 





	$add_res_admin = '1';

	$txnId = date('ymdhis');

	$booked_rooms=$_POST['booked_rooms']; 

	$payable=$_POST['payable'] + $_POST['extra_bed_price']; 

	$adults=$_POST['adults']; 

	$arrival=date('Y-m-d',strtotime($_POST['arrival'])); 

	$departure= date('Y-m-d',strtotime($_POST['departure'])); 

	$roomNo = $_POST['typeID'] ;



	$reservation_field = 'guest_id,booked_rooms,payable,adults,arrival,departure,roomNo,txnId,add_res_admin';

	$reservation_data = "'".$guest_id."','".$booked_rooms."','".$payable."','".$adults."','".$arrival."','".$departure."','".$roomNo."','".$txnId."','".$add_res_admin."'";

	$chk_dt = $obj->insert_reservation('reservation_list',$reservation_field,$reservation_data);  



	if($chk_dt == "true")

	{   

		dis_msg_red('success','Reservation successfully',RESERVATION_LIST);

	}

	else{

		dis_msg_red('error','OOps ! Database problem',RESERVATION_LIST);

	}	





    

    

}





   



?>