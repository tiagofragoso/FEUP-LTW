DROP TRIGGER IF EXISTS insertLike;
CREATE TRIGGER insertLike
AFTER INSERT ON SnippetRating
For Each Row
BEGIN
	UPDATE Snippet
	SET points = points + CASE New.isLike WHEN 1 THEN 1 ELSE -1 END
	WHERE Snippet.id = New.Snippet;
	UPDATE User
	SET points = points + CASE New.isLike WHEN 1 THEN 1 ELSE -1 END
	WHERE User.id = (SELECT author FROM Snippet WHERE Snippet.id = New.Snippet);
END;

DROP TRIGGER IF EXISTS removeLike;
CREATE TRIGGER removeLike
AFTER DELETE ON SnippetRating
For Each Row
BEGIN
	UPDATE Snippet
	SET points = points + CASE Old.isLike WHEN 1 THEN -1 ELSE 1 END
	WHERE Snippet.id = Old.Snippet;
	UPDATE User
	SET points = points + CASE Old.isLike WHEN 1 THEN -1 ELSE 1 END
	WHERE User.id = (SELECT author FROM Snippet WHERE Snippet.id = Old.Snippet);
END;

DROP TRIGGER IF EXISTS insertLikeComment;
CREATE TRIGGER insertLikeComment
AFTER INSERT ON CommentRating
For Each Row
BEGIN
	UPDATE Comment
	SET points = points + CASE New.isLike WHEN 1 THEN 1 ELSE -1 END
	WHERE Comment.id = New.comment;
END;

DROP TRIGGER IF EXISTS removeLikeComment;
CREATE TRIGGER removeLikeComment
AFTER DELETE ON CommentRating
For Each Row
BEGIN
	UPDATE Comment
	SET points = points + CASE Old.isLike WHEN 1 THEN -1 ELSE 1 END
	WHERE Comment.id = Old.Comment;
END;


