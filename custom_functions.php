<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Custome functions</h1>
    <h2>**********************</h2>

    <?php
    function reverseANumber(int $number)
    {
        $result = 0;
        while($number!=0)
        {
            $rem = (int)$number%10;
            $result = $result*10+$rem;
            $number = (int)($number/10);
            //echo "<p>type conversion number is {$dummy} , floor value is  {$number}</p>";
        }
        return $result;
    }

    #           FUNCTION PARAMETERS
    #           *******************

    function greeting (string $name)
    {
        echo "hey {$name} , how are you ???";
    }   

    greeting("murthy");





    #               SCOPE
    #               *****
    $outside = 100;

    function convert()
    {
        global $outside;
        $outside = "murthy";
    }
    var_dump($outside);
    echo $outside."<br>";
    convert();
    var_dump($outside);
    echo $outside."<br>";

if(true):
    function foo() : ?string
    {
        return "hello world";
    }
endif;



#           return statement

# you can return multiple datatypes


function sum() : int|float|array{
    return 1;
}

# if we want to put more datatypes use "mixed" keyword . 

function sum1() : mixed{
    return null;
}


    echo sum1()."<br>";











    ?>















</body>
</html>