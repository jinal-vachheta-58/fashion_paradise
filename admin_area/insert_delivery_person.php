<?php
session_start();
include("../includes/connect.php");

if (!isset($_SESSION["admin_of_fashion_paradise"])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert_delivery_person"])) {
    // Checking empty condition
    if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["area_1"]) || empty($_POST["area_2"]) || empty($_POST["area_3"]) || empty($_POST["area_4"]) || empty($_POST["salary"])) {
        echo "<script>alert('Please fill all the fields');</script>";
    } 
    
    else if (!preg_match("/^.{6,}$/", $_POST["area_1"]) || !preg_match("/^.{6,}$/", $_POST["area_2"]) || !preg_match("/^.{6,}$/", $_POST["area_3"]) || !preg_match("/^.{6,}$/", $_POST["area_4"])) {
        echo "<script>alert('All area fields must be at least 6 characters long');</script>";
    } 
    else {
        $password = '123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $username = $_POST["name"];
        $email = $_POST["email"];
        $order_area_1 = $_POST["area_1"];
        $order_area_2 = $_POST["area_2"];
        $order_area_3 = $_POST["area_3"];
        $order_area_4 = $_POST["area_4"];
        $salary = $_POST["salary"];

        // Insert query
        $insert_query = "INSERT INTO delivery_person (username, email, d_password, order_area_1, order_area_2, order_area_3, order_area_4, join_date, total_delivery, salary) VALUES ('$username', '$email', '$hashed_password', '$order_area_1', '$order_area_2', '$order_area_3', '$order_area_4', NOW(), '0', '$salary')";

        $result = mysqli_query($con, $insert_query);

        if ($result) {
            echo "<script>alert('Successfully inserted');</script>";
        } else {
            echo "<script>alert('Person insertion unsuccessful');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Delivery Person - Admin Dashboard</title>
    <link rel="stylesheet" href="../bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Delivery Person</h1>
        <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="area_1" class="form-label">Area 1:</label>
                <input type="text" name="area_1" id="area_1" class="form-control" placeholder="Enter area 1" required>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="area_2" class="form-label">Area 2:</label>
                <input type="text" name="area_2" id="area_2" class="form-control" placeholder="Enter area 2" required>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="area_3" class="form-label">Area 3:</label>
                <input type="text" name="area_3" id="area_3" class="form-control" placeholder="Enter area 3" required>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="area_4" class="form-label">Area 4:</label>
                <input type="text" name="area_4" id="area_4" class="form-control" placeholder="Enter area 4" required>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="salary" class="form-label">Salary:</label>
                <input type="text" name="salary" id="salary" class="form-control" placeholder="Enter salary" required>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" value="Insert Delivery Person" name="insert_delivery_person" class="btn btn-info mb-3 px-3">
            </div>
        </form>
    </div>
</body>
</html>
