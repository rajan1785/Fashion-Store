<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = "rajan";
    $pass = 'rajan';

    if($username == $user){
        if($password == $pass){
            $_SESSION['username'] = $username;
            header("Location: ../orders.php");
        }else{
            header("Location: ../orders.php?error=wrongPassword");
        }
    
    }else{
        header("Location:../orders.php?error=usernotfound");
    }
} else {
    header("Location: ../orders.php");
}
?>
