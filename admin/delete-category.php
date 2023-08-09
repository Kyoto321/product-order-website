<?php
    include('../config/constant.php');

    //confirm $id and $image_name value
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get values and delete category
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // remove image file if available
        if($image_name != "")
        {
            // remove image
            $path = "../images/category/".$image_name;
            $remove = unlink($path);

            // alert error if failed to remove image
            if($remove==false)
            {
                //set session message -redirect to category page
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                header('location:'.SITEURL.'admin/category-page.php');
                die();

            }
        }

        // sql query to delete from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        //confirm deletion
        if($res==True)
        {
            // success message and redirect
            $_SESSION['delete'] = "<div class='success'>Deleted successfully</div>";
            header('location:'.SITEURL.'admin/category-page.php');
        }
        else
        {
            // fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Fialed to delete category</div>";
            header('location:'.SITEURL.'admin/category-page.php');
        }

        //redirect to category-page

    }
    else{
        // redirect to category-page
        header('location:'.SITEURL.'admin/category-page.php');
    }
?>