<?php
include ("includes/connect.php");
include ("functions/common_functions.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FASHION PARADISE</title>
    <link rel="stylesheet" href="bootstrap.css">
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


        /* // <uniquifier>: Use a unique and descriptive class name
// <weight>: Use a value from 400 to 900 */

        /* .orbitron-<uniquifier> {
  font-family: "Orbitron", sans-serif;
  font-optical-sizing: auto;
  font-weight: <weight>;
  font-style: normal;
} */
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container bg-dark ">
            <a class="top-navbar navbar-brand text-light " href="#">FASHION PARADISE</a>

            <form class="d-flex" role="search">
                <button class="btn btn-outline-light text-light bg-success" type="submit">Register</button> &nbsp;
                <button class="btn btn-outline-light text-light bg-success" type="submit">Login</button>
            </form>
        </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container ">
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop_page.php">Shop</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            My Account
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="display_all.php">Order History</a></li>
                            <li><a class="dropdown-item" href="#">Cart</a></li>
                            <li><a class="dropdown-item" href="#">Wishlist</a></li>

                            <li><a class="dropdown-item" href="#">Edit Account</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="search_product.php" method="get">
                    <input class="form-control me-2" type="search" name="search_data" placeholder="Search" aria-label="Search">
                    <input type="submit" value="search" name="search_data_product"  class="btn btn-outline-light text-dark">
                    <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                </form>

            </div>
        </div>
    </nav>

    <div class="container">
        <!-- page content -->
        <div class="row">
            <div class="col-md-2 bg-light p-0 m-0">
                <!--side bar  -->
                <ul class="navbar-nav me-auto p-0 m-0">
                    <li class="bg-info text-center bg-success text-decoration-none border-dark">
                        <!-- <a href="" class="nav-link text-light"> -->
                        <h4> Categories</h4>
                        <!-- </a> -->
                    </li>
                    <?php

                    display_category();
                    ?>

                </ul>


            </div>


            <div class="col-md-10">
                <!--products  -->
                <div class="row">

                    <!-- fetching products  -->
                    <?php
                    get_all_products();
                    get_unique_categories()
                        ?>

                </div>
            </div>
        </div>
    </div>

</body>

</html>
