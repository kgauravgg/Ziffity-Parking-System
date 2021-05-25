<?php
include "../Database.php";
    session_start();
    if(isset($_SESSION['user'])){
        $url = $_SERVER["REQUEST_URI"];
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        $parkingSlotId = $query['id'];
        $user = $_SESSION['user'];

        $db = new Database();
        $db->select('customer','id, license', null, "username='$user'", null, null );
        $customerData = $db->getResult();

        $db->select('parkingslot', 'zip_code, vehicle_type', null, "id='$parkingSlotId'", null, null);
        $parkingSlotData = $db->getResult();
        
        if($parkingSlotData[0]['vehicle_type']==1){
            $vehicleType = "Simple";
        } else {
            $vehicleType = "Heavy";
        } 
        echo '<!DOCTYPE html>
        <html>
            <head>
                <title>Book Parking Slot</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https: maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                <script src="https: ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https: maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            </head>
            <body>
                
                <h1><a href="index.php">Dashboard</a></h1><hr>
                <a href="index.php"><button>Dashboard</button></a>
                <a href="Account.php"><button>My Account</button></a>
                <a href="AvailableParkingSlots.php"><button>Available Parking Slots</button></a>
                <a href="../logout.php"><button>Logout</button></a><hr>

                <div><h3>Book Your Parking Slot</h3><div>
                <form action="'.$_SERVER['PHP_SELF'].'" method="POST">
                    <label for="customer_id">Customer ID : </label>
                    <input type="text" name="customer_id" value="'.$customerData[0]['id'].'" readonly><br>

                    <label for="parking_area_zip">Area Zip Code :  </label>
                    <input type="text" name="parking_area_zip" value="'.$parkingSlotData[0]['zip_code'].'" readonly><br>

                    <label for="license">License : </label>
                    <input type="text" name="license" value="'.$customerData[0]['license'].'" readonly required><br>

                    <label for="vehicles_number">Vehicle Number : </label>
                    <input type="text" name="vehicles_number"><br>

                    <label for="vehicle_type">Vehicle Type : </label>
                    <input type="text" name="vehicle_type" value="'.$vehicleType.'" readonly><br>
                
                    <input type="submit" name="submit" value="Reserve Slot">
                </form>';  
            echo '</body>
        </html>';    
    } else{
        header("Location: ../CustomerLogin.php");
    }  
      
    if(isset($_POST['submit'])){
        array_pop($_POST);
        // print_r($_POST);die;
        $db->insert('bookings',$_POST);
        if($db->getResult()!=null){
            $header = "Location:".$db->hostname."/Customer/Bookings.php";
            header($header);
        } else {
            echo "<div class='alert alert-danger'>Something is wrong.</div>";
        }
    } 
?>