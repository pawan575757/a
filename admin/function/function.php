<?php

function dis_msg_red($status,$msg,$page,$url_value=null)
{
	create_session('data_status',$status);
	create_session('data_msg',$msg);
	redirect($page,$url_value);
}




function pr($data)
{
	echo "<pre>";
	print_r($data);
	die;
}

function array_has_duplicate($array) {
	if(count($array) == count(array_unique($array))){
return false ; // unique
}else{
	return true;
}
}

function add_quotes($data)
{   $new_data=array();
	if(is_array($data))
	{
		foreach ($data as $key => $value) 
		{
			$data_value = "'".$value."'";
			$new_data[$key]=$data_value;
		}
		return $new_data;	
	}else{
		$data_value  = "'".$data."'";
		return $data_value ; 
	}
}

function net_pay_back($data)
{  
	$pay=array();
	$back=array();

	if(is_array($data))
	{
		foreach ($data as $key => $value) 
		{
			if($value['pstatus']==1)
			{
				$pay[]=$value['amount'];
			}
			if($value['cback_status']==1)
			{
				$back[]=$value['bamount'];
			}
		}
		$total_pay=array_sum($pay);
		$total_back=array_sum($back);
		$return['total_pay']=$total_pay;
		$return['total_back']=$total_back;
		return $return ;
	}else{
		return false;
	}
}

function multi_single_array($data)
{   $new_data=array();
	if(is_array($data))
	{

		foreach ($data as $key => $value) 
		{   
			foreach ($value as $key => $lvalue) 
			{   
				
				$new_data[]=$lvalue;
			}
		}
		return $new_data;	
	}else{

		return false ; 
	}
}

function multi_single_array_on_key($data,$user_key)
{   
	$new_data=array();	
	if(is_array($data))
	{

		foreach ($data as $key => $value) 
		{   
			foreach ($value as $key => $lvalue) 
			{   
				if($key == $user_key)
				{
					$new_data[]=$value[$user_key];
				}
			}
		}

		return $new_data;	
	}else{

		return false ; 
	}
}


function chk_mandatory($post_data,$not_required=null)
{   $not_req=array();
	if(!empty($not_required))
	{
		$not_req=	$not_required;
	}
	if(!empty($post_data))
	{
		foreach ($post_data as $key => $value) 
		{

			if(empty($post_data[$key]))
			{  
				$chkrequired=in_array($key,$not_req)	; 
				if(empty($chkrequired))
				{
					return false;
				}

			}

		}

		return true ;
	}

	return false ;

}


function chk_require_fields($user_post,$require)
{   
	
	$valid=array();
	if(is_array($user_post) && is_array($require) )
	{

		foreach ($require as $key => $value) 
		{  
			if(!empty($user_post[$value]))
			{  
				$valid[]='true';
			}else{
				$valid[]='false';
			}
        }
		
	}else{
		$valid[]='false';
	}

	return $valid ;
}


function checked ($value)
{
	if($value==1)
	{
		return "checked";
	}else{
		return false;
	}

}

function selected ($list_value,$selected_value)
{   

	if($list_value==$selected_value)
	{
		return "selected";
	}else{
		return false;
	}

}

function uek_sep_strng($data)
{
// unique error key sepearated by comma and make a string
	if(is_array($data))
	{
		$new_data="";
		foreach ($data as $key => $value) 
		{

			if(!empty($new_data))
			{
				$new_data.= ',';
			}
			$new_data.= $key; 

		}
		return $new_data;	
	}else{
		return false ;
	}

}
// login session
function create_lsession($data)
{   
	
    if(session_status() == PHP_SESSION_NONE)
    {
      session_start();
    }

	if(is_array($data))
	{
		foreach ($data as $key => $value) {
			$_SESSION[SESSION_LOGIN][$key]=$value;
		}
		return true;
	}else{
		return false;
	}


}

// for session create
function create_session($name,$value)
{ 
   if (session_status() == PHP_SESSION_NONE) {
     session_start();
    }

	$_SESSION[$name]=$value ;
	if(!empty($_SESSION[$name]))
	{
		return true;
	}else{
		return false;
	}
}



function unset_session($name)
{   

	unset($_SESSION[$name]);
	if(empty($_SESSION[$name]))
	{
		return true;
	}else{
		return false;
	}
}

// validation for sql injection

