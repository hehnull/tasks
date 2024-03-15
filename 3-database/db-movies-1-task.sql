/*---------------моё---------------*/
CREATE TABLE langDirectory
(
    ID       char(3)      not null,
    LANGNAME varchar(200) not null,

    PRIMARY KEY (ID)
);

INSERT INTO langDirectory(ID, LANGNAME)
VALUES ('ru', 'Русский'),
       ('en', 'Английский');

CREATE TABLE movieTitles
(
    MOVIE_ID   int     not null,
    MOVIETITLE varchar(500),
    LANG_ID    char(3) not null,

    PRIMARY KEY (MOVIE_ID, LANG_ID),
    FOREIGN KEY FK_MOVIETITLES_LANGDIRECTORY (LANG_ID)
        REFERENCES langDirectory (ID),
    FOREIGN KEY FK_MOVIETITLES_MOVIE (MOVIE_ID)
        REFERENCES movie (ID)


);

INSERT INTO movieTitles
SELECT ID AS ID, TITLE AS MOVIETITLE, 'ru' AS LANG_ID
FROM movie;
ALTER TABLE movie
    DROP COLUMN TITLE;


/*ALTER TABLE movieTitles MODIFY ID INT NOT NULL;*/
DROP TABLE movieTitles;
