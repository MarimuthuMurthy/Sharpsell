<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


    <?php
    #               MATH INBUILT FUNSTIONS
    #               **********************

        echo "2 power of 3 is ",pow(2,3)."<br>";
        echo "random number between 1 and 100 using rand inbuilt functions is ",rand(1,100)."<br>";
        echo "square root of 4 is ",sqrt(4)."<br>";
        echo "ceil of 5 divided by 2 is ",ceil(5/2)."<br>";
        echo "round inbuilt function is ", round(5/2)."<br>";


    #           STRING INBUILT FUNCTIONS
    #           ************************

        $str = "hello students do you like the class";
        echo strlen($str)."<br>";
        $char_array = str_split($str);
        print_r($char_array)."<br>";
        echo strtoupper($str)."<br>";




    #           ARRAY INBUILT FUNCTIONS
    #           ***********************

        $list = ["hello" , "my" , "name" , "is" , "murthy"];
        print_r (array_reverse($list));






    ?>















</body>
</html>