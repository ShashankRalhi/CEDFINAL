<?php
session_start();
include("header.php");
include("action.php");

$obj = new connection();

$ary = $obj->dlocation();

$array = [];

$result = $ary;

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        array_push($array, $row);
    }
}

?>



<div class="container">
    <form action="customer.php" method="POST" id="form">
        <p href="#">CITY <span>TAXI</span></p>
        <hr />
        <h4>YOUR <span>EVERY</span> DAY <span>PATNER</span></h4>
        <div>
            <div>
                <select id="pickup_point" name="pickup_point">
                    <?php
                    foreach ($array as $key => $values) {
                    ?>
                        <option selected hidden disabled>Select PickUp Point</option>
                        <option>
                            <?php
                            print_r($values['name']);
                            ?>
                        </option>

                    <?php
                    }
                    ?>
                </select>
            </div>

            <div>
                <select id="drop_point" name="drop_point">
                    <?php
                    foreach ($array as $key => $values) {
                    ?>
                        <option selected hidden disabled>Select Drop Point</option>
                        <option>
                            <?php
                            print_r($values['name']);
                            ?>
                        </option>

                    <?php
                    }
                    ?>
                </select>
            </div>

            <div>
                <select id="car_type">
                    <option selected hidden disabled>Select Cab Type</option>
                    <option>CedMicro</option>
                    <option>CedMini</option>
                    <option>CedRoyal</option>
                    <option>CedSUV</option>
                </select>
            </div>

            <div>
                <input type="text" name="lwgt" placeholder="Enter Luggage weight in KG" id="lwgt" onkeypress="return isNumberKey(event)">
            </div>

            <div id="msg"></div>

            <div id="display"></div>

            <button type="submit" name="submit" id="submit" class="btn">SUBMIT</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if ((charCode < 48 || charCode > 57))
            return false;

        return true;
    }

    $(document).ready(function() {

        //Disable Button at Car Type
        $('#car_type').change(function() {
            $("#lwgt").attr("disabled", $("#car_type").val() == "CedMicro");
        });

        //Send data using Ajax
        $("#submit").click(function(a) {
            a.preventDefault();

            var pickup = $("#pickup_point").val();
            var drop = $("#drop_point").val();
            var car = $("#car_type").val();
            var luggage = $("#lwgt").val();

            console.log(pickup);
            console.log(drop);
            console.log(car);
            console.log(luggage);


            if (pickup == null) {
                $("#msg").text("PickUp Point is Null");
                $("#display").hide();
            }

            if (drop == null) {
                $("#msg").text("Drop Point is Null");
                $("#display").hide();
            }

            if (pickup == drop) {
                if (car != null) {
                    $("#msg").text("Both Positions are same");
                    $("#display").hide();
                } else if (car == null) {
                    $("#msg").text("Both Positions are same and Cab Field is NULL");
                    $("#display").hide();
                }
            }

            if (car == null) {
                $("#msg").text("Please Select Cab Type");
                $("#display").hide();
            }

            if (pickup == null && drop == null) {
                $("#msg").text("Please Select Pickup And Drop Point");
                $("#display").hide();
            }

            if (pickup == null && car == null) {
                $("#msg").text("Please Select Pickup and Cab Type");
                $("#display").hide();
            }


            if (drop == null && car == null) {
                $("#msg").text("Please Select Drop and Cab Type");
                $("#display").hide();
            }

            if (pickup == null && drop == null && car == null) {
                $("#msg").text("Please Complete all Fields");
                $("#display").hide();
            }

            if (isNaN(luggage)) {
                $("#msg").html("Luggage Weight Only In Number");
                $("#display").hide();

            }

            $.ajax({
                type: 'post',
                url: 'data.php',
                data: {
                    pickup: pickup,
                    drop: drop,
                    car: car,
                    luggage: luggage,
                },
                success: function(msg) {
                    //alert('form was submitted' + msg);
                    $("#display").text(msg);
                }
            });
        });
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>



<?php include("footer.php"); ?>