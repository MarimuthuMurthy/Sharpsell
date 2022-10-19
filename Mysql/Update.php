<?#php include "functions.php"?>
<?php include "PDOfunctions.php";?>

<?php

if(isset($_POST['submit']))
{
    if(passwordCheck())
    {
        updateTable();
    }
    else{
        echo "<h1 <span style= 'color : red ;'>Wrong username or Password </h1>";
    }
    
}
?>
<?php include "includes/header.php" ?>
<div class = "container">
    <div class = "updateTitle">
        <H1>UPDATE</H1>
    </div>
    <fieldset>
        <form action="Update.php" method = "post">
            <p>
            <label for="username">Enter current username : </label>
            <input type="text" name = "username" placeholder="eg:jio">
            </p>
            <p>
            <label for="password">Enter current password : </label>
            <input type="password" name = "password" placeholder = "Jio.aa@1" >
            </p>
            <p>
            <label for="password">Enter new password : </label>
            <input type="password" name = "Npassword" placeholder = "Jio123.aa@1" >
            </p>
            <p>
            <input class = "submit" type="submit" name = "submit" value = "update"  >
            </p>
        </form>
    </fieldset>
</div>
<?php include "includes/footer.php" ?>