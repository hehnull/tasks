<?php
declare(strict_types = 1);
$fixedPages = [
	['main' => 'Главная'],
	['favourites' => 'Избранное'],
];
$pathToGenres = ROOT . '/public/data/content/text/movies.php';
return [$fixedPages, $pathToGenres];