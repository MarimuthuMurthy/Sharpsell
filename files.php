<?php

/** require / require_once /include / include_once */


#       Difference between require and include
#       **************************************


#   require :
/*  *******

 if file not founnd means it doesnt proceed to another step . it shows fatal error .
*/

#   include :
/* **********

 if file not founnd means it  proceed to another step . it shows warning .
*/

$dir = scandir(__DIR__);
echo '<pre>';
var_dump($dir);
echo '</pre>';

// mkdir('foo');
// rmdir('foo');

if(file_exists('foo.txt'))
{
    echo "Before adding content in file , the size is ".filesize('foo.txt').'<br>';
    #file_put_contents('foo.txt' , 'hello world');
    clearstatcache();
    echo "after adding content in file , the size is ".filesize('foo.txt').'<br>';
}
else{
    echo 'File not found'.'<br>';
}



function errorHandler(int $type , string $msg,?string $file = null ,?string $line = null )
{
    echo $type." ".$msg." file : ".$file." on line : ".$line;
}

set_error_handler('errorHandler',E_ALL);

if(file_exists('foo.txt'))
{
    $file = fopen('foo.txt','r');
    while(($line = fgets($file))!=false)
    {
        echo $line."<br>";
    }
    fclose($file);
}
else{
    echo "file not found";
}

$file2 = fopen('arrayfile.txt' , 'r');
while(($line = fgetcsv($file2))!=false)
{
    echo '<pre>';
    print_r($line);
    echo '</pre>';
}
fclose($file2);

$content1 = file_get_contents('arrayfile.txt');
$content2 = file_get_contents('foo.txt');
echo "foo file content : "."<br>".$content2."<br>";
echo "arrayfile content : "."<br>".$content1."<br>";
file_put_contents('foo.txt','Adding new line',FILE_APPEND);


copy('foo.txt','arrayfile.txt');

#writiing purpose
#****************

$file = "example.txt";
if($handle = fopen($file , 'w'))
{
    fwrite($handle , 'I LOVE PHP');
    fclose($handle);
}
else
{
    echo "The application was not able to write on the file";
}


#   for deleting purpose :
#   **********************

    # use   unlink(filename);

?>