
<?#php include "functions.php";?>
<?php include "PDOfunctions.php";?>
<?php include "PDO.php";?>
<?php

if(isset($_POST['submit']))
{
    if(!checkData())
    {
        createTable();
    }
    else{
        echo "<h1 span style='text-align:center ; '><span style = 'color : RED;'>USERNAME ALREADY FOUND , TRY ANOTHER NAME</span></h1>";
    }
}
?>
<?php include "includes/header.php" ?>
<div class = "container">
    <div class = "create_title">
    <h1>CREATE</h1>
    </div>
    <fieldset>
        <form action="Login.php" method = "post">
            <p>
            <label for="username">UserName : </label>
            <input type="text" name = "username" placeholder="eg:jio">
            </p>
            <p>
            <label for="password">Password : </label>
            <input type="password" name = "password" placeholder = "Jio.aa@1" >
            </p>
            <p>
            <button class = "submit" name = "submit"  span style="color: blue;">SUBMIT</button>
            </p>
        </form>
    </fieldset>
</div>
<?php include "includes/footer.php" ?>