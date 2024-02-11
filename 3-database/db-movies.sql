CREATE TABLE IF NOT EXISTS director3
(
    ID int not null auto_increment,
    NAME varchar(500) not null,
    PRIMARY KEY (ID),
    MOVIE_ID int,

    FOREIGN KEY FK_DIRECTOR_MOVIE (MOVIE_ID)
        REFERENCES movie3(ID)
);
SELECT *
    from movie_people mp1 inner join movie_people mp2 on mp1.movie_id = mp2.movie_id and mp1.people_id=mp2.people_id;

SELECT * FROM (movie_people);
CREATE TABLE movie3
(
    ID int not null auto_increment,
    TITLE varchar(500) not null,
    RELEASE_YEAR YEAR,
    LENGTH int,
    MIN_AGE int,
    RATING int,

    PRIMARY KEY (ID)
);
SELECT *
    from movie_people mp1 inner join movie_people mp2 on mp1.movie_id = mp2.movie_id and mp1.people_id=mp2.people_id;

CREATE TABLE actor
(
    ID int not null auto_increment,
    NAME varchar(500) not null,
    PRIMARY KEY (ID)
);

CREATE TABLE movie_actor
(
    MOVIE_ID int not null,
    ACTOR_ID int not null,
    PRIMARY KEY (MOVIE_ID, ACTOR_ID),
    FOREIGN KEY FK_MA_MOVIE (MOVIE_ID)
        REFERENCES movie (ID)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT,
    FOREIGN KEY FK_MA_ACTOR (ACTOR_ID)
        REFERENCES actor (ID)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
);


INSERT INTO director (ID, NAME)
VALUES (1, 'Джеймс Кэмерон'),
       (2, 'Ридли Скотт'),
       (3, 'Джон Карпентер'),
       (4, 'Стэнли Кубрик');


INSERT INTO actor (ID, NAME)
VALUES (1, 'Арнольд Шварценеггер'),
       (2, 'Майкл Бин'),
       (3, 'Линда Хэмилтон'),
       (4, 'Сигурни Уивер'),
       (5, 'Том Скеррит'),
       (6, 'Иэн Холм'),
       (7, 'Курт Рассел'),
       (8, 'Кит Дэвид'),
       (9, 'Уилфорд Бримли'),
       (10, 'Джек Николсон'),
       (11, 'Сэм Уортингтон'),
       (12, 'Зои Салдана');


INSERT INTO movie (ID, TITLE, RELEASE_YEAR, LENGTH, MIN_AGE, RATING, DIRECTOR_ID)
VALUES (1, 'Терминатор', 1984, 108, 16, 8.0, 1),
       (2, 'Чужой', 1979, 116, 16, 8.1, 2),
       (3, 'Нечто', 1982, 109, 16, 7.9, 3),
       (4, 'Сияние', 1982, 144, 18, 7.8, 4),
       (5, 'Аватар', 2009, 162, 12, 7.9, 1);


INSERT INTO movie_actor (MOVIE_ID, ACTOR_ID)
VALUES (1, 1),
       (1, 2),
       (1, 3),
       (2, 4),
       (2, 5),
       (2, 6),
       (3, 7),
       (3, 8),
       (3, 9),
       (4, 10),
       (5, 11),
       (5, 12),
       (5, 4);

/*---------------моё---------------*/
CREATE TABLE langDirectory
(
    ID char(3) not null,
    LANGNAME varchar(200) not null,

    PRIMARY KEY (ID)
);

INSERT INTO langDirectory(ID, LANGNAME) VALUES ('ru','Русский'),('en','Английский');

CREATE TABLE movieTitles
(
    MOVIE_ID int not null,
    MOVIETITLE varchar(500),
    LANG_ID char(3) not null,

    PRIMARY KEY (MOVIE_ID, LANG_ID),
    FOREIGN KEY FK_MOVIETITLES_LANGDIRECTORY (LANG_ID)
        REFERENCES langDirectory (ID),
    FOREIGN KEY FK_MOVIETITLES_MOVIE (MOVIE_ID)
        REFERENCES movie (ID)


);

INSERT INTO movieTitles SELECT ID AS ID, TITLE AS MOVIETITLE, 'ru' AS LANG_ID FROM movie;
ALTER TABLE movie DROP COLUMN TITLE;


/*ALTER TABLE movieTitles MODIFY ID INT NOT NULL;*/
DROP TABLE movieTitles;

