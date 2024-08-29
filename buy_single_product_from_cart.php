<?php
    session_start();
    
    if (!isset($_SESSION["username_of_fashion_paradise"]) && !isset($_SESSION["cust_id_of_fashion_paradise"])) {

        $_SESSION["buy_product_you_selected"] = $fetch_pro_id = (int) $_REQUEST["buy_single_product_from_c"];
        echo "<script> alert('Please login so you can place order.'); window.location.href = 'login.php'; </script>";
    
        exit;
    
    }
    
require_once ("includes/connect.php");
include ("functions/common_functions.php");

if(isset($_REQUEST["buy_single_product_from_c"]))
{
    $fetch_pro_id = (int) $_REQUEST["buy_single_product_from_c"];



$name_err = $ph_err = $pin_err = $ad_err = "";
$username = $ph = $pin = $addr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login"])) {
        $username = $_POST["name"];
        $ph = $_POST["ph"];
        $pin = $_POST["pin"];
        $addr = $_POST["addr"];

        // Validate name
        if (empty($username)) {
            $name_err = "Name is required";
        } else {
            $pattern = "/^[a-zA-Z]*$/";
            if (!preg_match($pattern, $username)) {
                $name_err = "Invalid name";
            }
        }

        if (empty($ph)) {
            $ph_err = "Phone number is required";
        } else {
            $pattern = "/^[0-9]{10}$/";
            if (!preg_match($pattern, $ph)) {
                $ph_err = "Invalid phone number";
            }
        }

        // Validate pin code
        if (empty($pin)) {
            $pin_err = "Pin code is required";
        } else {
            $pattern = "/^[0-9]{6}$/";
            if (!preg_match($pattern, $pin)) {
                $pin_err = "Invalid pin code";
            }
        }

        // Validate address
        if (empty($addr)) {
            $ad_err = "Address is required";
        }

        if (empty($name_err) && empty($ph_err) && empty($ad_err) && empty($pin_err)) {
            // Find the matching delivery person

            
            $sql_find_dp = "SELECT dp_id FROM delivery_person WHERE order_area_1 = '$pin' OR order_area_2 = '$pin' ORDER BY RAND()";
            $result_find_dp = mysqli_query($con, $sql_find_dp);

            if (mysqli_num_rows($result_find_dp) > 0) {
                $row_find_dp = mysqli_fetch_assoc($result_find_dp);
                $dp_id = $row_find_dp['dp_id'];

                $num_of_item = 1;
                $cust_id = $_SESSION['cust_id_of_fashion_paradise'];
                $select_product_query = "SELECT * FROM products WHERE product_id = $fetch_pro_id";
                $result_find_product = mysqli_query($con, $select_product_query);
                $row_find_product = mysqli_fetch_assoc($result_find_product);
                $amount = $row_find_product["product_price"];

                // Insert the order details
                $sql_insert_order = "INSERT INTO orders (cust_id, dp_id, amount, shipping_address, pincode, num_of_item) VALUES ($cust_id, $dp_id, $amount, '$addr', '$pin', $num_of_item)";

                if (mysqli_query($con, $sql_insert_order)) {
                    $order_id = mysqli_insert_id($con);
                    $insert_orderline_items_success = true;

                    $sql_insert_orderline = "INSERT INTO order_line_items (product_id, order_id, quantity, price) VALUES ($fetch_pro_id, $order_id, $num_of_item, $amount)";
                    if (!mysqli_query($con, $sql_insert_orderline)) {
                        $insert_orderline_items_success = false;
                    }
                }

                if ($insert_orderline_items_success) {
                    // Update delivery person
                    $delivery_item_plus = "UPDATE delivery_person SET total_delivery = total_delivery + 1 WHERE dp_id = $dp_id";
                    $delete_pro = "delete from cart where cust_id = $cust_id and product_id = $fetch_pro_id";
                    // Empty the cart
                    // $cart_empty_query = "DELETE FROM cart WHERE cust_id = $cust_id";
// 
                    if(mysqli_query($con, $delete_pro))
                    {
                        if (mysqli_query($con, $delivery_item_plus) ) {
                            // echo "<script> alert('mysqli_affected_rows($con)'); </script>";
                            echo "<script>alert('Order placed successfully.');</script>";
                            echo "<script> window.location.href = 'shop_page.php'; </script>";
                        } else {
                            echo "<script>alert('Error in placing order.');</script>";
                            echo "<script> window.location.href = 'shop_page.php'; </script>";
                        }
                    }
                    else{
                        echo "<script> alert('mysqli_affected_rows($con)'); </script>";
                    }
                    
                } else {
                    echo "<script>alert('Error inserting order line items');</script>";
                    // echo "<script> window.location.href = 'shop_page.php'; </script>";
                }
            } else {
                echo "<script>alert('No delivery person available for the selected area');</script>";
                echo "<script> window.location.href = 'shop_page.php'; </script>";
            }


        }

    }
}
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input[type=text],
        input[type=pin],
        input[type=ph],
        input[type=addr],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 4px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            font-size: 25px;
            padding: 12px 20px;
            margin: 4px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        div {
            border-radius: 5px;
            margin: 10%;
            margin-top: 1px;
            margin-bottom: 100px;
            background-color: #f2f2f2;
            padding: 400px;
        }

        h1 {
            font-size: 50px;
            text-align: center;
            color: green;
            border: 2px solid #45a049;
            border-radius: 20px;
            background-color: white;


        }

        .login {
            padding: 100px;
            margin-top: 10px;
            margin-left: 310px;
            margin-right: 310px;
        }

        .err {
            color: red;
        }
    </style>
