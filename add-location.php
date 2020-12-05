<?php
include("admin.php");
include("action.php");

$obj = new connection();

// $msg = "";

if (isset($_POST['addlocation'])) {
    $location = $_POST['location'];
    $distance = $_POST['distance'];

    $sql = $obj->location($location, $distance);

    echo "<script> alert('Location Successfully Added');</script>";

    // header("location:add-location.php");
}
?>

<div>
    <div>
        <form action="add-location.php" method="POST">

            <div class="container-byadmin">
                <h1>ADD LOCATION</h1>
                <hr>

                <label><b>Location</b></label>
                <input type="text" placeholder="Enter Name of Location" name="location" id="location" required  onblur="this.value=removeSpaces(this.value);">

                <label><b>Distance</b></label>
                <input type="text" placeholder="Enter Distance wrt Charbag" name="distance" id="distance" required onkeypress="return isNumberKey(event)">

                <button type="submit" class="btn" name="addlocation">Add Location</button>
            </div>

        </form>
    </div>
</div>


<script type="text/javascript">


    $('#location').on("cut copy paste",function(e) {
                        e.preventDefault();
                });


    function removeSpaces(string) {
        return string.split(' ').join('');
    }

    function isNumberKey(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode;
                if ((charCode < 48 || charCode > 57))
                    return false;

                return true;
            }
</script>

<?php include("footer.php");
