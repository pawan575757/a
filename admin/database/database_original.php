<?php
class database_query
{
  public $mysqli;
  public function __construct()
  {    


define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u346044215_property');
define('DB_PASSWORD', '192118sS@');
define('DB_NAME', 'u346044215_property');
 
/* Attempt to connect to MySQL database */

    $this->mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);  
   // $this->mysqli = new mysqli('localhost', 'root', '', 'digitalw_sai_hotel'); 
    if ($this->mysqli->connect_error){
      die("Connection failed: " . $this->mysqli->connect_error);  
    } 
  }






public function chk_unique($tablename,array $data)    // this function is use for only chk record
{
  
  $selectValue=""; 

  foreach ($data as $key => $value)
  {   

    if(!empty($selectValue))
    {
      $selectValue.= ' AND ';
    }
    $selectValue .= $key.'='."'".trim($value)."'";

  }
  $create_query="SELECT id FROM $tablename WHERE $selectValue";
  $query = $this->mysqli->query($create_query);
  $count_record=$query->num_rows;
  if(empty($count_record))
  { 
    return 'true';
  }else{
    return 'false' ;
  }

}

public function chk_url_id($tablename,$url_id)    
{
  
  $create_query="SELECT * FROM $tablename WHERE url_id='$url_id' ";
  $query = $this->mysqli->query($create_query);
  $count_record=$query->num_rows;
  if(!empty($count_record))
  { 
    return true;
  }else{
    return false ;
  }

}

public function get_id($tablename,$url_id)    
{
  
  $create_query="SELECT id FROM $tablename WHERE url_id='$url_id' ";
  $query = $this->mysqli->query($create_query);
  $count_record=$query->num_rows;
  if(!empty($count_record))
  { 
    $fetch=$query->fetch_assoc();
    $id=$fetch['id'];
    return $id;
  }else{
    return false ;
  }

}


public function get_url_id($tablename,$condition,$field)    
{
  $where ="";      
  foreach ($condition as $key => $value)
  {   
    if(!empty($where))
    {
      $where.= ' AND ';
    }
    $where .= $key.'='."'".trim($value)."'";

  }

  $create_query="SELECT $field FROM $tablename WHERE $where "; 
  $query = $this->mysqli->query($create_query);
  $count_record=$query->num_rows;
  if(!empty($count_record))
  { 
    $fetch=$query->fetch_assoc();
    $id=$fetch[$field];
    return $id;
  }else{
    return false ;
  }

}




public function select_all($tablename,array $data,$order=null)    // this function is use for select all record
{

  $selectValue="";      
  foreach ($data as $key => $value)
  {   
    if(!empty($selectValue))
    {
      $selectValue.= ' AND ';
    }
    $selectValue .= $key.'='."'".trim($value)."'";

  }
  $create_query="SELECT * FROM $tablename WHERE $selectValue ";
  
  if(!empty($order))
  {
    $create_query.=" $order ";
  }else{
    $create_query.=" order by id  desc ";
  }
  

  $query = $this->mysqli->query($create_query);
  $count_record=$query->num_rows;
  if(!empty($count_record))
  { 
    while($fetch=$query->fetch_assoc())
    {
      $fetch_record[]=$fetch;
    }
    return  $fetch_record ;
  }else{
    return "no data";
  }

}

public function select_query($query , $order=null)    // this function is use for select all record
{
  $create_query=$query; 

  if(!empty($order))
  {
    $create_query.=" $order ";
  }else{
    $create_query.=" order by id  desc ";
  }
  
 // echo $create_query;die;
  $query = $this->mysqli->query($create_query); 

  $count_record=$query->num_rows; 
    //var_dump($count_record);die;
  if(!empty($count_record))
  { 
    while($fetch=$query->fetch_assoc())
    {
      $fetch_record[]=$fetch;
    }
    return  $fetch_record ;
  }else{
    return "no data";
  }


}






public function select_single_record($tablename,array $data ,$order=null)    //this function is use for select all and return only one record
{
  $selectValue="";      
  foreach ($data as $key => $value)
  {   
    if(!empty($selectValue))
    {
      $selectValue.= ' AND ';
    }
    $selectValue .= $key.'='."'".trim($value)."'";

  }
  $create_query="SELECT * FROM $tablename WHERE $selectValue"; 
 
  if(!empty($order))
  {
    $create_query.=" $order ";
  }else{
    $create_query.=" order by id  desc ";
  }
  // var_dump($create_query); die();
 // echo $create_query; die;
  $query = $this->mysqli->query($create_query);
  $count_record=$query->num_rows;
  if(!empty($count_record))
  { 
    $fetch=$query->fetch_assoc();
    $fetch_record=$fetch;

    return  $fetch_record ;
  }else{
    return "no data";
  }

}


