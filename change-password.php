<?php

include("admin.php");
include("action.php");

$obj = new connection();

$msg = "";

if (isset($_POST[`change`])) {
	$name = $_POST[`name`];
	$cpss = md5($_POST[`cpass`]);
	$npss = md5($_POST[`npass`]);
	$rnpss = md5($_POST[`rnpass`]);

	// $sql = $obj->displayuser($name);
	// $result = $sql;
	// if ($result->num_rows > 0) 
	// {
	// 	while ($row = $result->fetch_assoc()) 
	// 	{
	// 		$pass = $row[`password`];
	// 	}
	// }
	// if($cpass == $pass){
	// 	if($npass == $rnpass){
	// 		$sql = $obj->chngpass($name,$npass);
	// 		if($sql)
	// 		{
	// 			 $msg="New Password Update"; 
	// 			// session_destroy();
	// 			// header("location:login.php");
	// 		}else{ $msg="sorry"; }
	// 	}else{ $msg="New Password is not match with Re-Entery"; }
	// }else{ $msg="Current Password is not in Database"; }	
}
// else{ $msg="User is not in Database"; }
?>


<div>
	<div>
		<form action="change-password.php" method="POST">
			<div class="container">
				<h1>CHANGE PASSWORD</h1>
				<hr>
				<div id="display" style="text-align: center;">
					<?php echo $msg; ?>
				</div>
				<label><b>User Name</b></label>
				<input type="text" name="name" placeholder="Enter User Name">

				<label><b>Current Password</b></label>
				<input type="password" name="cpass" placeholder="Enter Current Password">

				<label><b>New Password</b></label>
				<input type="password" name="npass" placeholder="Enter New Password">

				<label><b>Re- Password</b></label>
				<input type="password" name="rnpass" placeholder="Enter New Password">

				<button type="submit" class="btn" name="change">Change Password</button>
			</div>
		</form>

	</div>
</div>