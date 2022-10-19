<?php declare(strict_types=1)?>
<!-- <?php #include "functions.php";?>
<?php #include "db.php";?> -->

<?php include "PDOfunctions.php";?>
<?php include "PDO.php";?>



<?php 
if(isset($_POST['submit']))
{
    if(isset($_POST["id"]))
    {
        # using my_sqli
        # deleteRecordsTable();

        #using PDO
        deleteRecordsUsingPdo();
    }
    else{
        echo "<h1><span style = 'color : violet'>sorry records not found</span></h1>";
    }
}

?>

<?php include "includes/header.php" ?>
    <div class = "deleteTitle">
        <h1>Delete records</h1>
    </div>
    <form action="Delete.php" method="post">
    <select name="id" id="">
        <?php
        showAllData();
        ?>
    </select>
    <input class = "submit" type="submit" name = "submit" value = "delete record">
    </form>
<?php include "includes/footer.php" ?>