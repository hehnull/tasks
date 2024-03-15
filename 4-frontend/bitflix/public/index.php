<?php
declare(strict_types = 1);
require_once __DIR__ . '/../boot.php';
$currentPage = 'main';
$uri = substr($_SERVER['REQUEST_URI'], 1);

if ($uri !== '' && isset(getDbGenresWithCodes()[$uri]))
{
	$selectedMovies = getDbFilteredMovies(getDbGenresWithCodes()[$uri]);
	$currentPage = $uri;
}
elseif (isset($_GET['q']))
{
	$selectedMovies = getDbFilteredMovies(null, $_GET['q']);
	$currentPage = null;
}
else
{
	$selectedMovies = getDbFilteredMovies();
}

/*echo '<pre>';
var_dump($selectedMovies);
echo '</pre>';
die;*/

echo view('layout', [
	'outputContent' => view('components/main-page/movie-output',
		['selectedMovies' => $selectedMovies]),
	'menuContent' => view('components/common/menu',
		[
			'currentPage' => $currentPage,
			'menuItem' => getMenuItem(),
		]),
	'referenceLogo' => getOptions('uri_for_logo'),
]);