<?php
declare(strict_types = 1);
require_once __DIR__ . '/../boot.php';
$currentPage = 'main';
$uri = substr($_SERVER['REQUEST_URI'], 1);

if ($uri !== '' && isset(getGernes()[$uri]))
{
	$selectedMovies = getMovies($uri);
	$currentPage = $uri;
}
if (isset($_GET['q']))
{
	$selectedMovies = getMovies(null, $_GET['q']);
	$currentPage = null;
}
else
{
	$selectedMovies = getMovies();
}

echo view('layout', [
	'outputContent' => view('components/main-page/movie-output',
		['selectedMovies' => $selectedMovies]),
	'menuContent' => view('components/common/menu',
		[
			'currentPage' => $currentPage,
			'menuItem' => getMenuItem(),
		]),
	'referenceLogo' => array_keys(getFixedPages()[0])[0],
	'rating' => null,
]);