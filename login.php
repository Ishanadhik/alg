<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['email']))
{
    header("location: alg.php");
    exit;
}
require_once "algconfig.php";

$email = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['email'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter email and password";
        echo $err;
    }
    else{
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    }


    if(empty($err))
    {
        $sql = "SELECT id, email, password FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = $email;

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                if(mysqli_stmt_fetch($stmt))
                {
                    if(password_verify($password, $hashed_password))
                    {
                        session_start();
                        $_SESSION["email"] = $email;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;

                        header("location: alg.php");

                    }
                }

            }

        }
    }


}
?>

<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>ALG</title>
</head>
<body>
   <a href="register.php">Register</a>
   <a href="login.php">Login</a>


<div class="container mt-4">
   <h3>Please login to continue: </h3>
   <hr>

   <form action="login.php" method="post">
           <label for="email">email</label>
           <input type="text" name="email" id="email" placeholder="Enter email">
           <label for="password">Password:</label>
           <input type="password" name="password" id="password" placeholder="Enter Password">
       <button type="submit" >Submit</button>
   </form>
</div>
</body>
</html>
