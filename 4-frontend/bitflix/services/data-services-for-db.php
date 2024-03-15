<?php

function getDbConnection(): mysqli
{
	static $connection = null;
	if ($connection === null)
	{
		$dbHost = getOptions('dbHost');
		$dbUser = getOptions('dbUser');
		$dbPassword = getOptions('dbPassword');
		$dbName = getOptions('dbName');

		$connection = mysqli_init();
		$connected = mysqli_real_connect($connection, $dbHost, $dbUser, $dbPassword, $dbName);

		if (!$connected)
		{
			$error = mysqli_connect_errno() . ': ' . mysqli_connect_error();
			throw new Exception($error);
		}

		$encodingResult = mysqli_set_charset($connection, 'utf8');

		if (!$encodingResult)
		{
			throw new Exception(mysqli_error($connection));
		}
	}
	return $connection;
}

function getDbMovies(): array
{
	static $resultMovies = [];
	if (empty($resultMovies))
	{
		$allMovies = mysqli_query(getDbConnection(), "SELECT * FROM movie;");
		while ($row = mysqli_fetch_assoc($allMovies))
		{
			$resultMovies[] = $row;
		}
		return $resultMovies;
	}
	return $resultMovies;
}

function getDbGenres(): array
{
	static $genres = [];
	if (empty($genres))
	{
		$result = mysqli_query(getDbConnection(), "SELECT ID, CODE, NAME FROM genre;");

		while ($row = mysqli_fetch_assoc($result))
		{
			$genres[$row['ID']] = ['CODE' => $row['CODE'], 'NAME' => $row['NAME']];
		}
		return $genres;
	}
	return $genres;
}

function getDbGenresWithCodes(): array
{
	$genres = getDbGenres();
	$genresResult = [];
	foreach ($genres as $genre)
	{
		$genresResult[$genre['CODE']] = $genre['NAME'];
	}
	return $genresResult;
}

function getDbGenresByMovies(): array
{
	$genres = getDbGenres();
	static $genresByMovies = [];
	if (empty($genresByMovies))
	{
		$resultGenresbyMovies = mysqli_query(getDbConnection(), "SELECT MOVIE_ID, GENRE_ID FROM movie_genre;");

		while ($row = mysqli_fetch_assoc($resultGenresbyMovies))
		{
			$genresByMovies[] = ['MOVIE_ID' => $row['MOVIE_ID'], 'NAME' => $genres[$row['GENRE_ID']]['NAME']];
		}
	}
	return $genresByMovies;
}

function getDbDirectorsNames(): array
{
	static $directors = [];
	if (empty($directors))
	{
		$result = mysqli_query(getDbConnection(), "SELECT * FROM director;");

		while ($row = mysqli_fetch_assoc($result))
		{
			$directors[$row['ID']] = $row['NAME'];
		}
		return $directors;
	}
	return $directors;
}

function getDbActorsNames(): array
{
	static $actors = [];
	if (empty($actors))
	{
		$result = mysqli_query(getDbConnection(), "SELECT * FROM actor;");

		while ($row = mysqli_fetch_assoc($result))
		{
			$actors[$row['ID']] = $row['NAME'];
		}
		return $actors;
	}
	return $actors;
}

function getDbActorsByMovies(): array
{
	$actors = getDbActorsNames();
	static $actorsByMovies = [];
	if (empty($actorsByMovies))
	{
		$resultActorsByMovies = mysqli_query(getDbConnection(), "SELECT MOVIE_ID, ACTOR_ID FROM movie_actor;");

		while ($row = mysqli_fetch_assoc($resultActorsByMovies))
		{
			$actorsByMovies[] = ['MOVIE_ID' => $row['MOVIE_ID'], 'NAME' => $actors[$row['ACTOR_ID']]];
		}
	}
	return $actorsByMovies;
}

function getDbFormedMovies()
{
	$resultMovies = [];
	$allMovies = getDbMovies();
	$genresByMovies = getDbGenresByMovies();
	$directors = getDbDirectorsNames();
	$actorsByMovies = getDbActorsByMovies();

	foreach ($allMovies as $movie)
	{
		$genresString = [];
		foreach ($genresByMovies as $entry)
		{
			if ($entry['MOVIE_ID'] === $movie['ID'])
			{
				$genresString[] = $entry['NAME'];
			}
		}
		$actorsString = [];
		foreach ($actorsByMovies as $entry)
		{
			if ($entry['MOVIE_ID'] === $movie['ID'])
			{
				$actorsString[] = $entry['NAME'];
			}
		}
		$directorId = $movie['DIRECTOR_ID'];
		$movie['DIRECTOR_ID'] = $directors[$directorId];
		$movie['GENRES'] = $genresString;
		$movie['CAST'] = $actorsString;
		$resultMovies[] = $movie;
	}
	return $resultMovies;
}

function getDbFilteredMovies(?string $genre = null, ?string $searchString = null)
{
	$movies = getDbFormedMovies();

	if (isset($genre) && isset($searchString))
	{
		$filteredMovies = [];
		foreach ($movies as $movie)
		{
			if (in_array($genre, $movie['GENRES'], true))
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
			if (in_array($genre, $movie['GENRES'], true))
			{
				$filteredMovies[] = $movie;
			}
		}
		return $filteredMovies;
	}
	return $movies;
}

function getDbMovieById(string $id)
{
	$movies = getDbFormedMovies();

	foreach ($movies as $movie)
	{
		if ($movie['ID'] === $id)
		{
			return $movie;
		}
	}
}
