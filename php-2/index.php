<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
    <link rel="stylesheet" href="css/main.css" type="text/css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<?php

//Функция, принимающая массив строк и выводящая каждую строку в отдельном параграфе.
function arrayToStrings($arr) {
    foreach ($arr as $str) {
        echo "<p>$str</p>";
    }
}

$arrStr = ["First text", "Second text", "Third text"];
arrayToStrings($arrStr);

echo "<hr>";



//Функция, принимающая 2 параметра ­ массив чисел и строку,
//обозначающую арифметическое действие,
//которое нужно выполнить со всеми элементами массива
function math($arrNum, $op) {
	$res = 0;

    foreach ($arrNum as $num) {
        if (!$res) {
            $res = $num;
            continue;
        }

        switch ($op) {
            case "+":
                $res += $num;
                break;
            case "-":
                $res -= $num;
                break;
            case "*":
                $res *= $num;
                break;
            case "/":
                $res /= $num;
                break;
        }
    }

    echo "<p>$res</p>";
}

math([2, 3, 5], "*");

echo "<hr>";



//Функция, принимающая переменное число аргументов,
//но первым аргументов обязательно должна быть строка,
//обозначающее арифметическое действие,
//которое необходимо выполнить со всеми передаваемыми аргументами.
function math2($op, ...$args) {
    $res = 0;

    foreach ($args as $num) {
	    if (!$res) {
		    $res = $num;
		    continue;
	    }

        switch ($op) {
            case "+":
                $res += $num;
                break;
            case "-":
                $res -= $num;
                break;
            case "*":
                $res *= $num;
                break;
            case "/":
                $res /= $num;
                break;
        }
    }

    echo "<p>$res</p>";
}

math2("+", 2, 5, 6, 8, 3);

echo "<hr>";



//Функция принимающая два параметра ­ 2 целых числа.
//Если вводятся не 2 целых числа ­ то функция должна выводить ошибку на экран.
//Если пользователь вводит 2 целых числа ­ то ему должна отрисовываться таблица умножения
//размером со значения параметров, переданных функции.
echo "<p>Функция принимающая два параметра - 2 целых числа. " .
    "Если вводятся не 2 целых числа - то функция должна выводить ошибку на экран. " .
    "Если пользователь вводит 2 целых числа - то ему должна отрисовываться таблица умножения " .
    "размером со значения параметров, переданных функции.</p>";
echo "<br>";

function table($a, $b) {
    $res = "<table>";

    for ($i = 1; $i <= $b; $i++) {
        $res .= "<tr>";
        for ($j = 1; $j <= $a; $j++) {
            if ($i == 1 || $j == 1) {
                $res .= "<th>" . ($j * $i) . "</th>";
            } else {
                $res .= "<td>" . ($j * $i) . "</td>";
            }
        }
        $res .= "</tr>";
    }

    $res .= "</table>";

    echo $res;
}

$table_a = $_POST['table_a'];
$table_b = $_POST['table_b'];

?>

<form action="#" method="post">
    <label>Введите первое число:
        <input type="text" name="table_a" value="<?= $table_a ?>">
    </label>
    <label>Введите второе число:
        <input type="text" name="table_b" value="<?= $table_b ?>">
    </label>
    <input type="submit" name="submit" value="Ok">
</form>

<?php

if (!$table_a || !$table_b) {
	echo "<p class='alert'>Введите данные.</p>";
} else if (ctype_digit($table_a) && ctype_digit($table_b)) {
	table(intval($table_a), intval($table_b));
} else {
    echo "<p class='alert'>Некорректно введены данные. \n Введите целые числа.</p>";
}

echo "<hr>";



//Функция, принимающая в качестве аргумента массив чисел вида: 1, 22, 5, 66, 3, 57
//и возвращает массив по возрастанию: 1, 3, 5, 22, 57, 66
function sortArr($arr) {
    for ($i = 0; $i < count($arr) - 1; $i++) {
        for ($j = 0; $j < count($arr) - $i - 1; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
            }
        }
    }

    return $arr;
}

$my_arr = [1, 22, 5, 66, 3, 57, 8, 2, 28];

print_r($my_arr);
echo "<br>";
print_r(sortArr($my_arr));

echo "<hr>";



//Рекурсивную функцию, принимающую два целых числа ­ начальное значение и конечное значение.
//Например, первый аргумент 10, второй ­ 35.
//Функция должна вывести на экран список нечетных чисел от 10 до 35.
function getOdd($a, $b) {
    if ($a > $b) return;
	if ($a % 2) echo $a . "<br>";

	getOdd($a + 1, $b);
}

getOdd(10, 35);

echo "<hr>";



//Функция, получающая 1 параметр (строку) и возвращающая TRUE,
//если строка является палиндромом, в противном случае - FALSE.
function isPalindrome($str) {
    $str = preg_replace("/[^a-zA-ZА-Яа-яЁё0-9]/u","",$str);
    $str = mb_strtolower($str);
    $half = floor(mb_strlen($str) / 2);
    $strRev = iconv('utf-8', 'utf-16le', $str);
	$strRev = iconv('utf-16be', 'utf-8', strrev($strRev));

    return mb_substr($str, 0, $half) === mb_substr($strRev, 0 ,$half);
}

$str1 = "Abc d  cba";
$str2 = "А роза упала на лапу Азора";
$str3 = "Madam, I'm Adam";

echo $str1;
echo "<br>";
var_dump(isPalindrome($str1));
echo "<br>";
echo "<br>";

echo $str2;
echo "<br>";
var_dump(isPalindrome($str2));
echo "<br>";
echo "<br>";

echo $str3;
echo "<br>";
var_dump(isPalindrome($str3));

?>




<script src="js/jquery-3.2.1.js"></script>
<script src="js/main.js"></script>
</body>

</html>
