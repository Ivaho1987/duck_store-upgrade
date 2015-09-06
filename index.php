<?php

$file = __DIR__."/data/products.csv"; // файл с данными по продуктам присваеиваем переменной

if (!file_exists($file)) {
    die("We dont have data file");		// проверка существования файла
}

if(($fp = fopen($file, 'r+')) === false) {		// открытие файла для чтения и записи
    die("Error while opening file");
}

$products = [];					// создание массива products

$i = 0;
while (($data = fgetcsv($fp, 1000, ';')) !== false) {			//создание массива products в котром каждому значению соотсвует массив строки
    if ($i > 0) {
        $products[$data[0]] = $data;
    }
    $i++;
}




if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'main';
}

switch ($page) {
    case 'main':
        include_once 'main.php';
        break;
    case 'catalog':
        include 'catalog.php';
        break;
    case 'single-item':
        include 'single-item.php';
        break;
    default:
        echo "<h1>Oooops. 404</h1>";
        break;
}

fclose($fp);
?>
