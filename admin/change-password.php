<?php include('common/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <br/><br/>

        <?php
        // get id
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="current_password" placeholder="Current password"></td>
                </tr> 

                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_password" placeholder="New password"></td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm password"></td>
                </tr>    
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class = "btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php

        // click on submit button
        if(isset($_POST['submit']))
        {
            //echo "clicked";
            // get data from form
            $id = $_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            // match user with current id and password -if exist
            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";     // no '' for integer value - id=$id

            // execute query
            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                //check for data on tbl_admin
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    //user exists
                     //echo "user found";
                    // match new password and confirm password
                    if($new_password==$confirm_password)
                    {
                        //update password
                        //echo "password match";
                        $sql2 = "UPDATE tbl_admin SET
                            password='$new_password'
                            WHERE id=$id
                            ";

                        // execute query
                        $res2 = mysqli_query($conn, $sql2);

                        // confirm query execution
                        if($res2==true)
                        {
                            // display message
                        //redirect to admin-page with error message
                        $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully.</div>";
                        // redirect url
                        header("location:".SITEURL.'admin/admin-page.php');                              
                        }
                        else
                        {
                            // display error message
                        //redirect to admin-page with error message
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to change password.</div>";
                        // redirect url
                        header("location:".SITEURL.'admin/admin-page.php');  

                        }
                    }
                    else
                    {
                        //redirect to admin-page with error message
                        $_SESSION['pwd-not-match'] = "<div class='error'>Password did not match</div>";
                        // redirect url
                        header("location:".SITEURL.'admin/admin-page.php');                        
                    }

                }
                else
                {
                    //user does not exist
                    $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
                    // redirect url
                    header("location:".SITEURL.'admin/admin-page.php');
                }
            }

            // match the new password with current password

            // change password 
        }

?>







<?php include('common/footer.php'); ?>  