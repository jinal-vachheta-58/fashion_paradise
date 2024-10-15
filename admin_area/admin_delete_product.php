<?php


session_start();

include ("../includes/connect.php");
if (!isset($_SESSION["admin_of_fashion_paradise"])) {

    echo "<script> alert('Please login first.'); window.location.href = 'admin_login.php'; </script>";

    exit;

}else{
    if (!isset($_GET["pro_id"])) {

        echo "<script> alert('Error in fetching product.'); window.location.href = 'admin_manage_products.php'; </script>";
    
        exit;
    
    }else{
        $product_id =(int) $_GET["pro_id"];
        $query="delete from products where product_id=$product_id";

        if(mysqli_query($con,$query))
        {
            echo "<script> alert('product deleted successfully.'); window.location.href = 'admin_manage_products.php'; </script>";
    
        }
        else{
            echo "<script> alert('Error in deleting product.'); window.location.href = 'admin_manage_products.php'; </script>";
    
        }
    }



}


   
    
    
?>