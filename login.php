<?php
session_start();
require_once ("includes/connect.php");
$name_err = $email_err = $password_err = "";
// $name = $email = $password = 0;
$name = $email=$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];

        if (empty($_POST["email"])) {
            $email_err = "email is required";
        } else {
            $pettern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9_.]+\.[a-zA-Z]{2,4}$/";
            if (!preg_match("$pettern", $email)) {
                $email_err = "invalid email";
            }
        }



        if (empty($_POST["username"])) {
            $name_err = "username is required";
        } else {
            $pattern = "/^[a-zA-Z]*$/";
            if (!preg_match("$pattern", $username)) {
                $name_err = "invalid name";
            }
        }


        if (empty($_POST["password"])) {
            $password_err = "password is required";
        } else {
            $pettern = "/^[a-zA-Z0-9]{3,8}/";
            if (!preg_match("$pettern", $password)) {
                $password_err = "invalid password";
            }
        }

        if (empty($name_err) && empty($email_err) && empty($password_err)) {

            $sql = "SELECT * FROM customer WHERE username = '$username' AND email = '$email'";

            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                // Verify password
                // $hash_password = password_hash($password, PASSWORD_DEFAULT);
                if (password_verify($password, $row['password'])) {
                    // start a new session
                    $_SESSION['username_of_fashion_paradise'] = $username;
                    $_SESSION['cust_id_of_fashion_paradise'] = $row['cust_id'];
                    

                    if(isset($_SESSION["buy_product_you_selected"]))
                    {
                        $x= $_SESSION['buy_product_you_selected'];
                        echo "<script>window.location.href = 'product_details.php?single_product_id=$x'; </script>";
                    }
                    else if(isset($_SESSION["item_to_be_added_to_cart"]))
                    {
                        $x= $_SESSION['item_to_be_added_to_cart'];
                        echo "<script>window.location.href = 'product_details.php?single_product_id=$x'; </script>";
                    }
                    else if(isset($_SESSION["item_to_be_added_to_wishlist"]))
                    {
                        $x= $_SESSION['item_to_be_added_to_wishlist'];
                        echo "<script>window.location.href = 'product_details.php?single_product_id=$x'; </script>";
                    }
                    else{

                        header("Location: shop_page.php");
                    }
                    exit();
                } else {
                    echo "<script>alert('incorrect Password');</script>";
                }
            } else {
                // echo "User not found";
                echo "<script>alert('User not found');</script>";
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
        input[type=email],
        input[type=password],
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

        <h1>Log in </h1>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            Username: <input type="text" name="username" value="<?php

            if (isset($username)) {
                echo $username;
            }

            ?>">
            <span class="err">*<?php echo $name_err; ?></span><br><br>

            Email: <input type="text" name="email" >


            <span class="err">*<?php echo $email_err; ?></span><br><br>

            Password: <input type="password" name="password">
            <span class="err">*<?php echo $password_err; ?></span><br><br>
            <input type="submit" name="login" value="login"><br>
            <p>not registred ? <a href="signup.php">sign up </a></p>
        </form>

    </div>

</body>

</html>


