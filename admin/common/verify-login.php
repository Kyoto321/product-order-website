
<?php
    // Autorization - Access control
    //verify whether user is logged or not
    if(!isset($_SESSION['user']))   //if user not set/login
    {
        // user is logged in, redirect to login page
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin page</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>