function prevent_inject($conn,$data)
{   
	$new_data=array();
	if(!empty($data))
	{   
		/*print_r($data); die;*/
		if(is_array($data))
		{

			foreach ($data as $key => $value) 
			{

				$data_value =strip_tags(mysqli_real_escape_string($conn,addslashes($value)));
				$new_data[$key]=$data_value;
			}
			return $new_data;	
		}else{
			$data_value =strip_tags(mysqli_real_escape_string($conn,addslashes($data)));
			return $data_value ; 
		}

	}else{
		return false;
	}
}
function lower($data)
{


	$new_data=array();
	if(!empty($data))
	{   
		/*print_r($data); die;*/
		if(is_array($data))
		{

			foreach ($data as $key => $value) 
			{

				$data_value =strtolower($value);
				$new_data[$key]=$data_value;
			}
			return $new_data;		
		}else{
			$data_value =strtolower($value);
			return $data_value ; 
		}

	}else{
		return false;
	}

}


function check_integer($data)
{
	$pattern = '/^[0-9\s]+$/';
	if(!empty($data))
	{   
		if(is_array($data))
		{

			foreach ($data as $key => $value) 
			{

				if (! preg_match ($pattern, $value) )
				{
					return 'false' ;
				}
			}
			return 'true';		
		}else{
			if ( preg_match ($pattern, $data) )
			{
				return 'true' ;
			}	
		}

	}else{
		return 'false';
	}


}


function check_character($data)
{
	$pattern = '/^[a-zA-Z\s]+$/';
	if(!empty($data))
	{   
		if(is_array($data))
		{

			foreach ($data as $key => $value) 
			{

				if (! preg_match ($pattern, $value) )
				{
					return 'false' ;
				}
			}
			return 'true';		
		}else{
			if ( preg_match ($pattern, $data) )
			{
				return 'true' ;
			}	
		}

	}else{
		return 'false';
	}
}

function check_valid_cpage($data)
{
	$pattern = '/^[A-Z]+$/';
	if(!empty($data))
	{   
		if(preg_match ($pattern, $data) )
		{
			return 'true';
		}

	}else{
		return 'false';
	}

}

function check_valid_dpage($data)
{
	$pattern = '/^[a-zA-Z]+[-_]?(.php)$/';
	if(!empty($data))
	{   
		if(preg_match ($pattern, $data) )
		{
			return 'true';
		}

	}else{
		return 'false';
	}

}


function check_email($email)
{
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		return 'true';
	}else{
		return false ;
	}
}


function redirect($path,$url_value=null)
{   
	if(!empty($url_value))
	{
	
	//	header("location:$path?$url_value");
	?>
       <script>
			 window.location ="<?php echo $path."?".$url_value ; ?>";
		</script>  
	 <?php   
	
	}else{
	
	//	header("location:$path");
	?>
	<script>
	
			 window.location ="<?php echo $path ; ?>";
		</script>

	 <?php
	
	}

	exit ;
}

function show_alert_message()
{
	if(!empty($_SESSION['info_status']))
	{
		if($_SESSION['info_status']=="success")
		{
			$message=$_SESSION['info_message'];
			$html="<div class='alert alert-success'><strong>Success! </strong>$message</div>";
			return $html ;
		}else{
			$message=$_SESSION['info_message'];
			$html="<div class='alert alert-danger'><strong>Error! </strong>$message</div>";
			return $html ;
		}
	}
}


function unset_alert_message()
{
	if(!empty($_SESSION['info_status']))
	{
		unset($_SESSION['info_status']);
		unset($_SESSION['info_message']);
		return true;
	}else{
		return false;
	}
}


function upload_file($name=null,$file,$destination)
{ 
  
  if(empty($name))
  {
  	$name=explode('.',$file['name']);
  	$name=$name[0];
  }
  $file_name=$file['name'];
  $file_type=$file['type'];
  $file_tmp_name=$file['tmp_name'];
  $file_error=$file['error'];
  if($file_error==0)
  {
   
      // get file name=
  	   $explode=explode('/',$file_type);
  	   $file_type=$explode['1']; 
  	   $create_name=str_replace(' ','-',$name).'.'.$file_type;
  	   $move=move_uploaded_file($file_tmp_name,$destination.$create_name);
  	   if($move)
  	   {
  	   	return $create_name ;
  	   }else{
  	   	return false;
  	   }


  }else{
  	return false;
  }

}

function multi_image_formate($file)
{ 
 
  $file_name=$file['name'];
  $file_type=$file['type'];
  $file_tmp_name=$file['tmp_name'];
  $file_error=$file['error'];
  
  $return_image=array();
  foreach ($file['name'] as $key => $value) {
  	//print_r($value);
  	$image['name']=$file['name'][$key];
  	$image['type']=$file['type'][$key];
  	$image['tmp_name']=$file['tmp_name'][$key];
  	$image['error']=$file['error'][$key];
  	$image['size']=$file['size'][$key];

  	$return_image[]=$image;
  }
   return  $return_image;

}

?>