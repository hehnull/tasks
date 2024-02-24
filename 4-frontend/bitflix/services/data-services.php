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

function getPagesOption(?string $option = null)
{
	[$fixedPages,] = extractData(ROOT . '/config.php');
	if (isset($option))
	{
		return $fixedPages[$option];
	}
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

	if (isset($genre) && isset($searchString))
	{
		$filteredMovies = [];
		foreach ($movies as $movie)
		{
			if (in_array($genre, $movie['genres'], true))
			{
				$filteredMovies[] = $movie;
			}
		}
		return array_intersect_assoc($filteredMovies, searchMovies($movies, $searchString));
	}
	if (isset($searchString))
	{
		return searchMovies($movies, $searchString);
	}
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
	return $movies;
}

function getMovieById(string $id)
{
	/** @var array $movies */
	require getPathToMoviesData();
	foreach (getMovies() as $movie)
	{
		if ($movie['id'] === (int)$id)
		{
			return $movie;
		}
	}
}

function toupperMenu($item)
{
	return mb_strtoupper($item);
}

function getMenuItem()
{
	return array_map('toUpperMenu',
		array_merge(getPagesOption('firstPages'), getGernes(), getPagesOption('lastPages')));
}