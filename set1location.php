<?php

include("action.php");

$obj = new connection();

$name = $_GET['id'];

$sql = $obj->avalocation($name);

$result = $sql;

if ($sql) {
    // echo "<script> alert('".$name."');</script>";

     echo "<script>alert('Location is Available')
                window.location='location.php';
                </script>";



    // header("location:location.php");
}

?>