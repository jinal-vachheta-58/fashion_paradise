<?php
session_start(); 
// echo $_SESSION["delivery_person_of_fashion_paradise"];
if(isset($_SESSION["delivery_person_of_fashion_paradise"])) {
    // $_SESSION = array();

    unset($_SESSION["delivery_person_of_fashion_paradise"]);
    unset($_SESSION["delivery_person_id"]);
    session_destroy();

    header("Location: d_p_dashboard.php");
    exit();
} else {
    // echo "Session delivery_person_of_fashion_paradise value: " . $_SESSION["delivery_person_of_fashion_paradise"];

    header("Location: d_p_dashboard.php");
}
?>