SELECT
        DIRECTOR_ID,
        NAME
FROM movie INNER JOIN director on movie.DIRECTOR_ID = director.ID;

SELECT
        DIRECTOR_ID,
        d.NAME,
        COUNT(movie.ID) as Total
FROM movie INNER JOIN director d on movie.DIRECTOR_ID = d.ID
GROUP BY DIRECTOR_ID, d.NAME;

SELECT * FROM actor;


SELECT

    COUNT(m.ID)
FROM movie m LEFT JOIN movieTitles mT on m.ID = mT.MOVIE_ID AND mT.LANG_ID='en'
WHERE MOVIETITLE is null;

INSERT INTO movieTitles (MOVIE_ID, MOVIETITLE, LANG_ID) VALUES (2, 'Чужой', 'ru'),
                                                         (4, 'Сияние', 'ru'), (5, 'Avatar', 'en');

SELECT ID
FROM movie m
WHERE NOT EXISTS(
    SELECT 'x' FROM movieTitles WHERE LANG_ID='en' AND MOVIE_ID=ID
    )

DROP TABLE movieTitles;

SELECT m.ID, mT.MOVIETITLE
FROM movie m
INNER JOIN movieTitles mT on m.ID = mT.MOVIE_ID
INNER JOIN movie_actor ma on m.ID = ma.MOVIE_ID
INNER JOIN actor a on ma.ACTOR_ID = a.ID
WHERE LANG_ID = 'ru'
AND a.NAME = 'Арнольд Шварценеггер';

SELECT * FROM movie_actor;

INSERT INTO movie_actor (MOVIE_ID, ACTOR_ID)
VALUES (1, 1), (1, 2), (1, 3),
       (2, 4), (2, 5), (2, 6),
       (3, 7), (3, 8), (3, 9),
       (4, 10),
       (5, 11), (5, 12), (5, 4);

SELECT
    m.ID,
    mt.movietitle,
    COUNT(ma.ACTOR_ID)
FROM movie m
INNER JOIN movie_actor ma on m.ID = ma.MOVIE_ID
INNER JOIN movieTitles mT on m.ID = mT.MOVIE_ID
WHERE mt.LANG_ID = 'ru'
GROUP BY 1,2
SELECT
        DIRECTOR_ID,
        NAME
FROM movie INNER JOIN director on movie.DIRECTOR_ID = director.ID;

SELECT
        DIRECTOR_ID,
        d.NAME,
        COUNT(movie.ID) as Total
FROM movie INNER JOIN director d on movie.DIRECTOR_ID = d.ID
GROUP BY DIRECTOR_ID, d.NAME;

SELECT * FROM actor;


SELECT

    COUNT(m.ID)
FROM movie m LEFT JOIN movieTitles mT on m.ID = mT.MOVIE_ID AND mT.LANG_ID='en'
WHERE MOVIETITLE is null;

INSERT INTO movieTitles (MOVIE_ID, MOVIETITLE, LANG_ID) VALUES (2, 'Чужой', 'ru'),
                                                         (4, 'Сияние', 'ru'), (5, 'Avatar', 'en');

SELECT ID
FROM movie m
WHERE NOT EXISTS(
    SELECT 'x' FROM movieTitles WHERE LANG_ID='en' AND MOVIE_ID=ID
    )

DROP TABLE movieTitles;

SELECT m.ID, mT.MOVIETITLE
FROM movie m
INNER JOIN movieTitles mT on m.ID = mT.MOVIE_ID
INNER JOIN movie_actor ma on m.ID = ma.MOVIE_ID
INNER JOIN actor a on ma.ACTOR_ID = a.ID
WHERE LANG_ID = 'ru'
AND a.NAME = 'Арнольд Шварценеггер';

SELECT * FROM movie_actor;

INSERT INTO movie_actor (MOVIE_ID, ACTOR_ID)
VALUES (1, 1), (1, 2), (1, 3),
       (2, 4), (2, 5), (2, 6),
       (3, 7), (3, 8), (3, 9),
       (4, 10),
       (5, 11), (5, 12), (5, 4);

SELECT
    m.ID,
    mt.movietitle,
    COUNT(ma.ACTOR_ID)
FROM movie m
INNER JOIN movie_actor ma on m.ID = ma.MOVIE_ID
INNER JOIN movieTitles mT on m.ID = mT.MOVIE_ID
WHERE mt.LANG_ID = 'ru'
GROUP BY 1,2