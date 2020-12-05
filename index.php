<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="taskstyle.css"> -->
    <link rel="stylesheet" href="style.css">
    <title>Car Rental Shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <?php
    session_start();

    if (isset($_SESSION['username'])) {
    ?>
        <div class="topnav">
            <a href="#" style="float: left;text-transform: uppercase;">
                <?php //echo "WELCOME" . " " . $_SESSION['username']; ?>
            </a>
            <a class="active" href="logout.php">Logout</a>
            <a class="active" href="index.php">Home</a>
        </div>
    <?php
    } //else {
    ?>
        <div class="topnav">
            <a class="logo" style="float: left">
                <span>CED</span>CAB
            </a>

            <a class="active" href="registration.php">Registration</a>
            <a class="active" href="login.php">Login</a>
             <a class="active" href="index.php">Home</a>
        </div>
    <?php

    ?>

    <?php 
        if (isset($_SESSION['username'])) {
            session_destroy();
            echo "<script>window.location='index.php';</script>";
        }
    ?>
<!-- 
    <div class="col col-xs col-sm col-md col-lg col-xl mt-3 pt-3 aria-expanded hey">
        <h1 class="text-center txt1">Book a city taxi to your destination in town</h1>
         <p class="text-center txt1 text-uppercase py-2">Choose from a range of categories and prices</p>
 --> 
        <div class="form-div float-left form">
            <form method="POST" id="iform">
                <h1 class="text-center txt1">Book a city taxi to your destination in town</h1>
                <!-- <p class="text-center txt1 text-uppercase py-2">Choose from a range of categories and prices
                </p> -->

                <h4 class=" px-4 py-2 text-uppercase"><span>Your every day travel partner</span></h4>
                <h6 class=" py-2 text-uppercase" style="text-align: center;"><span>AC Cabs for point to point travel</span>
                </h6>
                <hr />

                <div>
                    <div class="input-group mb-3 select">
                        <select id="pickup_point" name="pickup_point">
                            <option selected hidden disabled>Select PickUp Point</option>
                            <option value="Charbagh">Charbagh</option>
                            <option value="Indira Nagar">Indira Nagar</option>
                            <option value="BBD">BBD</option>
                            <option value="Barabanki">Barabanki</option>
                            <option value="Faizabad">Faizabad</option>
                            <option value="Basti">Basti</option>
                            <option value="Gorakhpur">Gorakhpur</option>
                        </select>
                    </div>

                    <div class="input-group mb-3 select">
                        <select id="drop_point">
                            <option selected hidden disabled>Select Drop Point</option>
                            <option value="Charbagh">Charbagh</option>
                            <option value="Indira Nagar">Indira Nagar</option>
                            <option value="BBD">BBD</option>
                            <option value="Barabanki">Barabanki</option>
                            <option value="Faizabad">Faizabad</option>
                            <option value="Basti">Basti</option>
                            <option value="Gorakhpur">Gorakhpur</option>
                        </select>
                    </div>

                    <div class="input-group mb-3 select">
                        <select id="car_type">
                            <option selected hidden disabled>Select Cab Type</option>
                            <option>CedMicro</option>
                            <option>CedMini</option>
                            <option>CedRoyal</option>
                            <option>CedSUV</option>
                        </select>
                    </div>

                    <div class="input-group mb-3 select">
                        <input type="text" name="lwgt" placeholder="Enter Luggage weight in KG" id="lwgt" onkeypress="return isNumberKey(event)">
                    </div>

                    <div class="input-group mb-3 display text-danger select" style="background-color: white;" id="msg"></div>

                    <button type="submit" class="btn btn-primary buttonstyle" name="submit" id="submit">Check Fare</button>
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

                //Disable Button at Car Type
                $('#car_type').change(function() {
                    if ($("#car_type").val() == "CedMicro") {
                        $("#lwgt").attr("disabled");
                        $("#lwgt").val("");
                        $("#lwgt").hide();
                    }
                    else{
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
     

                    if(car=="CedMicro")
                    {
                         $("#lwgt").attr("disabled");
                        $("#lwgt").val("");
                        $("#lwgt").hide();
                        alert("Weight not allowed");

                    }



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

                     if (pickup != null && drop != null && car != null) {
                        if(pickup !== drop)

                        $.ajax({
                            type: 'post',
                            url: 'maincopy.php',
                            data: {
                                pickup: pickup,
                                drop: drop,
                                car: car,
                                luggage: luggage,
                            },
                            success: function(msg) {
                              
                                    alert('Please Login to Book Your Ride'+ msg);

                                    $r = confirm("Do you confirm the ride ?");
                                    if($r==true){
                                        window.location='login.php';
                                        e.preventDefault();
                                    }else{
                                        window.location='index.php';
                                    }
                                // alert("Please Login To Book your Ride " + msg);
                                // header("location:login.php"); -->
                            }
                        });
                        }   
                });
            });
        </script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<?php include("footer.php");?>