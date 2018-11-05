PRAGMA foreign_keys = off;
BEGIN TRANSACTION;


-- Table: User
DROP TABLE IF EXISTS User;

CREATE TABLE User (
    id          INTEGER PRIMARY KEY,          
    username    TEXT    UNIQUE
                        NOT NULL,
    email       TEXT    UNIQUE
                        NOT NULL,
    name        TEXT    NOT NULL,
    password    TEXT    NOT NULL,
    profilePic  BLOB,
    points      INTEGER DEFAULT(0)
                        NOT NULL
);

-- Table: Snippet
DROP TABLE IF EXISTS Snippet;

-- Table: Language
DROP TABLE IF EXISTS Language;

CREATE TABLE Language (
    id      INTEGER PRIMARY KEY,
    code    TEXT    UNIQUE
                    NOT NULL,
    name    TEXT    UNIQUE
                    NOT NULL
);

CREATE TABLE Snippet (
    id                  INTEGER PRIMARY KEY,
    creationDate        DATE    NOT NULL,
    title               TEXT    NOT NULL,
    description         TEXT,
    rating              INTEGER DEFAULT(0)
                                NOT NULL,
    author              INTEGER REFERENCES User (id)
                                NOT NULL,
    language            INTEGER REFERENCES Language (id)
                                NOT NULL
);

-- Table: FollowUser
DROP TABLE IF EXISTS FollowUser;

CREATE TABLE FollowUser (
    user1   INTEGER REFERENCES User (id)
                    NOT NULL,
    user2   INTEGER REFERENCES User (id)
                    NOT NULL,
    PRIMARY KEY (
        user1,
        user2
    )
);

-- Table: FollowLanguage
DROP TABLE IF EXISTS FollowLanguage;

CREATE TABLE FollowLanguage (
    user        INTEGER REFERENCES User (id)
                        NOT NULL,
    language    INTEGER REFERENCES Language (id)
                        NOT NULL,
    PRIMARY KEY (
        user,
        language
    )
);

-- Table: Comment
DROP TABLE IF EXISTS Comment;

CREATE TABLE Comment (
    user        INTEGER REFERENCES User (id)
                        NOT NULL,
    snippet     INTEGER REFERENCES Snippet (id)
                        NOT NULL,
    text        TEXT    NOT NULL,
    PRIMARY KEY (
        user,
        snippet
    )
);

-- Table: SnippetRating
DROP TABLE IF EXISTS SnippetRating;

CREATE TABLE SnippetRating (
    user        INTEGER REFERENCES User (id)
                        NOT NULL,
    snippet     INTEGER REFERENCES Snippet (id)
                        NOT NULL,
    isLike      BOOLEAN NOT NULL,
    PRIMARY KEY (
        user,
        snippet
    )
);

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;