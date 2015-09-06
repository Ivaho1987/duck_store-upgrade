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

$total_pages=count($products);
$active_page=$_GET['page'];

if (!isset($_GET['page']) || $_GET['page'] <1 || $_GET['page'] > $total_pages) {
$active_page=1;
}
if($active_page==$total_pages) {$active_page==$total_pages-1;}
?>
<div class="item-block column column4">
	<a href="single-item.php" class="item" title="<?=$products[$active_page[1]];?>">
		<img src="img/item.jpeg" alt="уточка">
	</a>
	<a href="index.php?page=single-item&id=<?=$products[$active_page[0]];?>" class="btn-basket">В Корзину</a>
</div>
<div class="item-block column column4">
	<a href="single-item.php" class="item" title="<?=$products[$active_page[1]+1];?>">
		<img src="img/item.jpeg" alt="уточка">
	</a>
	<a href="index.php?page=single-item&id=<?=$products[$active_page[0]+1];?>" class="btn-basket">В Корзину</a>
</div>

<?php
switch($active_page) {
	case 1: $next_page1=3;
			$next_page2=4;
			$prev_page1="Нет предыдущих товаров";
			$next_page1link = "index.php?page=single-item&id=3";
			$next_page2link = "index.php?page=single-item&id=4";
			$prev_page1link = '';
			$prev_page2link = '';
	
	break;
	case 2: $next_page1=4;
			$next_page2=5;
			$next_page1link = "index.php?page=single-item&id=4";
			$next_page2link = "index.php?page=single-item&id=5";
			$prev_page2=1;
			$prev_page2link = "index.php?page=single-item&id=1";
	
	break;
	case ($active_page>2 && $active_page<$total_pages-1): 
			$next_page1=$active_page+1;
			$next_page2=$active_page+2;
			$next_page1link = "index.php?page=single-item&id=".$products[$active_page[0]+1];
			$next_page2link = "index.php?page=single-item&id=".$products[$active_page[0]+2];
			$prev_page1=$active_page-2;
			$prev_page2=$active_page-1;
			$prev_page1link = "index.php?page=single-item&id=".$products[$active_page[0]-2];
			$prev_page2link = "index.php?page=single-item&id=".$products[$active_page[0]-1];
	break;
	case ($active_page=$total_pages-1): 
			$next_page1=$active_page+1;
			$next_page2="Нет следующих товаров";
			$next_page1link = "index.php?page=single-item&id=".$products[$total_pages];
			$next_page2link = "";
			$prev_page1=$active_page-2;
			$prev_page2=$active_page-1;
			$prev_page1link = "index.php?page=single-item&id=".$products[$active_page[0]-2];
			$prev_page2link = "index.php?page=single-item&id=".$products[$active_page[0]-1];
	break;
	
}
?>
<div class="pagination">
    <div class="prev"><a href="<?=$prev_page1link ?>"><? echo $prev_page1; ?></a></div>
     <div class="prev"><a href="<?=$prev_page2link ?>"><? echo $prev_page2; ?></a></div>
 
	<div class="next"><a href="<?=$next_page1link ?>"><? echo $next_page1; ?></a></div>
	<div class="next"><a href="<?=$next_page2link ?>"><? echo $next_page2; ?></a></div>
</div>

