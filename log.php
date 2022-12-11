<?php
    session_start();
    if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        if($username=="" || $password==""){
            header('location:log.php?missing');
        }
        else{
            if($username=="bader" && $password=="bader_admin"){
                $_SESSION['user']=$username;
                header('location:admin.php');
            }
            else{
                header('location:log.php?incorrect');
            }
        }
    }
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/log.css" >
    <title>Login</title>
</head>
<body>
<nav>
        <div class="logo">
                <img src="./pictures/YANV3833.JPG" >
        </div>
        <div class="pages">
            <ul>
                <li ><a href="./index.php" >Home</a></li>
                <li   ><a href="./Contact.html" >Contact Us</a></li>
                <li class="h" ><a href="./log.php" >Admin Zone</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <form action="" method="POST" >
                <img src="./pictures/SN/user.png"><br>
                <input type="text"  name="username"  placeholder="Enter Your username" ><br>
                <input type="text"  name="password"  placeholder="Enter Your Password" ><br>
                <button type="submit" name="submit" >Login</button>
                <?php
                    if(isset($_GET['missing'])){
                        echo("<div class=\"alert\" > Fill All the Blanks </div>");
                    }
                    if(isset($_GET['incorrect'])){
                        echo("<div class=\"alert\" > Username Or Password Incorrect </div>");
                    }
                ?>
        </form>
    </div>
</body>
</html>