public function select_single_required($tablename,array $fields,array $wh_conditions,$order=null)    
{ 

$fields_value="";
foreach($fields as $key=>$value) 
{
  if(!empty($fields_value))
  {
    $fields_value.= ',';
  }
  $fields_value .= $value; 
} 

$conditions="";
foreach ($wh_conditions as $cond_key => $cond_value) 
{
  if(!empty($conditions))
  {
    $conditions.= ' AND ';
  }

  $conditions .= $cond_key.'='."'".trim($cond_value)."'";
}      

$create_query="SELECT $fields_value  FROM $tablename WHERE $conditions";  

if(!empty($order))
{
$create_query.=" $order ";
}else{
$create_query.=" order by id  desc ";
}

$query = $this->mysqli->query($create_query);
$count_record=$query->num_rows;
if(!empty($count_record))
{ 
  $fetch=$query->fetch_assoc() ;       
  return  $fetch ;
}else{
  return "no data";
}

}


public function select_all_required($tablename,array $fields,array $wh_conditions,$order=null)    
{ 

$fields_value="";
foreach($fields as $key=>$value) 
{
  if(!empty($fields_value))
  {
    $fields_value.= ',';
  }
  $fields_value .= $value; 
} 

$conditions="";
foreach ($wh_conditions as $cond_key => $cond_value) 
{
  if(!empty($conditions))
  {
    $conditions.= ' AND ';
  }

  $conditions .= $cond_key.'='."'".trim($cond_value)."'";
}      

$create_query="SELECT $fields_value  FROM $tablename WHERE $conditions"; 

if(!empty($order))
{
$create_query.=" $order ";
}else{
$create_query.=" order by id  desc ";
}

// print_r($create_query);die;
$query = $this->mysqli->query($create_query);
$count_record=$query->num_rows;
if(!empty($count_record))
{ 
  while($fetch=$query->fetch_assoc() )
  {   
    $fetch_array[]=$fetch;           
  }
  return  $fetch_array ;       

}else{
  return "no data";
}

}




public function insert_record($tablename,array $data)
{
  $column="";
  $columnValue="";
  foreach ($data as $key => $value) {
    $column .= $key.",";
    $columnValue .= "'".trim($value)."',";
  }
  $column .= "add_date";
  $columnValue .="'".date('Y-m-d h:i:s')."'";
  
  $query = "INSERT INTO $tablename($column) VALUES ($columnValue)"; 
  $result = $this->mysqli->query($query);
  $last_id=$this->mysqli->insert_id;
  if(!empty($last_id))
  {
    return $last_id;
  }else{ 
    return false ;

  }

}

