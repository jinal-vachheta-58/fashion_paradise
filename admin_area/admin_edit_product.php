<?php


session_start();
include ("../includes/connect.php");
if (!isset($_SESSION["admin_of_fashion_paradise"])) {

    echo "<script> alert('Please login first.'); window.location.href = 'admin_login.php'; </script>";

    exit;

}
if (!isset($_GET["pro_id"])) {

    echo "<script> alert('Error in fetching product.'); window.location.href = 'admin_manage_products.php'; </script>";

    exit;

}
else{
    $product_id = (int)$_GET["pro_id"];
    $query="select * from products where product_id=$product_id";
    $res=mysqli_query($con,$query);
    $arrres=mysqli_fetch_assoc($res);
    if (($_SERVER["REQUEST_METHOD"]) == "POST") {

        if (isset($_POST["submit"])) {
    
            if (empty($_POST["product_title"]) || empty($_POST["product_description"]) || empty($_POST["product_keywords"]) || empty($_POST["product_category"]) || empty($_POST["product_price"]) )
            {
                echo "<script> alert('please fill the all the fields') window.location.href = 'admin_manage_products.php'; </script>";
                // exit();
            } else {
                $product_title = $_POST["product_title"];
                $description = $_POST["product_description"];
                $product_keywords = $_POST["product_keywords"];
                $product_category = $_POST["product_category"];
                $product_price = $_POST["product_price"];
                // image name 
                $product_image_name = $_FILES["product_image"]["name"];
                $temp_name = $_FILES["product_image"]["tmp_name"];
    
                if(!empty($product_image_name))
                {
                    move_uploaded_file($temp_name, "./product_images/$product_image_name");
                    $image_query="product_image = '$product_image_name',";    
                }
                else{
                    $image_query = "";
                }
                $update_query = "UPDATE products SET 
                product_title = '$product_title',
                product_description = '$description',
                product_keywords = '$product_keywords',
                cat_id = '$product_category',
                $image_query
                product_price = $product_price 
                WHERE product_id = $product_id";

            $result = mysqli_query($con, $update_query);

            if ($result) {
                // header("location:admin_manage_products.php");
                echo "<script> alert('Successfully updated.'); window.location.href = 'admin_manage_products.php'; </script>";
            } else {
                echo "<script> alert('Product update unsuccessful.'); window.location.href = 'admin_manage_products.php'; </script>";
            }
                
            }
        }
    }
    
    
}


?>

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
<body>
<div class="container mt-3">
        <h1 class="text-center">
            Edit Product
        </h1>

        <!-- form -->
        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">

            <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control"
                    placeholder="Enter product title" required="required" 
                    value="<?php echo htmlspecialchars($arrres['product_title']); ?>">
            </div>

            <!-- description  -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product description</label>
                <input type="text" name="product_description" id="description" class="form-control"
                    placeholder="Enter product description" required="required"
                    value="<?php echo htmlspecialchars($arrres['product_description']); ?>">
            </div>

            <!-- keywords  -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control"
                    placeholder="Enter product keywords" required="required"
                    value="<?php echo htmlspecialchars($arrres['product_keywords']); ?>">
            </div>

            <!-- categiry select for product  -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select"
                    value="<?php echo htmlspecialchars($arrres['cat_id']); ?>"> 
                    <option value="">select a category</option>

                    <?php
                    $select_query = "select * from category";
                    $result = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $category_id = $row['cat_id'];
                        $category_name = $row['cat_name'];
                        $selected = $category_id == $arrres['cat_id'] ? 'selected' : '';
                        echo "<option value='$category_id' $selected>$category_name</option>";
                    }
                    ?>
                </select>
            </div>


            <!-- image  -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image" class="form-label">Product image</label>
                <input type="file" name="product_image" id="product_image" class="form-control">
                <p>current image: <?php echo htmlspecialchars($arrres["product_image"]);?></p>
            </div>

            <!-- price  -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="number" name="product_price" id="product_price" class="form-control"
                    placeholder="Enter product price" required="required"
                    value="<?php echo htmlspecialchars($arrres['product_price']); ?>">
            </div>


            <!-- submit  -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" value="Edit product" name="submit" class="btn btn-info mb-3 px-3">
            </div>

        </form>

    </div>
</body>
</html>