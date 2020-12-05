<?php 

	include("action.php");

	$id = $_GET['id']; 

	// echo $id;

	$obj = new connection();

	$sql = $obj->cride($id);

	if($sql){
		header("location:pendingride.php");
	}
?>