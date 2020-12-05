<?php

include("header.php");

if ($_SESSION['username'] != "ADMIN") {


?>
    <!-- Side navigation -->
    <div class="sidenav">
        <a href="customer.php">Book Now</a>
        <a href="alluserride.php">All Ride</a>
        <a href="userpendingride.php">Pending Ride</a>
        <a href="usercompleteride.php">Complete Ride</a>
        <a href="updatemobile.php">Update Contact</a>
        <a href="updatepassword.php">Update Password</a>       
    </div>





<?php
} else {
    echo "<script>
                alert('Don't Try to Access Customer Pannel);
            </script>";

    header("location:logout.php");
}
?>

<!-- <?php //include("footer.php"); ?> -->