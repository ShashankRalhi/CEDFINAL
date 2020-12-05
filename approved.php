<?php

include("action.php");

$id = $_GET['id'];

$obj = new connection();

$sql = $obj->approve($id);

if ($sql) {
	header("location:pending-request.php");
}
?>