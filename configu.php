<?php

#   error_repoting
#   error_log
#   display_errors

#it turns off to show errors .
ini_set('display_errors',0);
var_dump(ini_get('display_errors'));

#we set maximum execution time is 3 seconds .
ini_set('max_execution_time',3);


#it produce fatal error because it exceeds maximum execution time .
sleep(3);
echo 'hello world';



#memory limit
var_dump(ini_get('memory_limit'));
#it displays 500 MB
#if we exceed more than memory limit it gives error .



#this shows all errors expect warnings
error_reporting(E_ALL & ~E_WARNING);


#   it produce fatal error .
#   we can use second argument as user error  only not other errors .
trigger_error('Example error' , E_USER_ERROR);
echo 1;








?>