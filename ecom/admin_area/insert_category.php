<?php
include ("../includes/connect.php");

if (isset($_POST["insert_cat"])) {
    // $category_title = $_POST["cat_title"];

    if (empty($_POST["cat_title"])) {
        // $name_err ="username is required";
        echo "<script> alert('name of the category is required.')</script>";
    } else {
        $category_title = $_POST["cat_title"];
        $pattern = "/^[a-zA-Z ]*$/";
        if (!preg_match("$pattern", $category_title)) {
            echo "<script> alert('category name can contain only alphabets and white spaces')</script>";
        } else {
            // select data from database to check category is present in database or not
            $select_query = "select * from category where cat_name = '$category_title'";
            $select_result = mysqli_query($con, $select_query);
            if (!$select_result) {
                echo "<script> alert('sorry category could not be inserted.')</script>";
            } else {
                $num_rows = mysqli_num_rows($select_result);
                if ($num_rows > 0) {
                    echo "<script> alert('category already present in database')</script>";
                    $flag = 0;
                } else {
                    $insert_query = "insert into category (cat_name) values('$category_title')";
                    $result = mysqli_query($con, $insert_query);
                    if ($result) {
                        echo "<script> alert('category has been inserted successfully')</script>";
                    }
                    else {
                        echo "sorry category not inserted";
                    }
                }
            }
        }
    }


    // // select data from database
    // $select_query = "select * from category where cat_name = '$category_title'";
    // $select_result = mysqli_query($con, $select_query);
    // if (!$select_result) {
    //     echo "<script> alert('sorry category could not be inserted.')</script>";
    // }

    // $num_rows = mysqli_num_rows($select_result);
    // if ($num_rows > 0) {
    //     echo "<script> alert('category already present in database')</script>";
    //     $flag = 0;
    // } else {
    //     $insert_query = "insert into category (cat_name) values('$category_title')";

    //     $result = mysqli_query($con, $insert_query);
    //     if ($result) {
    //         echo "<script> alert('category has been inserted successfully')</script>";
    //     }
    // }

}
?>

<h2 class="text-center">Insert product category</h2>
<form action="" class="mb-2" method="post" autocomplete="off">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-dark" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>

        <input type="text" class="form-control" placeholder="insert category" name="cat_title" aria-label="Username"
            aria-describedby="basic-addon1">
    </div>


    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class=" m-3 p-3 border-0 bg-info" value="insert category" name="insert_cat">
        <!-- <button class="bg-info m-3 p-3 border-0">insert categories</button> -->
    </div>


</form>