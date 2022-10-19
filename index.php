<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php


#constants in php :
#******************

#                        way1 :

//                 using define function :

//             eg : define("name" , "value");

define('NAME' , 'murthy');
#no need to add $ sign
echo NAME."<br>";
    
#                       way 2

#                 using const keyword

#           eg : const status_paid = 'paid';

const status_paid = "paid";
#no need to add $ sign
echo status_paid."<br>";




#another example : 


$PAID = "PAID";
define('STATUS_'.$PAID , "paid");
echo STATUS_PAID."<br>";
echo "current php version is ".PHP_VERSION."<br>";









    #                       variable Variables 


    $foo = 'bar';

    $$foo = "baz";
    # which means $$foo assigned as bar and bar = baz
    echo $$foo."<br>"; 






    #                      data types and type casting:
#                         ******************************
#           4 scalar types
#          ****************
#
#                          1 . bool     (true/false)
#                          2 . int      (1,2,3,4,5,6)
#                          3 . float    (1.5 , 1.6 , 0.8)
#                          4 . string   ("gio" , "hello world")

$completed  = true ; 
$age        = 20 ; 
$cgpa       = 4.5;
$name       = "murthy";
echo "my name is ",$name," and my age is {$age} "," . My cgpa is ",$cgpa , " yes , that is {$completed}"."<br>";

#                  to find type of variable 
#                  ************************
#
#               use function     gettype("$variable")
#           
echo gettype($age)."<br>";




#                   to find complete variable
#                   *************************

#       use function             var_dump("$variable name")

echo var_dump($age),"<br>";








#
#           4 compound types
#           ****************
#
#                           1 . Array       list of integer , float , string ,boolean
                                        $companies = ["sharpsell" , "recruit crm " , "accenture"  ,1,1,2,3,3,true];
                                        # echo($companies); => gives error
                                        print_r($companies);
#                           2 . object  
#                           3 . callable
#                           4 . iterable








#
#           2 special types 
#           ***************
#
#                           1 . resource
#                           2 . null






#                      ********* important **********
#

function sum(int $a ,int $b){
    var_dump($a , $b);
    return $a+$b;
}

$sum = sum("10",20)."<br>";

$gum = sum(10 ,20)."<br>";

#both sum and gum are equal because in runtime , string of 10 converts into integer 


# to avaoid these we declare   constant                 define(strict_types = 1)

echo $sum."<br>";



#                         type casting
#                        **************

$a = (int)'10';









#                           BOOLEAN DATA TYPE
#                        *************************


$isCompleted = true;

// integer 0 consider as false
// integer 1 consider as true
// float 0.0 consider as false
// empty string '' consider as false
// '0' consider as false
// [] consider as false
// null = false


#                            INTEGER DATA TYPE
#                          *********************

#       predefined constants : 

echo PHP_INT_MAX."<br>";
echo PHP_INT_MIN."<br>";
echo PHP_INT_SIZE."<br>";

$a = 10;        #base 10 
$b = 0x2A;      #hexadecimal values
$c = 055;       #octal values
$d = 0b111;     #binary to decimal


#                               casting :
#                              **********

$a = (int)10.9;     #   result = 10 
$b = (int)"10.9";   #   result = 10    

#    check integer or not 
is_int($a);



#                           FLOATING DATA TYPE
#                       **************************

$x = 143.2;
echo PHP_FLOAT_MAX."<br>";
echo PHP_FLOAT_MIN."<br>";
echo PHP_FLOAT_DIG."<br>";


#floor

$floor_value  = floor($x);
echo "floor value of {$x} is ",$floor_value."<br>";

#ceil

$ceil_value = ceil($x);
echo "ceil value of {$x} is ",$ceil_value."<br>";


#                        STRING DATA TYPE
#                       ******************

$first_name = "will";
$last_name = "smith";
$name = $first_name." ".$last_name;
# specific character in a single string 

echo $name[0]."<br>";
$name[0] = "M";
echo $name."<br>";
 
# another two representations of strings


# HereDoc

$start = <<<TEXT
line1
line2
line3
TEXT;

