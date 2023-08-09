<?php include('common/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
            // get id of selected admin
            $id = $_GET['id'];

            // create SQL quert to get the details
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            // execute the query
            $res = mysqli_query($conn, $sql);

            // confirm query execution
            if($res==true)
            {
                // check for data
                $count = mysqli_num_rows($res);
                // select admin
                if($count==1)
                {
                    // get the details
                    //echo "Admin available";
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    // redirect to admin page
                    header('location:'.SITEURL.'admin/admin-page.php');
                }
            }

    


        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php 

// click submit button
if(isset($_POST['submit']))
{
    //echo "button clicked";
    // get all values from form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    // SQL query to update admin
    $sql = "UPDATE tbl_admin SET
    full_name = '$full_name',
    username = '$username'
    WHERE id='$id'
    ";

    // execute the query
    $res = mysqli_query($conn, $sql);

    // check for query execution
    if($res == true)
    {
        // query executed and admin updated
        $_SESSION['update'] = "<div class='success'>Admin updated successfully.</div>";
        // redirect to admin page
        header('location:'.SITEURL.'admin/admin-page.php');
    }
    else
    {
        // failed to update
        $_SESSION['update'] = "<div class='error'>Failed to update. PLease try again </div>";
        // redirect to admin page
        header('location:'.SITEURL.'admin/admin-page.php');
    }

}

?>



<?php include('common/footer.php'); ?> 