<?php
    // include '../Database.php';
    session_start();

    // $db = new Database();
    // if($db->getResult()!==null){
    //     if($pass !== $password){
    //         echo "<script>alert('You have entered wrong password');</script>";
    //         header('Location: ../index.php');
    //     } else {
    //         $_SESSION['admin_user'] = $user;
    //         
    //     }
    // }else {
    //     echo "<script>alert('You have entered wrong password');</script>";
    //     header('Location: ../index.php');

    // }
    if(isset($_SESSION['customer_user'])){
        echo "Welcome";     
    }else{
        header("Location: ../index.php");
    }
    


    // echo "Select result is : ";
    
    // print_r();// include("dashboard.php");
?>

