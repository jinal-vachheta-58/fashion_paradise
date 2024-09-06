<?php
session_start();
include ("../includes/connect.php");
// include ("../functions/common_functions.php");

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard</title>

    <!-- font awsome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- bootstrap link -->
    <link rel="stylesheet" href="../bootstrap.css">

        <style>
        /* .admin_image {
            width: 100px;
            object-fit: contain;
        } */
        body{
            user-select: none;
            -moz-user-select: none;
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
        .nav-link{
            width: 165px;
            height: 30px;
            margin: 1.5px;
        }

        .nav-link:hover{
            /* color: black; */
            text-decoration: underline;
        }
        .activities{
            padding-top: 10px;
            padding-bottom: 10px;
            margin-bottom: 20px;
            align-items: center;
            font-size:larger;
            
        }
        .x{
            margin-left: 5px;
        }
        .n-i:nth-child(1){
            margin-left: 200px;
        }
      
    </style>

</head>
<body>
    
    <!-- navbar -->
    <div class="container-fluid p-0">

        <!-- first child -->

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container bg-dark ">
            <a class="top-navbar navbar-brand text-light " href="#">FASHION PARADISE</a>

            <form class="d-flex" role="search">
            <?php if (!isset($_SESSION["admin_of_fashion_paradise"])): ?>
                        <button class="btn btn-outline-light text-light bg-success" type="button">
                            <a class="text-light text-decoration-none" href="admin_registration.php">Register</a>
                        </button> &nbsp;
                        <button class="btn btn-outline-light text-light bg-success" type="button">
                            <a class="text-light text-decoration-none" href="admin_login.php">Login</a>
                        </button>
                    <?php else: ?>
                        <button class="btn btn-outline-light text-light bg-success x" type="button">
                            <a class="text-light text-decoration-none" href="admin_logout.php">Logout</a>
                        </button>
                    <?php endif; ?>
                <!-- <button class="btn btn-outline-light text-light bg-success" type="submit"><a class="text-light text-decoration-none" href="admin_registration.php">Register</a></button> &nbsp;
                <button class="btn btn-outline-light text-light bg-success" type="submit"><a class="text-light text-decoration-none" href="admin_login.php">Login</a></button>
                <button class="btn btn-outline-light text-light bg-success x" type="submit"><a class="text-light text-decoration-none " href="admin_logout.php">Logout</a></button> -->
            </form>
        </div>
        </div>
    </nav>

        <!-- second child -->

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

        <!-- third child -->

        <div class="container bg-dark activities">
        <div class="row bg-secondry">
            <div class="col-md-12  p-1 d-flex align-items-center">

                <div class="button text-center ">
                    <button class="my-4 n-i bg-success"><a href="admin_manage_products.php" class="nav-link text-light p-0 my-1">Manage Products</a></button>
                    <button class="n-i bg-success"><a href="admin_manage_category.php" class="nav-link text-light  bg-success my-1">Manage Category</a></button>
                    <button class="n-i bg-success"><a href="a_manage_customer.php" class="nav-link text-light  bg-success my-1">Manage Customers</a></button>
                    <button class="n-i bg-success"><a href="admin_manage_orders.php" class="nav-link text-light  bg-success my-1">List Of Orders</a></button>
                    <button class="n-i bg-success"><a href="admin_manage_delivery_person.php" class="nav-link text-light  bg-success my-1">Delivery Person</a></button>
                    <!-- <button class="n-i bg-success"><a href="" class="nav-link text-light  bg-success my-1">All orders</a></button> -->
                    <!-- <button class="n-i bg-success"><a href="" class="nav-link text-light  bg-success my-1">list users</a></button> -->
                    <!-- <button class="n-i bg-success"><a href="admin_logout.php" class="nav-link text-light  bg-success my-1">logout</a></button> -->


                </div>
                
            </div>
        </div>

        </div>

        <!-- fourth child -->
        <div class="container my-5">
            <?php
                // if (isset($_GET['insert_categoty'])) {
                //     include('insert_category.php');
                // }

                // if (isset($_GET['view_products'])) {
                //     include('view_products.php');
                // }
            ?>
        </div>
        <!-- js bootsrtap link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css"
        integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">

</body>
</html>