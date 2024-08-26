<?php
session_start();
include("../includes/connect.php");

// Check if user is logged in
if (!isset($_SESSION["delivery_person_of_fashion_paradise"]) && !isset($_SESSION["delivery_person_id"])) {
    echo "<script> alert('Please login first.'); window.location.href = 'd_p_login.php'; </script>";
    exit;
}

// Get the order ID and customer ID from the URL
if (isset($_GET["see_order_details"]) ) {
    $order_id = intval($_GET["see_order_details"]);
    // $cust_id = intval($_GET["cust_id"]);

    // Check the current status of the order and payment
    $check_query = "SELECT order_status, payment_status FROM orders WHERE order_id = $order_id";
    $check_result = mysqli_query($con, $check_query);
    
    if ($check_result && mysqli_num_rows($check_result) > 0) {
        $row = mysqli_fetch_assoc($check_result);
        
        // Order status check
        if ($row["order_status"] !== "delivered") {
            echo "<script> alert('First deliver the order to the customer before changing the payment status.'); window.location.href = 'see_order_detail_of_delivery.php'; </script>";
        } elseif ($row["payment_status"] === "success") {
            echo "<script> alert('Payment is already marked as success.'); window.location.href = 'see_order_detail_of_delivery.php'; </script>";
        } else {
            // Update payment status to 'success'
            $update_query = "UPDATE orders SET payment_status = 'success' WHERE order_id = $order_id";
            
            if (mysqli_query($con, $update_query)) {
                echo "<script> alert('Payment status updated to success.'); window.location.href = 'see_order_detail_of_delivery.php'; </script>";
            } else {
                echo "<script> alert('Failed to update payment status.'); window.location.href = 'see_order_detail_of_delivery.php'; </script>";
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
