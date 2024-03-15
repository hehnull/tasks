<?php
declare(strict_types = 1);

function getGernes(): array
{
	/** @var array $genres */
	require getOptions('pathToMovies');
	return $genres;
}

function getMovies(?string $genre = null, ?string $searchString = null): array
{
	/** @var array $movies */
	require getOptions('pathToMovies');

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
	require getOptions('pathToMovies');
	foreach (getMovies() as $movie)
	{
		if ($movie['id'] === (int)$id)
		{
			return $movie;
		}
	}
}

