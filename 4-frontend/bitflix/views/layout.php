<?php
/**
 * @var string $outputContent
 * @var string $menuContent
 * @var string $referenceLogo
 * @var string $rating
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" href="style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">


	<meta charset="UTF-8">
	<title>Title</title>
	<style>
		<?= $rating ?? '' ?>
	</style>
</head>
<body>
<div class="sidebar">
	<a class="logo" href="<?= $referenceLogo; ?>">
		<img class="imglogo" src="data/site/logo.png" alt="Векторный логотип">
	</a>
	<nav class="menu-buttons">
		<?= $menuContent ?>
	</nav>

</div>
<div class="wrapper">
	<div class="header">
		<form action="/search" method="get" class="form-search">
			<div class="search-field">
				<img src="../public/data/site/search%201.png" alt="" class="logo-search">
				<input type="text" class="search-text" name="q" placeholder="Поиск по каталогу...">
			</div>
			<input type="submit" class="search-button" value="ИСКАТЬ">
		</form>
		<a class="add-button" href="/add-movie">ДОБАВИТЬ ФИЛЬМ</a>
	</div>
	<?= $outputContent; ?>
</div>

</body>
</html>