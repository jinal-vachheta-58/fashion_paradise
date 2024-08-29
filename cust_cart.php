<?php
session_start();
// include("functions/common_functions.php");

if (!isset($_SESSION["username_of_fashion_paradise"]) && !isset($_SESSION["cust_id_of_fashion_paradise"])) {

    echo "<script> alert('Please login so you can see your cart.'); window.location.href = 'login.php'; </script>";

    exit;

}
include ("includes/connect.php");
include ("functions/common_functions.php");
remove_from_cart();
cart();
wishlist();
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
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container bg-dark ">
            <a class="top-navbar navbar-brand text-light " href="#">FASHION PARADISE</a>

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
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
                            <li><a class="dropdown-item" href="cust_history.php">Order History</a></li>
                            <!-- <li><a class="dropdown-item" href="cust_cart.php">Cart</a></li> -->
                            <li><a class="dropdown-item" href="cust_wishlist.php">Wishlist</a></li>

                            <!-- <li><a class="dropdown-item" href="#">Edit Account</a></li> -->
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <?php
                    if (isset($_SESSION["username_of_fashion_paradise"]) && isset($_SESSION["cust_id_of_fashion_paradise"])) {
                        $user = $_SESSION["username_of_fashion_paradise"];
                        $cust_id = $_SESSION["cust_id_of_fashion_paradise"];
                        //   echo '<script> alert("by by '.$user .' '.$cust_id.'") </script>';
                    
                        echo '<li class="n">
welcome ' . $user . '</li>';
                        // welcome '.$user. ' '.$cust_id.'</li>';
// echo $_SESSION["cust_id_of_fashion_paradise"];
                    } else {

                        echo '<li class="n">
  welcome user</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="container">
            <div id="hotbox">
                <div class="box">
                    <div class="shop_by_cat container bg-dark text-light">
                        <div class="col-md-12">
                            <h1> CART</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <!-- page content -->
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered border-warning">

                        <tbody>
                            <!-- dynamic data of cart -->
                            <?php
                            global $con;
                            $cust_id = $_SESSION["cust_id_of_fashion_paradise"];
                            $total = 0;
                            $cart_query = "SELECT * FROM cart where cust_id = $cust_id";
                            $result_select_query = mysqli_query($con, $cart_query);
                            $result_count = mysqli_num_rows($result_select_query);
                            if ($result_count > 0) {
                                echo "<thead>
<tr>
    <th>Product Title</th>
    <th>Product Image</th>
    <th>Quantity</th>
    <th>Total Price</th>
    <th>Buy  Now</th>
    <th>Remove from cart</th>
    <th>move to wishlist</th>
</tr>
</thead>";

                                while ($row = mysqli_fetch_array($result_select_query)) {
                                    $product_id = $row["product_id"];
                                    $qty_cart = $row["qty"];
                                    $select_product_query = "select * from products where product_id = $product_id";
                                    $result_product_query = mysqli_query($con, $select_product_query);
                                    while ($row_product_price = mysqli_fetch_array($result_product_query)) {
                                        // price of single product
                                        $price_table = $row_product_price["product_price"];
                                        // product_title
                                        $product_title = $row_product_price["product_title"];
                                        $product_image = $row_product_price["product_image"];

                                        $product_price = array($row_product_price['product_price']);
                                        $product_values = array_sum($product_price);
                                        $total += $product_values;
                                        //   }
// }
                            
                                        ?>

                                        <!-- end here total price -->
                                        <tr>
                                            <td>
                                                <?php
                                                echo $product_title;
                                                ?>
                                            </td>
                                            <td>
                                                <img class="cart_image"
                                                    src="admin_area/product_images/<?php echo $product_image; ?>"
                                                    alt="product_image">
                                            </td>
                                            <td>
                                                <!-- <input type="text" class="form-input w-50" name="quantity" id="" > -->
                                                <?php
                                                echo $qty_cart;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $price_table . "/-";
                                                ?>
                                            </td>
                                            <td class="">

<?php
echo "
<a href='buy_single_product_from_cart.php?buy_single_product_from_c=$product_id' class='fun btn btn-warning col-12 mb-2 '>Buy now</a>";

?>
</td>

                                            <td class="">

                                                <?php
                                                echo "
<a href='cust_cart.php?remove_from_cart=$product_id' class='fun btn btn-secondary col-12 mb-2'>Remove</a>";

                                                ?>
                                            </td>

                                            <td class="">

                                                <?php
                                                echo "
<a href='cust_cart.php?remove_from_cart=$product_id&&add_to_wishlist=$product_id' class='fun btn btn-secondary col-12 mb-2'>move</a>";
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>

                                    <?php
                                    }
                                }
                            }
                            // else{
                            //     echo "<h2 class='text-center text-danger'> Cart is empty </h2>";
                            //     echo '<a href="shop_page.php"><button class="bg-info p-3 py-2 border-0 mx-3">continue shopping</button></a>';
                            // }
                            else {
                                echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                                echo '<a href="shop_page.php" class="bg-info p-3 py-2 border-0 mx-3 text-dark" style="display: inline-block; text-decoration: none;">Continue Shopping</a>';
                            }

                            ?>
                    </table>

                    <!-- # subtotal -->

                    <?php
                    global $con;
                    $cust_id = $_SESSION["cust_id_of_fashion_paradise"];
                    // $total = 0;
                    $cart_query = "SELECT * FROM cart where cust_id = $cust_id";
                    $result_select_query = mysqli_query($con, $cart_query);
                    $result_count = mysqli_num_rows($result_select_query);
                    if ($result_count > 0) {



                        echo '<div class="d-flex mb-3">
                    <h4 class="px-3">subtotal : <strong class="text-info">' . $total . '/-</strong></h4>
                    <a href="shop_page.php" class="bg-info p-3 py-2 border-0 mx-3 text-dark" style="display: inline-block; text-decoration: none;">Continue Shopping</a>
                    <a href="check_out.php" class="bg-secondary text-light p-3 border-0  py-2 text-decoration-none">Checkout</a>
                    </div>';
                    }
                    ?>

                </form>
            </div>
        </div>
        <!-- footer -->

        <div class="container-fluid bg-dark mt-3 mb-0">
            <h1 class="text-dark" style="margin-bottom:0%; height:200px;">#</h1>
        </div>
</body>

</html>