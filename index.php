<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="st.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" id="form">
      <span>
         Показать товары, у которых
      </span>
        <select name="type-price">
            <option value="column1">Розничная цена</option>
            <option value="column2"> Оптовая цена</option>
        </select>
        <span>от</span>
        <input type="text" name="min-price">
        <span>до</span>
        <input type="text" name="max-price">
        <span>рублей и на складе</span>
        <select name="more-less">
            <option value=">">Более</option>
            <option value="<">Менее</option>
        </select>
        <input type="text" name="quantity">
        <span>штук.</span>
        <input type="submit" value="Показать">
    </form>
    <br>
    <div id="result">
    <?php
    $host = 'localhost'; 
    $user = 'sana'; 
    $password = 'sanazez503'; 
    $db_name = 'user879191_pricelist'; 

    $link = mysqli_connect($host, $user, $password, $db_name);
    mysqli_query($link, "SET NAMES 'utf8'");
    echo "<table>";
    $query = "SELECT * FROM tovars";
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
    ?>
    </div>
    <script src="script.js"></script>
</body>
</html>
