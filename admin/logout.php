<?php include ('../config/constant.php'); ?>

<?php
    // stop session and redirect to login page
    session_destroy();  //unsets $_SESSION['user']

    // redirect to login page
    header('location:'.SITEURL.'admin/login.php');

?>