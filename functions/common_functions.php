<?php
// session_start();
include ("includes/connect.php");
$con = mysqli_connect("localhost", "root", "", "fashion_paradise");


function index_category_display()
{
  global $con;
  $select_query = "SELECT * FROM category ORDER BY rand() ";
  $result_select_query = mysqli_query($con, $select_query);

  while ($row = mysqli_fetch_assoc($result_select_query)) {
    $cat_id = $row['cat_id'];
      $cat_name = $row['cat_name'];
      $cat_pic = $row['cat_pic'];
      $discount = $row['discount'];
  echo '<div class="col text-center">
  <div class="card h-100">
      <img src="photos/'.$cat_pic.'" class="card-img-top" alt="...">
      <div class="card-body">
          <h5 class="card-title">'.$cat_name.'</h5>
          <h3 class="card-text">'.$discount.'</h3>
      </div>
      <div class="card-footer">
          <small class="text-body-secondary"><a href=shop_page.php?category_id='.$cat_id.' class="nav-link text-dark">SHOP NOW</a></small>
      </div>
  </div>
</div>';
  }
}
 

function get_products()
{
  global $con;

  //  condition to check isset or not
  if (!isset($_GET['category_id'])) {

    $select_query = "SELECT * FROM products ORDER BY rand() ";
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
        <p class='card-text text-danger'>Rs $product_price</p>

        <a href='shop_page.php?add_to_cart=$product_id' class='fun btn btn-secondary col-4 mb-2'>Cart</a>
        <a href='shop_page.php?add_to_wishlist=$product_id' class='fun btn btn-secondary col-4 mb-2'>Wishlist</a>
        <a href='buy_single_product.php?buy_single_product=$product_id' class='fun btn btn-secondary col-4'>Buy</a>
        <a href='product_details.php?single_product_id=$product_id' class='fun btn btn-secondary col-4'>Details</a>
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
    if ($num_rows == 0) {
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
        <p class='card-text text-danger'>Rs $product_price</p>
        <a href='shop_page.php?add_to_cart=$product_id' class='fun btn btn-secondary col-4 mb-2'>Cart</a>
        <a href='shop_page.php?add_to_wishlist=$product_id' class='btn btn-secondary col-4 mb-2'>Wishlist</a>
        <a href='buy_single_product.php?buy_single_product=$product_id' class='btn btn-secondary col-4'>Buy</a>
        <a href='product_details.php?single_product_id=$product_id' class='btn btn-secondary col-4'>Details</a>
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
  if (isset($_GET["search_data_product"])) {

    $user_search_data_value = $_GET["search_data"];

    $search_terms = explode(" ", $user_search_data_value);
    $like_conditions = array();

    foreach ($search_terms as $term) {
      $like_conditions[] = "product_keywords LIKE '%$term%'";
    }

    $like_query = implode(" OR ", $like_conditions);

    $select_query = "SELECT * FROM products WHERE $like_query";
    // $select_query = "select * from products where product_keywords like '%$user_search_data_value%'";
    // $select_query = "select * from products order by rand()";
    $result_select_query = mysqli_query($con, $select_query);
    // $row = mysqli_fetch_assoc($result_select_query);


    if (mysqli_num_rows($result_select_query) > 0) {
      // Display products
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
            <p class='card-text text-danger'>Rs $product_price</p>
            <a href='shop_page.php?add_to_cart=$product_id' class='fun btn btn-secondary col-4 mb-2'>Cart</a>
            <a href='shop_page.php?add_to_wishlist=$product_id' class='btn btn-secondary col-4 mb-2'>Wishlist</a>
            <a href='buy_single_product.php?buy_single_product=$product_id' class='btn btn-secondary col-4'>Buy</a>
            <a href='product_details.php?single_product_id=$product_id' class='btn btn-secondary col-4'>Details</a>
          </div>
        </div>
        </div>";
      }
    } else {
      echo "<h2 class='text-center text-danger m-auto mt-5'>no stock for this search </h2>";
    }



  }

}

function get_all_products()
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
        <p class='card-text text-danger'>Rs $product_price</p>
        <a href='shop_page.php?add_to_cart=$product_id' class='fun btn btn-secondary col-4 mb-2'>Cart</a>
        <a href='shop_page.php?add_to_wishlist=$product_id' class='btn btn-secondary col-4 mb-2'>Wishlist</a>
        <a href='buy_single_product.php?buy_single_product=$product_id' class='btn btn-secondary col-4'>Buy</a>
        <a href='product_details.php?single_product_id=$product_id' class='btn btn-secondary col-4'>Details</a>
      </div>
    </div>
    </div>";
    }

  }
}



