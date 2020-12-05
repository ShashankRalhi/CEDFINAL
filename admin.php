<?php
session_start();
include("header.php");

if(isset($_SESSION['username']))
{


if ($_SESSION['username'] == "ADMIN") {

?>


	<div id="sidebar">

		<!-- <div class="dropdown">
			<button class="dropbtn" id="home">Home</button>
		</div> -->

		<div class="dropdown">
			<button class="dropbtn">Rides</button>
			<div class="dropdown-content">
				<a href="allrides.php">All Rides</a>
				<a href="pendingride.php">Pending Rides</a>
				<a href="completeride.php">Approved Rides</a>

			</div>
		</div>

		<div class="dropdown">
			<button class="dropbtn">Users</button>
			<div class="dropdown-content">
				<a href="primemember.php">All Users</a>
				<a href="pending-request.php">Pending Request</a>
				<a href="approved-request.php">Approved Request</a>
			</div>
		</div>

		<div class="dropdown">
			<button class="dropbtn">Locations</button>
			<div class="dropdown-content">
				<a href="add-location.php">New Location</a>
				<a href="location.php">All Location</a>
				<a href="unavailable.php">Unavailable Location</a>
				<a href="available.php">Available Location</a>
			</div>
		</div>

		<!-- <div class="dropdown">
		<button class="dropbtn">Accounts</button>
		<div class="dropdown-content">
	    	<a href="change-password.php">Change Password</a>
	  	</div>
	</div> -->

	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$("#home").click(function() {
				location.href = "admin-home.php";
			});
		});
	</script>

<?php
} else {
	echo "<script>
				alert('You have no permission to access the admin side.');
			</script>";

	header("location:logout.php");
}
?>


<?php
}
else

    echo "<script>alert('Please Login Again')
                window.location='login.php';
                </script>";
?>

