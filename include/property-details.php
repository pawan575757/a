<?php include_once('include/config.php');


// include 'include/config.php';
extract($_GET);

$id=$_GET['mid'];

//$id=$_REQUEST['proid'];


$query=mysqli_query($conn,"select * from property where proid='$id' ");

$res=mysqli_fetch_array($query);
//$id=$_REQUEST['proid'];

$id=$res['proid'] or die("Error: ".mysqli_error($conn)); 

 $sel_city = mysqli_query($conn, "SELECT * FROM city_master WHERE cityid = ".$res['cityid']);
    $row_city = mysqli_fetch_array($sel_city);

    //................................ Location Table -------------------------------//


    $sel_location = mysqli_query($conn, "SELECT * FROM location_master WHERE locationid = ".$res['locationid']);
    $row_location = mysqli_fetch_array($sel_location);

    //......................... Rent/Sell Type Table -------------------------------//

    
     $sel_type = mysqli_query($conn, "SELECT * FROM type_master WHERE typeid = ".$res['typeid']);
    $row_type = mysqli_fetch_array($sel_type);
    
 $sel_developer = mysqli_query($conn, "SELECT * FROM developer_master WHERE developerid = ".$res['developer']);
    $row_developer = mysqli_fetch_array($sel_developer);


     $sel_agent = mysqli_query($conn, "SELECT * FROM agent_master WHERE id = ".$res['agent']);
    $row_agent = mysqli_fetch_array($sel_agent);


     $sel_cat = mysqli_query($conn, "SELECT * FROM cat_master WHERE catid = ".$res['catid']);
    $row_cat = mysqli_fetch_array($sel_cat);
?>
