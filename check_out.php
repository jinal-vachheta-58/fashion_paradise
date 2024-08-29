<?php

?>
<?php
session_start();
require_once("includes/connect.php");
include("functions/common_functions.php");

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
            $sql_find_dp = "SELECT dp_id FROM delivery_person WHERE order_area_1 = '$pin' OR order_area_2 = '$pin' or order_area_3 = '$pin' OR order_area_4 = '$pin' ORDER BY RAND()";
            $result_find_dp = mysqli_query($con, $sql_find_dp);

            if (mysqli_num_rows($result_find_dp) > 0) {
                $row_find_dp = mysqli_fetch_assoc($result_find_dp);
                $dp_id = $row_find_dp['dp_id'];
                $num_of_item = order_items();
                $cust_id = $_SESSION['cust_id_of_fashion_paradise'];
                $amount = return_total_amt();

                // Insert the order details
                $sql_insert_order = "INSERT INTO orders (cust_id, dp_id, amount, shipping_address, pincode, num_of_item) VALUES ($cust_id, $dp_id, $amount, '$addr', '$pin', $num_of_item)";

                if (mysqli_query($con, $sql_insert_order)) {
                    $order_id = mysqli_insert_id($con);

                    // // Insert order line items
                    // $sql_cart_items = "SELECT product_id, qty, price FROM cart WHERE cust_id = $cust_id";
                    // $result_cart_items = mysqli_query($con, $sql_cart_items);
                    // Insert order line items
                    $sql_cart_items = "SELECT c.product_id, c.qty, p.product_price FROM cart c INNER JOIN products p ON c.product_id = p.product_id WHERE c.cust_id = $cust_id";
                    $result_cart_items = mysqli_query($con, $sql_cart_items);
                    $insert_orderline_items_success = true;
                    while ($row_cart_item = mysqli_fetch_assoc($result_cart_items)) {
                        $product_id = $row_cart_item['product_id'];
                        $qty = $row_cart_item['qty'];
                        $price = $row_cart_item['product_price'];

                        $sql_insert_orderline = "INSERT INTO order_line_items (product_id, order_id, quantity, price) VALUES ($product_id, $order_id, $qty, $price)";
                        if (!mysqli_query($con, $sql_insert_orderline)) {
                            $insert_orderline_items_success = false;
                            break;
                        }
                    }

                    if ($insert_orderline_items_success) {
                        // Update delivery person
                        $delivery_item_plus = "UPDATE delivery_person SET total_delivery = total_delivery + 1 WHERE dp_id = $dp_id";

                        // Empty the cart
                        $cart_empty_query = "DELETE FROM cart WHERE cust_id = $cust_id";

                        if (mysqli_query($con, $delivery_item_plus) && mysqli_query($con, $cart_empty_query)) {
                            echo "<script>alert('Order placed successfully.');</script>";
                            echo "<script> window.location.href = 'shop_page.php'; </script>";
                        } else {
                            echo "<script>alert('Error in placing order.');</script>";
                            echo "<script> window.location.href = 'check_out.php'; </script>";
                        }
                    } else {
                        echo "<script>alert('Error inserting order line items');</script>";
                        echo "<script> window.location.href = 'check_out.php'; </script>";
                    }
                } else {
                    echo "<script>alert('Error placing order');</script>";
                    echo "<script> window.location.href = 'check_out.php'; </script>";
                }
            } else {
                echo "<script>alert('No delivery person available for the selected area');</script>";
                echo "<script> window.location.href = 'check_out.php'; </script>";
            }
        }
//         if (empty($name_err) && empty($ph_err) && empty($ad_err) && empty($pin_err)) {

// // Find the matching delivery person
// $sql_find_dp = "SELECT dp_id FROM delivery_person WHERE order_area_1 = '$pin' OR order_area_2 = '$pin' order by rand() LIMIT 1";
// $result_find_dp = mysqli_query($con, $sql_find_dp);

// if (mysqli_num_rows($result_find_dp) > 0) {
//     $row_find_dp = mysqli_fetch_assoc($result_find_dp);
//     $dp_id = $row_find_dp['dp_id'];
//     $num_of_item = order_items();
//     $cust_id = $_SESSION['cust_id_of_fashion_paradise']; 
//     $amount = return_total_amt();