// cart function 
function cart() {
  if (isset($_GET['add_to_cart'])) {
        if (isset($_SESSION["username_of_fashion_paradise"]) && isset($_SESSION["cust_id_of_fashion_paradise"])) {
          global $con;

          // get product id
          $get_product_id = (int) $_GET['add_to_cart'];

          // get cust id
          $cust_id = (int) $_SESSION['cust_id_of_fashion_paradise'];

          $select_query = "SELECT * FROM cart WHERE cust_id = $cust_id AND product_id = $get_product_id";
          $result_select_query = mysqli_query($con, $select_query);

          if (mysqli_num_rows($result_select_query) > 0) {
              echo "<script> alert('This item is already present in your cart.') </script>";
          } else {
              $insert_query = "INSERT INTO cart (product_id, cust_id, qty) VALUES ($get_product_id, $cust_id, 1)";
              $result_insert_query = mysqli_query($con, $insert_query);

              if ($result_insert_query) {
                  echo "<script> alert('Item added to cart.') </script>";
              } else {
                  echo "<script> alert('Failed to add item to cart.') </script>";
              }
          }

          echo "<script> window.open('shop_page.php', '_self') </script>";
      } else{
        echo "<script> alert('Please login so you can add to cart.'); window.location.href = 'login.php'; </script>";
  
      }
  }
}



// whishlist function
function wishlist()
{
  if (isset($_GET['add_to_wishlist'])) {
      if (isset($_SESSION["username_of_fashion_paradise"]) && isset($_SESSION["cust_id_of_fashion_paradise"])) {
        global $con;

        // get product id
        $get_product_id = (int) $_GET['add_to_wishlist'];

        // get cust id
        $cust_id = (int) $_SESSION['cust_id_of_fashion_paradise'];

        $select_query = "SELECT * FROM wishlist WHERE cust_id = $cust_id AND product_id = $get_product_id";
        $result_select_query = mysqli_query($con, $select_query);

        if (mysqli_num_rows($result_select_query) > 0) {
            echo "<script> alert('This item is already present in your wishlist.') </script>";
        } else {
            $insert_query = "INSERT INTO wishlist (product_id, cust_id) VALUES ($get_product_id, $cust_id)";
            $result_insert_query = mysqli_query($con, $insert_query);

            if ($result_insert_query) {
                echo "<script> alert('Item added to wishlist.') </script>";
            } else {
                echo "<script> alert('Failed to add item to wishlist.') </script>";
            }
        }

        echo "<script> window.open('shop_page.php', '_self') </script>";
    }
    else {
      echo "<script> alert('Please login so you can add to wishlist.'); window.location.href = 'login.php'; </script>";
  
    }
} 
}


