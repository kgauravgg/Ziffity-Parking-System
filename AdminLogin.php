<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
    </head>
    <body>
        <h1>Admin Login</h1>
        <p>If you have an Account, please signin with your email address</p>        
        <hr>
        <div>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <label for="username">Username : *</label><br>
                <input type="text" id="username" name="username" required><br><br>

                <label for="password">Password *</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <input type="submit" name="signin" id="signin" class="btn btn-submit" value="Sign In" >
            </form>
            <?php
                if(isset($_POST['signin'])){
                    include "Database.php";
                    $db = new Database();
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $user = null; $pass = null; $role=null;
                    $sql = "SELECT role, username, password  FROM admin WHERE username='$username' AND password='$password'";
                    $db->selectAll($sql);
                    foreach($db->getResult() as $key => $value){
                        foreach($value as $itemKey => $itemValue){
                            if($itemKey=="role"){
                                echo $role=$itemValue;
                            } else if($itemKey=="username"){
                                echo $user = $itemValue;
                            } else if($itemKey == "password") {
                                echo $pass = $itemValue;
                            }
                        }
                    }
                    if($user!=null){
                        echo $user;
                        session_start();
                        $_SESSION["admin_user"]=$user;
                        $_SESSION["role"]=$role;
                        $header = "Location:".$db->hostname."/Admin/index.php";
                        header($header);
                    } else {
                        echo "<div class='alert alert-danger'>Username or Password are not matched please try again.</div>";
                    }
                }
            ?>
        </div>
    </body>
</html>