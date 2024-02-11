<?php
declare(strict_types = 1);

function extractData(string $dataPath)
{
	static $receivedAllPaths = [];
	$receivedData = null;
	if (!in_array($dataPath, array_keys($receivedAllPaths), true))
	{
		$receivedData = require_once $dataPath;
		$receivedAllPaths[$dataPath] = $receivedData;
	}
	return $receivedAllPaths[$dataPath];
}

function getFixedPages()
{
	[$fixedPages,] = extractData(ROOT . '/config.php');
	return $fixedPages;
}

function getPathToMoviesData(): string
{
	[, $pathToData] = extractData(ROOT . '/config.php');
	return $pathToData;
}

function getMovieGernes(): array
{
	/** @var array $genres */
	require getPathToMoviesData();
	return $genres;
}

function getMovies(): array
{
	/** @var array $movies */
	require getPathToMoviesData();
	return $movies;
}

function getPageAdressById(int $num): string
{
	$keys = array_keys(getFixedPages());
	if (!isset($keys[$num - 1]))
	{
		throw new Exception('Invalid number');
	}
	return $keys[$num - 1];
}

function getPageNameById(int $num): string
{
	$keys = array_keys(getFixedPages());
	if (!isset(getFixedPages()[$keys[$num - 1]]))
	{
		throw new Exception('Invalid number');
	}
	return getFixedPages()[$keys[$num - 1]];
}

function outputDuration(int $onlyMinutes): string
{
	$minutes = $onlyMinutes % 60;
	$hours = intval($onlyMinutes / 60);
	return sprintf("%s мин. / %s:%s", $onlyMinutes, $hours, $minutes);
}

function getFilteredMoviesByGenres(string $genreName): array
{
	$filteredMovies = [];

	foreach (getMovies() as $movie)
	{
		if (in_array($genreName, $movie['genres'], true))
		{
			$filteredMovies[] = $movie;
		}
	}
	return $filteredMovies;
}

