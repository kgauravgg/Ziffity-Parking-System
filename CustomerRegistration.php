<!DOCTYPE html>
<html>
    <head>
        <title>Customer Registration</title>
    </head>
    <body>
        <h1>Customer Registration</h1>
        <p>If you don't have an Account, please create an Account with folloing details. </p>        
        <hr>
        <div>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <h3>Personal Details</h3>
                <label for="first_name">First Name : </label>
                <input type="text" name="first_name" id="firstName" placeholder="First name" required><br>
                <label for="last_name">Last Name : </label>
                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required><br>
                <label for="email">Email : </label>
                <input type="email" name="email" id="email" placeholder="Email : abc@example.com" required><br>
                <label for="mobile">Mobile : </label>
                <input type="tel" name="mobile" id="mobile" placeholder="Mobile Number" required><br>
                <h3>Car Details</h3>
                <label for="car_details">PWD Car Details (R.C) : </label><br>
                <input type="text" name="car_details" id="car_details" placeholder="PWD Car Details (R.C)" required><br>
                <label for="license">License : </label>
                <input type="text" name="license" id="license" placeholder="License No." required><br>
                <label for="img_file">Select Image of License : </label>
                <input type="file" name="img_file" id="img_file" required><br>
                <label for="username">Username : </label>
                <input type="text" name="username" id="username" placeholder="Username"><br>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password" placeholder="password" required><br>
                <label for="cnfPassword">Confirm Password : </label>
                <input type="password" name="cnfPassword" id="cnfPassword" placeholder="Confirm Password" required><br>
                <input type="submit" name="submit" value="Submit" id="submit">
            </form>
            <?php
                if(isset($_POST['submit'])){
                    include "Database.php";
                    $database = new Database();
                    array_pop($_POST);
                    array_pop($_POST);
                    $database->insert('customer',$_POST);
                    if($database->getResult()!=null){
                        session_start();
                        $_SESSION["customer_user"]=$_POST["mobile"];
                        $header = "Location:".$database->hostname."/Customer/index.php";
                        header($header);
                    }else {
                        echo "<div class='alert alert-danger'>Something is wrong.</div>";
                    }
                }
            ?>
        </div>
    </body>
</html>