
<?php
session_start();
include("action.php");

if (isset($_POST["pick"]) || isset($_POST["drop"]) || isset($_POST["car"]) || isset($_POST["wgt"])) {
    $obj = new connection();

    $ary = $obj->dlocation();

    $array = [];

    $result = $ary;
    // print_r($result);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            array_push($array, $row);
        }
        // print_r($array);
    }

    // $pickup = array('Charbagh' => 0, 'Indira Nagar' => 10, 'BBD' => 30, 'Barabanki' => 60, 'Faizabad' => 100, 'Basti' => 150, 'Gorakhpur' => 210);


    $pick = $_POST['pickup'];
    $drop = $_POST['drop'];
    $car = $_POST['car'];
    $wgt = $_POST['luggage'];

    $ttldistance;
    $ttlcost = 0;
    $droppoint = 0;
    $pickpoint = 0;

    foreach ($array as $key => $values) {


        if ($pick == $values['name']) {
            $pickpoint = $values['distance'];
        }


        if ($drop == $values['name']) {
            $droppoint = $values['distance'];
        }
    }

    $ttldistance = abs($droppoint - $pickpoint);


    if ($car == "CedMicro") {
        if ($ttldistance <= 10) {
            $ttlcost = (50 + ($ttldistance * 13.50));
        } elseif ($ttldistance > 10 && $ttldistance <= 60) {
            $ttlcost = (50 + (10 * 13.50) + (($ttldistance - 10) * 12));
        } elseif ($ttldistance > 60 && $ttldistance <= 160) {
            $ttlcost = (50 + (10 * 13.50) + (50 * 12) + (($ttldistance - 60) * 10.20));
        } elseif ($ttldistance > 160) {
            $ttlcost = (50 + (10 * 13.50) + (50 * 12) + (100 * 10.20) + (($ttldistance - 160) * 8.50));
        }
    } elseif ($car == "CedSUV") {

        if ($ttldistance <= 10) {
            $ttlcost += 250 + ($ttldistance * 16.50);
        } elseif ($ttldistance > 10 && $ttldistance <= 60) {
            $ttlcost += 250 + (10 * 16.50) + (($ttldistance - 10) * 15);
        } elseif ($ttldistance > 60 && $ttldistance <= 160) {
            $ttlcost += 250 + (10 * 16.50) + (50 * 15) + (($ttldistance - 60) * 13.20);
        } elseif ($ttldistance > 160) {
            $ttlcost += 250 + (10 * 16.50) + (50 * 15) + (100 * 13.20) + (($ttldistance - 160) * 11.50);
        }

        if ($wgt >= 1 && $wgt <= 10) {
            $ttlcost = $ttlcost + 100;
        }

        if ($wgt > 10 && $wgt <= 20) {
            $ttlcost = $ttlcost + 200;
        }
        if ($wgt > 20) {
            $ttlcost = $ttlcost + 400;
        }
    } elseif ($car == "CedRoyal") {

        if ($ttldistance <= 10) {
            $ttlcost += 200 + ($ttldistance * 15.50);
        } elseif ($ttldistance > 10 && $ttldistance <= 60) {
            $ttlcost += 120 + (10 * 15.50) + (($ttldistance - 10) * 14);
        } elseif ($ttldistance > 60 && $ttldistance <= 160) {
            $ttlcost += 200 + (10 * 15.50) + (50 * 14) + (($ttldistance - 60) * 12.20);
        } elseif ($ttldistance > 160) {
            $ttlcost += 200 + (10 * 15.50) + (50 * 14) + (100 * 12.20) + (($ttldistance - 160) * 10.50);
        }

        if ($wgt >= 1 && $wgt <= 10) {
            $ttlcost = $ttlcost + 50;
        }

        if ($wgt > 10 && $wgt <= 20) {
            $ttlcost = $ttlcost + 100;
        }
        if ($wgt > 20) {
            $ttlcost = $ttlcost + 200;
        }
    } elseif ($car == "CedMini") {

        if ($ttldistance <= 10) {
            $ttlcost += 150 + ($ttldistance * 14.50);
        } elseif ($ttldistance > 10 && $ttldistance <= 60) {
            $ttlcost += 150 + (10 * 14.50) + (($ttldistance - 10) * 13);
        } elseif ($ttldistance > 60 && $ttldistance <= 160) {
            $ttlcost += 150 + (10 * 14.50) + (50 * 13) + (($ttldistance - 60) * 11.20);
        } elseif ($ttldistance > 160) {
            $ttlcost += 150 + (10 * 14.50) + (50 * 13) + (100 * 11.20) + (($ttldistance - 160) * 9.50);
        }

        if ($wgt >= 1 && $wgt <= 10) {
            $ttlcost = $ttlcost + 50;
        }

        if ($wgt > 10 && $wgt <= 20) {
            $ttlcost = $ttlcost + 100;
        }
        if ($wgt > 20) {
            $ttlcost = $ttlcost + 200;
        }
    }
    $username = $_SESSION['username'];

    $lug="";
    if($wgt!="")
    {
        $lug=$wgt;
    } else
    $lug=0;

    $ride = $obj->userride($pick, $drop, $lug, $username, $ttldistance, $ttlcost, $car);

    echo "PickUp Point : "." ".$pick."\n";
    echo "Drop Point : "." ".$drop."\n";
    echo "Cab Type : "." ".$car."\n";
    echo "Luggage : "." ".$lug."Kg"."\n";
    echo "Total Distance : "." ".$ttldistance."Km"."\n";
    echo "Total Cost : "."Rs.".$ttlcost."\n";
    echo "Status : Your Ride is Confirmed wait for Admin approval";


    // if($wgt == ""){
    //     $array = array("pickup" => $pick, "drop" => $drop, "totaldistance" => $ttldistance, "Cab" => $car, "luggage" => 0, "Total Cost" => $ttlcost, "User Name" => $username, "Status" => "Status: Request Send to admin for Confirmation Thankyou for booking request.");  
    // }
    // else{
    //     $array = array("pickup" => $pick, "drop" => $drop, "totaldistance" => $ttldistance, "Cab" => $car, "luggage" => $wgt, "Total Cost" => $ttlcost, "User Name" => $username, "Status" => "Status: Request Send to admin for Confirmation Thankyou for booking request.");
    // }  

    // if ($pick != null && $drop != null && $car != null || $wgt != null ) {
    //     print_r($array);
    // } else {
    //     echo "No Data Provided";
    // }
} elseif (($_POST["pick"]) || ($_POST["drop"]) || ($_POST["car"]) || ($_POST["wgt"] == "")) {
}


?>

     






       

