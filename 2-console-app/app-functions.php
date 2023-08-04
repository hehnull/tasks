<?php

function verifyAge($typedAge): bool
{
    if (is_numeric($typedAge) && (int)$typedAge != 0 && (int)$typedAge >= 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function displayMovies($filteredMovies): void
{
    $numberMovie = 0;
    foreach ($filteredMovies as $movie)
    {
        $numberMovie = $numberMovie + 1;
        displayMovie($movie, $numberMovie);
    }
}

function displayMovie($movie, $moviePosition): void
{
    echo "${moviePosition}. {$movie["title"]} ({$movie["release_year"]}), {$movie["age_restriction"]}+. Rating - {$movie["rating"]}\n";
}

function filterMoviesByAgeRestriction($initialMoviesList, $userAge): array
{
    $filteredMovies = [];
    foreach ($initialMoviesList as $movie)
    {
        if ($movie["age_restriction"] <= $userAge)
        {
            $filteredMovies[] = $movie;
        }
    }
    return $filteredMovies;
}