// get_cart_products
function get_cart_products()
{
  $cust_id = (int) $_SESSION['cust_id_of_fashion_paradise'];
  global $con;
    $select_query = "SELECT c.product_id, c.qty, p.product_title, p.product_description, p.product_price, p.product_image 
    FROM cart c 
    JOIN products p ON c.product_id = p.product_id 
    WHERE c.cust_id = $cust_id";
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
      // $cat_id = $row['cat_id'];
      // $product_id = $row['product_id'];
      echo "<div class='col-md-4 mb-2'>
    <div class='card h-100' style='width: 18rem;'>
      <img class='card-img-top' src='./admin_area/product_images/$product_image' alt='$product_title'>
      <div class='card-body'>
        <h5 class='card-title'>$product_title</h5>
        <p class='card-text'>$product_description</p>
        <p class='card-text text-danger'>Rs $product_price</p>

        <a href='cust_cart.php?remove_from_cart=$product_id' class='fun btn btn-secondary col-4 mb-2'>Remove</a>
        <a href='cust_cart.php?add_to_wishlist=$product_id&remove_from_cart=$product_id' class='fun btn btn-secondary col-4 mb-2'>Wishlist</a>
        <a href='buy_single_product.php?buy_single_product=$product_id' class='fun btn btn-secondary col-4'>Buy</a>
        <a href='product_details.php?single_product_id=$product_id' class='fun btn btn-secondary col-4'>Details</a>
      </div>
    </div>
    </div>";
    }

  }


  // get_wishlist_products
  function get_wishlist_products()
  {
    $cust_id = (int) $_SESSION['cust_id_of_fashion_paradise'];
    global $con;
      $select_query = "SELECT c.product_id, p.product_title, p.product_description, p.product_price, p.product_image 
      FROM wishlist c 
      JOIN products p ON c.product_id = p.product_id 
      WHERE c.cust_id = $cust_id";
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
        // $cat_id = $row['cat_id'];
        // $product_id = $row['product_id'];
        echo "<div class='col-md-4 mb-2'>
      <div class='card h-100' style='width: 18rem;'>
        <img class='card-img-top' src='./admin_area/product_images/$product_image' alt='$product_title'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_description</p>
          <p class='card-text text-danger'>Rs $product_price</p>
  
          <a href='cust_wishlist.php?remove_from_wishlist=$product_id' class='fun btn btn-secondary col-12 mb-2'>Remove from whishlist</a>
          <a href='cust_wishlist.php?remove_from_wishlist=$product_id&add_to_cart=$product_id' class='fun btn btn-secondary col-12 mb-2'>move to Cart</a>
          
        </div>
      </div>
      </div>";
      
      }
  
  }

  function remove_from_cart()
  {
    if (isset($_GET['remove_from_cart'])) {
      if (isset($_SESSION["username_of_fashion_paradise"]) && isset($_SESSION["cust_id_of_fashion_paradise"])) {
        global $con;

        // get product id
        $get_product_id = (int) $_GET['remove_from_cart'];

        // get cust id
        $cust_id = (int) $_SESSION['cust_id_of_fashion_paradise'];

        $select_query = "SELECT * FROM cart WHERE cust_id = $cust_id AND product_id = $get_product_id";
        $result_select_query = mysqli_query($con, $select_query);

        if (mysqli_num_rows($result_select_query) > 0) {
          $remove_query = "delete from cart Where cust_id = $cust_id AND product_id = $get_product_id";
          $result_remove_query = mysqli_query($con, $remove_query);
          if ($result_remove_query) {
            echo "<script> alert('This item is removed from cart.') </script>";
        } else {
            echo "<script> alert('Failed to add remove from cart.') </script>";
        }
        } 

        // echo "<script> window.open('shop_page.php', '_self') </script>";
    } else{
      echo "<script> alert('Please login so you can add to cart.'); window.location.href = 'login.php'; </script>";

    }
}

  }


  function remove_from_wishlist()
  {
    if (isset($_GET['remove_from_wishlist'])) {
      if (isset($_SESSION["username_of_fashion_paradise"]) && isset($_SESSION["cust_id_of_fashion_paradise"])) {
        global $con;

        // get product id
        $get_product_id = (int) $_GET['remove_from_wishlist'];

        // get cust id
        $cust_id = (int) $_SESSION['cust_id_of_fashion_paradise'];

        $select_query = "SELECT * FROM wishlist WHERE cust_id = $cust_id AND product_id = $get_product_id";
        $result_select_query = mysqli_query($con, $select_query);

        if (mysqli_num_rows($result_select_query) > 0) {
          $remove_query = "delete from wishlist Where cust_id = $cust_id AND product_id = $get_product_id";
          $result_remove_query = mysqli_query($con, $remove_query);
          if ($result_remove_query) {
            echo "<script> alert('This item is removed from wishlist.') </script>";
        } else {
            echo "<script> alert('Failed to add remove from wishlist.') </script>";
        }
        } 

        // echo "<script> window.open('shop_page.php', '_self') </script>";
    } else{
      echo "<script> alert('Please login so you can add to wishlist.'); window.location.href = 'login.php'; </script>";

    }
}

  }

