<?php
session_start(); 
if(isset($_SESSION["username_of_fashion_paradise"]) && $_SESSION["cust_id_of_fashion_paradise"]) {
    // $_SESSION = array();
    $user = $_SESSION["username_of_fashion_paradise"] ;
    $cust_id = $_SESSION["cust_id_of_fashion_paradise"] ;
    // echo '<script> alert("by by '.$user .$cust_id.') </script>';
    // echo '<script> alert("by by '.$user .' '.$cust_id.'") </script>';

    unset($_SESSION["username_of_fashion_paradise"]);
    unset($_SESSION["cust_id_of_fashion_paradise"]);
    session_destroy();

    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
}
?>
