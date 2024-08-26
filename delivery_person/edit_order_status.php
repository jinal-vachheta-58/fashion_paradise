<?php
session_start();
include("../includes/connect.php");

// Check if user is logged in
if (!isset($_SESSION["delivery_person_of_fashion_paradise"]) && !isset($_SESSION["delivery_person_id"])) {
    echo "<script> alert('Please login first.'); window.location.href = 'd_p_login.php'; </script>";
    exit;
}

// Get the order ID from the URL
if (isset($_GET["see_order_details"])) {
    $order_id = intval($_GET["see_order_details"]);

    // Check the current status of the order
    $check_query = "SELECT order_status FROM orders WHERE order_id = $order_id";
    $check_result = mysqli_query($con, $check_query);
    
    if ($check_result && mysqli_num_rows($check_result) > 0) {
        $row = mysqli_fetch_assoc($check_result);
        
        if ($row["order_status"] === "delivered") {
            echo "<script> alert('Order is already delivered.'); window.location.href = 'see_order_detail_of_delivery.php'; </script>";
        } else {
            // Update order status to 'delivered'
            $update_query = "UPDATE orders SET order_status = 'delivered' WHERE order_id = $order_id";
            
            if (mysqli_query($con, $update_query)) {
                echo "<script> alert('Order status updated to delivered.'); window.location.href = 'see_order_detail_of_delivery.php'; </script>";
            } else {
                echo "<script> alert('Failed to update order status.'); window.location.href = 'see_order_detail_of_delivery.php'; </script>";
            }
        }
    } else {
        echo "<script> alert('Invalid order ID.'); window.location.href = 'see_order_detail_of_delivery.php'; </script>";
    }
} else {
    echo "<script> alert('Invalid order ID.'); window.location.href = 'see_order_detail_of_delivery.php'; </script>";
    exit;
}
?>
