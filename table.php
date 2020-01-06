<?php

$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
$user = 'sana'; //имя пользователя, по умолчанию это root
$password = 'sanazez503'; //пароль, по умолчанию пустой
$db_name = 'user879191_pricelist'; //имя базы данных
//Соединяемся с базой данных используя наши доступы:
$link = mysqli_connect($host, $user, $password, $db_name);
mysqli_query($link, "SET NAMES 'utf8'");
if (!empty($_POST['min-price']) and !empty($_POST['max-price']) and !empty($_POST["quantity"])) {
    if (is_int($_POST["quantity"] + 0) and is_numeric($_POST["quantity"]) and is_numeric($_POST['min-price']) and is_numeric($_POST['max-price'])) {
        echo "<table>";
        $query = "SELECT * FROM tovars WHERE (" . $_POST['type-price'] . " >" . $_POST['min-price'] . " AND " . $_POST['type-price'] . "<" . $_POST['max-price'] . ") AND (column3" . $_POST["more-less"] . $_POST["quantity"] . " OR column4" . $_POST["more-less"] . $_POST["quantity"] . ")";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
        $result = '';
        $result .= '<tr>';
        $result .= '<th> Наименование товара </th>';
        $result .= '<th>Стоимость, руб</th>';
        $result .= '<th>Стоимость опт, руб</th>';
        $result .= '<th>Наличие на складе 1, шт</th>';
        $result .= '<th >Наличие на складе 2, шт</th>';
        $result .= '<th>Страна производства</th>';
        $result .= '<th> Примечание </th>';
        $result .= '</tr>';
        for ($i = 1; $i < count($data); $i++) {
            $result .= '<tr>';
            $result .= '<td>' . $data[$i]['column0'] . '</td>';
            $result .= '<td>' . $data[$i]['column1'] . '</td>';
            $result .= '<td>' . $data[$i]['column2'] . '</td>';
            $result .= '<td>' . $data[$i]['column3'] . '</td>';
            $result .= '<td>' . $data[$i]['column4'] . '</td>';
            $result .= '<td>' . $data[$i]['column5'] . '</td>';
            $result .= '<td> </td>';
            $result .= '</tr>';
        }
        echo $result;
        echo "</table>";
    } else {
        echo "Введены не коректные данные!!!";
    }
} else {
    echo "Введены ни все данные!!!";
}
