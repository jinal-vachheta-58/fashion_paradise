<?php
session_start();
// include("functions/common_functions.php");

if (!isset($_SESSION["admin_of_fashion_paradise"])) {

    echo "<script> alert('Please login so you can see customer order details.'); window.location.href = 'login.php'; </script>";

    exit;

}

if (!isset($_GET["see_order_details"]) && !isset($_GET["cust_id"])) {

    echo "<script> alert('eroor in fetching order details.'); window.location.href = 'admin_see_details_of_cust_order.php'; </script>";

    exit;

}
else{
    $see_order_details = $_GET["see_order_details"];
    $cust_id = $_GET["cust_id"];
}


include ("../includes/connect.php");
// include ("functions/common_functions.php");
// remove_from_cart();
// cart();
// wishlist();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FASHION PARADISE</title>
    <link rel="stylesheet" href="../bootstrap.css">
    <!-- <link rel="stylesheet" href="home_page_style.css"> -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2 bg-dark/css/fontawesome.min.css"
        integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">


    <!-- 1 font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">


    <!-- 2 font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&display=swap"
        rel="stylesheet">

    <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: none;
        }

        .top-navbar {
            font-size: 35px;
            font-family: "Orbitron", sans-serif;
            font-optical-sizing: auto;
            font-weight: 300;
            font-style: normal;
        }


        .top-navbar {
            font-family: "Noto Serif Display", serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
        }

        .nav-item {
            margin-left: 5px;
            margin-right: 5px;
            font-size: large;
            text-decoration: none;
        }

        .box {
            background-color: #fff;
            margin: 0px 0px 30px;
            border: solid 1px #e6e6e6;
            padding: 20px;
            box-shadow: 0 1ox 5px rgba(0, 0, 0, 0.1);
        }

        #advantage {
            text-align: center;
            display: flex;
            justify-content: space-between;
        }

        #advantage .box .icon {
            position: absolute;
            font-size: 120px;
            width: 100%;
            text-align: center;
            top: -20px;
            height: 100%;
            float: left;
            color: #eeeeee;
            transition: all 0.2s ease-out;
            z-index: 1;
            box-sizing: border-box;
        }

        #advantages .box h3 {
            position: relative;
            margin: 0px 0px 20px;
            font-weight: 300;
            text-transform: uppercase;
            z-index: 2;
        }

        #advantages .box h3 a:hover {
            text-decoration: none;

        }

        #advantages .box p {
            position: relative;
            color: #555555;
            z-index: 2;
        }

        #hotbox {
            text-transform: uppercase;
            font-size: 36px;
            color: #4993e4;
            font-weight: 100;
            text-align: center;
            /* margin-top: 20px; */
        }

        .shop_by_cat {
            padding: 20px;
            border-radius: 35px;
            font-family: "Noto Serif Display", serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
            color: aqua;
        }

        .custom-hr {
            border: 7px solid red;
            width: 100%;
            /* Adjust the width as needed */
        }

        small {
            font-size: large;
        }

        .nav-item:hover {
            /* border: 1px solid brown; */
            border-bottom: 1px solid black;
        }

        .card {
            width: 100px;
            height: 300px;
        }

        .card-img-top {
            width: 100%;
            height: 300px;
            object-fit: contain;
        }

        .fun:hover {
            background-color: #4993e4;
            color: black;
        }

        .n {
            margin-left: 5px;
            margin-right: 5px;
            font-size: large;
        }

        img {
            width: 200px;
            height: 250px;
            object-fit: contain;
        }
        .dash
        {
            text-align: center;
        }

        .a,.b,.c,.d{
            margin-right:3px;
            width: 245px;
        }
        .c{
            width: 560px;
            word-wrap: break-word;
        }
        .x{
            margin-right: 0%;
            margin-left: 0%;
            display: flex ;
            /* display: c\ ; */
            
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container bg-dark ">
            <a class="top-navbar navbar-brand text-light " href="#">FASHION PARADISE</a>

        </div>
        </div>
    </nav>

    <div class="bg-light">
            <h2 class="text-center p-2">
                <?php
    if (isset($_SESSION["admin_of_fashion_paradise"]))
    {
        echo" Welcome Admin ".$_SESSION["admin_of_fashion_paradise"]."";
    }
    else{
        echo "Admin Dashboard";
    }

?>
            </h2>
        </div>  

    <div class="container">
        <div class="container">
            <div id="hotbox">
                <div class="box">
                    <div class="shop_by_cat container bg-dark text-light">
                        <div class="col-md-12">
                            <h1> ORDER details </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php

    if (isset($_GET['see_order_details'])) {

        $fetch_order_id = (int) $_REQUEST['see_order_details'];
$select_order_details = "select * from orders where order_id = $fetch_order_id";
$result = mysqli_query($con,$select_order_details);

while($row = mysqli_fetch_assoc($result))
{
    $order_date =$row["order_date"];
    $amt= $row["amount"];
    // $amt= $row["phone_no"];
    $ship= $row["shipping_address"];
    $pincode= $row["pincode"];

echo "<div class='row'>";
    echo "<div class='col-3 border border-secondary rounded a'>";
    echo "<p class='mb-0 text-secondary'> Customer Id : </p>";
    echo "<h4> " .$cust_id." </h4>";
    echo "</div>";
    
    echo "<div class='col-3 border border-secondary b rounded'>";
    echo "<p class='mb-0 text-secondary'> Order Id : </p>";
    echo "<h4> " . $fetch_order_id ." </h4>";
    echo "</div>";


    echo "<div class='col-3 border border-secondary d rounded'>";
    echo "<p class='mb-0 text-secondary'> Pincode : </p>";
    echo "<h4> " .$pincode." </h4>";
    echo "</div>";

    
    echo "<div class='col-3 border border-secondary c rounded'>";
    echo "<p class='mb-0 text-secondary'> Shipping Address : </p>";
    echo "<h4> " .$ship." </h4>"; 
    echo "</div>";

    echo "</div>";
}
    }
?>



<?php



?>
<div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered border-warning mt-5">

                        <tbody>
                            <!-- dynamic data of cart -->
                            <?php
                            // global $con;
                            // $cust_id = $_SESSION["cust_id_of_fashion_paradise"];
                            // if ($result_count > 0) {
                                echo "<thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>description</th>
                                    <th>Price</th>
                                </tr>
                                </thead>";
                                
    $select_query = "SELECT * FROM order_line_items where order_id =  $fetch_order_id";
    $result_query = mysqli_query($con,$select_query);
    while ($rr = mysqli_fetch_assoc($result_query)) {
        $product_id=$rr["product_id"];

        $select_query = "SELECT * FROM products where product_id = $product_id";
        $result_select_query = mysqli_query($con, $select_query);
        // $result_count = mysqli_num_rows($result_select_query);
        
        while ($row = mysqli_fetch_assoc($result_select_query)) {
            // $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            // $product_keywords = $row['product_keywords'];
            $product_image = $row['product_image'];
            $product_price = $row['product_price'];
            $cat_id = $row['cat_id'];
            // $product_id = $row['product_id'];
                                ?>
                                
                                <tr>
                                <td>
                                    <?php
                                    echo $product_title;
                                    ?>
                                </td>
                                <td>
                                    <img class="cart_image"
                                        src="product_images/<?php echo $product_image; ?>"
                                        alt="product_image">
                                </td>
                                <td>
                                    <!-- <input type="text" class="form-input w-50" name="quantity" id="" > -->
                                    <?php
                                    echo $product_description;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $product_price . "/-";
                                    ?>
                                </td>
                                <!-- <td class=""> -->

                                    
                            </tr>
                        </tbody>

                        <?php
                        // }else{
                        //     echo "<h2 class='text-center text-danger'>order history is empty</h2>";
                        //         // echo '<a href="shop_page.php" class="bg-info p-3 py-2 border-0 mx-3 text-dark" style="display: inline-block; text-decoration: none;">Continue Shopping</a>';
                            
                        // }

                    }
                }
            
                ?>
        </table>

<?php


    
            
?>
        
                
    </div>
        
        <!-- footer -->

        <div class="container-fluid bg-dark mt-3 mb-0">
            <h1 class="text-dark" style="margin-bottom:0%; height:200px;">#</h1>
        </div>
</body>

</html>