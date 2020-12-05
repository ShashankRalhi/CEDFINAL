<?php

include("action.php");

$obj = new connection();

$name = $_GET['id'];

$sql = $obj->unavalocation($name);

$result = $sql;

if ($sql) {
    //echo "<script> alert('Ride Succefully Deleted');</script>";
    //header("location:location.php");
    echo "<script>alert('Location is Unavailable')
                window.location='location.php';
                </script>";
}

?>