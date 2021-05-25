<?php
include '../Database.php';
    session_start();
    if(isset($_SESSION["user"])){
        $database = new Database();
        $database->select('bookings',"*",null,null,null,null);
        echo '<!DOCTYPE html>
        <html>
            <head>
                <title>Bookings</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                <style>
                    table, th, td {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                </style>
            </head>
        <body>
            
            <h1><a href="index.php">Dashboard</a></h1><br>
            <h2>Your Booking Slots</h2><hr>
            <a href="index.php"><button>Dashboard</button></a>
            <a href="Account.php"><button>My Account</button></a>
            <a href="../logout.php"><button>Logout</button></a><hr>

            <table style="width:50%">
                <tr>
                    <th>Id</th>
                    <th>Area Zip Code</th>
                    <th>License</th>
                    <th>Vehicle Number</th>
                    <th>Vehicle Type</th>
                    <th>Amount</th>
                    <th>Total Hrs</th>
                    <th>Check-In Date-Time</th>
                    <th>Check-Out Date-Time</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>';
//Array ( [0] => Array ( [id] => 1 [customer_id] => 1 [parking_area_zip] => 821305 [license] => 1234567 [vehicles_number] => 43523423 [vehicle_type] => Heavy [amount] => [total_hrs] => [entry_datetime] => [exit_datetime] => [payment_id] => )
                foreach($database->getResult() as $id => $items){   
                    $i = $id+1;
                    echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$items['parking_area_zip']."</td>";
                        echo "<td>".$items['license']."</td>";
                        echo "<td>".$items['vehicles_number']."</td>";
                        echo "<td>".$items['vehicle_type']."</td>";
                        echo "<td>".$items['amount']."</td>";
                        echo "<td>".$items['total_hrs']."</td>";
                        if($items['entry_datetime'] != null){
                            $checkInButton = $items['entry_datetime'];
                        } else {
                            $checkInButton = '<a href=""><button>Check-IN</button></a>';
                        }
                        echo "<td>".$checkInButton."</td>";
                        if($items['entry_datetime'] != null && $items['exit_datetime'] == null ){
                            $checkOutButton = '<a href=""><button>Check-Out</button></a>';
                        } else {
                            $checkOutButton = $items['exit_datetime'];
                        }
                        echo "<td>".$checkOutButton."</td>";
                        if($items['payment_id'] != null){
                            $paymentButton = "Paid";
                        } else {
                            $paymentButton = '<a href=""><button>Not Paid</button></a>';
                        }
                        echo "<td>".$paymentButton."</td>";
                        echo "<td></td>";
                    echo "</tr>";
                }
                echo '
            </body>
        </html>';     
    }else{
        header("Location: ../CustomerLogin.php");
    }
?>
