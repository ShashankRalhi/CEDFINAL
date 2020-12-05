<?php
include("admin.php");

include("action.php");

?>

<div id="adminhome">
	<p style="text-align: center;font-size: 50px;margin-bottom: 20px;">ALL LOCATIONS</p>
	<div id="adminhome">
	<table id="admintable" cellspacing="10">
		<tr>
			<th>
				Location
			</th>

			<th>
				Distance
			</th>

			<th colspan="2">
				Action
			</th>
		</tr>

		<?php

		$obj = new connection();

		$sql = $obj->dlocation();

		$result = $sql;

		if ($result->num_rows > 0) {
			// output data of each row
			while ($row = $result->fetch_assoc()) {
		?>

				<tr>
					<td>
						<?php echo $row['name']; ?>
					</td>

					<td>
						<?php echo $row['distance']; ?>
					</td>
					
					<td>
					<?php $aval = $row['is_available']; 
						if($aval==2 || $aval==0){
					?>
						<a href="set1location.php?id=<?php echo $row['name'];?>" 
							name="update" class="update" style="color:#009075 ;font-weight: bold;">AVAILABLE</a>
					</td>

					<td>
					<?php 
						}
						elseif($aval==1)
						{
					?>
						<a href="set2location.php?id=<?php echo $row['name'];?>" 
						name="update" class="update" style="color:#030C0B ;font-weight: bold;">UNAVAILABLE</a>
					</td>

					<td>
					<?php

						}
					?>
						<a href="locationdelete.php?id=<?php echo $row['name']; ?>" 
							name="delete" class="delete" style="color: red">DELETE</a>
					</td>
					<!-- <td>
				<input type="hidden" name="userid" value="<?php //echo $row['user_id']; 
															?>">
			</td>  -->
				<?php
			}
		} else {
				?>
				<td colspan="8">
					<?php echo "No User is available"; ?>
				</td>
				</tr>
	</table>
</div>
</div>

<?php
		}
?>

