CREATE TABLE IF NOT EXISTS director
(
    ID int not null auto_increment,
    NAME varchar(500) not null,
    PRIMARY KEY (ID)
);

CREATE TABLE movie
(
    ID int not null auto_increment,
    TITLE varchar(500) not null,
    RELEASE_YEAR YEAR,
    LENGTH int,
    MIN_AGE int,
    RATING int,

    DIRECTOR_ID int,

    PRIMARY KEY (ID),
    FOREIGN KEY FK_MOVIE_DIRECTOR (DIRECTOR_ID)
        REFERENCES director(ID)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
);

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
    ID int not null auto_increment,
    LANGNAME varchar(200),

    PRIMARY KEY (ID)
);
CREATE TABLE movieTitles
(
    ID int not null,
    MOVIETITLE varchar(500),
    LANG_ID int,

    FOREIGN KEY FK_MOVIETITLES_LANGDIRECTORY (LANG_ID)
        REFERENCES langDirectory (ID)

);

INSERT INTO langDirectory (LANGNAME) VALUES
                                         ('Английский'),('Немецкий'),('Французский'),('Китайский'),('Испанский'),('Русский');
INSERT INTO movieTitles SELECT ID AS ID, TITLE AS MOVIETITLE, 6 AS LANG_ID FROM movie;
SELECT * FROM movie;

ALTER TABLE movie DROP COLUMN TITLE;


/*ALTER TABLE movieTitles MODIFY ID INT NOT NULL;*/