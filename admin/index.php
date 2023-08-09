<?php include('common/menu.php'); ?>

        <!--main content section -->
        <div class="main-content">
            <div class="wrapper">
                <h1><strong>Dashboard</strong></h1>
                <br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br>
                <div class="col-4 text-center">
                    <H1>5</H1>
                    <br>
                    Categories
                </div>

                <div class="col-4 text-center">
                    <H1>5</H1>
                    <br>
                    Categories
                </div>
                
                <div class="col-4 text-center">
                    <H1>5</H1>
                    <br>
                    Categories
                </div> 

                <div class="col-4 text-center">
                    <H1>5</H1>
                    <br>
                    Categories
                </div>
                <div class="clearfix"></div>

            </div>
        </div>

<?php include('common/footer.php'); ?>


