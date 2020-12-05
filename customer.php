<?php
session_start();
// include("header.php"); 
include("action.php");
if(isset($_SESSION['username']))
{

if ($_SESSION['username'] != "ADMIN") {


    include("customer-dashboard.php");


    $obj = new connection();

    $ary = $obj->available();

    $array = [];

    $result = $ary;

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            array_push($array, $row);
        }
    }

?>
    <div class="bookcontainer">
        <form action="customer.php" method="POST" id="form">
            <p>CITY <span>TAXI</span></p>
            <hr />
            <h4>YOUR <span>EVERY</span> DAY <span>PATNER</span></h4>
            <div>
                <div>
                    <select id="pickup_point" name="pickup_point" required>
                        <!-- <?php //echo '<option selected >'.$_SESSION['pickup'].'</option>'; 
                                ?> -->

                        <?php

                        if (isset($_SESSION['pickup'])) {
                            echo '<option selected >' . $_SESSION['pickup'] . '</option>';
                        } else {
                            echo ' <option disabled selected>Select PickUp Point</option>';
                        }
                        ?>

                        <?php
                        foreach ($array as $key => $values) {
                        ?>

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
                    <select id="drop_point" name="drop_point" required>
                        <!--  <?php //echo '<option selected >'.$_SESSION['drop'].'</option>';
                                ?> -->

                        <?php

                        if (isset($_SESSION['drop'])) {
                            echo '<option selected >' . $_SESSION['drop'] . '</option>';
                        } else {
                            echo ' <option disabled selected>Select Drop Point</option>';
                        }
                        ?>

                        <?php
                        foreach ($array as $key => $values) {
                        ?>
                            <!--   <option selected hidden disabled>Select Drop Point</option> -->

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
                    <select id="car_type" required>

                        <?php

                        if (isset($_SESSION['car'])) {
                            echo '<option selected >' . $_SESSION['car'] . '</option>';
                        } else {
                            echo ' <option disabled selected>Select Cab Type</option>';
                        }
                        ?>

                        <!-- <?php //echo '<option selected >'.$_SESSION['car'].'</option>'; 
                                ?> -->
                        <!--   <option selected hidden disabled>Select Cab Type</option> -->
                        <option>CedMicro</option>
                        <option>CedMini</option>
                        <option>CedRoyal</option>
                        <option>CedSUV</option>
                    </select>
                </div>

                <div>
                    <?php

                    if (isset($_SESSION['wgt'])) {
                        echo '<input type="text" name="lwgt" placeholder="Enter Luggage weight in KG" id="lwgt"
                            onkeypress="return isNumberKey(event)" value="' . $_SESSION['wgt'] . '">';
                    } else {
                        echo '<input type="text" name="lwgt" placeholder="Enter Luggage weight in KG" id="lwgt"
                            onkeypress="return isNumberKey(event)">';
                    }

                    ?>
                </div>

                <div id="msg" style="color: red; font-weight: bold;"></div>

                <div id="display" style="color: green; width: bold;"></div>

                <button type="submit" name="submit" id="submit" class="btn">BOOK</button>
            </div>
        </form>
    </div>


    <script type="text/javascript">

        $('#lwgt').on("cut copy paste",function(e) {
                        e.preventDefault();
                });


        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if ((charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        $(document).ready(function() {
            $car = $("#car_type").val();

             if ($("#car_type").val() == "CedMicro") {
                    $("#lwgt").attr("disabled");
                    $("#lwgt").val("");
                    $("#lwgt").hide();

                }else{
                    $("#lwgt").show(); 
                }

            //Disable Button at Car Type
            $('#car_type').change(function() {
                if ($("#car_type").val() == "CedMicro") {

                    console.log("dsfdsfsd");
                    $("#lwgt").attr("disabled");
                    $("#lwgt").val("");
                    $("#lwgt").hide();

                }else{
                    $("#lwgt").show(); 
                }
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

                if (pickup == drop) {
                    if (car != null) {
                        $("#msg").text("Both Positions are same");
                        $("#display").hide();
                    } else if (car == null) {
                        $("#msg").text("Plesase Complete All fields");
                        $("#display").hide();
                    } else {
                        alert("Please Don't Select Same Location")
                    }
                }
                else if(pickup != null && drop != null && car != null && pickup!=drop )
                {
                        $r = confirm("Do you confirm the ride ?");
                        if($r==true){

                            $.ajax({
                                type: 'post',
                                url: 'main.php',
                                data: {
                                    pickup: pickup,
                                    drop: drop,
                                    car: car,
                                    luggage: luggage,
                                },
                                success: function(msg) {
                                    alert(msg);
                                     $("#msg").hide();
                                     $("#submit").attr("disabled",true);

                                     <?php
                                        unset($_SESSION['pickup']);
                                        unset($_SESSION['drop']);
                                        unset($_SESSION['car']);
                                        unset($_SESSION['wgt']);
                                     ?>
                                    // $("#display").html(msg);
                                }
                            });
                        }else{
                            alert("You canceled your last ride");
                        } 
                }
            });
        
        });


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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>



<?php
} else {
    echo "<script>
                alert('Don't Try to Access Customer Pannel);
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
include("footer.php"); 
?>

















<!-- 

<option 
        <?php   //if(isset($_SESSION['pickup'])){
        //                 if($values['name']==$_SESSION['pickup']){
        //                           echo 'value=$values["name"]';
        ?> selected <?php
                                                                        //  }
                                                                        //} 
                                                                        ?>
>
    <?php
    //print_r($values['name']);
    ?>                                 
</option> -->