public function insert_blocked_room($tablename,array $data,$typeID)
  {
      $column="";
      $columnValue="";
      $date_from = "";
      $date_to = "";
      $nob_rooms = "";
      $done = "";
      $tablename = "block_list";
      foreach ($data as $key => $value) {
        if($key=='block_from'){
        $date_from = trim($value);
        }
        else if($key=='block_to'){
        $date_to = trim($value);
        }
        else if($key=='block_set'){
        $nob_rooms = trim($value);
        }
        if($key=='typeID' || $key=='id'){
        $typeID = trim($value);
        }
        else{
        //$column .= $key.",";
        //$columnValue .= "'".trim($value)."',";
        }
      }
    
      // Specify the start date. This date can be any English textual format  
      //$date_from = "2010-02-03";   
      $date_from = strtotime($date_from); // Convert date to a UNIX timestamp  
        
      // Specify the end date. This date can be any English textual format  
      //$date_to = "2010-09-10";  
      $date_to = strtotime($date_to); // Convert date to a UNIX timestamp  
        
      // Loop from the start date to end date and output all dates inbetween  
    for ($i=$date_from; $i<=$date_to; $i+=86400) {  
      $date = date("Y-m-d", $i);  
      $id="";
      $already_blocked="";
      // Redundency Check
       // var_dump($tablename,$typeID); die();
      $select="SELECT * FROM $tablename WHERE date = '".$date."' AND room_id = '".$typeID."';";
      $result=$this->mysqli->query($select);
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $id = $row["id"];
        $already_blocked = $row["nob_rooms"];
        $total = $already_blocked + $nob_rooms;
        
        // SELECT TOTAL NUMBER OF ROOMS
        $rooms="SELECT * FROM room WHERE typeID = '".$typeID."';";
        $rresult=$this->mysqli->query($rooms);
        $rrow = $rresult->fetch_assoc();
        $room_set = $rrow["room_set"];
        
        
        if($room_set >= $total){
          // UPDATE QUERY
          $create_query="UPDATE $tablename set nob_rooms = '".$total."', blocked_on = '".date('Y-m-d h:i:s')."' where id = '".$id."';"; 
          $query=$this->mysqli->query($create_query); 
          $done = "true";
        }
        else{
          $done = "no_room";
        }
      }
      else{ 

        $column="";
        $columnValue="";
        // SELECT ROOM NAME 
        $name="SELECT * FROM roomtype WHERE typeID = '".$typeID."';";
        $nresult=$this->mysqli->query($name);
        $nrow = $nresult->fetch_assoc();
        $room_name = $nrow["typename"];

        
        // SELECT TOTAL NUMBER OF ROOMS
        $rooms="SELECT * FROM room WHERE typeID = '".$typeID."';";
        $rresult=$this->mysqli->query($rooms);
        $rrow = $rresult->fetch_assoc();
        $room_set = $rrow["room_set"];
        
        if($room_set >= $nob_rooms){
          $column .= "date,room_id,room_type,total_rooms,nob_rooms,";
          $columnValue .= "'".$date."','".$typeID."','".$room_name."','".$room_set."','".$nob_rooms."',";
          
          $column .= "blocked_on";
          $columnValue .="'".date('Y-m-d h:i:s')."'";
         

          $query = "INSERT INTO $tablename($column) VALUES ($columnValue)"; 
          $result = $this->mysqli->query($query);
          $last_id=$this->mysqli->insert_id;
          $done = "true";
        }
        else{
          $done = "no_room";
        }
      }
    }
    return $done;
    
  }

public function update_record($tablename,array $data,array $wh_conditions)
{

  $setrecord ="";       
  foreach ($data as $key => $value) {           

    if(!empty($setrecord))
    {
      $setrecord.= ' , ';
    }
    $setrecord .= $key.'='."'".trim($value)."'";
  } 

  $conditions="";
  foreach ($wh_conditions as $cond_key => $cond_value) 
  {
    if(!empty($conditions))
    {
      $conditions.= ' AND ';
    }
    $conditions .= $cond_key.'='."'".trim($cond_value)."'";
  }

  $create_query="UPDATE $tablename set $setrecord where $conditions "; 
  $query=$this->mysqli->query($create_query); 
  if($query) 
  {
    return true;
  }else{

    return false;
  }



} 

public function custome_update($query)
{
  $create_query="$query";
  $query=$this->mysqli->query($create_query); 
  if($query) 
  {
    return true;
  }else{

    return false;
  }



} 


public function update_record_in($tablename,array $data,array $wh_conditions)
{

  $setrecord ="";       
  foreach ($data as $key => $value) {           

    if(!empty($setrecord))
    {
      $setrecord.= ' , ';
    }
    $setrecord .= $key.'='."'".trim($value)."'";
  } 

  $conditions="";
  foreach ($wh_conditions as $cond_key => $cond_value) 
  {
    if(!empty($conditions))
    {
      $conditions.= ' AND ';
    }
    $conditions .= $cond_key .' in ('.$cond_value.')';
  }

  $create_query="UPDATE $tablename set $setrecord where $conditions ";
  $query=$this->mysqli->query($create_query); 
  if($query) 
  {
    return true;
  }else{

    return false;
  }



}

public function custome_delete($query)
{
  $create_query="$query";
  $query=$this->mysqli->query($create_query); 
  if($query) 
  {
    return true;
  }else{

    return false;
  }



} 

public function insert_guest($table,$guest_field,$guest_data)
{
  $query = "INSERT INTO $table($guest_field) VALUES ($guest_data)"; 
  $result = $this->mysqli->query($query);
  $last_id=$this->mysqli->insert_id;

  return $last_id;
}

public function insert_reservation($table,$reservation_field,$reservation_data)
{
  $query = "INSERT INTO $table($reservation_field) VALUES ($reservation_data)"; 
  $result = $this->mysqli->query($query);
  $last_id=$this->mysqli->insert_id;

  return "true";
}






}



?>



