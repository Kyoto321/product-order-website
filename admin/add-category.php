<?php include('common/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Category</h2>
        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br>

        <!--- add category form -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Category title"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" >Yes
                        <input type="radio" name="featured" value="No" >No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No" > No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>                   
                    
            </table>
        </form>

        <?php
            //confirm submit button
            if(isset($_POST['submit']))
            {
                //display message
                //get value
                $title = $_POST['title'];

                // check for selected radio input type Yes/No
                if(isset($_POST['featured']))
                {
                    // get value from form
                    $featured = $_POST['featured'];

                }
                else
                {
                    //set default value
                    $featured = "No";
                }                        $file_ext = explode('.', $image_name);
                $ext = end($file_ext);
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                // check image selection and set vale for image
                //print_r($_FILES['image']);
                //die();

                if(isset($_FILES['image']['name']))
                {
                    //upload image if image is selected
                   // if($image_name !="")
                    //{                    
                        // get image name, source path and destination path
                        $image_name = $_FILES['image']['name'];
                        //auto re-rename image
                        //get the extention of image_name
                        $ext = end(explode('.', $image_name));
                        //$file_ext = explode('.', $image_name);
                        //$ext = end($file_ext);
                        // rename image
                        $image_name = "product_category_".rand(000,999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //upload image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // confirm image is uploaded
                        if($upload==false)
                        {
                            // set message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                            // redirect to add-category page
                            header('location:'.SITEURL.'admin/add-category.php');
                            // stop the process
                            die();
                        }
                   //}
                }
                else
                {
                    //failed to upload
                    $image_name="";
                }

                // sql query to insert category into database
                $sql = "INSERT INTO tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'";

                // execute query and save in database
                $res = mysqli_query($conn, $sql);

                // confirm, query execution
                if($res == True)
                {
                    //query executed and category added
                    $_SESSION['add'] = "<div class='success'>Category added successfully.</div>";
                    //redirect to category-page
                    header('location:'.SITEURL.'admin/category-page.php');
                }
                else
                {
                    // failed to add category
                    //query executed and category added
                    $_SESSION['add'] = "<div class='error'>Failed to add category.</div>";
                    //redirect to category-page
                    header('location:'.SITEURL.'admin/add-category.php');

                }
            }
        ?>

    </div>
</div>


<?php include('common/footer.php'); ?> 