# output of start is line1 line2 line3

# but we want output line by line means use

echo nl2br($start)."<br>";



#NowDoc

$start = <<<'TEXT'
line1
line2
line3
TEXT;






#                       NULL DATATYPE

#to destroy existing variable use function unsset(10)
$x = 10;
echo $x."<br>";
unset($x);





#                           ARRAYS
#                           ******

#intializing

$programming_languages = ['Php' , 'Java' , 'python'];
echo $programming_languages[0]."<br>";
echo $programming_languages[1]."<br>";
echo $programming_languages[2]."<br>";

echo '<pre>';
print_r($programming_languages)."<br>";
echo '</pre>';

#KEYS 

#pre  intialiazing interpreter puts index0 , 1, 2 etc

var_dump(isset($programming_languages[1]));

$programming_languages[1] = "c++";
echo $programming_languages[1]."<br>";

# insertion 

#ONE WAY : 

$programming_languages[] = "java";

#ANOTHER WAY :

array_push($programming_languages , "cobalt" , "c","flutter");


echo '<pre>';
    print_r($programming_languages);
echo '</pre>';


#                   CUSTOM KEYS

$custom_array = [
    'Grandma' => [
        "name " => "R.Andal",
        "Age"=> 60,
        "children"=>[
            "son"=>"paneer Selvam",
            "Daughter"=>"selvi"
        ]
    ],
    'Daddy' => [
        "name"=>"selvi",
        "age"=>40,
        "childer"=>[
            "first_son"=>"ramkumar",
            "second_son"=>"murthy"
        ]
    ]
];


echo $custom_array['Daddy']["children"]["so n"]."<br>";

echo '<pre>';
print_r($custom_array);
echo '</pre>';

$arr_numbers = [1,2,3,50=>4,5,6];

#ouput :
#   0 => 1
#   1 => 2
#   2 => 3
#   50 => 4
#   51 => 5
#   52 => 6


#           Remove last element using

            array_pop($arr_numbers);

# once we remove elements in Array  , it integer keys are assigened and starts from 0 .

#ouput :
#   0 => 1
#   1 => 2
#   2 => 3
#   3 => 4
#   4 => 5



#           Remove front element using

            array_shift($arr_numbers);

#           Remove element using unset function

            unset($arr_numbers[50]);

            #multiple elements : 
            #********************

                unset($arr_numbers[0] , $arr_numbers[1]);


                # in unset integer keys are not reassigned .


                #eg : 
                $mine = [1,2,3];
                unset($mine[0] , $mine[1],$mine[2]);
                $mine[] = 10;
                #we assume output
                #     Array([0] => 10)
                # but actual output
                #     Array([3] => 10)

                # because after unset full array , it takes largest index and assign largest index+1 to new element 


echo '<pre>';
    print_r($arr_numbers);
echo '</pre>';





#               Array type casting
#               ******************

$x = "10";
var_dump((array)$x);

#               Key exists or not
#               *****************

$array = ['a' => 1 , 'b'=>2];
var_dump(array_key_exists('a',$array));
var_dump(isset($array['a']));


echo <<<TEXT

difference bwtween isset and array_key_exits .
 *********************************************


isset : 
    
       checks if key present or not and its value is not null

array_key_exits :

    checks if key is present or not only .

    

TEXT;






    #string
        $name = "murthy";

    #Integer

        $age = 10;
    #format
        #float 
        $number_list = 100.5;
        #string
        $numberList = "100";
        #float
        $Number_List = 100;
        

        #remember php is case sensitive

        #string concatenantion

        echo $name." "."age is {$age}";

        #we can use assign HTML TAGS in variables

        #eg :

        $n  = "<h1>n is html element assigned in one variable</h1>";
        echo $n;

    ?>
    <h1>
        <?php $name = "Murthy" ?>
        <?php echo "hello world" ?>
    </h1>
    <h2>
        <?php echo $name?>
    </h2>
    <h2>
        <?php $a = 10 ; echo "This is my first php file ".$a ?>
    </h2>
</body>
</html>
