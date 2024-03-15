<?php
declare(strict_types = 1);
require_once __DIR__ . '/../../boot.php';


$currentPage = null;
$selectedMovie = getDbMovieById($_GET['id']);


if (empty($selectedMovie))
{
	header('Location: /');
}
$partRatingPercent = round(($selectedMovie['RATING'] - floor((int)$selectedMovie['RATING'])) * 100);
$wholeRatingPercent = floor((int)$selectedMovie['RATING']);

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
	'referenceLogo' => getOptions('uri_for_logo'),

]);