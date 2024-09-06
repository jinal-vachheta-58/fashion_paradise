<?php
// session_start();
// include ("../includes/connect.php");

// // if (isset($_POST["go_to_index_page"])) {
// //     header("index.php");
// // }
// // Check if admin is not logged in
// if (!isset($_SESSION["admin_of_fashion_paradise"])) {
//     // echo "<p>You need to be logged in as an admin to access this page.</p>";
//     echo "<script> alert('please fill the all the fields'); window.location.href='admin_login.php';  </script>";
    
//     exit();
// }

// if (($_SERVER["REQUEST_METHOD"]) == "POST") {

//     if (isset($_POST["insert_product"])) {

//         // checking empty condition
//         if (empty($_POST["product_title"]) || empty($_POST["description"]) || empty($_POST["product_keywords"]) || empty($_POST["product_category"]) || empty($_POST["product_price"]) || empty($_FILES["product_image"]["name"]))
//         // if (empty($_POST["product_title"]) || empty($_POST["product_keywords"]) || empty($_POST["product_category"]) || empty($_POST["product_price"]) || empty($_FILES["product_image"]["name"])) 
//         {
//             echo "<script> alert('please fill the all the fields')  </script>";
//             // exit();
//         } else {

//             $product_title = $_POST["product_title"];
//             $description = $_POST["description"];
//             $product_keywords = $_POST["product_keywords"];
//             $product_category = $_POST["product_category"];
//             $product_price = $_POST["product_price"];
//             // image name 
//             $product_image_name = $_FILES["product_image"]["name"];
//             $temp_name = $_FILES["product_image"]["tmp_name"];


//             move_uploaded_file($temp_name, "./product_images/$product_image_name");

//             // insert query 
//             $insert_query = "insert into products (product_title,product_description,product_keywords,cat_id,product_image,product_price,date,status) values('$product_title','$description','$product_keywords','$product_category','$product_image_name','$product_price',NOW(),'true')";

//             $result = mysqli_query($con, $insert_query);
//             if ($result) {
//                 echo "<script> alert('successfully inserted ') </script>";
//                 // header("index.php");
//             } else {
//                 echo "<script> alert('product insertion unsuccessfull. ') </script>";
//                 // header("index.php");
//             }
//         }
//     }
// }


?>

<?php
session_start();
include ("../includes/connect.php");

// Check if admin is not logged in
if (!isset($_SESSION["admin_of_fashion_paradise"])) {
    echo "<script> alert('Please log in as an admin to access this page.'); window.location.href='admin_login.php'; </script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["insert_category"])) {
        // Checking empty condition
        if (empty($_POST["category_name"]) || empty($_FILES["cat_i"]["name"]) || empty($_POST["discount"])) {
            echo "<script> alert('Please fill all the fields.'); </script>";
        } else {
            $category_name = $_POST["category_name"];
            $category_discount = $_POST["discount"];
            $cat_i = $_FILES["cat_i"]["name"];
            $temp_name = $_FILES["cat_i"]["tmp_name"];
            // Insert query 

            move_uploaded_file($temp_name, "../photos/$cat_i");

            $insert_query = "INSERT INTO category (cat_name, cat_pic,discount) VALUES ('$category_name', '$cat_i', '$category_discount')";

            $result = mysqli_query($con, $insert_query);
            if ($result) {
                echo "<script> alert('Category successfully inserted.'); window.location.href='admin_manage_category.php'; </script>";
            } else {
                echo "<script> alert('Category insertion unsuccessful.');  window.location.href='admin_manage_category.php'; </script>";
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
    <title>Insert Category - Admin Dashboard</title>

    <!-- Bootstrap link -->
    <link rel="stylesheet" href="../bootstrap.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">
            Insert Category
        </h1>

        <!-- Form -->
        <form action="" method="post" autocomplete="on" enctype="multipart/form-data">

            <!-- Category Name -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control"
                    placeholder="Enter category name" required="required">
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label class="form-label">category image</label>
                <input type="file" name="cat_i" id="product_image" class="form-control" required="required">
            </div>

            <!-- Category discount -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="category_description" class="form-label">Category Description</label>
                <input type="text" name="discount" id="category_description" class="form-control"
                    placeholder="Enter category discount like 30-40%" required="required">
            </div>

            <!-- Submit -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" value="Insert Category" name="insert_category" class="btn btn-info mb-3 px-3">
            </div>

        </form>
    </div>
</body>

</html>