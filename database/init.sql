PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: Comment
DROP TABLE IF EXISTS Comment;

CREATE TABLE Comment (
    id      INTEGER PRIMARY KEY,
    user    INTEGER REFERENCES User (id) 
                    NOT NULL,
    snippet INTEGER REFERENCES Snippet
                    NOT NULL,
    text    TEXT    NOT NULL
);


-- Table: FollowLanguage
DROP TABLE IF EXISTS FollowLanguage;

CREATE TABLE FollowLanguage (
    user     INTEGER REFERENCES User (id) 
                     NOT NULL,
    language INTEGER REFERENCES Language
                     NOT NULL,
    PRIMARY KEY (
        user,
        language
    )
);


-- Table: FollowUser
DROP TABLE IF EXISTS FollowUser;

CREATE TABLE FollowUser (
    user1 INTEGER REFERENCES User (id) 
                  NOT NULL,
    user2 INTEGER REFERENCES User (id) 
                  NOT NULL,
    PRIMARY KEY (
        user1,
        user2
    )
);


-- Table: Language
DROP TABLE IF EXISTS Language;

CREATE TABLE Language (
    code TEXT NOT NULL
              PRIMARY KEY,
    name TEXT UNIQUE
              NOT NULL
);


-- Table: Snippet
DROP TABLE IF EXISTS Snippet;

CREATE TABLE Snippet (
    id          INTEGER PRIMARY KEY,
    date        DATE    NOT NULL,
    title       TEXT    NOT NULL,
    description TEXT,
    rating      INTEGER DEFAULT (0) 
                        NOT NULL,
    author      INTEGER REFERENCES User (id) 
                        NOT NULL,
    language    INTEGER REFERENCES Language
                        NOT NULL,
    code        TEXT    NOT NULL
);


-- Table: SnippetRating
DROP TABLE IF EXISTS SnippetRating;

CREATE TABLE SnippetRating (
    user    INTEGER REFERENCES User (id) 
                    NOT NULL,
    snippet INTEGER REFERENCES Snippet
                    NOT NULL,
    isLike  BOOLEAN NOT NULL,
    PRIMARY KEY (
        user,
        snippet
    )
);


-- Table: User
DROP TABLE IF EXISTS User;

CREATE TABLE User (
    id         INTEGER PRIMARY KEY,
    username   TEXT    UNIQUE
                       NOT NULL,
    email      TEXT    UNIQUE
                       NOT NULL,
    name       TEXT,
    password   TEXT    NOT NULL,
    profilePic BLOB,
    points     INTEGER DEFAULT (0) 
                       NOT NULL
);


COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
