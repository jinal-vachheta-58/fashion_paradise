<?php
// session_start();
// include("../includes/connect.php");

// // Check if admin is not logged in
// if (!isset($_SESSION["admin_of_fashion_paradise"])) {
//     echo "<script> alert('You need to be logged in as an admin to access this page.'); window.location.href='admin_login.php'; </script>";
//     exit();
// }
// $row = "";
// // Fetching category details for editing
// if (isset($_GET['cat_id'])) {
//     $edit_id = $_GET['cat_id'];
//     $select_query = "SELECT * FROM category WHERE cat_id = '$edit_id'";
//     $result = mysqli_query($con, $select_query);
//     $row = mysqli_fetch_assoc($result);
//     if (!$row) {
//         echo "<script> alert('Category not found.'); window.location.href='admin_manage_products.php'; </script>";
//         exit();
//     }
// }

// // Handling form submission for updating category
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (isset($_POST["update_category"])) {
//         $edit_id = $_POST['edit_id'];
//         $cat_name = $_POST["cat_name"];
//         $discount = $_POST["discount"];
//         $c_i = $_FILES["cat_image"]["name"];


//         if (empty($_POST["cat_name"]) || empty($_POST["discount"])) {
//             echo "<script> alert('Please fill the fields.'); </script>";
//         }
//         else{
//             $image_query = "";
//             if (!empty($c_i)) {
//                 move_uploaded_file($temp_name, "../photos/$c_i");
//                 $image_query = "cat_pic = '$c_i',";
//             }

//             $update_query = "UPDATE category SET 
//                              cat_name = '$cat_name',
//                              discount = '$discount',
//                              $image_query
//                              WHERE cat_id = '$edit_id'";
//         //     if(!empty($cat_image))
//         //     {
//         //         move_uploaded_file($temp_name, "../photos/$c_i");
//         //         $image_query="cat_pic = '$c_i',";    
//         //     }
//         //     else{
//         //         $image_query = "";
//         //     }
//         // $update_query = "UPDATE category SET 
//         // cat_name = '$cat_name',
//         // discount = '$discount',
//         // $image_query
//         // WHERE cat_id = $edit_id";

//         $result = mysqli_query($con, $update_query);

//         if ($result) {
//         // header("location:admin_manage_products.php");
//         echo "<script> alert('Successfully updated.'); window.location.href = 'admin_manage_products.php'; </script>";
//         } else {
//         echo "<script> alert('Product update unsuccessful.'); window.location.href = 'admin_manage_products.php'; </script>";
//         }
//         }
        
//         // // Check if image is being updated
//         // if (!empty($_FILES["cat_image"]["name"])) {
//         //     $cat_image_name = $_FILES["cat_image"]["name"];
//         //     $temp_name = $_FILES["cat_image"]["tmp_name"];

//         //     // Upload new image and update database
//         //     move_uploaded_file($temp_name, "./category_images/$cat_image_name");

//         //     $update_query = "UPDATE category SET cat_name = '$cat_name', cat_image = '$cat_image_name', discount = '$discount' WHERE cat_id = '$edit_id'";
//         // } else {
//         //     // Update without changing image
//         //     $update_query = "UPDATE category SET cat_name = '$cat_name', discount = '$discount' WHERE cat_id = '$edit_id'";
//         // }

//         // $result = mysqli_query($con, $update_query);

//         // if ($result) {
//         //     echo "<script> alert('Category updated successfully.'); window.location.href='admin_manage_products.php'; </script>";
//         // } else {
//         //     echo "<script> alert('Failed to update category.'); </script>";
//         // }
//     }
// }
?>

<?php
// session_start();
// include("../includes/connect.php");

// // Check if admin is not logged in
// if (!isset($_SESSION["admin_of_fashion_paradise"])) {
//     echo "<script> alert('You need to be logged in as an admin to access this page.'); window.location.href='admin_login.php'; </script>";
//     exit();
// }

// $row = "";

// // Fetching category details for editing
// if (isset($_GET['cat_id'])) {
//     $edit_id = $_GET['cat_id'];
//     $select_query = "SELECT * FROM category WHERE cat_id = '$edit_id'";
//     $result = mysqli_query($con, $select_query);
//     $row = mysqli_fetch_assoc($result);
//     if (!$row) {
//         echo "<script> alert('Category not found.'); window.location.href='admin_manage_products.php'; </script>";
//         exit();
//     }
// }

// // Handling form submission for updating category
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (isset($_POST["update_category"])) {
//         $edit_id = $_POST['edit_id'];
//         $cat_name = $_POST["cat_name"];
//         $discount = $_POST["discount"];
        
//         // Handle image upload
//         $c_i = $_FILES["cat_image"]["name"];
//         $temp_name = $_FILES["cat_image"]["tmp_name"];

//         if (empty($_POST["cat_name"]) || empty($_POST["discount"])) {
//             echo "<script> alert('Please fill all fields.'); </script>";
//         } else {
//             $image_query = "";
//             if (!empty($c_i)) {
//                 move_uploaded_file($temp_name, "../photos/$c_i");
//                 $image_query = "cat_pic = '$c_i',";
//             }

//             $update_query = "UPDATE category SET 
//                              cat_name = '$cat_name',
//                              discount = '$discount',
//                              $image_query
//                              WHERE cat_id = '$edit_id'";

//             $result = mysqli_query($con, $update_query);

//             if ($result) {
//                 echo "<script> alert('Successfully updated.'); window.location.href = 'admin_manage_products.php'; </script>";
//             } else {
//                 echo "<script> alert('Product update unsuccessful.'); window.location.href = 'admin_manage_products.php'; </script>";
//             }
//         }
//     }
// }
?>
<?php
session_start();
include("../includes/connect.php");

// Check if admin is not logged in
if (!isset($_SESSION["admin_of_fashion_paradise"])) {
    echo "<script> alert('You need to be logged in as an admin to access this page.'); window.location.href='admin_login.php'; </script>";
    exit();
}

$row = "";

// Fetching category details for editing
if (isset($_GET['cat_id'])) {
    $edit_id = mysqli_real_escape_string($con, $_GET['cat_id']);
    $select_query = "SELECT * FROM category WHERE cat_id = '$edit_id'";
    $result = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        echo "<script> alert('Category not found.'); window.location.href='admin_manage_products.php'; </script>";
        exit();
    }
}

// Handling form submission for updating category
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_category"])) {
    $edit_id = mysqli_real_escape_string($con, $_POST['edit_id']);
    $cat_name = mysqli_real_escape_string($con, $_POST["cat_name"]);
    $discount = mysqli_real_escape_string($con, $_POST["discount"]);
    
    // Handle image upload
    $c_i = $_FILES["cat_image"]["name"];
    $temp_name = $_FILES["cat_image"]["tmp_name"];

    // Check if image file is provided
    if (!empty($c_i)) {
        // Move uploaded image to destination folder
        move_uploaded_file($temp_name, "../photos/$c_i");
        $c_i = mysqli_real_escape_string($con, $c_i);
        $image_query = "cat_pic = '$c_i',";
    } else {
        $image_query = "";
    }

    // Update query
    $update_query = "UPDATE category SET 
                     cat_name = '$cat_name',
                     $image_query
                     discount = '$discount'
                     WHERE cat_id = $edit_id";

    $result = mysqli_query($con, $update_query);

    if ($result) {
        echo "<script> alert('Successfully updated.'); window.location.href = 'admin_manage_category.php'; </script>";
    } else {
        echo "<script> alert('Product update unsuccessful.'); window.location.href = 'admin_manage_category.php'; </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Edit Category</h1>

        <!-- Form for editing category -->
        <form action="" method="post" enctype="multipart/form-data" autocomplete="on" class="w-50 m-auto">
            <input type="hidden" name="edit_id" value="<?php echo htmlspecialchars($row['cat_id']); ?>">

            <!-- Category Name -->
            <div class="form-outline mb-4">
                <label for="cat_name" class="form-label">Category Name</label>
                <input type="text" name="cat_name" id="cat_name" class="form-control"
                    value="<?php echo htmlspecialchars($row['cat_name']); ?>" required>
            </div>

            <!-- Category Image -->
            <div class="form-outline mb-4">
                <label for="cat_image" class="form-label">Category Image</label>
                <input type="file" name="cat_image" id="cat_image" class="form-control">
                <p>Current Image: <?php echo htmlspecialchars($row["cat_pic"]); ?></p>
            </div>

            <!-- Discount -->
            <div class="form-outline mb-4">
                <label for="discount" class="form-label">Discount (%)</label>
                <input type="text" name="discount" id="discount" class="form-control"
                    value="<?php echo htmlspecialchars($row['discount']); ?>" required>
            </div>

            <!-- Submit Button -->
            <div class="form-outline mb-4">
                <input type="submit" value="Update Category" name="update_category" class="btn btn-info mb-3 px-3">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
