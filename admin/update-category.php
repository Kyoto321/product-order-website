<?php include('common/menu.php'); ?> 


<div class="main-content">
    <div class="wrapper">
        <h2>Update category</h2>
        <br><br>
        <?php
        //check id
        if(isset($_GET['id']))
        {
            // get 'id' and all details
            $id = $_GET['id'];
            // sql query to delete from database
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            //confirm selection
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                // get all data
                $row = mysqli_fetch_assoc($res);

                $id = $row['id'];
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

                // success message and redirect
                //$_SESSION['update-successful'] = "<div class='success'>Updated successfully</div>";
                //header('location:'.SITEURL.'admin/category-page.php');
            }
            else
            {
                // no category found
                $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
                header('location:'.SITEURL.'admin/category-page.php');
            }

        }
        else
        {
            //redirect tp category-page
            header('location:'.SITEURL.'admin/category-page.php');
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    </tr>
                    <tr>
                        <td>Current Image: </td>
                        <?php
                            if($current_image!= "")
                            {
                                // display image
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?> width="150px">
                                <?php

                            }
                            else
                            {
                                // display message
                                echo "<div class='error'>No image.</div>";
                            }
                        ?>
                    </tr>
                    <tr>
                        <td>New Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes" >Yes
                            <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No" >No
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No" > No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update category" class="btn-secondary">
                        </td>
                    </tr>       
            </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                //select button - get all values from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // update new image if selected
                //if new image is selected
                if(isset($_FILES['image']['name']))
                {
                    // get image details
                    $image_name = $_FILES['image']['name'];
                    // if image is available
                    if($image_name != "")
                    {
                        // upload new image
                        //auto re-rename image
                        //get the extention of image_name
                        //$ext = end(explode('.', $image_name));
                        $file_ext = explode('.', $image_name);
                        $ext = end($file_ext);
                
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
                            header('location:'.SITEURL.'admin/category-page.php');
                            // stop the process
                            die();
                        }

                        // remove current image
                        if($current_image != "")
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path); 
                            
                            // confirm image update
                            if($remove==false)
                            {
                                //failed to remove image
                                $_SESSION['remove-fail'] = "<div class='error'>Failed to remove current image</div>";
                                header('location:'.SITEURL.'admin/category-page.php');
                                die();
                            }
                        };

                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                // update to database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active',
                    WHERE id=$id
                    ";

                // execute query
                $res2 = mysqli_query($conn, $sql2);

                // confirm query execution
                if($res2==true)
                {
                    // category uploaded
                    $_SESSION['update'] = "<div class='success'>Category updated successfully</div>";
                    header('location:'.SITEURL.'admin/category-page.php');
                }
                else
                {
                    // failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to update category</div>";
                    header('location:'.SITEURL.'admin/category-page.php');
                }

                // redirect to category-page 
            }
        ?>
    </div>
</div>


<?php include('common/footer.php'); ?> 