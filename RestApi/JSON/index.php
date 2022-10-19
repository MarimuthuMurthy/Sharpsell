<?php

if(isset($_POST['submit']))
{
    if($_POST['username']!='' && $_POST['password']!='')
{
    if(file_exists('userdata.json'))
    {
        $currentdata = file_get_contents('userdata.json');
        $array_data = json_decode($currentdata,true);
        $new_data = array(
            "username"=>$_POST['username'],
            "password"=>$_POST['password']
        );
        $array_data[] = $new_data;
        $json_data = json_encode($array_data , JSON_PRETTY_PRINT);
        if(file_put_contents('userdata.json' , $json_data))
        {
            echo "<h3>Succesfully saved data</h3>";
        }
        else{
            echo "<h3>unsuccessfully saved data</h3>";
        }
    }
    else{
        echo "file not found";
    }
}

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST">
        <p>
            <label for="username">USERNAME : </label>
            <input type="text" name = "username" placeholder = "username">
        </p>
        <p>
            <label for="password">PASSWORD : </label>
            <input type="password" name = "password" placeholder = "password">
        </p>
        <p>
            <input type="submit" name="submit" value = "submit">
        </p>
    </form>
</body>
</html>