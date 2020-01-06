<?php
require_once __DIR__ . "/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";
$host = 'localhost';
$user = 'sana';
$password = 'sanazez503';
$db_name = 'user879191_pricelist';
$link = mysqli_connect($host, $user, $password, $db_name);
mysqli_query($link, "SET NAMES 'utf8'");

$query = "CREATE TABLE tovars (
    column0 TEXT,
    column1 TEXT,
    column2 TEXT,
    column3 TEXT,
    column4 TEXT,
    column5 TEXT
   )";
mysqli_query($link, $query) or die(mysqli_error($link));

$xls = PHPExcel_IOFactory::load('pricelist.xls');
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();

for ($i = 1; $i <= $sheet->getHighestRow(); $i++) {
    $query = "INSERT INTO tovars SET";
    for ($j = 0; $j < 6; $j++) {
        $value = $sheet->getCellByColumnAndRow($j, $i)->getValue();
        $query .= " column" . $j . "='" . $value . "',";
    }
    $query = substr($query, 0, -1);
    mysqli_query($link, $query) or die(mysqli_error($link));
}
