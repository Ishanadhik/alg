<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}
?>
<?php 

require_once "algconfig.php";

$email=$_SESSION["email"];
$temail = $model= "";

//database bata teacher ko name ani reason ko corresponding data haru taneko  

            if(isset($_POST['tname']) && isset($_POST['reason']) ){
                $tname = $_POST['tname'];
                $reason = $_POST['reason'];
                if(isset($_POST['submit'])){
                    if(empty($tname) && empty($reason)){
                        echo "please select";
                    }else{
                        
                               
                            $sql1 = "SELECT temail FROM teacher_detail WHERE tname = $tname";
                            $temail = mysqli_query($conn, $sql1);

                            $sql2 = "SELECT mail FROM reason WHERE reason = $reason";
                            $model = mysqli_query($conn, $sql2);

                            //taneko data bata mail haneko 

                            $to_email = $temail;
                            $subject = "Application for leave";
                            $body = $model . "ishan" . "adhikari";
                            $from = $email;
                            ini_set("sendmail_from",$email);

                            if(mail($to_email, $subject,$body,)){
                                echo "MAIL sent SUCCESSFULLY";
                            }else{
                                echo"MAIL was not sent";
                            }
            }
        }
}







?>


<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">    <title>HOME</title>
    </head>
    <body>
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="logo.jpg" alt="" width="100" height="120" class="d-inline-block align-text-center"> 
            APPLICATION LEAVE GENERATOR</a>
            <a class="d-inline-block align-text-right"  href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h3><?php echo "Welcome "?> !Now you can send emails to teacher in an instant</h3>
        <hr>
    </div>

        <form action="alg.php" method="POST">
            <select name="tname"class="form-select">
                <option value="">Select teacher</option>
                <option value="Ishan Adhikari">Ishan Adhhikari</option>
                <option value="Sagina Maharjan">Sagina Maharjan</option>
                <option value="Kusal Bista">Kusal Bista</option>
                <option value="Prayush Shrestha">Prayush Shrestha</option>
            </select><br>
            <select name="reason" class="form-select">
                <option selected>Select reason</option>
                <option value = "sick" >Sick</option>
                <option value = "wedding">Wedding</option>
                <option value = "family_function">Important family function</option>
            </select><br>

            <input type="submit" name="submit">
        </form>
    </body>
</html>
