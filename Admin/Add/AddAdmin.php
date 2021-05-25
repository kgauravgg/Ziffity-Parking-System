<?php
    session_start();
    if(isset($_SESSION["admin_user"])){
        echo '<!DOCTYPE html>
        <html>
            <head>
                <title>Add Parking Slot</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            </head>
        <body>
            
            <h1><a href="index.php">Admin Dashboard</a></h1><hr>
            <a href="../Customers.php"><button>Customers</button></a>
            <a href="../ParkingSlots.php"><button>Parking Slots</button></a>
            <a href="../Vehicles.php"><button>Vehicles</button></a>
            <a href="../Administrators.php"><button>Administrators</button>
            <a href="../../logout.php"><button>Logout</button></a><hr>

            <form action="'; $_SERVER['PHP_SELF']; echo '" method="POST">
                <h3>Personal Details</h3>
                <label for="name">Name : </label>
                <input type="text" name="name" id="name" placeholder="Name" required><br>
                
                <label for="role">Role</label>
                <select name="role" id="role">
                    <option>Select</option>
                    <option value="1">General</option>
                    <option value="2">Administrator</option>
                </select><br>

                <label for="email">Email : </label>
                <input type="email" name="email" id="email" placeholder="Email : abc@example.com" required><br>

                <label for="username">Username : </label>
                <input type="text" name="username" id="username" placeholder="Username"><br>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password" placeholder="password" required><br>
                
                <input type="submit" name="submit" value="Submit" id="submit">
            </form>';
            if(isset($_POST['submit'])){
                include "../../Database.php";
                $database = new Database();
                array_pop($_POST);
                $database->insert('admin',$_POST);
                if($database->getResult()!=null){
                    $header = "Location: ../Administrators.php";
                    header($header);
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
