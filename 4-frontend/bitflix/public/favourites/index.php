<?php
declare(strict_types = 1);
require_once __DIR__ . '/../../boot.php';

$currentPage = 'favourites';

echo view('layout', [
	'outputContent' => view('components/main-page/movie-output',
		['selectedMovies' => ""]),
	'menuContent' => view('components/common/menu',
		[
			'currentPage' => $currentPage,
			'menuItem' => getMenuItem(),
		]),
	'referenceLogo' => getOptions('uri_for_logo'),
]);