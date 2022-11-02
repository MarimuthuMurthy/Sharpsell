<?php include "../admin/includes/admin_header.php" ?>
<?php include_once "functions1.php" ?>
<?php ob_start() ;


    if(!is_admin())
    {
        header("Location: index.php");
    }
?>

<div id="wrapper">




    <?php #redirect to admin/functions.php
    ?>
    <?php insert_categories() ?>


    <!-- Navigation -->
    <?php include "../admin/includes/admin_navigation.php" ?>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- heading -->
                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>
                    </h1>

                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }
                    switch ($source) {
                        
                        case 'add_user':
                            include "includes/add_user.php";
                            break;
                        case 'edit_post':
                            include "includes/edit_user.php";
                            break;
                        default:
                            include "includes/view_all_users.php";
                    }
                    ?>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "../admin/includes/admin_footer.php" ?>