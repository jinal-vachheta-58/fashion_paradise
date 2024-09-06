

<?php 

session_start();

require_once("../includes/connect.php");

$name_err = $email_err =$password_err = "";
$name_f = $pass_f = $email_f = 0; 
    if(($_SERVER["REQUEST_METHOD"])== "POST"  )
    {
        if(isset($_POST["signup"]))
        {

            $username = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["email"];

            if(empty($_POST["email"]))
            {
                $email_err ="email is required";
            }
            else
            {
                $pettern ="/^[a-zA-Z0-9._-]+@[a-zA-Z0-9_.]+\.[a-zA-Z]{2,4}$/";
                if(!preg_match($pettern,$email))
                {
                    $email_err = "invalid email";
                }
                else {
                    $email_err = "";
                    $email_f = 1; 
                    $email = $_POST["email"];
                }
            }
            

            
        if(empty($_POST["username"]))
        {
            $name_err ="username is required";
        }
        else
        {
            $pattern = "/^[a-zA-Z]*$/";
            if(!preg_match("$pattern",$username))
            {
                $name_err = "invalid name";
            }
            else {
                $name_err = "";
                $name_f = 1; 
                $username = $_POST["username"];
            }
        }


        



        if(empty($_POST["password"]))
        {
            $password_err ="password is required";
        }
        else
        {
            $pettern ="/^[a-zA-Z0-9]{3,8}/";
            if(!preg_match("$pettern",$password))
            {
                $password_err = "invalid password";
            }
            else {
                $password_err = "";
                $pass_f = 1;
                $password = $_POST["password"];
            }
        }

        // Check if user with same email or username already exists
        $sql_check = "SELECT * FROM staff WHERE email = '$email'";
        $result_check = mysqli_query($con, $sql_check);
        if (mysqli_num_rows($result_check) > 0) {
            echo "<script>alert('User with the same email or username already exists. Please change username and email.');</script>";
            // Redirect to login page
            echo "<script>window.location.href = 'admin_registration.php';</script>";
            // header("location:login.php");
            exit();
        }


            if($name_f == 1 && $pass_f == 1 && $email_f == 1  && empty($password_err) && empty($name_err) && empty($email_err) && isset($username) && isset($email) && isset($password) )
            {

                $hash_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO staff (username, email,s_password, role,hire_date,salary) VALUES ('$username', '$email', '$hash_password' ,'admin',NOW(),40000)";

                
                $result = mysqli_query($con,$sql);
                if (!$result) {
                    die('Error: ' . mysqli_error($con));
                    // echo "sorry result is false";
                } else {
                    //echo "Data inserted successfully";
                    $_SESSION["admin_of_fashion_paradise"] = $username;
                    // echo $_SESSION["username_of_fashion_paradise"];
                    // echo "<script>alert('Welcome $username');</script>";
                    
                    
                    header("Location: index.php");
                    // exit();
                }
            }
            // else {
            //     echo "<script>alert('sorry some error occured');</script>";
            //     // echo"there is err";
            // }
    }
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
input[type=text],input[type=email],input[type=password], select {
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
  margin:10%;
  margin-top: 1px;
  margin-bottom: 100px;
    background-color: #f2f2f2;
  padding: 400px;
}
h1{
    font-size:50px;
    text-align: center;
    color: green;
    border:2px solid #45a049;
    border-radius: 20px;
    background-color: white;

    
}
.signup{
    padding: 100px;
    margin-top: 10px;
    margin-left: 310px;
    margin-right: 310px;
}
.err{
    color: red;
}
</style>
<body>

<div class="signup">
<h1 > Admin Sign up </h1>
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
        Username: <input type="text" name="username" value="<?php 
        
        if(isset($username))
        {
            echo $username;
        }
        
        ?>">
            <span class="err">*<?php  echo $name_err;?></span><br><br>

            Email:  <input type="email" name = "email" value="<?php 
        
        if(isset($email))
        {
            echo $email;
        }
        
        ?>">
            <span class="err">*<?php echo $email_err;?></span><br><br>

            Password: <input type="password" name ="password">
            <span  class="err">*<?php echo $password_err;?></span><br><br>

            <input type="submit" name="signup" value ="signup"><br>
            <p>already registred? <a href="admin_login.php">login </a></p>
        </form>
        
    </div>    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


