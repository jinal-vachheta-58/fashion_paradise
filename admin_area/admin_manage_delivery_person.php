<?php
session_start();

if (!isset($_SESSION["admin_of_fashion_paradise"])) {

    echo "<script> alert('Please login first.'); window.location.href = 'admin_login.php'; </script>";

    exit;

}


include ("../includes/connect.php");
// include ("functions/common_functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN OF FASHION PARADISE</title>
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
            /* border: solid 1px #e6e6e6; */
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

        .dash {
            text-align: center;
        }

        .ship_w {
            max-width: 100px;
            /* overflow:hidden; */
            word-wrap: break-word;
        }
        .pr{
            min-width: 100px;    
        }
        .insert
        {
            width:30%;
            text-align: center;
            font-size: larger;
            border-radius: 30px;
            margin-left: 500px;
        }
    </style>
</head>

<body>
    <!-- FIRST NAV -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container bg-dark ">
            <a class="top-navbar navbar-brand text-light " href="#">FASHION PARADISE</a>

        </div>
        </div>
    </nav>


    <!-- SECOND -->
    <div class="bg-light">
        <h2 class="text-center p-2">
            <?php
            if (isset($_SESSION["admin_of_fashion_paradise"])) {
                echo " Welcome Admin " . $_SESSION["admin_of_fashion_paradise"] . "";
            } else {
                echo "Admin Dashboard";
            }

            ?>
        </h2>
    </div>


    <!-- THIRD -->
    <div class="container">
        <div class="container">
            <div id="hotbox">
                <div class="box">
                    <div class="shop_by_cat container bg-dark text-light">
                        <div class="col-md-12">
                            <h1>List Of Delivery Persons</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOURTH -->
        <div class="container">
            <!-- page content -->
            <div class="row">
                
                <?php
            echo '<a href="insert_delivery_person.php" class="bg-info p-3 py-2 border-0 mx-3 text-dark mb-4 insert" style="display: inline-block; text-decoration: none;">Insert New Delivery Person</a>';
             ?>   <form action="" method="post">
                    <table class="table table-bordered border-warning">

                        <tbody>
                            <!-- dynamic data of cart -->
                            <?php
                            global $con;
                            // $cust_id = $_SESSION["cust_id_of_fashion_paradise"];
                            // $total = 0;
                            $cart_query = "SELECT * FROM delivery_person order by dp_id desc ";
                            $result_select_query = mysqli_query($con, $cart_query);
                            $result_count = mysqli_num_rows($result_select_query);
                            if ($result_count > 0) {
echo "<thead>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>area 1</th>
    <th>area 2</th>
    <th>area 3</th>
    <th>area 4</th>
    <th>Total Deliveries</th>
    <th>Join Date</th>

    <th>See Order Details</th>
</tr>
</thead>";
// <th>salary</th>
                                while ($row = mysqli_fetch_array($result_select_query)) {
                                    $dp_id = $row["dp_id"];
                                    $username = $row["username"];
                                    $email = $row["email"];
                                    $order_area_1 = $row["order_area_1"];
                                    $order_area_2 = $row["order_area_2"];
                                    $order_area_3 = $row["order_area_1"];
                                    $order_area_4 = $row["order_area_2"];
                                    $total_delivery = $row["total_delivery"];
                                    $join_date = $row["join_date"];
                                    // $salary = $row["salary"];
                                    

                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                echo $dp_id;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $username;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $email;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $order_area_1;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $order_area_2;
                                                ?>
                                            </td>
                                            <td>
                                            <?php
                                                echo $order_area_3;
                                                ?>
                                            </td>
                                            <td class="pr">
                                                <?php
                                                echo $order_area_4;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $total_delivery;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $join_date;
                                                ?>
                                            </td>
<!--                                 
                                            <td>
                                                <?php
                                                // echo $salary;
                                                ?>
                                            </td> -->
                                            <td >

                                                <?php
                                                echo "
<a href='see_order_detail_of_delivery.php?dp_orders_id=$dp_id' class='fun btn btn-secondary col-12 mb-2'>See Order Details </a>";

                                                ?>
                                            </td>
                                            
                                        </tr>
                                    </tbody>

                                    <?php
                                    }
                                }

                            ?>
                    </table>

                    <!-- # subtotal -->

                    

                </form>
            </div>
        </div>
 <!-- footer -->

        <div class="container-fluid bg-dark mt-3 mb-0">
            <h1 class="text-dark" style="margin-bottom:0%; height:200px;">#</h1>
        </div>
</body>

</html>