CREATE TABLE staff
(
    ID   int         not null auto_increment,
    NAME varchar(30) not null,
    PRIMARY KEY (ID)
);

CREATE TABLE people
(
    ID   int          not null auto_increment,
    NAME varchar(100) not null,
    PRIMARY KEY (ID)
);

CREATE TABLE movie_people
(
    ID        int not null auto_increment,
    PEOPLE_ID int not null,
    MOVIE_ID  int not null,
    STAFF_ID  int not null,
    PRIMARY KEY (ID),
    FOREIGN KEY FK_MP_MOVIE (MOVIE_ID)
        REFERENCES movie (ID)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT,
    FOREIGN KEY FK_MP_PEOPLE (PEOPLE_ID)
        REFERENCES people (ID)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT,
    FOREIGN KEY FK_MP_STAFF (STAFF_ID)
        REFERENCES staff (ID)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
);


INSERT INTO dev2.people
SELECT ID AS ID, NAME AS NAME
FROM dev2.actor;
INSERT INTO dev2.people (NAME)
SELECT NAME
FROM dev2.director;

INSERT INTO dev2.staff (ID, NAME)
VALUES (1, 'Актер');
INSERT INTO dev2.staff (ID, NAME)
VALUES (1, 'Режиссер');

INSERT INTO dev2.movie_people (PEOPLE_ID, MOVIE_ID, STAFF_ID)
SELECT ACTOR_ID, MOVIE_ID, 1
FROM dev2.movie_actor;

INSERT INTO dev2.movie_people (PEOPLE_ID, MOVIE_ID, STAFF_ID)
VALUES (14, 1, 2);
INSERT INTO dev2.movie_people (PEOPLE_ID, MOVIE_ID, STAFF_ID)
VALUES (14, 5, 2);
INSERT INTO dev2.movie_people (PEOPLE_ID, MOVIE_ID, STAFF_ID)
VALUES (14, 6, 2);
INSERT INTO dev2.movie_people (PEOPLE_ID, MOVIE_ID, STAFF_ID)
VALUES (14, 7, 2);
INSERT INTO dev2.movie_people (PEOPLE_ID, MOVIE_ID, STAFF_ID)
VALUES (15, 2, 2);
INSERT INTO dev2.movie_people (PEOPLE_ID, MOVIE_ID, STAFF_ID)
VALUES (17, 4, 2)

DROP TABLE dev2.movie_actor;
DROP TABLE dev2.actor;
ALTER TABLE dev2.movie
    DROP FOREIGN KEY movie_ibfk_1;
ALTER TABLE dev2.movie
    DROP COLUMN DIRECTOR_ID;
DROP TABLE dev2.director;

CREATE TABLE `character`
(
    ID       int          not null auto_increment,
    MOVIE_ID int          not null,
    NAME     varchar(100) not null,
    PRIMARY KEY (ID)

);
ALTER TABLE `character`
    ADD CONSTRAINT FK_M_MOVIE FOREIGN KEY (MOVIE_ID)
        REFERENCES dev2.movie (ID);

CREATE TABLE people_character
(
    ID           int not null auto_increment,
    PEOPLE_ID    int not null,
    CHARACTER_ID int not null,
    PRIMARY KEY (ID),
    FOREIGN KEY FK_PC_PEOPLE (PEOPLE_ID)
        REFERENCES dev2.people (ID)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT,
    FOREIGN KEY FK_PC_CHARACTER (CHARACTER_ID)
        REFERENCES `character` (ID)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
);

EXPLAIN FORMAT = JSON
SELECT ID, NAME
FROM dev2.people
WHERE ID in (SELECT PEOPLE_ID
             FROM dev2.movie_people
             WHERE MOVIE_ID = 1
               AND STAFF_ID = 1);
#лучше IN

EXPLAIN FORMAT = JSON
SELECT ID, NAME
FROM dev2.people
WHERE ID =
      (SELECT PEOPLE_ID
       FROM dev2.movie_people
       WHERE MOVIE_ID = 1
         AND STAFF_ID = 1
         AND PEOPLE_ID = people.ID);


EXPLAIN FORMAT = JSON
SELECT people.ID, NAME
FROM dev2.people
         inner join dev2.movie_people on people.ID = movie_people.PEOPLE_ID
WHERE STAFF_ID = 1
  AND MOVIE_ID = 1;

ALTER TABLE dev2.people
    ADD INDEX ID_NAME (ID, NAME);
ALTER TABLE dev2.people
    DROP INDEX ID_NAME;


/*- поиск всех актеров, снимавшихся в конкретном фильме
- выбор режиссера конкретного фильма
- получение списка фильмов, в которых играл конкретный актер*/