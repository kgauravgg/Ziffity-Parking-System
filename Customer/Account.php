<?php
include "../Database.php";
    session_start();
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        $db = new Database();
        $sql = "SELECT first_name, last_name, email, mobile, car_details, license, wallet_amount FROM customer WHERE username='$user'";
        $db->selectAll($sql);
        $data = $db->getResult();
        echo '<!DOCTYPE html>
        <html>
            <head>
                <title>My Account</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https: maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                <script src="https: ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https: maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            </head>
            <body>
                
                <h1><a href="index.php">Dashboard</a></h1><hr>
                <a href="index.php"><button>Dashboard</button></a>
                <a href="AvailableParkingSlots.php"><button>Available Parking Slots</button></a>
                <a href="../logout.php"><button>Logout</button></a><hr>

                <div><h3>Amount Available in your Wallet : <span>'.$data[0]['wallet_amount'].'</span></h3><div><hr>
                <div><h3>Update Account Information</h3><div>';
                echo '<form action="';  $_SERVER['PHP_SELF']; echo '" method="POST">
                        <h3>Personal Details</h3>
                        <label for="first_name">First Name : </label>
                        <input type="text" name="first_name" id="firstName" placeholder="First name" value="'.$data[0]['first_name'].'" required><br>
                        <label for="last_name">Last Name : </label>
                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" value="'.$data[0]['last_name'].'" required><br>
                        <label for="email">Email : </label>
                        <input type="email" name="email" id="email" placeholder="Email : abc@example.com" value="'.$data[0]['email'].'" required><br>
                        <label for="mobile">Mobile : </label>
                        <input type="tel" name="mobile" id="mobile" placeholder="Mobile Number" value="'.$data[0]['mobile'].'" required><br>
                        <h3>Car Details</h3>
                        <label for="car_details">PWD Car Details (R.C) : </label>
                        <input type="text" name="car_details" id="car_details" placeholder="PWD Car Details (R.C)" value="'.$data[0]['car_details'].'" required><br>
                        <label for="license">License : </label>
                        <input type="text" name="license" id="license" placeholder="License No." value="'.$data[0]['license'].'" required><br>
                        <label for="img_file">Select Image of License : </label>
                        <input type="file" name="img_file" id="img_file" required><br>
                        <label for="password">Password : </label>
                        <input type="password" name="password" id="password" placeholder="password" required><br>
                        <label for="cnfPassword">Confirm Password : </label>
                        <input type="password" name="cnfPassword" id="cnfPassword" placeholder="Confirm Password" required><br>
                        <input type="submit" name="submit" value="Submit" id="submit">
                </form>';
                if(isset($_POST['submit'])){
                    array_pop($_POST);
                    array_pop($_POST);
                    $where = "username='$user'";
                    $db->update('customer',$_POST, null, null, $where);
                    
                    if($db->getResult()!=null){
                        session_start();
                        $_SESSION["customer_user"]=$_POST["mobile"];
                        $header = "Location:".$db->hostname."/Customer/index.php";
                        header($header);
                    }else {
                        echo "<div class='alert alert-danger'>Something is wrong.</div>";
                    }
                }
            echo '</body>
        </html>';    
    }else{
        header("Location: ../CustomerLogin.php");
    }  
?>

