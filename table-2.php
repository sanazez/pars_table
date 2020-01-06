<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <table>
        <?php

$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
$user = 'sana'; //имя пользователя, по умолчанию это root
$password = 'sanazez503'; //пароль, по умолчанию пустой
$db_name = 'user879191_pricelist'; //имя базы данных

//Соединяемся с базой данных используя наши доступы:
$link = mysqli_connect($host, $user, $password, $db_name);
mysqli_query($link, "SET NAMES 'utf8'");
$query = "SELECT * FROM tovars";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
$result = '';

for ($i = 1; $i < count($data); $i++) {
    if (is_numeric($data[$i]['column1'])) {
        $arrayRetail[] = ($data[$i]['column1']) + 0;
    }
    if (is_numeric($data[$i]['column2'])) {
        $arrayWh[] = ($data[$i]['column2']) + 0;
    }
}

$result .= '<tr>';
$result .= '<th>' . $data[0]['column0'] . '</th>';
$result .= '<th>' . $data[0]['column1'] . '</th>';
$result .= '<th>' . $data[0]['column2'] . '</th>';
$result .= '<th>' . $data[0]['column3'] . '</th>';
$result .= '<th >' . $data[0]['column4'] . '</th>';
$result .= '<th>' . $data[0]['column5'] . '</th>';
$result .= '<th> Примечание </th>';
$result .= '</tr>';
for ($i = 1; $i < count($data); $i++) {
    $total += $data[$i]['column3'];
    $total += $data[$i]['column4'];

    $result .= '<tr>';
    if (is_numeric($data[$i]['column2'])) {
        $result .= '<td>' . $data[$i]['column0'] . '</td>';
    } else {
        $result .= '<th>' . $data[$i]['column0'] . '</th>';
    }
    /* находим самый дорогой товар по рознице */
    if (is_numeric($data[$i]['column1'])) {
        if (($data[$i]['column1']) + 0 == max($arrayRetail)) {
            $result .= '<td class="expensive">' . $data[$i]['column1'] . '</td>';
        } else {
            $result .= '<td>' . $data[$i]['column1'] . '</td>';
        }
    } else {
        $result .= '<td>' . $data[$i]['column1'] . '</td>';
    }
/* находим самый дешевый товар по опту */
    if (is_numeric($data[$i]['column2'])) {
        if (($data[$i]['column2']) + 0 == min($arrayWh)) {
            $result .= '<td class="cheap">' . $data[$i]['column2'] . '</td>';
        } else {
            $result .= '<td>' . $data[$i]['column2'] . '</td>';
        }
    } else {
        $result .= '<td>' . $data[$i]['column2'] . '</td>';
    }
    $result .= '<td>' . $data[$i]['column3'] . '</td>';
    $result .= '<td>' . $data[$i]['column4'] . '</td>';
    $result .= '<td>' . $data[$i]['column5'] . '</td>';

    if ($data[$i]['column3'] + 0 < 20 or $data[$i]['column4'] + 0 < 20) {
        $result .= '<td> "Осталось мало!! Срочно докупите!!!"</td>';
        $data[$i]["column6"] = "Осталось мало!! Срочно докупите!!!";
    } else {
        $result .= '<td></td>';
    }
    /* $result .= '<td>' . $data[$i]["column6"] . '</td>'; */
    $result .= '</tr>';
}
echo $result;

?>
    </table>
    <?php
$averageRetailPrice = array_sum($arrayRetail) / count($arrayRetail); /* находим среднюю стоимость розничной цены товара */
$averageWhPrice = array_sum($arrayWh) / count($arrayWh); /* находим среднюю стоимость оптовой цены товара */
echo "<p>
Oбщее количество товаров на Складе1 и на Складе2: " . $total . " шт. <br>
Средняя стоимость розничной цены товара: " . $averageRetailPrice . "<br>
Средняя стоимость оптовой цены товара: " . $averageWhPrice . "
</p>"

?>
</body>

</html>