<?php
include "../Database.php";
    session_start();
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        $db = new Database();
        $sql = "SELECT wallet_amount FROM customer WHERE username='$user'";
        $db->selectAll($sql);
        $amount = $db->getResult();
        echo '<!DOCTYPE html>
        <html>
            <head>
                <title>Dashboard</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            </head>
        <body>
            
            <h1><a href="index.php">Dashboard</a></h1><hr>
            <a href="Account.php"><button>My Account</button></a>
            <a href="AvailableParkingSlots.php"><button>Available Parking Slots</button></a>
            <a href="../logout.php"><button>Logout</button></a><hr>

            <div><h3>Amount Available in your Wallet : <span>'.$amount[0]['wallet_amount'].'</span></h3><div>
        </body>
        </html>';    
    }else{
        header("Location: ../CustomerLogin.php");
    }
    
?>

