<?php
require_once('../config/constant.php');
require_once('../config/table_variable.php');
require_once('../function/function.php');
require_once('../database/database.php');


$obj=new database_query();
$conn=$obj->mysqli;

$page=$_POST['page'];

switch ($page) {
	
	case 'RoomType':
	roomtype_update($tbl_roomtype);
	break;

	case 'room':
	room_update($tbl_room);
	break;

	case 'UserType':
	usertype_update($tbl_usertype);
	break;
	
	case 'user':
	user_update($tbl_user);
	break;
	



	default:

    # code...
	break;
}

function common_update($table)
{
	global $conn,$obj ;
	$button=$_POST['button']; 
    
    $add_quotes=add_quotes($_POST['chkbox']);
    $selected_id=implode(',',$add_quotes);
    if(!empty($_POST['typeID']))
	{
		$table='room_master_list';
		$wh_conditions=array($_POST['typeID']=>$selected_id);
	}else
	{
			if(!empty($_POST['id']))
			{
				$wh_conditions=array($_POST['id']=>$selected_id);
			}else{
				$wh_conditions=array('url_id'=>$selected_id);
			}
	}
   //var_dump($_POST['typeID'],$_POST['id'],$_POST['url_id'],$wh_conditions,$table);die();
   
    /*if(!empty($_POST['id']))
    {
    	$wh_conditions=array($_POST['id']=>$selected_id);
    }else{
    	$wh_conditions=array('url_id'=>$selected_id);
    }*/
	
	/*if(empty($value['url_id']) && empty($value['typeID']))
	{
		echo '1';die();
		$wh_conditions=array($_POST['id']=>$selected_id);
	}
	else if(empty($value['url_id']) && empty($value['id']))
	{
		echo '2';die();
		$wh_conditions=array($_POST['typeID']=>$selected_id);
	}
	else if(empty($value['id']) && empty($value['typeID']))
	{
		echo '3';die();
		$wh_conditions=array('url_id'=>$selected_id);
	}
	*/
//var_dump($wh_conditions);die();

	if($button=='active')
	{
		$status=1;
		$update_data=array('status'=>$status);
		$chk_update =$obj->update_record_in($table,$update_data,$wh_conditions); 
	}else if($button=='inactive')
	{
		$status=2;
		$update_data=array('status'=>$status);
		$chk_update =$obj->update_record_in($table,$update_data,$wh_conditions); 
	}else if($button=='unblock_room'){
      
      $create_query= "UPDATE $table set block_from= NULL ,block_to= NULL ,block_set= NULL  where roomNo in ($selected_id) ";
      $chk_update=$obj->custome_update($create_query); 

	}
		
	
	
    
	return $chk_update; 
}




function roomtype_update($table)
{   
//var_dump('dsadas');die();
	$chk_update=roomtype_common_update($table); 
	if($chk_update)
	{   
		dis_msg_red('success','Updated successfully',ROOMTYPE_LIST);
	}else{
		dis_msg_red('error','OOps ! Database problem',ROOMTYPE_LIST);
	} 

}

function roomtype_common_update($table)
{
	global $conn,$obj ;
	$button=$_POST['button']; 
    
    $add_quotes=add_quotes($_POST['chkbox']);
    $selected_id=implode(',',$add_quotes);
    if(!empty($_POST['typeID']))
	{
		$table='room_master_list';
		$wh_conditions=array($_POST['typeID']=>$selected_id);
	}
  // var_dump($_POST['typeID'],$_POST['id'],$_POST['url_id'],$wh_conditions,$table);die();
   
    /*if(!empty($_POST['id']))
    {
    	$wh_conditions=array($_POST['id']=>$selected_id);
    }else{
    	$wh_conditions=array('url_id'=>$selected_id);
    }*/
	
	/*if(empty($value['url_id']) && empty($value['typeID']))
	{
		echo '1';die();
		$wh_conditions=array($_POST['id']=>$selected_id);
	}
	else if(empty($value['url_id']) && empty($value['id']))
	{
		echo '2';die();
		$wh_conditions=array($_POST['typeID']=>$selected_id);
	}
	else if(empty($value['id']) && empty($value['typeID']))
	{
		echo '3';die();
		$wh_conditions=array('url_id'=>$selected_id);
	}
	*/
//var_dump($wh_conditions);die();

	if($button=='active')
	{
		$status=1;
		$update_data=array('status'=>$status);
		$chk_update =$obj->update_record_in($table,$update_data,$wh_conditions); 
	}else if($button=='inactive')
	{
		$status=2;
		$update_data=array('status'=>$status);
		$chk_update =$obj->update_record_in($table,$update_data,$wh_conditions); 
	}else if($button=='unblock_room'){
      
      $create_query= "UPDATE $table set block_from= NULL ,block_to= NULL ,block_set= NULL  where roomNo in ($selected_id) ";
      $chk_update=$obj->custome_update($create_query); 

	}
		
	
	
    
	return $chk_update; 
}







function room_update($table)
{   

	$chk_update=common_update($table); 
	if($chk_update)
	{   
		dis_msg_red('success','Updated successfully',ROOM_LIST);
	}else{
		dis_msg_red('error','OOps ! Database problem',ROOM_LIST);
	} 

}


function usertype_update($table)
{   
	$chk_update=common_update($table); 
	if($chk_update)
	{   
		dis_msg_red('success','Updated successfully',USERTYPE_LIST);
	}else{
		dis_msg_red('error','OOps ! Database problem',USERTYPE_LIST);
	} 

}




function user_update($table)
{ 
    $chk_update=common_update($table);  
	if($chk_update)
	{   
		dis_msg_red('success','Updated successfully',USER_LIST);
	}else{
		dis_msg_red('error','OOps ! Database problem',USER_LIST);
	} 

}




?>