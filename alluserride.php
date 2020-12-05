<?php
session_start();


if(isset($_SESSION['username']))
{

if ($_SESSION['username'] != "ADMIN") {

	include("customer-dashboard.php");

	include("action.php");

	$obj = new connection();

	$username = $_SESSION['username'];

?>

	<div>

		<h1 style="text-align: center;margin-bottom: 2%; text-transform: uppercase;margin-left: 15%"><?php echo $_SESSION['username']; ?>'s ALL Ride</h1>
		<div>
			<input class="w3-input w3-border w3-padding" type="text" placeholder="Filter by Date (YYYY-MM-DD) / Filter by Time" id="myInputDate" onkeyup="myFunctionDate()" style="width: 25%; margin-left: 30%">

			<input class="w3-input w3-border w3-padding" type="text" placeholder="Filter by Cab" id="myInputCab" onkeyup="myFunctionCab()" style="width: 25%; margin-left: 2%">
		</div>

		<hr />

		<table id="userridetable" cellspacing="10">

			<tr>

				<th>
					Ride Id
				</th>

				<th onclick="sortTable1(1)">
					Ride Date
				</th>

				<th>
					Pickup Point
				</th>

				<th>
					Drop Point
				</th>


				<th>
					Cab Type
				</th>


				<th>
					Total Distance
				</th>


				<th onclick="sortTable1(6)">
					Total Cost &#x21c5;
				</th>


				<th>
					Luggage
				</th>

				<!-- 
		<th>
			Action
		</th> -->
			</tr>

			<?php

			$sql = $obj->alluserride($username);

			$result = $sql;

			if ($result->num_rows > 0) {
				// output data of each row
				while ($row = $result->fetch_assoc()) {
			?>

					<tr>

						<td>
							<?php echo $row['ride_id']; ?>
						</td>

						<td>
							<?php echo $row['ride_date']; ?>
						</td>

						<td>
							<?php echo $row['pickup_point']; ?>
						</td>

						<td>
							<?php echo $row['drop_point']; ?>
						</td>

						<td>
							<?php echo $row['cab_type']; ?>
						</td>

						<td>
							<?php echo $row['total_distance']; ?>
						</td>

						<td>
							&#x20B9;<?php echo $row['total_cost']; ?>
						</td>

						<td>
							<?php echo $row['luggage']; ?>
						</td>

					<?php
				}
			} else {
					?>
					<td colspan="8">
						<?php echo "No Ride is available"; ?>
					</td>
				<?php
			}
				?>
					</tr>
		</table>

</div>

		<script type="text/javascript">
			
			// Filter By Date
			function myFunctionDate() {
						var input, filter, table, tr, td, i;
							input = document.getElementById("myInputDate");
							filter = input.value.toUpperCase();
							table = document.getElementById("userridetable");
							tr = table.getElementsByTagName("tr");
								for (i = 1; i < tr.length; i++) {
											td = tr[i].getElementsByTagName("td")[1];
										if (td) {
											txtValue = td.textContent || td.innerText;
										if (txtValue.toUpperCase().indexOf(filter) > -1) {
											tr[i].style.display = "";
										} else {
											tr[i].style.display = "none";
												}
										}
										}
						}





			//Filter By Cab
			function myFunctionCab() {
				var input, filter, table, tr, td, i;
					input = document.getElementById("myInputCab");
					filter = input.value.toUpperCase();
					table = document.getElementById("userridetable");
					tr = table.getElementsByTagName("tr");
								for (i = 1; i < tr.length; i++) {
											td = tr[i].getElementsByTagName("td")[4];
										if (td) {
											txtValue = td.textContent || td.innerText;
										if (txtValue.toUpperCase().indexOf(filter) > -1) {
											tr[i].style.display = "";
										} else {
											tr[i].style.display = "none";
												}
										}
									}
			}



			function sortTable(n) {
var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
table = document.getElementById("userridetable");
switching = true;
// Set the sorting direction to ascending:
dir = "asc";
/* Make a loop that will continue until
no switching has been done: */
while (switching) {
// Start by saying: no switching is done:
switching = false;
rows = table.rows;
/* Loop through all table rows (except the
first, which contains table headers): */
for (i = 1; i < (rows.length - 1); i++) {
// Start by saying there should be no switching:
shouldSwitch = false;
/* Get the two elements you want to compare,
one from current row and one from the next: */
x = rows[i].getElementsByTagName("TD")[n];
y = rows[i + 1].getElementsByTagName("TD")[n];
/* Check if the two rows should switch place,
based on the direction, asc or desc: */
if (dir == "asc") {
if (parseFloat(x.innerHTML) > parseFloat(y.innerHTML)) {
// If so, mark as a switch and break the loop:
shouldSwitch = true;
break;
}
} else if (dir == "desc") {
if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
// If so, mark as a switch and break the loop:
shouldSwitch = true;
break;
}
}
}
if (shouldSwitch) {
/* If a switch has been marked, make the switch
and mark that a switch has been done: */
rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
switching = true;
// Each time a switch is done, increase this count by 1:
switchcount ++;
} else {
/* If no switching has been done AND the direction is "asc",
set the direction to "desc" and run the while loop again. */
if (switchcount == 0 && dir == "asc") {
dir = "desc";
switching = true;
}
}
}
}

function sortTable1(n) {
var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
table = document.getElementById("userridetable");
switching = true;
// Set the sorting direction to ascending:
dir = "asc";
/* Make a loop that will continue until
no switching has been done: */
while (switching) {
// Start by saying: no switching is done:
switching = false;
rows = table.rows;
/* Loop through all table rows (except the
first, which contains table headers): */
for (i = 1; i < (rows.length - 1); i++) {
// Start by saying there should be no switching:
shouldSwitch = false;
/* Get the two elements you want to compare,
one from current row and one from the next: */
x = rows[i].getElementsByTagName("TD")[n];
y = rows[i + 1].getElementsByTagName("TD")[n];
/* Check if the two rows should switch place,
based on the direction, asc or desc: */
if (dir == "asc") {
if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
// If so, mark as a switch and break the loop:
shouldSwitch = true;
break;
}
} else if (dir == "desc") {
if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
// If so, mark as a switch and break the loop:
shouldSwitch = true;
break;
}
}
}
if (shouldSwitch) {
/* If a switch has been marked, make the switch
and mark that a switch has been done: */
rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
switching = true;
// Each time a switch is done, increase this count by 1:
switchcount ++;
} else {
/* If no switching has been done AND the direction is "asc",
set the direction to "desc" and run the while loop again. */
if (switchcount == 0 && dir == "asc") {
dir = "desc";
switching = true;
}
}
}
}



			$(document).ready(function() {
						function disablePrev() {
							window.history.forward()
						}
						window.onload = disablePrev();

						window.onpageshow = function(evt) {
							if (evt.persisted) {
								disableBack();
							}
						}
					});
		</script>


	<?php
} else {
	echo "<script>
                alert('Don't Try to Access Customer Pannel);
            </script>";

	header("location:logout.php");
}


}
else

	echo "<script>alert('Please Login Again')
                window.location='login.php';
                </script>";
?>



