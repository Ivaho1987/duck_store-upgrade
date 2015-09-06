<?php

include_once __DIR__ . '/templates/_header.php';
include_once __DIR__ . '/templates/_top_menu.php';

?>

<main>
	<div class="container">
		<div class="banner"></div>
		<div class="row clearfix">
			<!-- боковое меню -->
            <?php include_once 'templates/_menu.php'; ?>

			<form enctype="multipart/form-data" action="add_item.php" method="POST">
				<p>Введите название товара</p>
				<input name="item_name" type="text">
				    <p>Введите описание товара</p>
				    <textarea name="description" rows="5"></textarea>
				   <p>Введите цену товара</p>
				    <input name="price" type="text">
				   <p>Загрузите изображение</p>
				    <input type="file" name="image" accept="image/*">
				    <p>Добавление товара</p>
				    <input type="submit" value="Добавить товар в базу">				
			</form>
		</div>
	</div>
</main>
<?php include_once __DIR__ . '/templates/_footer.php';