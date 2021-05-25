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
            <a href="../logout.php"><button>Logout</button></a><hr>

            <form action="" method="POST">
                <label for="license">License : </label>
                <input type="text" name="license" id="license" placeholder="License No." required><br>
                <label for="amount">Amount in Rupees : </label>
                <input type="number" name="wallet_amount" id="wallet_amount" min="0"><br>
                <label for="payment_type">Payment Type : </label>
                <select name="payment_type" id="payment_type">
                    <option value="deposit">Deposit</option>
                    <option value="withdraw">Withdraw</option>
                </select><br>
                <label for="payment_method">Payment Method : </label>
                <select name="payment_method" id="payment_method">
                    <option value="cash">Cash</option>
                    <option value="upi">UPI</option>
                </select><br>
                <label for="trancetion_id">Transection Id (Optional) : </label>
                <input type="text" name="trancetion_id" id="trancetion_id"><br>
                <input type="submit" name="submit" id="submit" valu="Add Amount">

            </form>';
            if(isset($_POST['submit'])){
                include "../Database.php";
                $database = new Database();

                $licenseNum = $_POST['license'];
                $walletAmount = $_POST['wallet_amount'];
                if($_POST['payment_type']=="deposit"){
                    $paymentType = "+";
                } else {
                    $paymentType = "-";
                }
                echo $paymentType; die;
                array_pop($_POST);
                if(!$_POST['trancetion_id']){
                    array_pop($_POST);
                }
                $database->insert('transection',$_POST,null,null,null);
                if($database->getResult()!=null){
                    $database->updateValueToExisting('customer','wallet_amount', $paymentType, $walletAmount,"license=$licenseNum");
                    if($database->getResult()!=null){
                        $header = "Location: RechargeWallet.php";
                        header($header);
                        echo "<div class='alert alert-success'>Transection Successfull.</div>";
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