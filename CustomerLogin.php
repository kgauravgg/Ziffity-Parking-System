<!DOCTYPE html>
<html>
    <head>
        <title>Customer Login</title>
    </head>
    <body>
        <h1>Customer Login</h1>
        <p>If you have an Account, please signin with your email address</p>        
        <hr>
        <div>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <label for="mobile">Mobile: *</label><br>
                <input type="tel" id="mobile" name="mobile" required><br><br>

                <label for="password">Password: *</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <input type="submit" name="login" id="login" class="btn btn-submit" value="Log In" >
            </form>
            <?php
                if(isset($_POST['login'])){
                    include "Database.php";
                    $db = new Database();
                    $mobile = $_POST['mobile'];
                    $password = $_POST['password'];
                    $user = null; $cust_id = null;
                    $sql = "SELECT id, username, password  FROM customer WHERE mobile='$mobile' AND password='$password'";
                    $db->selectAll($sql);
                    foreach($db->getResult() as $key => $value){
                        foreach($value as $itemKey => $itemValue){
                            if($itemKey=="id"){
                                echo $cust_id=$itemValue;
                            }
                            if($itemKey=="username"){
                                echo $user = $itemValue;
                            }
                        }
                    }
                    if($user!=null){
                        session_start();
                        $_SESSION["user"]=$user;
                        $_SESSION["id"]=$cust_id;
                        $header = "Location:".$db->hostname."/Customer/index.php";
                        header($header);
                    } else {
                        echo "<div class='alert alert-danger'>Username or Password are not matched please try again.</div>";
                    }
                }
                // if(isset($_POST['login'])){
                //     include "Database.php";
                //     $db = new Database();
                //     $mobile = $_POST['mobile'];
                //     $password = $_POST['password'];
                //     $mobile = null; $cust_id = null;
                //     $sql = "SELECT mobile, password  FROM customer WHERE mobile='$mobile' AND password='$password'";
                //     echo $db->selectAll($sql);
                //     print_r($db->getResult());

                //     foreach($db->getResult() as $key => $value){
                //         foreach($value as $itemKey => $itemValue){
                //             if($itemKey=="id") {
                //                 $cust_id = $itemValue;
                //             }
                //             if($itemKey=="mobile"){
                //                 $mobile=$itemValue;
                //             }  
                //         }
                //     }
                //     // echo $cust_id." / ".$mobile;die;
                //     if($mobile!=null){
                //         session_start();
                //         $_SESSION["customer_user"]=$mobile;
                //         $_SESSION["customer_id"] = $cust_id;
                //         $header = "Location:".$db->hostname."/Customer/index.php";
                //         header($header);
                //     } else {
                //         echo "<div class='alert alert-danger'>Username or Password are not matched please try again.</div>";
                //     }
                // }
            ?>
        </div>
    </body>
</html>