SELECT MOVIE_ID, MOVIETITLE
from movieTitles
         inner join movie on movieTitles.MOVIE_ID = movie.ID
where length = (SELECT max(LENGTH)
                from movie
                WHERE DIRECTOR_ID = 1)
  AND LANG_ID = 'ru';


/* 1 задание */
SELECT m.ID, MOVIETITLE, director.NAME
FROM movie_actor ma1
         INNER JOIN movie_actor ma2 ON ma1.movie_id = ma2.movie_id
         INNER JOIN movieTitles on ma1.MOVIE_ID = movieTitles.MOVIE_ID
         INNER JOIN movie m on ma1.MOVIE_ID = m.ID
         INNER JOIN director on m.DIRECTOR_ID = director.ID
WHERE ma1.actor_id = 4
  AND ma2.actor_id = 5;


SELECT ma.movie_id, MOVIETITLE, director.NAME
FROM movie_actor ma
         INNER JOIN movieTitles on ma.MOVIE_ID = movieTitles.MOVIE_ID
         INNER JOIN movie m on ma.MOVIE_ID = m.ID
         INNER JOIN director on m.DIRECTOR_ID = director.ID
WHERE actor_id = 4
  AND ma.movie_id IN (SELECT movie_id FROM movie_actor WHERE actor_id = 5);

/*удовлетворение нескольким значениям из другого одного столбца одновременно*/
/*посредством сужения круга movie_id через AND условиями по отдельности */

/*2 !!!*/
#при отстутствии фильмов только на англ
SELECT COALESCE(mT.MOVIETITLE, m.MOVIETITLE)
FROM movieTitles m
         left join movieTitles mT on m.MOVIE_ID = mT.MOVIE_ID AND mT.LANG_ID = 'en'
WHERE m.LANG_ID = 'ru';
#наоборот
SELECT COALESCE(m.MOVIETITLE, mT.MOVIETITLE)
FROM movie
         left join dev.movieTitles mT on movie.ID = mT.MOVIE_ID AND mT.LANG_ID = 'ru'
         left join dev.movieTitles m on movie.ID = m.MOVIE_ID AND m.LANG_ID = 'en'
WHERE m.MOVIETITLE IS NOT NULL
   OR mT.MOVIETITLE IS NOT NULL;


/*3*/
SELECT MOVIE_ID, MOVIETITLE
from movieTitles
         inner join movie on movieTitles.MOVIE_ID = movie.ID
where length = (SELECT max(LENGTH)
                from movie
                WHERE DIRECTOR_ID = 1)
  AND LANG_ID = 'ru';

SELECT MOVIE_ID, MOVIETITLE, LENGTH
from movieTitles
         inner join movie on movieTitles.MOVIE_ID = movie.ID
WHERE DIRECTOR_ID = 1
  AND LANG_ID = 'ru'
order by LENGTH desc
limit 1;

/*4*/
SELECT movie_id,
       IF(LENGTH(MOVIETITLE) <= 10, MOVIETITLE, CONCAT(SUBSTRING(MOVIETITLE, 1, 7), '...'))
FROM movieTitles
WHERE LANG_ID = 'ru';

/*5*/
SELECT actor.NAME, COUNT(movie_id) AS number_of_movies
from movie_actor
         inner join actor on movie_actor.ACTOR_ID = actor.ID
group by 1;

/*6*/
SELECT GENRE_ID, NAME
from genre
         inner join dev.movie_genre mg on genre.ID = mg.GENRE_ID
         inner join movie m on mg.MOVIE_ID = m.ID
         left join movie_actor ma on m.ID = ma.MOVIE_ID AND ACTOR_ID = 1
GROUP BY 1, 2
HAVING COUNT(ACTOR_ID) = 0;


/*7*/
SELECT ID, MOVIETITLE
from movieTitles
         inner join movie on movieTitles.MOVIE_ID = movie.ID
         left join movie_genre mg on movie.ID = mg.MOVIE_ID
WHERE GENRE_ID is null
  AND LANG_ID = 'ru';


/*8 !!!*/