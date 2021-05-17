<?php
    session_start();
    if(isset($_SESSION["admin_user"])){
        echo '<!DOCTYPE html>
        <html>
            <head>
                <title>Admin Dashboard</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            </head>
        <body>
            
            <h1><a href="index.php">Admin Dashboard</a></h1>
            <h2>Recharge Wallet</h2><hr>
            <a href="index.php"><button>Admin Dashboard</button></a>
            <a href="Customers.php"><button>Customers</button></a>
            <a href="ParkingSlots.php"><button>Parking Slots</button></a>
            <a href="Vehicles.php"><button>Vehicles</button></a>
            <a href="Administrators.php"><button>Administrators</button></a>
            <a href="logout.php"><button>Logout</button></a><hr>

            <form action="" method="POST">
                <label for="license">License : </label>
                <input type="text" name="license" id="license" placeholder="License No." required><br>
                <label for="amount">Amount in Rupees : </label>
                <input type="number" name="wallet_amount" id="wallet_amount" min="0">
                <input type="submit" name="submit" id="submit" valu="Add Amount">
            </form>';
            if(isset($_POST['submit'])){
                include "Database.php";
                $database = new Database();
                array_pop($_POST);
                $database->update()
                $database->insert('transection',$_POST);
                if($database->getResult()!=null){
                    $database->update('customer',$_POST, "license='$_POST['license']'")
                    if($database->getResult()!=null){
                        $header = "Location: RechargeWallet.php";
                        header($header);
                    }
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