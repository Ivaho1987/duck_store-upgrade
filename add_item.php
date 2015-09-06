<?php

$item_name = $_POST['item_name'];
$description = $_POST['description'];
$price = $_POST['price'];
$item_image = $_POST['image'];

$file = __DIR__."/data/products.csv";
if (!file_exists($file)) {
    die("We dont have data file");		// проверка существования файла
}
if(($fp = fopen($file, 'r+')) === false) {		// открытие файла для чтения и записи
    die("Error while opening file");
}
$products = [];					// создание массива products
$i = 0;
while (($data = fgetcsv($fp, 1000, ';')) !== false) {			
    if ($i > 0) {
        $products[$data[0]] = $data;
    }
    $i++;
}
$new_item=count($products).";".$item_name.";".$description.";".$price;

$adding_item = fwrite($fp, $new_item);

if ($adding_item) {
  echo "Товар занесен в базу";
} else {
  echo "Ops";
}

$uploaddir = __DIR__ . "/images";
$uploadfile = $uploaddir . basename($_FILES['$item_image']['name']);

if (move_uploaded_file($_FILES['$item_image']['name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo "Что-то пошло нет так\n";
}

fclose($fp);

?>