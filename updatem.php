<?php 

	session_start();
$name=$_SESSION['username'];
	include("action.php");

	$obj = new connection();

	
    $oldm = $_POST['oldm'];
    $newm = $_POST['newm'];

    if($oldm!=$newm){
          $sql = $obj->mobile($name,$newm);
     	echo "dfksdfldsflmd";
    }
    else{
    	echo "fdlkgdfk;gfdl";
    }
}

?>