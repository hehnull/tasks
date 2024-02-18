<?php
declare(strict_types = 1);
require_once __DIR__ . '/../../boot.php';

$currentPage = null;
foreach (getMovies() as $movie)
{
	if ($movie['id'] === (int)$_GET['id'])
	{
		$selectedMovie = $movie;
	}
}
if (empty($selectedMovie))
{
	header('Location: /');
}

$partRatingPercent = round(($selectedMovie['rating'] - floor($selectedMovie['rating'])) * 100);
$wholeRatingPercent = floor($selectedMovie['rating']);

echo view('layout', [
	'rating' => view('components/specific-movie/rating',
		[
			'partRatingPercent' => $partRatingPercent,
			'wholeRatingPercent' => $wholeRatingPercent,
		]),
	'outputContent' => view('components/specific-movie/movie-info',
		[
			'selectedMovie' => $selectedMovie,
		]),
	'menuContent' => view('components/common/menu', [
		'currentPage' => $currentPage,
		'menuItem' => getMenuItem(),
	]),
	'referenceLogo' => array_keys(getFixedPages()[0])[0],
]);