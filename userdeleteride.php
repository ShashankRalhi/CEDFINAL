<?php
session_start();

include("action.php");

$obj = new connection();

$rideid = $_GET['id'];

$username = $_SESSION['username'];

$sql = $obj->deleteride($rideid);

$result = $sql;

if ($sql) {
	header("location:userpendingride.php");
}

?>