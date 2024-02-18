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

function outputDuration(int $onlyMinutes): string
{
	$minutes = $onlyMinutes % 60;
	$hours = intval($onlyMinutes / 60);
	return sprintf("%s мин. / %s:%s", $onlyMinutes, $hours, $minutes);
}

function getPathToMoviesData(): string
{
	[, $pathToData] = extractData(ROOT . '/config.php');
	return $pathToData;
}

function getGernes(): array
{
	/** @var array $genres */
	require getPathToMoviesData();
	return $genres;
}

function getMovies(?string $genre = null, ?string $searchString = null): array
{
	/** @var array $movies */
	require getPathToMoviesData();
	if (isset($genre))
	{
		$filteredMovies = [];

		foreach ($movies as $movie)
		{
			if (in_array($genre, $movie['genres'], true))
			{
				$filteredMovies[] = $movie;
			}
		}
		return $filteredMovies;
	}
	if (isset($searchString))
	{
		return searchMovies($movies, $_GET['q']);
	}
	return $movies;
}

function toupperMenu($item)
{
	return mb_strtoupper($item);
}

function getMenuItem()
{
	return array_map('toUpperMenu', array_merge(getFixedPages()[0], getGernes(), getFixedPages()[1]));
}