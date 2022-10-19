<?php include "../admin/includes/admin_header.php"?>
<?php include "functions.php"?>
<?php ob_start()?>



    <div id="wrapper">




        <?php #redirect to admin/functions.php?>
        <?php insert_categories()?>


        <!-- Navigation -->
        <?php include "../admin/includes/admin_navigation.php"?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">


                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>



                        <div class="col-xs-6">


                            


                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class  ="form-control" name = "cat_title">
                                </div>
                                <div class="form-group">
                                    <input class = "btn btn-primary" type="submit" name = "submit" value = "Add Category">
                                </div>
                            </form>



                            
                            <?php    //upload and includue query

                                if(isset($_GET['edit']))
                                    {
                                        $cat_id = $_GET['edit'];
                                        include "includes/update-categories.php";
                                    }
                            ?>


                            
                        </div>



                        <div class="col-xs-6">
                            <table class = "table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php   // FIND ALL CATEGORY QUERY

                                        findAllCategories();

                                    ?>
                                
                                    

                                     
                                    <?php // Delete query
                                        
                                        if(isset($_GET['delete']))
                                        {
                                            $del = $_GET['delete'];
                                            $query = "delete from categories where cat_id = '{$del}'";
                                            mysqli_query($connection , $query) or die("query failed");
                                            header("Location: Categories.php");
                                        }
                                    ?>


                                       



                                    
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "../admin/includes/admin_footer.php"?>