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
            
            <h1><a href="index.php">Admin Dashboard</a></h1><br>
            <h2>Vehicles</h2><hr>
            <a href="index.php"><button>Admin Dashboard</button></a>
            <a href="Customers.php"><button>Customers</button></a>
            <a href="ParkingSlots.php"><button>Parking Slots</button></a>
            <a href="Administrators.php"><button>Administrators</button></a>
            <a href="RechargeWallet.php"><button>Recharge Wallet</button></a>
            <a href="../logout.php"><button>Logout</button></a>
        </body>
        </html>';     
    }else{
        header("Location: ../AdminLogin.php");
    }
?>