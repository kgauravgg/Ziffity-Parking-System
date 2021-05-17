<?php
    session_start();
    if(isset($_SESSION["admin_user"])){
        echo '<!DOCTYPE html>
        <html>
            <head>
                <title>Parking Slots</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            </head>
        <body>
            
            <h1><a href="../index.php">Admin Dashboard</a></h1><br>
            <h2>Parking Slots</h2><hr>
            <a href="../index.php"><button>Admin Dashboard</button></a>
            <a href="../Customers.php"><button>Customers</button></a>
            <a href="../Vehicles.php"><button>Vehicles</button></a>
            <a href="../Administrators.php"><button>Administrators</button></a>
            <a href="../../logout.php"><button>Logout</button></a><hr>

            <form action="" method="POST">
                <label for="zip_code">Zip Code</label>
                <input type="text" id="zip_code" name="zip_code"><br>
                <label for="vechil_type">Vehicle Type</label>
                <select name="vehicle_type" id="vehicle_type">
                    <option>select</option>
                    <option value="1">Simple</option>
                    <option value="2">Heavy</option>
                </select><br>
                <select name="slot_type" id="slot_type">
                    <option>select</option>
                    <option value="1">Free</option>
                    <option value="2">Paid</option>
                </select><br>   
                <label for="no_of_parkin_slot">Number Of Parking Slots</label>
                <input type="number" name="no_of_parkin_slot" id="no_of_parkin_slot" min="0"><br>
                <label for="cancelation_charge">Cancelation Charge</label>
                <input type="number" name="cancelation_charge" id="cancelation_charge" min="0"><br>
                <label for="cut_off_time">Cut Off Time</label>
                <input type="datetime-local" name="cut_off_time" id="cut_off_time"><br>
                <input type="submit" id="save" name="save" value="Save">
            </form>';
            if(isset($_POST['save'])){
                include "Database.php";
                $database = new Database();
                array_pop($_POST);
                $database->insert('parkingslot',$_POST);
                if($database->getResult()!=null){
                    $header = "Location: ../ParkingSlots.php";
                    header($header);
                }else {
                    echo "<div class='alert alert-danger'>Something is wrong.</div>";
                }
            }
        echo '</body>
        </html>';     
    }else{
        header("Location: ../AdminLogin.php");
    }
?>