</head>

<body>
    <div class="login">

        <h1> Check out Page</h1>
        <form action="buy_single_product_from_cart.php?buy_single_product_from_c=<?php echo $fetch_pro_id; ?>" method="POST">


            Name <input type="text" name="name" value="<?php
            if (isset($_SESSION["username_of_fashion_paradise"])) {
                echo htmlspecialchars($_SESSION["username_of_fashion_paradise"]);
            }
            ?>">
            <span class="err">* <?php echo $name_err; ?></span><br><br>

            Phone No <input type="text" name="ph" value="<?php
            if (isset($ph)) {
                echo htmlspecialchars($ph);
            }
            ?>">
            <span class="err">* <?php echo $ph_err; ?></span><br><br>

            <!-- Pin <input type="text" name="pin" value="<?php
            if (isset($pin)) {
                echo htmlspecialchars($pin);
            }
            ?>"> -->

            <select name="pin">
                <option value="">Select Area</option>
                <option value="380013" <?php if (isset($pin) && $pin == '380013')
                    echo 'selected'; ?>>Naranpura - 380013
                </option>
                <option value="380009" <?php if (isset($pin) && $pin == '380009')
                    echo 'selected'; ?>>Navrangpura - 380009
                </option>
                <option value="380013" <?php if (isset($pin) && $pin == '380013')
                    echo 'selected'; ?>>Nava Vadaj - 380013
                </option>
                <option value="382480" <?php if (isset($pin) && $pin == '382480')
                    echo 'selected'; ?>>Ranip - 382480
                </option>
                <option value="380001" <?php if (isset($pin) && $pin == '380001')
                    echo 'selected'; ?>>Bhadra - 380001
                </option>
                <option value="380002" <?php if (isset($pin) && $pin == '380002')
                    echo 'selected'; ?>>Khanpur - 380002
                </option>
                <option value="380015" <?php if (isset($pin) && $pin == '380015')
                    echo 'selected'; ?>>Ambawadi - 380015
                </option>
                <option value="380052" <?php if (isset($pin) && $pin == '380052')
                    echo 'selected'; ?>>Bodakdev - 380052
                </option>
                <option value="380061" <?php if (isset($pin) && $pin == '380061')
                    echo 'selected'; ?>>Chandkheda - 380061
                </option>
                <option value="380008" <?php if (isset($pin) && $pin == '380008')
                    echo 'selected'; ?>>Dariapur - 380008
                </option>
                <option value="380025" <?php if (isset($pin) && $pin == '380025')
                    echo 'selected'; ?>>Ghodasar - 380025
                </option>
                <option value="380007" <?php if (isset($pin) && $pin == '380007')
                    echo 'selected'; ?>>Maninagar - 380007
                </option>
                <option value="380060" <?php if (isset($pin) && $pin == '380060')
                    echo 'selected'; ?>>Motera - 380060
                </option>
                <option value="380010" <?php if (isset($pin) && $pin == '380010')
                    echo 'selected'; ?>>Paldi - 380010
                </option>
                <option value="380054" <?php if (isset($pin) && $pin == '380054')
                    echo 'selected'; ?>>Satellite - 380054
                </option>
                <option value="380058" <?php if (isset($pin) && $pin == '380058')
                    echo 'selected'; ?>>Sarkhej - 380058
                </option>
                <option value="380051" <?php if (isset($pin) && $pin == '380051')
                    echo 'selected'; ?>>Thaltej - 380051
                </option>
                <option value="382443" <?php if (isset($pin) && $pin == '382443')
                    echo 'selected'; ?>>Vastral - 382443
                </option>
                <option value="380015" <?php if (isset($pin) && $pin == '380015')
                    echo 'selected'; ?>>Vasna - 380015
                </option>
            </select>

            <span class="err">* <?php echo $pin_err; ?></span><br><br>

            Address <input type="text" name="addr" value="<?php
            if (isset($addr)) {
                echo htmlspecialchars($addr);
            }
            ?>">
            <span class="err">* <?php echo $ad_err; ?></span><br><br>

            <input type="submit" name="login" value="Buy"><br>
        </form>
    </div>

</body>

</html>