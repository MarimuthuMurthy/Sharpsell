<?php

echo $_POST['name'];


?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="The_post.php" method="post">
        <input type="text" name ="name">
        <input type="submit" name="submit">
    </form>
</body>
</html>