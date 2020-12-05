<?php
include("admin.php");

include("action.php");

?>

<div id="adminhome" >

	<div>
		<p style="text-align: center;font-size: 50px;margin-bottom: 20px;">APPROVED RIDE</p>

		<input class="w3-input w3-border w3-padding" type="text" placeholder="Filter by Date (YYYY-MM-DD) / Filter by Time" id="myInputDate" onkeyup="myFunctionDate()" style="width: 25%; margin-left: 1%">

		<input class="w3-input w3-border w3-padding" type="text" placeholder="Filter by Cab" id="myInputCab" onkeyup="myFunctionCab()" style="width: 25%; margin-left: 2%">
	</div>

	<hr />
<div id="adminhome">
	<table id="admintable" cellspacing="10">
		<tr>
			<th>
				Ride Id
			</th>

			<th onclick="sortnum(1)">
				Ride Date
			</th>

			<th>
				Pickup Point
			</th>

			<th>
				Drop Point
			</th>

			<th>
				Luggage
			</th>

			<th>
				Cab Type
			</th>


			<th>
				Total Distance
			</th>


			<th onclick="sortnum(7)">
				Total Cost &#x21c5;
			</th>

			<th onclick="sortaplha(8)">
				Customer Name &#x21c5;
			</th>

			<th>
				Invoice
			</th>

			<th>
				Action
			</th>
		</tr>

		<?php

		$total = 0;

		$obj = new connection();

		$sql = $obj->completeride();

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

					<td class="rideop">
						<?php echo $row['luggage']; ?>
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
						<?php echo $row['customer_user_name']; ?>
					</td>

					<td>
						<a href="invoice.php?id=<?php echo $row['ride_id']; ?>">&#x2139;</a>
					</td>

					<td>
						<!-- <a href="cride.php?id=<?php //echo $row['ride_id'];
													?>">Allow</a> -->
						<a href="deleteride.php?id=<?php echo $row['ride_id']; ?>" name="delete" class="delete">DELETE</a>
					</td>

					<!-- <td>
				<input type="hidden" name="userid" value="<?php //echo $row['user_id']; 
															?>">
			</td> -->
				<?php
				$total = $total + $row['total_cost'];
			}
		} else {
				?>
				<td colspan="11">
					<?php echo "No Confirmed is available"; ?>
				</td>
			<?php
		}
			?>
				</tr>

				<tr>
					<td colspan="11">
						Total: 
						&#8377;<?php
						echo $total;
						?>
						
					</td>
				</tr>

	</table>

</div>


<!-- 
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



			function sortaplha(n) {
				var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
				table = document.getElementById("userridetable");
				switching = true;

				dir = "asc";

				while (switching) {

					switching = false;
					rows = table.rows;

					for (i = 1; i < (rows.length - 1); i++) {

						shouldSwitch = false;

						x = rows[i].getElementsByTagName("TD")[n];
						y = rows[i + 1].getElementsByTagName("TD")[n];

						if (dir == "asc") {
							if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {

								shouldSwitch = true;
								break;
							}
						} else if (dir == "desc") {
							if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {

								shouldSwitch = true;
								break;
							}
						}
					}
					if (shouldSwitch) {

						rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
						switching = true;

						switchcount++;
					} else {

						if (switchcount == 0 && dir == "asc") {
							dir = "desc";
							switching = true;
						}
					}
				}
			}



			function sortnum(n) {
				var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
				table = document.getElementById("userridetable");
				switching = true;

				dir = "asc";

				while (switching) {

					switching = false;
					rows = table.rows;

					for (i = 1; i < (rows.length - 1); i++) {

						shouldSwitch = false;

						x = rows[i].getElementsByTagName("TD")[n];
						y = rows[i + 1].getElementsByTagName("TD")[n];

						if (dir == "asc") {
							if (parseFloat(x.innerHTML) > parseFloat(y.innerHTML)) {

								shouldSwitch = true;
								break;
							}
						} else if (dir == "desc") {
							if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {

								shouldSwitch = true;
								break;
							}
						}
					}
					if (shouldSwitch) {

						rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
						switching = true;

						switchcount++;
					} else {

						if (switchcount == 0 && dir == "asc") {
							dir = "desc";
							switching = true;
						}
					}
				}
			}

		</script>

-->

<script type="text/javascript">

 

				//Filter By Date
				function myFunctionDate() {
				var input, filter, table, tr, td, i;
				input = document.getElementById("myInputDate");
				filter = input.value.toUpperCase();
				table = document.getElementById("admintable");
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
				table = document.getElementById("admintable");
				tr = table.getElementsByTagName("tr");
				for (i = 1; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[5];
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
table = document.getElementById("admintable");
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
table = document.getElementById("admintable");
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
</script>