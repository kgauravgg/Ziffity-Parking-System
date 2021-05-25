<?php
    session_start();
    if(isset($_SESSION["admin_user"])){
        include '../Database.php';
        $database = new Database();
        $database->select('parkingslot',"*",null,null,null,null);
        echo '<!DOCTYPE html>
        <html>
            <head>
                <title>Parking Slots</title>
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
            
            <h1><a href="index.php">Admin Dashboard</a></h1><br>
            <h2>Parking Slots</h2><hr>
            <a href="index.php"><button>Admin Dashboard</button></a>
            <a href="Customers.php"><button>Customers</button></a>
            <a href="Vehicles.php"><button>Vehicles</button></a>
            <a href="Administrators.php"><button>Administrators</button></a>
            <a href="RechargeWallet.php"><button>Recharge Wallet</button></a>
            <a href="../logout.php"><button>Logout</button></a><hr>

            <a href="Add/AddParkingSlot.php"><button>Add Parking Slot</button></a>
            <table style="width:50%">
                <tr>
                    <th>Id</th>
                    <th>Area Zip</th>
                    <th>Vehicle Type</th>
                    <th>Slot Type</th>
                    <th>Numbers of Parking Slots</th>
                    <th>Charges Per Hour</th>
                    <th>Cancelation Charge</th>
                    <th>Cut Off Time</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>';
                // print_r($database->getResult());die;
                foreach($database->getResult() as $id => $items){   
                    $i = $id+1;
                    echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$items['zip_code']."</td>";
                        if($items['vehicle_type'] == '1'){
                            echo "<td>Simple</td>";
                        } else {
                            echo "<td>Heavy</td>";
                        }
                        if($items['slot_type'] == '1'){
                            echo "<td>Free</td>";
                        } else {
                            echo "<td>Paid</td>";
                        }
                        echo "<td>".$items['no_of_parking_slots']."</td>";
                        echo "<td>".$items['charges_per_hour']."</td>";
                        echo "<td>".$items['cancelation_charge']."</td>";
                        echo "<td>".$items['cut_off_time']."</td>";
                        echo "<td><a href='".$items['id']."'>Update</a></td>";
                        echo "<td><a href='".$items['id']."'>Delete</a></td>";
                    echo "</tr>";
                }
                echo '
        </body>
        </html>';     
    }else{
        header("Location: ../AdminLogin.php");
    }
?>