<?php
include("../database/config.php");
$id = $_POST["id"];

$result = mysqli_query($conn,"SELECT * FROM subcat_master where primcat='$id' order by name asc");
?>
<option value="">Select Property Type</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["subcatid"];?>"><?php echo $row["name"];?></option>
<?php
}
?>

