
<?php 
require_once("<includes/connect.php");

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
            $pattern = "/^[a-zA-Z]/";
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


            if($name_f = 1 && $pass_f = 1 && $email_f = 1  && empty($password_err) && empty($name_err) && empty($email_err))
            {
            
                $sql = "INSERT INTO customer (username, email, password) VALUES ('$username', '$email', '$password')";

                // Execute statement
                $result = mysqli_query($conn,$sql);
                if (!$result) {
                    // die('Error: ' . mysqli_error($conn));
                    echo "sorry result is false";
                } else {
                    echo "Data inserted successfully";
                    // Redirect or do something else
                    header("Location: index.php");
                    // exit();
                }
            }
            else {
                echo"there is err";
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
</head>
<style>
input[type=text],input[type=password], select {
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
</style>
<body>

<div class="signup">
<h1 >Sign up </h1>
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
        Username: <input type="text" name="username">
            <span>*<?php  echo $name_err;?></span><br><br>

            Email:  <input type="text" name = "email">
            <span>*<?php echo $email_err;?></span><br><br>

            Password: <input type="password" name ="password">
            <span>*<?php echo $password_err;?></span><br><br>

            <input type="submit" name="signup" value ="signup"><br>
            <p>already registred? <a href="login.php">login </a></p>
        </form>
        
    </div>    
</body>
</html>
