--
-- File generated with SQLiteStudio v3.1.1 on Mon Dec 10 11:18:25 2018
--
-- Text encoding used: UTF-8
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: Comment
DROP TABLE IF EXISTS Comment;

CREATE TABLE Comment (
    id      INTEGER PRIMARY KEY,
    user    INTEGER REFERENCES User (id) 
                    NOT NULL,
    snippet INTEGER REFERENCES Snippet (id) 
                    NOT NULL,
    text    TEXT    NOT NULL,
    date    DATE    NOT NULL,
    points  INTEGER NOT NULL
                    DEFAULT (0) 
);


-- Table: CommentRating
DROP TABLE IF EXISTS CommentRating;

CREATE TABLE CommentRating (
    user    INTEGER REFERENCES User (id) 
                    NOT NULL,
    comment INTEGER REFERENCES Comment
                    NOT NULL,
    isLike  BOOLEAN NOT NULL,
    PRIMARY KEY (
        user,
        comment
    )
);


-- Table: FollowLanguage
DROP TABLE IF EXISTS FollowLanguage;

CREATE TABLE FollowLanguage (
    user     INTEGER REFERENCES User (id) 
                     NOT NULL,
    language INTEGER REFERENCES Language (code) 
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
    ),
    CHECK (user1 <> user2) 
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
    points      INTEGER DEFAULT (0) 
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
    ON CONFLICT REPLACE
);


-- Table: User
DROP TABLE IF EXISTS User;

CREATE TABLE User (
    id       INTEGER PRIMARY KEY,
    username TEXT    UNIQUE
                     NOT NULL,
    email    TEXT    UNIQUE
                     NOT NULL,
    name     TEXT,
    password TEXT    NOT NULL,
    points   INTEGER DEFAULT (0) 
                     NOT NULL
);


-- Trigger: insertLike
DROP TRIGGER IF EXISTS insertLike;
CREATE TRIGGER insertLike
         AFTER INSERT
            ON SnippetRating
      FOR EACH ROW
BEGIN
    UPDATE Snippet
       SET points = points + CASE New.isLike WHEN 1 THEN 1 ELSE -1 END
     WHERE Snippet.id = New.Snippet;
    UPDATE User
       SET points = points + CASE New.isLike WHEN 1 THEN 1 ELSE -1 END
     WHERE User.id = (
                         SELECT author
                           FROM Snippet
                          WHERE Snippet.id = New.Snippet
                     );
END;


-- Trigger: insertLikeComment
DROP TRIGGER IF EXISTS insertLikeComment;
CREATE TRIGGER insertLikeComment
         AFTER INSERT
            ON CommentRating
      FOR EACH ROW
BEGIN
    UPDATE Comment
       SET points = points + CASE New.isLike WHEN 1 THEN 1 ELSE -1 END
     WHERE Comment.id = New.comment;
END;


-- Trigger: removeLike
DROP TRIGGER IF EXISTS removeLike;
CREATE TRIGGER removeLike
         AFTER DELETE
            ON SnippetRating
      FOR EACH ROW
BEGIN
    UPDATE Snippet
       SET points = points + CASE Old.isLike WHEN 1 THEN -1 ELSE 1 END
     WHERE Snippet.id = Old.Snippet;
    UPDATE User
       SET points = points + CASE Old.isLike WHEN 1 THEN -1 ELSE 1 END
     WHERE User.id = (
                         SELECT author
                           FROM Snippet
                          WHERE Snippet.id = Old.Snippet
                     );
END;


-- Trigger: removeLikeComment
DROP TRIGGER IF EXISTS removeLikeComment;
CREATE TRIGGER removeLikeComment
         AFTER DELETE
            ON CommentRating
      FOR EACH ROW
BEGIN
    UPDATE Comment
       SET points = points + CASE Old.isLike WHEN 1 THEN -1 ELSE 1 END
     WHERE Comment.id = Old.Comment;
END;


COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
