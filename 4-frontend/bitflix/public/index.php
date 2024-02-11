<?php
declare(strict_types = 1);
require_once __DIR__ . '/../boot.php';

$getParams = $_GET;
$uri = substr($_SERVER['REQUEST_URI'], 1);
$referenceLogo = array_keys(getFixedPages())[0];
$mainPageAdress = getPageAdressById(1);
$favPageAdress = getPageAdressById(2);
$mainPageName = mb_strtoupper(getPageNameById(1));
$favPageName = mb_strtoupper(getPageNameById(2));

$selectedMovies = [];

if (isset($getParams['genre']) && isset(getMovieGernes()[$getParams['genre']]))
{
	$selectedMovies = getFilteredMoviesByGenres(getMovieGernes()[$getParams['genre']]);
}
else
{
	$selectedMovies = getMovies();
}
if (isset($getParams['q']))
{
	$selectedMovies = searchMovies($selectedMovies, $getParams['q']);
}

echo view('layout', [
	'outputContent' => view('components/main-page/movie-output',
		['selectedMovies' => $selectedMovies]),
	'menuContent' => view('components/common/menu',
		[
			'genre' => $getParams['genre'] ?? null,
			'uri' => $uri,
			'mainPageAdress' => $mainPageAdress,
			'favPageAdress' => $favPageAdress,
			'mainPageName' => $mainPageName,
			'favPageName' => $favPageName,

		]),
	'referenceLogo' => $referenceLogo,
]);