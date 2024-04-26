<?php
include("./includes/connect.php");
$con = mysqli_connect("localhost","root","","fashion_paradise");


function get_products()
{
    global $con;

//  condition to check isset or not
if (!isset($_GET['category_id'])) {


    $select_query = "select * from products order by rand()";
$result_select_query = mysqli_query($con, $select_query);
// $row = mysqli_fetch_assoc($result_select_query);

while ($row = mysqli_fetch_assoc($result_select_query)) {
    $product_id = $row['product_id'];
    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    // $product_keywords = $row['product_keywords'];
    $product_image = $row['product_image'];
    $product_price = $row['product_price'];
    $cat_id = $row['cat_id'];
    // $product_id = $row['product_id'];
    echo "<div class='col-md-4 mb-2'>


    <div class='card h-100' style='width: 18rem;'>
      <img class='card-img-top' src='./admin_area/product_images/$product_image' alt='$product_title'>
      <div class='card-body'>
        <h5 class='card-title'>$product_title</h5>
        <p class='card-text'>$product_description</p>
        <a href='#' class='btn btn-secondary col-4'>add to cart</a>
        <a href='#' class='btn btn-secondary col-4'> add to wishlist</a>
        <a href='#' class='btn btn-secondary col-4'>buy</a>
        <a href='#' class='btn btn-secondary col-4'>details</a>
      </div>
    </div>
    </div>";
}

}
}


// getting unique categories

function get_unique_categories()
{
    global $con;

//  condition to check isset or not
if (isset($_GET['category_id'])) {
    
$category_id = $_GET['category_id'];
    $select_query = "select * from products where cat_id = $category_id";
$result_select_query = mysqli_query($con, $select_query);
$num_rows = mysqli_num_rows($result_select_query);
if($num_rows == 0)
{
    echo "<h2 class='text-center text-danger m-auto mt-5'>no stock for this category </h2>";
}
// $row = mysqli_fetch_assoc($result_select_query);

while ($row = mysqli_fetch_assoc($result_select_query)) {
    $product_id = $row['product_id'];
    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    // $product_keywords = $row['product_keywords'];
    $product_image = $row['product_image'];
    $product_price = $row['product_price'];
    $cat_id = $row['cat_id'];
    // $product_id = $row['product_id'];
    echo "<div class='col-md-4 mb-2'>


    <div class='card h-100' style='width: 18rem;'>
      <img class='card-img-top' src='./admin_area/product_images/$product_image' alt='$product_title'>
      <div class='card-body'>
        <h5 class='card-title'>$product_title</h5>
        <p class='card-text'>$product_description</p>
        <a href='#' class='btn btn-secondary col-4'>add to cart</a>
        <a href='#' class='btn btn-secondary col-4'> add to wishlist</a>
        <a href='#' class='btn btn-secondary col-4'>buy</a>
        <a href='#' class='btn btn-secondary col-4'>details</a>
      </div>
    </div>
    </div>";
}

}
}


function display_category()
{
    global $con;
    $select_category_query = "select * from category";
    $result_select_category = mysqli_query($con, $select_category_query);
    // $row_data = mysqli_fetch_assoc($result_select_category);
// echo" <br> ".$row_data["cat_id"]." -> ".$row_data['cat_name'];
    
    while ($row_category = mysqli_fetch_assoc($result_select_category)) {
        $category_id = $row_category["cat_id"];
        $category_name = $row_category["cat_name"];
        echo "<li class=nav-item bg-info'>
        <a href='shop_page.php?category_id=$category_id' class='nav-link text-dark'>
        $category_name
        </a>
        </li>";
    }
}


// search data 
function search_data()
{
    global $con;
    if(isset($_GET["serch_data_product"]))
    {

    $user_search_data_value = $_GET["search_data"];
$select_query = "select * from products where product_keywords like '%$user_search_data_value%'";
        // $select_query = "select * from products order by rand()";
    $result_select_query = mysqli_query($con, $select_query);
    // $row = mysqli_fetch_assoc($result_select_query);
    
    while ($row = mysqli_fetch_assoc($result_select_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        // $product_keywords = $row['product_keywords'];
        $product_image = $row['product_image'];
        $product_price = $row['product_price'];
        $cat_id = $row['cat_id'];
        // $product_id = $row['product_id'];
        echo "<div class='col-md-4 mb-2'>
    
    
        <div class='card h-100' style='width: 18rem;'>
          <img class='card-img-top' src='./admin_area/product_images/$product_image' alt='$product_title'>
          <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <a href='#' class='btn btn-secondary col-4'>add to cart</a>
            <a href='#' class='btn btn-secondary col-4'> add to wishlist</a>
            <a href='#' class='btn btn-secondary col-4'>buy</a>
            <a href='#' class='btn btn-secondary col-4'>details</a>
          </div>
        </div>
        </div>";
    }
    
    }
}
?>