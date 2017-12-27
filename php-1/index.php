<?php

$colors = ["red", "blue", "green", "orange", "purple", "black", "yellow", "pink", "gray", "maroon", "lime", "cyan"];

shuffle($colors);

$div = array_slice($colors , -4);

?>



<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JS</title>
    <link rel="stylesheet" href="css/main.css" type="text/css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<?php

for($i = 0; $i < count($div); $i++) {
    echo "<div style=\"background-color: " . $div[$i] . "\"></div>";
}

?>



<script src="js/jquery-3.2.1.js"></script>
<script src="js/main.js"></script>
</body>

</html>
