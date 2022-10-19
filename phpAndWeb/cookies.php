
<?php

$name= "Murthy";
$value = 15892;
$expiration = time()+(60*60*24*7);
setcookie($name,$value,$expiration);

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_COOKIE['Murthy']))
        {
            $someone = $_COOKIE['Murthy'];
            echo '<pre>';
                print_r($someone);
            echo '</pre>';
        }
        else{
            $someone="";
        }
    ?>
</body>
</html>

