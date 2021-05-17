<?php
    session_start();
    if(isset($_SESSION["admin_user"])){
        include '../Database.php';
        $database = new Database();
        $database->select('customer',"*",null,null,null,null);
        echo '<!DOCTYPE html>
        <html>
            <head>
                <title>Customers</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                <style>
                    table, th, td {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                </style>
            </head>
        <body>
            
            <h1><a href="index.php">Admin Dashboard</a></h1><hr>
            <h2>Customers</h2>
            <a href="index.php"><button>Admin Dashboard</button></a>
            <a href="ParkingSlots.php"><button>Parking Slots</button></a>
            <a href="Vehicles.php"><button>Vehicles</button></a>
            <a href="Administrators.php"><button>Administrators</button></a>
            <a href="RechargeWallet.php"><button>Recharge Wallet</button></a>
            <a href="logout.php"><button>Logout</button></a><hr>

            <a href="Add/AddCustomer.php"><button>Add Customer</button></a>
            <table style="width:50%">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Car Details</th>
                    <th>License No.</th>
                    <th>License Photo</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';
                
                foreach($database->getResult() as $id => $items){   
                    $i = $id+1;
                    echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$items['first_name']." ".$items['last_name']."</td>";
                        echo "<td>".$items['email']."</td>";
                        echo "<td>".$items['mobile']."</td>";
                        echo "<td>".$items['car_details']."</td>";
                        echo "<td>".$items['license']."</td>";
                        echo "<td>".$items['img_file']."</td>";
                        echo "<td><a href='".$items['id']."'>Update</a></td>";
                        echo "<td><a href='".$items['id']."'>Delete</a></td>";
                    echo "</tr>";
                }
                echo '
            </table>

        </body>
        </html>';     
    }else{
        header("Location: ../AdminLogin.php");
    }
?>