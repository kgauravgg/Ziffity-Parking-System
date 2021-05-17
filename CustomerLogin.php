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
                <label for="username">Mobile: *</label><br>
                <input type="text" id="username" name="username" required><br><br>

                <label for="password">Password *</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <input type="submit" name="login" id="login" class="btn btn-submit" value="Log In" >
            </form>
            <?php
                if(isset($_POST['login'])){
                    include "Database.php";
                    $db = new Database();
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $user = null; $pass = null; $role=null;
                    $sql = "SELECT mobile, username, password  FROM customer WHERE mobile='$username' AND password='$password'";
                    $db->selectAll($sql);
                    // print_r($db->getResult());
                    foreach($db->getResult() as $key => $value){
                        foreach($value as $itemKey => $itemValue){
                            if($itemKey=="mobile"){
                                echo $mobile=$itemValue;
                            } 
                        }
                    }
                    if($mobile!=null){
                        session_start();
                        $_SESSION["customer_user"]=$mobile;
                        $header = "Location:".$db->hostname."/Customer/index.php";
                        header($header);
                    } else {
                        echo "<div class='alert alert-danger'>Username or Password are not matched please try again.</div>";
                    }
                }
            ?>
        </div>
    </body>
</html>