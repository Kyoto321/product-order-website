<?php include ('../config/constant.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Goods Order System </title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h2 class="text-center">Login</h2>
        <br>

        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>
        <br>

        <!-- login form -->
        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter username"> <br> <br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter password"> <br> <br>
            <br> 
            <input type="submit" name="submit" value="Login" class="btn-primary"><br> <br>
        </form>

        <p class="text-center"><a href="www.pillow.com">Ayo Bankole</a></p>
    </div>
    
</body>
</html> 

<?php

    // confirm submit button
    if(isset($_POST['submit']))
    {
        //get data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // sql to confirm user account
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    
        // execute the query
        $res = mysqli_query($conn, $sql);

        // confirm user -count roles
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            // user available / login successful
            $_SESSION['login'] = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username;      //confirm user login & logout will unset it
            // redirect to dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user not available
            // user available / login successful
            $_SESSION['login'] = "<div class='error text-center'>Failed login. Username and password do not match</div>";

            // redirect to dashboard
            header('location:'.SITEURL.'admin/login.php');
        }

    }
?>