
<?php include('common/menu.php'); ?>
    
        <!--main content section -->
        <div class="main-content">
            <div class="wrapper">
                <h1><strong>Category</strong></h1>

                <?php
                    if(isset($_SESSION['add']))     // check session
                    {
                        echo $_SESSION['add'];      //display session message
                        unset($_SESSION['add']);    //removing session messages
                    }

                    if(isset($_SESSION['remove'])) 
                    {
                        echo $_SESSION['remove'];      
                        unset($_SESSION['remove']);    
                    }

                    if(isset($_SESSION['delete']))  
                    {
                        echo $_SESSION['delete'];   
                        unset($_SESSION['delete']);   
                    }

                    if(isset($_SESSION['no-category-found']))  
                    {
                        echo $_SESSION['no-category-found'];   
                        unset($_SESSION['no-category-found']);   
                    }

                    if(isset($_SESSION['update']))  
                    {
                        echo $_SESSION['update'];   
                        unset($_SESSION['update']);   
                    }

                    if(isset($_SESSION['upload']))  
                    {
                        echo $_SESSION['upload'];   
                        unset($_SESSION['upload']);   
                    }

                    if(isset($_SESSION['remove-fail']))  
                    {
                        echo $_SESSION['remove-fail'];   
                        unset($_SESSION['remove-fail']);   
                    }

                ?>
                <br /><br />
                <!-- button to add admin -->
                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
                <br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>

                    </tr>

                    <?php

                    // get all categories
                    $sql = "SELECT * FROM tbl_category";

                    // execute query
                    $res = mysqli_query($conn, $sql);

                    //count rows
                    $count = mysqli_num_rows($res);

                    //serial number variable
                    $sn=1;

                    // check for data in database
                    if($count>0)
                    {
                        // display data table
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                        
                                <tr>
                                    <td><?php echo $sn++; ?>.</td>
                                    <td><?php echo $title; ?></td>

                                    <td>
                                        <?php 

                                        // verify image name
                                        if($image_name!="")
                                        {
                                            //display the image
                                            ?>
                                                <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" width="100px" alt="">
                                            <?php
                                        }
                                        else
                                        {
                                            //display the message
                                            echo "<div class='error'>Image not found.</div>";
                                        }

                                        ?>
                                    </td>

                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>                                   
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update category</a> 
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete category</a> 
                                    </td>                            
                                </tr>

                            <?php
                        }
                    }
                    else
                    {
                        //display message
                        ?>
                        <tr>
                            <td colspan="6"><div class="error">No category found</div></td>
                        </tr>

                        <?php
                    }
                    ?>
                </table>               
                <div class="clearfix"></div>
            </div>
        </div>

<?php include('common/footer.php'); ?>       

