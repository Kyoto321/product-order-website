<?php include('common/menu.php'); ?>



<!--main content section -->
<div class="main-content">
            <div class="wrapper">
                <h1><strong>Add Admin</strong></h1>

                <br /><br/>

                <?php
                    if(isset($_SESSION['add']))     // check session
                    {
                        echo $_SESSION['add'];      //display session message
                        unset($_SESSION['add']);    //removing session messages
                    }
                ?>
                
                <form action="" method="POST">
                    <table class="tbl-30">
                        <tr>
                            <td>Full Name: </td>
                            <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                        </tr>

                        <tr>
                            <td>Username: </td>
                            <td><input type="text" name="username" placeholder="Enter your username"></td>
                        </tr>

                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="password" placeholder="Enter your password"></td> 
                        </tr>

                        <tr>
                            <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td>
                        </tr>
                    </table>
                </form>

            </div>
</div>

<?php include('common/footer.php'); ?>

<?php
    // process the value from form and save to the database
    //confirm the click button

    if(isset($_POST['submit']))
    {
        // click button
        //echo "button clicked"

        // get data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);  // encrpyt password with md5

        // sql query to save data into database
        // db colomns on the left, data form on the right
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'"; 
          
        // execute query and save data in database
        //$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_connect_error());     //database connection
        //$db_select = mysqli_select_db($conn, 'food-design-restuarant') or die(mysqli_connect_error());   //selecting the database
    
        // executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_connect_error());
        
        // verify data confirmation
        if($res==True)
        {
            // create a variable to display message
            $_SESSION['add'] = "Admin Added Sucessfully";
            // redirect page to admin-page
            header("location:".SITEURL.'admin/admin-page.php');

        }
        else
        {
            //Failed to Insert Data
            // create a variable to display message
            $_SESSION['add'] = "Failed to Create Admin";
            // redirect page to admin-page
            header("location:".SITEURL.'admin/add-admin.php');
}
    };
?>