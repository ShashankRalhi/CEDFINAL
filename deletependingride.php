<?php 

include("action.php");

$obj = new connection();

$rideid = $_GET['id'];

$sql = $obj->deleteride($rideid);

$result = $sql;

if($sql){
	//echo "<script> alert('Ride Succefully Deleted');</script>";
	header("location:pendingride.php");
}	
?>