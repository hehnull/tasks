<?php
declare(strict_types = 1);

function searchMovies(array $movies, string $desiredMovie): array
{
	$filteredMovies = [];

	foreach ($movies as $movie)
	{
		$isMatching = mb_stripos($movie['title'], $desiredMovie);
		if ($isMatching === 0)
		{
			$filteredMovies[] = $movie;
		}
	}
	return $filteredMovies;
}