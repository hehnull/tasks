<?php
declare(strict_types = 1);
require_once __DIR__ . '/../../boot.php';

$referenceLogo = array_keys(getFixedPages())[0];
$mainPageAdress = getPageAdressById(1);
$favPageAdress = getPageAdressById(2);
$mainPageName = mb_strtoupper(getPageNameById(1));
$favPageName = mb_strtoupper(getPageNameById(2));
$getParams = $_GET;
$selectedMovie = null;
$amountActors = null;
if (!(isset($getParams['id']) && isset(getMovies()[$getParams['id']])))
{
	header('Location: /');
}
foreach (getMovies() as $movie)
{
	if ($movie['id'] === (int)$getParams['id'])
	{
		$selectedMovie = $movie;
		$amountActors = count($selectedMovie['cast']);
		break;
	}
}

$partRatingPercent = round(($selectedMovie['rating'] - floor($selectedMovie['rating']))
	* 100); // Оставшаяся часть после запятой, умноженная на 100
$wholeRatingPercent = floor($selectedMovie['rating']) - 1;
echo view('layout', [
	'outputContent' => view('components/specific-movie/movie-info',
		[
			'selectedMovie' => $selectedMovie,
			'amountActors' => $amountActors,
		]),
	'menuContent' => view('components/common/menu', [
		'mainPageAdress' => $mainPageAdress,
		'favPageAdress' => $favPageAdress,
		'mainPageName' => $mainPageName,
		'favPageName' => $favPageName,
	]),
	'referenceLogo' => $referenceLogo,
	'partRatingPercent' => $partRatingPercent,
	'wholeRatingPercent' => $wholeRatingPercent,
]);