//      // Insert the order details
//      $sql_insert_order = "INSERT INTO orders (cust_id, dp_id, amount, shipping_address, pincode,num_of_item)
//      VALUES ($cust_id, $dp_id, $amount, '$addr', '$pin',$num_of_item)";

//     $cart_empty_query = "delete from cart where cust_id = $cust_id";
    
// $delivery_item_plus = "update delivery_person set total_delivery = total_delivery + 1 where dp_id =  $dp_id";

//     if (mysqli_query($con, $sql_insert_order) && mysqli_query($con, $cart_empty_query) && mysqli_query($con, $delivery_item_plus)) {
//         echo "<script>alert('Order placed successfully');</script>";
//         echo "<script> window.location.href = 'shop_page.php'; </script>";
//     } else {
//         echo "<script>alert('Error placing order');</script>";
//         echo "<script> window.location.href = 'shop_page.php'; </script>";
//     }
    
// } else {
//     echo "<script>alert('No delivery person available for the selected area');</script>";
//     echo "<script> window.location.href = 'shop_page.php'; </script>";
//         }
//     }
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
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">


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
                <option value="380013" <?php if (isset($pin) && $pin == '380013') echo 'selected'; ?>>Naranpura - 380013</option>
                <option value="380009" <?php if (isset($pin) && $pin == '380009') echo 'selected'; ?>>Navrangpura - 380009</option>
                <option value="380013" <?php if (isset($pin) && $pin == '380013') echo 'selected'; ?>>Nava Vadaj - 380013</option>
                <option value="382480" <?php if (isset($pin) && $pin == '382480') echo 'selected'; ?>>Ranip - 382480</option>
                <option value="380001" <?php if (isset($pin) && $pin == '380001') echo 'selected'; ?>>Bhadra - 380001</option>
                <option value="380002" <?php if (isset($pin) && $pin == '380002') echo 'selected'; ?>>Khanpur - 380002</option>
                <option value="380015" <?php if (isset($pin) && $pin == '380015') echo 'selected'; ?>>Ambawadi - 380015</option>
                <option value="380052" <?php if (isset($pin) && $pin == '380052') echo 'selected'; ?>>Bodakdev - 380052</option>
                <option value="380061" <?php if (isset($pin) && $pin == '380061') echo 'selected'; ?>>Chandkheda - 380061</option>
                <option value="380008" <?php if (isset($pin) && $pin == '380008') echo 'selected'; ?>>Dariapur - 380008</option>
                <option value="380025" <?php if (isset($pin) && $pin == '380025') echo 'selected'; ?>>Ghodasar - 380025</option>
                <option value="380007" <?php if (isset($pin) && $pin == '380007') echo 'selected'; ?>>Maninagar - 380007</option>
                <option value="380060" <?php if (isset($pin) && $pin == '380060') echo 'selected'; ?>>Motera - 380060</option>
                <option value="380010" <?php if (isset($pin) && $pin == '380010') echo 'selected'; ?>>Paldi - 380010</option>
                <option value="380054" <?php if (isset($pin) && $pin == '380054') echo 'selected'; ?>>Satellite - 380054</option>
                <option value="380058" <?php if (isset($pin) && $pin == '380058') echo 'selected'; ?>>Sarkhej - 380058</option>
                <option value="380051" <?php if (isset($pin) && $pin == '380051') echo 'selected'; ?>>Thaltej - 380051</option>
                <option value="382443" <?php if (isset($pin) && $pin == '382443') echo 'selected'; ?>>Vastral - 382443</option>
                <option value="380015" <?php if (isset($pin) && $pin == '380015') echo 'selected'; ?>>Vasna - 380015</option></select>

            <span class="err">* <?php echo $pin_err; ?></span><br><br> 
            
            Address <input type="text" name="addr" value="<?php 
            if (isset($addr)) {
                echo htmlspecialchars($addr); 
            }
            ?>">
            <span class="err">* <?php echo $ad_err; ?></span><br><br> 
            
            <input type="submit" name="login" value="Check out"><br>
        </form>
    </div>

</body>

</html>