<?php
session_start();
include ("../includes/connect.php");

// if (isset($_POST["go_to_index_page"])) {
//     header("index.php");
// }
// Check if admin is not logged in
if (!isset($_SESSION["admin_of_fashion_paradise"])) {
    // echo "<p>You need to be logged in as an admin to access this page.</p>";
    header("Location: admin_login.php");
    exit();
}

if (($_SERVER["REQUEST_METHOD"]) == "POST") {

    if (isset($_POST["insert_product"])) {

        // checking empty condition
        if (empty($_POST["product_title"]) || empty($_POST["description"]) || empty($_POST["product_keywords"]) || empty($_POST["product_category"]) || empty($_POST["product_price"]) || empty($_FILES["product_image"]["name"]))
        // if (empty($_POST["product_title"]) || empty($_POST["product_keywords"]) || empty($_POST["product_category"]) || empty($_POST["product_price"]) || empty($_FILES["product_image"]["name"])) 
        {
            echo "<script> alert('please fill the all the fields')  </script>";
            // exit();
        } else {

            $product_title = $_POST["product_title"];
            $description = $_POST["description"];
            $product_keywords = $_POST["product_keywords"];
            $product_category = $_POST["product_category"];
            $product_price = $_POST["product_price"];
            // image name 
            $product_image_name = $_FILES["product_image"]["name"];
            $temp_name = $_FILES["product_image"]["tmp_name"];


            move_uploaded_file($temp_name, "./product_images/$product_image_name");

            // insert query 
            $insert_query = "insert into products (product_title,product_description,product_keywords,cat_id,product_image,product_price,date,status) values('$product_title','$description','$product_keywords','$product_category','$product_image_name','$product_price',NOW(),'true')";

            $result = mysqli_query($con, $insert_query);
            if ($result) {
                echo "<script> alert('successfully inserted '); window.location.href= 'admin_manage_products.php';</script>";
                // header("index.php");
            } else {
                echo "<script> alert('product insertion unsuccessfull. '); window.location.href= 'admin_manage_products.php';</script>";
                // header("index.php");
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
    <title>Insert product-admin dashboard</title>

    <!-- bootstrap link -->
    <link rel="stylesheet" href="../bootstrap.css">

    <!-- font awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">
            Insert product
        </h1>

        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data" autocomplete="off">

            <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control"
                    placeholder="Enter product title" required="required">
            </div>

            <!-- description  -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product description</label>
                <input type="text" name="description" id="description" class="form-control"
                    placeholder="Enter product description" required="required">
            </div>

            <!-- keywords  -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control"
                    placeholder="Enter product keywords" required="required">
            </div>

            <!-- categiry select for product  -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">select a category</option>

                    <?php
                    $select_query = "select * from category";
                    $result = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $category_id = $row['cat_id'];
                        $category_name = $row['cat_name'];
                        echo "<option value='$category_id'>$category_name</option>";
                    }
                    ?>
                </select>
            </div>


            <!-- image  -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image" class="form-label">Product image</label>
                <input type="file" name="product_image" id="product_image" class="form-control" required="required">
            </div>

            <!-- price  -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="number" name="product_price" id="product_price" class="form-control"
                    placeholder="Enter product price" required="required">
            </div>


            <!-- submit  -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" value="insert product" name="insert_product" class="btn btn-info mb-3 px-3">
            </div>

        </form>

    </div>
    <!-- <button type="button" class="btn btn-secondary m-auto"> <a href="index.php">Secondary</a></button> -->
</body>

</html>