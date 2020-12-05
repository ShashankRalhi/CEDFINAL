<?php

//include("connection.php");

class connection
{
	public $dbhost;
	public $dbuser;
	public $dbpass;
	public $dbname;
	public $conn;



	function __construct()
	{
		$this->conn = new mysqli('localhost', 'root', '', 'cabbooking');

		// Check connection
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		} else {
			//echo "Connected successfully";
		}
	}







	//--------------------------Sending Data into DB-----------------------------------------------
	public function insert($username, $mobile, $passwordA)
	{
		$sql = mysqli_query($this->conn, "INSERT INTO tbl_user (`user_name`,`dateofsignup`,`mobile`,`isblock`,`password`) VALUES('" . $username . "',NOW(),'" . $mobile . "',0,'" . $passwordA . "')");
		
		return $sql;
	}
	//----------------------------------------------------------------------------------------------










	//------------------------To fetch dat from DB to LOGIN-----------------------------------------
	public function fetch($username, $password)
	{
		$sql = mysqli_query($this->conn, "SELECT * from tbl_user 
		                    WHERE `user_name` = '" . $username . "' and `password` = '" . $password . "' and `isblock` = 1");
		return $sql;
	}
	//----------------------------------------------------------------------------------------------



	//--------------------------To accept the user request------------------------------------------
	public function updatepass($username, $newpass)
	{
		$sql = mysqli_query($this->conn, " UPDATE `tbl_user` SET `password`= '" . $newpass . "' WHERE `user_name`= '" . $username . "'");
		return $sql;
	}
	//-----------------------------------------------------------------------------------------------





	//--------------------------To accept the user request------------------------------------------
	public function approve($id)
	{
		$sql = mysqli_query($this->conn, " UPDATE `tbl_user` SET `isblock`= 1 WHERE `user_id`= '" . $id . "'");
		return $sql;
	}
	//-----------------------------------------------------------------------------------------------









	//--------------------------To accept the user request-------------------------------------------
	public function reject($id)
	{
		$sql = mysqli_query($this->conn, " UPDATE `tbl_user` SET `isblock`= 0 WHERE `user_id`= '" . $id . "'");
		return $sql;
	}
	//-----------------------------------------------------------------------------------------------




	//-------------------------------To Delete users from DB------------------------------------------
	public function delete($userid)
	{
		$sql = mysqli_query($this->conn, "DELETE from tbl_user WHERE `user_id` = '" . $userid . "' ");
		return $sql;
	}
	//-------------------------------------------------------------------------------------------------







	//---------------------------------To Display users in DB-----------------------------------------
	public function display()
	{
		$sql = mysqli_query($this->conn, "SELECT * from tbl_user");
		return $sql;
	}
	//-------------------------------------------------------------------------------------------------






	//--------------------------------To Display users in DB-------------------------------------------
	public function pendingrequest()
	{
		$sql = mysqli_query($this->conn, "SELECT * from `tbl_user` WHERE `isblock` = 0");
		return $sql;
	}
	//-------------------------------------------------------------------------------------------------




	//---------------------------------To Display users from DB----------------------------------------
	public function approvedrequest()
	{
		$sql = mysqli_query($this->conn, "SELECT * from `tbl_user` WHERE `isblock` = 1");
		return $sql;
	}
	//-------------------------------------------------------------------------------------------------






	// -----------------------------------RIDE---------------------------------------------------

	//To add the ride into DB
	public function userride($pick, $drop, $wgt, $username, $ttldistance, $ttlcost, $car)
	{
		if ($drop != $pick && $pick != null && $drop != null) {
			$sql = mysqli_query($this->conn, "INSERT INTO `tbl_ride`(`ride_date`, `pickup_point`, `drop_point`, `cab_type`, `total_distance`, `total_cost`, `luggage`, `status`, `customer_user_name`) VALUES (NOW(),'" . $pick . "','" . $drop . "','" . $car . "','" . $ttldistance . "','" . $ttlcost . "','" . $wgt . "',0,'" . $username . "')");

			return $sql;
		} else {
		}
	}



























	// Show location from DB
	public function allride()
	{
		$sql = mysqli_query($this->conn, "SELECT * from tbl_ride");
		return $sql;
	}


	// Show location from DB
	public function alluserride($username)
	{
		$sql = mysqli_query($this->conn, "SELECT * from tbl_ride WHERE `customer_user_name` = '" . $username . "' ORDER BY ride_id DESC");
		return $sql;
	}

	// Show location from DB
	public function userpendingride($username)
	{
		$sql = mysqli_query($this->conn, "SELECT * from tbl_ride WHERE `customer_user_name` = '" . $username . "' and `status` = 0 ORDER BY ride_id DESC");
		return $sql;
	}

	// // Show location from DB
	public function usercompleteride($username)
	{
		$sql = mysqli_query($this->conn, "SELECT * from tbl_ride WHERE `customer_user_name` = '" . $username . "' and `status` = 1 ORDER BY ride_id DESC ");
		return $sql;
	}

	// Show location from DB which are active
	public function completeride()
	{
		$sql = mysqli_query($this->conn, "SELECT * from tbl_ride WHERE `status` = 1");
		return $sql;
	}

	// Show location from DB which are deactive
	public function pendingride()
	{
		$sql = mysqli_query($this->conn, "SELECT * from tbl_ride WHERE `status` = 0");
		return $sql;
	}

	//To accept the user request
	public function cride($id)
	{
		$sql = mysqli_query($this->conn, " UPDATE `tbl_ride` SET `status`= 1 WHERE `ride_id`= '" . $id . "'");
		return $sql;
	}

	// //To accept the user request
	// public function reject($id)
	// {
	// 	$sql = mysqli_query($this->conn, " UPDATE `tbl_user` SET `isblock`= 0 WHERE `user_id`= '".$id."'");
	// 	return $sql; 
	// }


	//---------------------To Delete users from DB------------------------------------------
	public function deleteride($rideid)
	{
		$sql = mysqli_query($this->conn, "DELETE from tbl_ride WHERE `ride_id` = '" . $rideid . "' ");
		return $sql;
	}


	// -----------------------------------RIDE--------------------------------------------------





	//--------------------------------To Display users in DB-------------------------------------------
	public function invoice($id)
	{
		$sql = mysqli_query($this->conn, "SELECT * from `tbl_ride` WHERE `ride_id` = $id");
		return $sql;
	}
	//-------------------------------------------------------------------------------------------------








	public function deletelocation($name)
	{
		$sql = mysqli_query($this->conn, "DELETE from tbl_location WHERE `name` = '" . $name . "' ");
		return $sql;
	}












	//To add the ride into DB from client side
	public function chngpass($name, $npass)
	{
		$sql = mysqli_query($this->conn, " UPDATE `tbl_user` SET `password`= '" . $npass . "' WHERE `user_name`= '" . $name . "'");
		return $sql;
	}




	//To add location in DB
	public function location($location, $distance)
	{
		$sql = mysqli_query($this->conn, "INSERT INTO tbl_location ( `name`, `distance`, `is_available`) VALUES ('" . $location . "','" . $distance . "',0)");
		return $sql;
	}

	// Show location from DB
	public function dlocation()
	{
		$sql = mysqli_query($this->conn, "SELECT * from tbl_location ORDER BY `name` ASC");
		return $sql;
	}

	// Show Available location from DB
	public function available()
	{
		$sql = mysqli_query($this->conn, "SELECT * from tbl_location WHERE `is_available` = 1");
		return $sql;
	}

	// Show Unavailable location from DB
	public function unavailable()
	{
		$sql = mysqli_query($this->conn, "SELECT * from tbl_location WHERE `is_available` = 2");
		return $sql;
	}

	//To add the ride into DB from client side
	public function avalocation($name)
	{
		$sql = mysqli_query($this->conn, " UPDATE `tbl_location` SET `is_available`= 1 WHERE 
		                    `name`= '" . $name . "'");
		return $sql;
	}


	//To add the ride into DB from client side
	public function unavalocation($name)
	{
		$sql = mysqli_query($this->conn, " UPDATE `tbl_location` SET `is_available`= 2 WHERE 
		                    `name`= '" . $name . "'");
		return $sql;
	}



	public function mobile($name, $newm)
	{
		$sql = mysqli_query($this->conn, "UPDATE `tbl_user` SET `mobile`= '".$newm."' WHERE 
		                    `user_name`= '" . $name . "' ");
		return $sql;
	}

	public function pass($name, $newpass)
	{
		$sql = mysqli_query($this->conn, "UPDATE `tbl_user` SET `password`= '".$newpass."' WHERE 
		                    `user_name`= '" . $name . "' ");
		return $sql;
	}

}



