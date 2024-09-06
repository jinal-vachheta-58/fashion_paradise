<?php
session_start(); 
// echo $_SESSION["admin_of_fashion_paradise"];
if(isset($_SESSION["admin_of_fashion_paradise"])) {
    // $_SESSION = array();

    unset($_SESSION["admin_of_fashion_paradise"]);
    session_destroy();

    header("Location: index.php");
    exit();
} else {
    // echo "Session admin_of_fashion_paradise value: " . $_SESSION["admin_of_fashion_paradise"];

    header("Location: index.php");
}
?>
