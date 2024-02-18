<?php

declare(strict_types = 1);
require_once __DIR__ . '/../../boot.php';

$currentPage = 'add-movie';

echo view('layout', [
	'outputContent' =>  view('components/main-page/movie-output',
		['selectedMovies' => ""]),
	'menuContent' => view('components/common/menu',
		[
			'currentPage' => $currentPage,
			'menuItem' => getMenuItem()
		]),
	'referenceLogo' => array_keys(getFixedPages()[0])[0],
	'rating' => null,
]);