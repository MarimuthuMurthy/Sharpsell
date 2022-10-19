<?php

if(isset($_POST["submit"]))
{
    $names = ['murthy' , 'student' , 'peter','mohad' , 'maria','jane'];
    $minimum = 5;
    $maximum = 15;
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    if(strlen($user_name) < $minimum)
    {
        echo "username has to be longer than 5";
    }
    if(strlen($user_name) > $maximum)
    {
        echo "username cannot be longer than 15";
    }
    if(!in_array($user_name , $names))
    {
        echo "sorry!!! you are not allowed";
    }
    else{
        echo "welcome";
    }


}
?>