<?php


session_start();

include ("../includes/connect.php");
if (!isset($_SESSION["admin_of_fashion_paradise"])) {

    echo "<script> alert('Please login first.'); window.location.href = 'admin_login.php'; </script>";

    exit;

}else{
    if (!isset($_GET["cat_id"])) {

        echo "<script> alert('Error in fetching product.'); window.location.href = 'admin_manage_category.php'; </script>";
    
        exit;
    
    }else{
        $cat_id =(int) $_GET["cat_id"];
        $query="delete from category where cat_id=$cat_id";

        if(mysqli_query($con,$query))
        {
            echo "<script> alert('category deleted successfully.'); window.location.href = 'admin_manage_category.php'; </script>";
    
        }
        else{
            echo "<script> alert('Error in deleting category.'); window.location.href = 'admin_manage_category.php'; </script>";
    
        }
    }

}
  
?>