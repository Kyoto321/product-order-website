<?php 

    // include contants.php file here
    include('../config/constant.php');

    // get admin id to be deleted
    $id = $_GET['id'];

    // sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // execute the query
    $res = mysqli_query($conn, $sql);

    // check whether the query executed successfully
    if($res == true )
    {
        // query executed successfully and admin deleted
        // create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        // redirect to admin-page
        header('location:'.SITEURL.'admin/admin-page.php');
    }
    else
    {
        //failed to deleted admin
        //echo "Failed to Delete Admin";
        $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try again.</div>";
        header('location:'.SITEURL.'admin/admin-page.php');
    }

    // redirect to admin-page with msg(success/error)

?>


