
<?php include('common/menu.php'); ?>
    
<div class="main-content">
    <div class="wrapper">
        <h2>Add product</h2>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="product name"></td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="description"></textarea></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" placeholder="price"></td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <option value="1">Cloths</option>
                            <option value="2">Cosmetics</option>
                            <option value="3">Beverages</option>
                            <option value="4">Food and food stuffs</option>
                            <option value="5">Drinks</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="Featured" value="Yes"> Yes
                        <input type="radio" name="Featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="Active" value="Yes"> Yes
                        <input type="radio" name="Active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add product" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>


<?php include('common/footer.php'); ?>
    