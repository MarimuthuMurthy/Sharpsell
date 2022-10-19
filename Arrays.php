<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        
        #one-way
        $numberList = array(23,64,267 , 23 , "123" , "murthy" , "<h1>hello</h1>");
        #another way
        $number_list = [];
        echo $numberList[6];
        print_r($numberList)
    ?>
    <h2>
        <!-- /**
        *Associate Arrays
       *********************
         */ -->

        <?php
        #normal array : based on INDEX
            $number = [10 , 20 ,45 , 49];
            echo $number[2];
            echo $number[1]. "<br>";
        
        #associated array
            $names = ["first_name" => "Marimuthu" , "last_name" => "Murthy",20 , "age"=>20 , 40];
            print_r($names);
        ?>
    </h2>

    <?php

    $items = ['a'=>1 , 'b'=>2 , 'c'=>3 , 'd'=>4,'e'=>5];
    array_chunk($items,2,true);


    $array1 = ["john" , "rey" , "mike"];
    $array2 = ["cena" , "mysterio" , "tyson"];
    $new_array = array_combine($array1 , $array2);

    $allNumebrs = [1,2,3,4,5,6,7,8];
    $even = array_filter($allNumebrs , fn($element)=>$element%2===0);
    $even = array_values($even);


    $mixedAllValues= ['a'=>1 , 'b'=>2 , 'c'=>3 , 'd'=>4];
    $mixedAllValues = array_keys($mixedAllValues , 2, true);

    $array = [1,2,3,4,5,6,7,8,9];
    $result_array = array_map(fn($element)=>$element+2 , $array);


    $array1 = [1,2,3,4];
    $array2= ['a'=>5,6,7,8];
    $array3 = [10,20,30,40];
    $merged = array_merge($array1 , $array2 , $array3);

    echo '<pre>';
        print_r($items);
        print_r($new_array);
        print_r($even);
        print_r($mixedAllValues);
        print_r($result_array);
        print_r($merged);
    echo '</pre>';


    $invoiceitems =
    [
        ['price'=>9.99  , 'qty'=>3,'desc'=>'item 1'],
        ['price'=>29.99 , 'qty'=>1,'desc'=>'item 2'],
        ['price'=>149   , 'qty'=>1,'desc'=>'item 3'],
        ['price'=>14.99 , 'qty'=>2,'desc'=>'item 4'],
        ['price'=>4.99  , 'qty'=>4,'desc'=>'item 5'],
    ];
    $total = array_reduce(
        $invoiceitems , fn($sum , $item)=>$sum+$item['qty']*$item['price']
    );
    echo $total."<br>";

    echo array_search(5 ,$array)."<br>";
    echo in_array(1,$array);

    #to sort only values use        "asort"
    #to sort only keys use          "ksort"
    #to do manual sort use          "usort"
    $arra = [1,3,2,4];
    usort($arra , fn($a,$b)=> $b<>$a);

    echo "<pre>";
    print_r($arra);
    echo "</pre>";

    ?>





</body>
</html>