// display single product details 
function single_product_details()
{
  global $con;
  if (isset($_GET['single_product_id'])) {
    $get_product_id = (int) $_GET['single_product_id'];
    $select_query = "SELECT * FROM products where product_id = $get_product_id";
    $result_select_query = mysqli_query($con, $select_query);

    while ($row = mysqli_fetch_assoc($result_select_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      // $product_keywords = $row['product_keywords'];
      $product_image = $row['product_image'];
      $product_price = $row['product_price'];
      $cat_id = $row['cat_id'];
      
    echo '<div class="d-flex justify-content-center">
    <div class="card pl-3 ml-auto h-100"  style="width: 100rem; >
    <div class="row g-0">
      <div class="col-md-12 ">
      <div class="d-flex flex-row mb-3">
        <img src="./admin_area/product_images/'.$product_image.'" class="img-display d-flex rounded-start" alt="'.$product_title.'">
        <div class="card-body mt-5">
          <h3 class="card-title mt-5">'.$product_title.'</h3>
          <h4 class="card-text mt-2 text-success ">'.$product_description.'</h4>
          <h4 class="card-text text-danger mt-5"> Rs. '.$product_price.'</h4>


          <div class="d-grid gap-2">
          <a href="shop_page.php?add_to_cart='.$product_id.'" class="btn btn-primary mb-2 x" type="button">Add to Cart</a>
          <a href="shop_page.php?add_to_wishlist='.$product_id.'" class="btn btn-secondary mb-2 y" type="button">Save to wishlist</a>
          <a href="buy_single_product.php?buy_single_product='.$product_id.'" class="btn btn-success mb-2 z" type="button">Buy Now</a>
</div>

        </div>
        </div>
      </div>
      
      
      </div>
    </div>
  </div>
    </div>';
    }


  }
}
  
  
// cart item numbers function
function cart_items()
{
  global $con;
  $cust_id = $_SESSION["cust_id_of_fashion_paradise"];
  $select_query = "SELECT * FROM cart where cust_id = $cust_id";
    $result_select_query = mysqli_query($con, $select_query);
    $product_count = 0; 
    while ($row = mysqli_fetch_assoc($result_select_query)) {
      $product_count = $product_count +1;
    }
  echo "<div class='gol mb-4'><p class='bg-secondary rounded-circle'><b class='text-light bg'>".$product_count."</b></p></div>";
}

function order_items()
{
  global $con;
  $cust_id = $_SESSION["cust_id_of_fashion_paradise"];
  $select_query = "SELECT * FROM cart where cust_id = $cust_id";
    $result_select_query = mysqli_query($con, $select_query);
    $product_count = 0; 
    while ($row = mysqli_fetch_assoc($result_select_query)) {
      $product_count = $product_count +1;
    }
  return $product_count;
}


// total price function
function total_price_display()
{
  global $con;
  $cust_id = $_SESSION["cust_id_of_fashion_paradise"];
  $total = 0; 
  $cart_query = "SELECT * FROM cart where cust_id = $cust_id";
  $result_select_query = mysqli_query($con, $cart_query);
  while ($row = mysqli_fetch_array($result_select_query)) {
    $product_id = $row["product_id"];
    $select_product_query = "select * from products where product_id = $product_id";
    $result_product_query = mysqli_query($con, $select_product_query);
    while($row_product_price = mysqli_fetch_array($result_product_query)){
      $product_price  = array($row_product_price['product_price']); 
      $product_values  = array_sum($product_price);
      $total += $product_values; 
    }
  }
  echo "<p>&nbsp;&nbsp;&nbsp;total price : $total/- </p>";
}

function return_total_amt()
{
  global $con;
  $cust_id = $_SESSION["cust_id_of_fashion_paradise"];
  $total = 0; 
  $cart_query = "SELECT * FROM cart where cust_id = $cust_id";
  $result_select_query = mysqli_query($con, $cart_query);
  while ($row = mysqli_fetch_array($result_select_query)) {
    $product_id = $row["product_id"];
    $select_product_query = "select * from products where product_id = $product_id";
    $result_product_query = mysqli_query($con, $select_product_query);
    while($row_product_price = mysqli_fetch_array($result_product_query)){
      $product_price  = array($row_product_price['product_price']); 
      $product_values  = array_sum($product_price);
      $total += $product_values; 
    }
  }
  return $total;
}


function buy_now(){
if(isset($_REQUEST["buy_single_product"]))
{
  $fetch_pro_id = (int) $_REQUEST["buy_single_product"];  

}

}