<?php

include("admin.php");

if(isset($_SESSION['username']))
{

include("action.php");

$obj = new connection();

$sqlA = $obj->pendingride();

$resultA = $sqlA;

$countA = 0;
$countB = 0;
$countC = 0;
$countD = 0;
$countE = 0;
$countF = 0;

if ($resultA->num_rows > 0) {

	while ($rowA = $resultA->fetch_assoc()) {
		$countA = $countA + 1;
	}
}

$sqlB = $obj->completeride();

$resultB = $sqlB;

$countB = 0;
$total = 0;

if ($resultB->num_rows > 0) {

	while ($rowB = $resultB->fetch_assoc()) {
		$countB = $countB + 1;
		// $total =$total+$rowB['total_cost'];
	}
}



$sqlC = $obj->allride();

$resultC = $sqlC;

$countC = 0;

if ($resultC->num_rows > 0) {

	while ($rowC = $resultC->fetch_assoc()) {
		$countC = $countC + 1;
	}
}


$sqlD = $obj->pendingrequest();

$resultD = $sqlD;

$countD = 0;

if ($resultD->num_rows > 0) {

	while ($rowD = $resultD->fetch_assoc()) {
		$countD = $countD + 1;
	}
}




$sqlE = $obj->approvedrequest();

$resultE = $sqlE;

$countE = 0;

if ($resultE->num_rows > 0) {

	while ($rowE = $resultE->fetch_assoc()) {
		$countE = $countE + 1;
	}
}




$sqlF = $obj->display();

$resultF = $sqlF;

$countF = 0;

if ($resultF->num_rows > 0) {

	while ($rowF = $resultF->fetch_assoc()) {
		$countF = $countF + 1;
	}
}

?>

<div id="adminhome">
	<p style="text-align: center;font-size: 50px;margin-bottom: 20px; color: white;">WELCOME ADMIN</p>
	<div>
		<a href="pendingride.php">
			<div class="card pending">
				<h1 style="text-align: center;">
					<?php echo $countA; ?>
				</h1>
				<div class="container-card pending">
					<h4><b>Pending Rides</b></h4>
				</div>
			</div>
		</a>
	</div>

	<div>
		<a href="completeride.php">
			<div class="card reject">
				<h1 style="text-align: center;">
					<?php echo $countB; ?>
				</h1>
				<div class="container-card reject">
					<h4><b>Approved Rides</b></h4>
				</div>
			</div>
		</a>
	</div>

	<div>
		<a href="allrides.php">
			<div class="card all">
				<h1 style="text-align: center;">
					<?php echo $countC; ?>
				</h1>
				<div class="container-card all">
					<h4><b>All Rides</b></h4>
				</div>
			</div>
		</a>
	</div>

	<div>
		<a href="pending-request.php">
			<div class="card pending">
				<h1 style="text-align: center;">
					<?php echo $countD; ?>
				</h1>
				<div class="container-card pending">
					<h4><b>Pending Users</b></h4>
				</div>
			</div>
		</a>
	</div>

	<div>
		<a href="approved-request.php">
			<div class="card reject">
				<h1 style="text-align: center;">
					<?php echo $countE; ?>
				</h1>
				<div class="container-card reject">
					<h4><b>Approved Users</b></h4>
				</div>
			</div>
		</a>
	</div>

	<div>
		<a href="primemember.php">
			<div class="card all">
				<h1 style="text-align: center;">
					<?php echo $countF; ?>
				</h1>
				<div class="container-card all">
					<h4><b>All Users</b></h4>
				</div>
			</div>
		</a>
	</div>
</div>


<?php }
else

    echo "<script>alert('Please Login Again')
                window.location='login.php';
                </script>";

    // include("footer.php"); 
?>

