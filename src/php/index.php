<?php
$start = microtime(true); // Время начала работы скрипта

function check_hit($x, $y, $r): bool
{
    if($x >= 0 and $y >= 0){ // 1
        if($x + $y <= $r){
            return true;
        }
        return false;
    }
    else if($x >= 0 and $y < 0){ // 2
        if($x * $x + $y * $y <= $r * $r / 4){
            return true;
        }
        return false;
    }
    else if($x < 0 and $y < 0){ // 3
        if($x >= -$r/2 and $y >= -$r){
            return true;
        }
        return false;
    }
    else{ // 4
        return false;
    }
}

function validate($x, $y, $r): bool
{
    return -3 <= $x and $x <= 5 and -5 <= $y and $y <= 5 and 1 <= $r and $r <= 4;
}

// Парсинг аргументов GET-запроса

$x = ($_GET['x']);
$y = ($_GET['y']);
$r = ($_GET['r']);

if(isset($x) and isset($y) and isset($r)){
    global $x, $y, $r;

    $y = str_replace(',','.',$y);
    $r = str_replace(',','.',$r);

    $x = (float)$x;
    $y = (float)$y;
    $r = (float)$r;
}

if(validate($x, $y, $r)){
    //
    $is_hit = check_hit($x, $y, $r);

    $curr = array(
        "x" => $x,
        "y" => $y,
        "r" => $r,
        "is_hit" => $is_hit
    );

    session_start();
    if (isset($_SESSION['saves'])) {
        $saves = unserialize($_SESSION['saves']);
        array_push($saves, $curr);
        $_SESSION['saves'] = serialize($saves);
    } else {
        $saves = array();
        array_push($saves, $curr);
        $_SESSION['saves'] = serialize($saves);
    }

    echo '
    <!DOCTYPE html>
    <html lang="ru">
        <head>
            <meta charset="utf-8">
            <meta name="author" content="Kirill Neevin">
            <title>Неевин Кирилл</title>
            <link rel="icon" href="../img/icon.ico">
            <link rel="stylesheet" href="../style.css">
        </head>
        <body>
            <header id="header">
                Неевин Кирилл P3213, выриант: 13201
            </header>';

    echo "<div class='center-wrapper'>
    <table class='inner'>
        <tr>
            <th>X</th>
            <th>Y</th>
            <th>R</th>
            <th>Есть попадание</th>
        </tr>
";
    foreach ($saves as &$element) {
        echo "
        <tr>
            <td>".$element["x"]."</td>
            <td>".$element["y"]."</td>
            <td>".$element["r"]."</td>
            <td>".($element["is_hit"] ? "да" : "нет")."</td>
        </tr>";
    }
    echo "</table></div>";

    echo '<p id="info-pannel">';
    echo "Текущая дата: " . date("d M Y, H:i:s") . "<br>";
    echo "Время работы скрипта: " . (microtime(true) - $start) . " мс";
    echo '</p>';

    echo '
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../script.js"></script>
    </body>
</html>
';

}
else{
    echo "Неверные поля GET запроса. Измените и отправьте снова.";
}

// Очистить данные сессии
$reset = $_GET['reset'] ?? 'no';
if($reset !== 'no'){
    $_SESSION['saves'] = serialize(array());
}
?>