<?php
declare(strict_types = 1);

function searchMovies(array $movies, string $desiredMovie): array
{
	$filteredMovies = [];

	foreach ($movies as $movie)
	{
		$isFirstMatching = mb_stripos($desiredMovie, $movie['title']);
		$isSecondMatching = mb_stripos($movie['title'], $desiredMovie);
		if ($isFirstMatching !== false || $isSecondMatching === 0)
		{
			$filteredMovies[] = $movie;
		}
	}
	return $filteredMovies;
}