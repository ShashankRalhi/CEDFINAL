<?php

include("action.php");

$obj = new connection();

$name = $_GET['id'];

$sql = $obj->deletelocation($name);

$result = $sql;

if ($sql) {
    //echo "<script> alert('Ride Succefully Deleted');</script>";
    header("location:location.php");
}

?>