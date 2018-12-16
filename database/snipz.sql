--
-- File generated with SQLiteStudio v3.1.1 on Sun Dec 16 22:55:20 2018
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
    parent  INTEGER REFERENCES Comment (id),
    text    TEXT    NOT NULL,
    date    DATE    NOT NULL,
    points  INTEGER NOT NULL
                    DEFAULT (0),
    FOREIGN KEY (
        user
    )
    REFERENCES User (id) ON DELETE CASCADE,
    FOREIGN KEY (
        snippet
    )
    REFERENCES Snippet (id) ON DELETE CASCADE,
    FOREIGN KEY (
        parent
    )
    REFERENCES Comment (id) ON DELETE CASCADE
);

INSERT INTO Comment (id, user, snippet, parent, text, date, points) VALUES (1, 5, 8, NULL, 'Very nice!', '2018-12-16 20:05', 1);
INSERT INTO Comment (id, user, snippet, parent, text, date, points) VALUES (2, 6, 2, NULL, 'Thank you, this was very helpful!', '2018-12-16 20:16', 0);
INSERT INTO Comment (id, user, snippet, parent, text, date, points) VALUES (3, 6, 8, NULL, 'Awesome!!', '2018-12-16 20:16', 0);
INSERT INTO Comment (id, user, snippet, parent, text, date, points) VALUES (4, 7, 10, NULL, 'wow thank you for this', '2018-12-16 20:29', 1);
INSERT INTO Comment (id, user, snippet, parent, text, date, points) VALUES (5, 9, 8, NULL, 'This is indeed very nice', '2018-12-16 20:46', 0);
INSERT INTO Comment (id, user, snippet, parent, text, date, points) VALUES (6, 9, 14, NULL, 'Very nice design', '2018-12-16 20:46', 0);
INSERT INTO Comment (id, user, snippet, parent, text, date, points) VALUES (7, 9, 9, NULL, 'This is just great!', '2018-12-16 20:47', 0);

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
    ),
    FOREIGN KEY (
        comment
    )
    REFERENCES Comment (id) ON DELETE CASCADE,
    FOREIGN KEY (
        user
    )
    REFERENCES User (id) ON DELETE CASCADE
);

INSERT INTO CommentRating (user, comment, isLike) VALUES (6, 1, 1);
INSERT INTO CommentRating (user, comment, isLike) VALUES (1, 4, 1);

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
    ),
    FOREIGN KEY (
        user
    )
    REFERENCES User (id) ON DELETE CASCADE
);

INSERT INTO FollowLanguage (user, language) VALUES (4, 'dart');
INSERT INTO FollowLanguage (user, language) VALUES (4, 'javascript');
INSERT INTO FollowLanguage (user, language) VALUES (4, 'c');
INSERT INTO FollowLanguage (user, language) VALUES (5, 'sql');
INSERT INTO FollowLanguage (user, language) VALUES (5, 'c');
INSERT INTO FollowLanguage (user, language) VALUES (5, 'java');
INSERT INTO FollowLanguage (user, language) VALUES (5, 'swift');
INSERT INTO FollowLanguage (user, language) VALUES (5, 'cpp');
INSERT INTO FollowLanguage (user, language) VALUES (6, 'c');
INSERT INTO FollowLanguage (user, language) VALUES (6, 'sql');
INSERT INTO FollowLanguage (user, language) VALUES (6, 'css');
INSERT INTO FollowLanguage (user, language) VALUES (6, 'javascript');
INSERT INTO FollowLanguage (user, language) VALUES (6, 'prolog');
INSERT INTO FollowLanguage (user, language) VALUES (8, 'c');
INSERT INTO FollowLanguage (user, language) VALUES (8, 'makefile');
INSERT INTO FollowLanguage (user, language) VALUES (8, 'php');
INSERT INTO FollowLanguage (user, language) VALUES (9, 'pug');
INSERT INTO FollowLanguage (user, language) VALUES (9, 'powershell');
INSERT INTO FollowLanguage (user, language) VALUES (9, 'r');
INSERT INTO FollowLanguage (user, language) VALUES (9, 'ruby');
INSERT INTO FollowLanguage (user, language) VALUES (9, 'sass');
INSERT INTO FollowLanguage (user, language) VALUES (9, 'scss');
INSERT INTO FollowLanguage (user, language) VALUES (9, 'swift');
INSERT INTO FollowLanguage (user, language) VALUES (9, 'typescript');
INSERT INTO FollowLanguage (user, language) VALUES (9, 'scheme');
INSERT INTO FollowLanguage (user, language) VALUES (9, 'visual-basic');
INSERT INTO FollowLanguage (user, language) VALUES (10, 'c');
INSERT INTO FollowLanguage (user, language) VALUES (10, 'clike');
INSERT INTO FollowLanguage (user, language) VALUES (10, 'cpp');
INSERT INTO FollowLanguage (user, language) VALUES (10, 'csharp');
INSERT INTO FollowLanguage (user, language) VALUES (4, 'sql');
INSERT INTO FollowLanguage (user, language) VALUES (4, 'css');
INSERT INTO FollowLanguage (user, language) VALUES (4, 'php');
INSERT INTO FollowLanguage (user, language) VALUES (4, 'cpp');

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
    CHECK (user1 <> user2),
    FOREIGN KEY (
        user1
    )
    REFERENCES User (id) ON DELETE CASCADE,
    FOREIGN KEY (
        user2
    )
    REFERENCES User (id) ON DELETE CASCADE
);

INSERT INTO FollowUser (user1, user2) VALUES (1, 3);
INSERT INTO FollowUser (user1, user2) VALUES (4, 1);
INSERT INTO FollowUser (user1, user2) VALUES (4, 3);
INSERT INTO FollowUser (user1, user2) VALUES (5, 1);
INSERT INTO FollowUser (user1, user2) VALUES (5, 3);
INSERT INTO FollowUser (user1, user2) VALUES (5, 4);
INSERT INTO FollowUser (user1, user2) VALUES (6, 1);
INSERT INTO FollowUser (user1, user2) VALUES (6, 3);
INSERT INTO FollowUser (user1, user2) VALUES (6, 4);
INSERT INTO FollowUser (user1, user2) VALUES (6, 5);
INSERT INTO FollowUser (user1, user2) VALUES (7, 1);
INSERT INTO FollowUser (user1, user2) VALUES (7, 6);
INSERT INTO FollowUser (user1, user2) VALUES (7, 5);
INSERT INTO FollowUser (user1, user2) VALUES (7, 4);
INSERT INTO FollowUser (user1, user2) VALUES (7, 3);
INSERT INTO FollowUser (user1, user2) VALUES (8, 1);
INSERT INTO FollowUser (user1, user2) VALUES (8, 3);
INSERT INTO FollowUser (user1, user2) VALUES (8, 4);
INSERT INTO FollowUser (user1, user2) VALUES (8, 5);
INSERT INTO FollowUser (user1, user2) VALUES (8, 6);
INSERT INTO FollowUser (user1, user2) VALUES (8, 7);
INSERT INTO FollowUser (user1, user2) VALUES (9, 1);
INSERT INTO FollowUser (user1, user2) VALUES (9, 3);
INSERT INTO FollowUser (user1, user2) VALUES (9, 4);
INSERT INTO FollowUser (user1, user2) VALUES (9, 5);
INSERT INTO FollowUser (user1, user2) VALUES (9, 6);
INSERT INTO FollowUser (user1, user2) VALUES (9, 7);
INSERT INTO FollowUser (user1, user2) VALUES (9, 8);
INSERT INTO FollowUser (user1, user2) VALUES (10, 1);
INSERT INTO FollowUser (user1, user2) VALUES (10, 3);
INSERT INTO FollowUser (user1, user2) VALUES (10, 4);
INSERT INTO FollowUser (user1, user2) VALUES (10, 5);
INSERT INTO FollowUser (user1, user2) VALUES (10, 6);
INSERT INTO FollowUser (user1, user2) VALUES (10, 7);
INSERT INTO FollowUser (user1, user2) VALUES (10, 8);
INSERT INTO FollowUser (user1, user2) VALUES (10, 9);
INSERT INTO FollowUser (user1, user2) VALUES (4, 5);
INSERT INTO FollowUser (user1, user2) VALUES (4, 6);
INSERT INTO FollowUser (user1, user2) VALUES (4, 7);
INSERT INTO FollowUser (user1, user2) VALUES (4, 8);
INSERT INTO FollowUser (user1, user2) VALUES (4, 9);
INSERT INTO FollowUser (user1, user2) VALUES (4, 10);

-- Table: Language
DROP TABLE IF EXISTS Language;

CREATE TABLE Language (
    code TEXT NOT NULL
              PRIMARY KEY,
    name TEXT UNIQUE
              NOT NULL
);

INSERT INTO Language (code, name) VALUES ('markup', 'Markup');
INSERT INTO Language (code, name) VALUES ('css', 'CSS');
INSERT INTO Language (code, name) VALUES ('clike', 'Clike');
INSERT INTO Language (code, name) VALUES ('javascript', 'JavaScript');
INSERT INTO Language (code, name) VALUES ('c', 'C');
INSERT INTO Language (code, name) VALUES ('csharp', 'C#');
INSERT INTO Language (code, name) VALUES ('cpp', 'C++');
INSERT INTO Language (code, name) VALUES ('aspnet', 'ASP.NET');
INSERT INTO Language (code, name) VALUES ('ruby', 'Ruby');
INSERT INTO Language (code, name) VALUES ('dart', 'Dart');
INSERT INTO Language (code, name) VALUES ('elixir', 'Elixir');
INSERT INTO Language (code, name) VALUES ('markdown', 'Markdown');
INSERT INTO Language (code, name) VALUES ('git', 'Git');
INSERT INTO Language (code, name) VALUES ('go', 'Go');
INSERT INTO Language (code, name) VALUES ('graphql', 'GraphQL');
INSERT INTO Language (code, name) VALUES ('less', 'Less');
INSERT INTO Language (code, name) VALUES ('http', 'HTTP');
INSERT INTO Language (code, name) VALUES ('java', 'Java');
INSERT INTO Language (code, name) VALUES ('json', 'JSON');
INSERT INTO Language (code, name) VALUES ('kotlin', 'Kotlin');
INSERT INTO Language (code, name) VALUES ('latex', 'LaTeX');
INSERT INTO Language (code, name) VALUES ('lua', 'Lua');
INSERT INTO Language (code, name) VALUES ('makefile', 'Makefile');
INSERT INTO Language (code, name) VALUES ('matlab', 'MATLAB');
INSERT INTO Language (code, name) VALUES ('pascal', 'Pascal');
INSERT INTO Language (code, name) VALUES ('objectivec', 'Objective-C');
INSERT INTO Language (code, name) VALUES ('perl', 'Perl');
INSERT INTO Language (code, name) VALUES ('php', 'PHP');
INSERT INTO Language (code, name) VALUES ('sql', 'SQL');
INSERT INTO Language (code, name) VALUES ('powershell', 'PowerShell');
INSERT INTO Language (code, name) VALUES ('prolog', 'Prolog');
INSERT INTO Language (code, name) VALUES ('sass', 'SASS');
INSERT INTO Language (code, name) VALUES ('scss', 'SCSS');
INSERT INTO Language (code, name) VALUES ('python', 'Python');
INSERT INTO Language (code, name) VALUES ('r', 'R');
INSERT INTO Language (code, name) VALUES ('scala', 'Scala');
INSERT INTO Language (code, name) VALUES ('scheme', 'Scheme');
INSERT INTO Language (code, name) VALUES ('pug', 'Pug');
INSERT INTO Language (code, name) VALUES ('swift', 'Swift');
INSERT INTO Language (code, name) VALUES ('typescript', 'TypeScript');
INSERT INTO Language (code, name) VALUES ('vbnet', 'VB.net');
INSERT INTO Language (code, name) VALUES ('visual-basic', 'Visual Basic');
INSERT INTO Language (code, name) VALUES ('yaml', 'YAML');
INSERT INTO Language (code, name) VALUES ('html', 'HTML');
INSERT INTO Language (code, name) VALUES ('none', 'Plain Text');

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
    code        TEXT    NOT NULL,
    FOREIGN KEY (
        author
    )
    REFERENCES User (id) ON DELETE CASCADE
);

INSERT INTO Snippet (id, date, title, description, points, author, language, code) VALUES (2, '2018-12-11 23:13', 'SQL Init script', 'SQL Script for SNIPZ database', 4, 3, 'sql', '--
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
');
INSERT INTO Snippet (id, date, title, description, points, author, language, code) VALUES (8, '2018-11-30 15:26', 'Parser', 'This snippet parses grades and average grade of a SiFEUP page.', 4, 1, 'dart', 'import ''package:html/dom.dart'';
import ''package:flutter/services.dart'' show rootBundle;

class CourseUnit {
  int year;
  int semester;
  String code;
  String name;
  num ects;
  int grade;
  bool approved;
  
  CourseUnit(this.year, this.semester, this.code, this.name, this.ects, this.grade, this.approved);

  void printT(){
     print(''${this.year} | ${this.semester} | ${this.code} | ${this.name} | ${this.grade} | ${this.approved}'');
  }
}



Future<String> getFileData(String path) async {
  return await rootBundle.loadString(path);
}



void main() async {
  String file = await getFileData(''assets/html/personalInfo.html'');
  final document = Document.html(file);
  final name = document.querySelector(''.estudante-info-nome'').text;
  final course = document.querySelector(''.estudante-lista-curso-nome'').text;
  final gradesBox = document.querySelector(''.caixa'');
  final average = gradesBox.querySelectorAll(''td'')[1].text;
  final List<Element> rows = gradesBox.querySelector(''#tabelapercurso'').querySelectorAll(''.i, .p'');
  List<CourseUnit> ucs = parseUCs(rows);
  print(''Name: $name'');
  print(''Course: $course'');
  print(''Average: $average'');
  ucs.forEach((f) => f.printT());  
  }

  List<CourseUnit> parseUCs(List<Element> rows) {
    List<CourseUnit> ucs = List<CourseUnit>();

    for (var row in rows) {
      final children = row.children;
      final year = int.parse(children[0].text);
      final semester = int.parse(children[1].text[0]);
      final code = children[2].firstChild.text;
      final name = children[3].firstChild.text;
      //final ects =  double.parse(children[5].text);
      //print(ects);
      final approved = row.querySelectorAll(''.aprovado'').length > 0? true: false;
      var grade = 0;
      if (approved) {
        final List<Element> grades = row.querySelectorAll(''.n.aprovado'');
        grade = int.parse(grades.last.text);
      }
      ucs.add(CourseUnit(year, semester, code, name, 6, grade, approved));
      
    } 
  return ucs;
}');
INSERT INTO Snippet (id, date, title, description, points, author, language, code) VALUES (9, '2018-12-16 20:04', 'URL parser for FTP ', 'This a parser for url''s used for FTP', 0, 5, 'c', '#include "Parser.h"

int parse_url(Url *info, char *url) {
    if (strncmp(url, "ftp://", strlen("ftp://"))) {
        printf("url does not start by ftp://\n");
        return 1;
    }

    char * start_host;

    if (strchr(url, ''@'') == NULL) {
        memcpy(info->user, "anonymous", 9);
        memcpy(info->pass, "anonymous", 9);
        start_host = url + 6;

    } else {
        char * start_username = url + 6;
        char * two_points = strchr(start_username, '':'');
        if (two_points == NULL) {
            return 1;
        }
        memcpy(info->user, start_username, two_points - start_username);

        char * start_pass = two_points + 1;
        char * at = strchr(start_pass, ''@'');
        memcpy(info->pass, start_pass, at - start_pass);
        start_host = at + 1;
    }

    char * first_slash = strchr(start_host, ''/'');
    if (first_slash == NULL) {
        return 1;
    }
    memcpy(info->host, start_host, first_slash - start_host);

    char * start_path = first_slash + 1;
    char * last_slash = strrchr(start_path, ''/'');
    if (last_slash == NULL) {
        return 1;
    }
    last_slash++;
    memcpy(info->path, start_path, last_slash - start_path);
    memcpy(info->filename, last_slash, strlen(last_slash) + 1);

    if (get_ip(info)) {
        return 1;
    } 
    return 0;
}

int get_ip(Url *info) {
    struct hostent *h;

    if ((h = gethostbyname(info->host)) == NULL) {
        herror("gethostname");
       return 1;
    }

    char * ip = inet_ntoa(*((struct in_addr *) h->h_addr));
    strcpy(info->ip, ip);
    return 0;
}

');
INSERT INTO Snippet (id, date, title, description, points, author, language, code) VALUES (10, '2018-12-16 20:07', 'State Machine in C', 'State machine for messages of a STOP and WAIT protocol used in a serial port connection', 1, 5, 'c', '#include "StateMachine.h"

void initSM(StateMachine * sm, int type, addrfield_t addr, int sequenceNumber) {
	sm->state = START;
	sm->type = type;
	sm->address = addr;
	sm->message = NONE;
	sm->currentMessageType = NONE;
	sm->expectedSeqNumber = sequenceNumber;
}

void resetSM(StateMachine * sm, state_t state){
	sm->state = state;
	sm->message = NONE;
	sm->currentMessageType = NONE;
}

void transition(StateMachine * sm, unsigned char buf){
	switch(sm->state){
		case START:
			startTransition(sm, buf);
			break;
		case FLAG_RCV:
			flagTransition(sm, buf);
			break;
		case A_RCV:
			addressTransition(sm, buf);
			break;
		case C_RCV:
			controlTransition(sm, buf);
			break;
		case BCC1_OK:
			bcc1Transition(sm, buf);
			break;
		case DATA:
			dataTransition(sm, buf);
			break;
		default:
			return;
	}
}

void startTransition(StateMachine * sm, unsigned char buf){
	if (buf == FLAG)
		sm->state = FLAG_RCV;
}

void flagTransition(StateMachine * sm, unsigned char buf){
	if (buf == sm->address){
		sm->state = A_RCV;
		sm->addrField = buf;
	}
	else if (buf != FLAG)
		resetSM(sm, START);
}

void addressTransition(StateMachine * sm, unsigned char buf){
	setCurrentMessageType(sm, buf);
	if (sm->currentMessageType != NONE){
		sm->ctrlField = buf;
		sm->state = C_RCV;
		checkSequenceNumber(sm);
	} else if (buf == FLAG) {
		resetSM(sm, FLAG_RCV);
	} else resetSM(sm, START);
}

void controlTransition(StateMachine * sm, unsigned char buf){
	if (buf == (sm->addrField^sm->ctrlField)){
		if (rand() % 100 < BCC1_ERR_RATE){
			resetSM(sm, START);
		} else {
			sm->state = BCC1_OK;
		}
		
	} else if (buf == FLAG) {
		resetSM(sm, FLAG_RCV);
	} else resetSM(sm, START);
}

void bcc1Transition(StateMachine * sm, unsigned char buf){
	if (sm->currentMessageType == DATA0_RCV || sm->currentMessageType == DATA1_RCV){
		if (buf == FLAG)
			resetSM(sm, FLAG);
		else sm->state = DATA;
	} else {
		if (buf == FLAG)
			validateMessage(sm);
		else 
			resetSM(sm, START);
	}
}

void dataTransition(StateMachine * sm, unsigned char buf){
	if (buf == FLAG)
		validateMessage(sm);
}

void setCurrentMessageType(StateMachine * sm, unsigned char ctrl) {
	switch(ctrl) {
		case SET:
			sm->currentMessageType = SET_RCV;
			break;
		case DISC:
			sm->currentMessageType = DISC_RCV;
			break;
		case UA:
			sm->currentMessageType = UA_RCV;
			break;
		case RR0:
			if (sm->type == TRANSMITTER)
				sm->currentMessageType = RR0_RCV;
			break;
		case RR1:
			if (sm->type == TRANSMITTER)
				sm->currentMessageType = RR1_RCV;
			break;
		case REJ0:
			if (sm->type == TRANSMITTER)
				sm->currentMessageType = REJ0_RCV;
			break;
		case REJ1:
			if (sm->type == TRANSMITTER)
				sm->currentMessageType = REJ1_RCV;
			break;
		case DAT0:
			if (sm->type == RECEIVER)
				sm->currentMessageType = DATA0_RCV;
			break;
		case DAT1:
			if (sm->type == RECEIVER)
				sm->currentMessageType = DATA1_RCV;
			break;
	}
}

void validateMessage(StateMachine * sm) {
	sm->message = sm->currentMessageType;
}

void checkSequenceNumber(StateMachine * sm) {
	if (sm->expectedSeqNumber == 0) {
		if (sm->currentMessageType == DATA1_RCV){
			sm->message = DUP_RCV;
		}	
	} else {
		if (sm->currentMessageType == DATA0_RCV){
			sm->message = DUP_RCV;
		}	
	}		
}

void printMessage(message_t msg){
	switch(msg){
		case SET_RCV:
			printf("Received SET\n");
			break;
		case UA_RCV:
			printf("Received UA\n");
			break;
		case DISC_RCV:
			printf("Received DISC\n");
			break;
		case RR0_RCV:
			printf("Received RR0\n");
			break;
		case RR1_RCV:
			printf("Received RR1\n");
			break;
		case REJ0_RCV:
			printf("Received REJ0\n");
			break;
		case REJ1_RCV:
			printf("Received REJ1\n");
			break;
		case DATA0_RCV:
			printf("Received DATA0\n");
			break;
		case DATA1_RCV:
			printf("Received DATA1\n");
			break;
		case DUP_RCV:
			printf("Received Duplicate\n");
			break;
		case NONE:
			printf("Received no valid message\n");
			break;
	}
}');
INSERT INTO Snippet (id, date, title, description, points, author, language, code) VALUES (11, '2018-12-16 20:15', 'Example of a makefile', 'Just a very simple makefile', 0, 6, 'makefile', 'make:
	make clean
	gcc -Wall -o app.o ApplicationLayer.c LinkLayer.c StateMachine.c
clean:
	rm -rf *.o
');
INSERT INTO Snippet (id, date, title, description, points, author, language, code) VALUES (12, '2018-12-16 20:21', 'Display of a board in Prolog', 'Displaying a Flume game board in prolog', 0, 6, 'prolog', '% Print board and player turn
display_game(Board, Player):-
	nl, print_board(Board), nl,
	print_player_turn(Player).

% Print player''s turn
print_player_turn(0):-
	write(''The game ended.'').

print_player_turn(1):-
	write(''Red player\''s turn: '').

print_player_turn(2):-
	write(''Blue player\''s turn: '').

% Prints board
print_board(Board):- 
	length(Board, N), 
	print_coordinates(N), 
	print_board(Board, N , 0),
	print_separation(N), nl.

% Prints board with size 
print_board([], _, _).
print_board([L | B], N, I):- 
	print_separation(N), nl, 
	I1 is I+1,
	(I1 < 10 -> write('' ''); true),
	write(I1),  % prints side coordinate number
	print_line(L), % prints current line
	write('' |''), nl, 
	print_board(B, N, I1). % recursive call without the printed line

% Prints N top coordinates
print_coordinates(N):- 
	write(''   ''), 
	print_coordinates(N, 0), 
	write(''|''), nl.

print_coordinates(N, N).
print_coordinates(N, I):-
	I1 is I +1,
	write(''| ''),
	write(I1), % prints coordinate number
	(I1 < 10 -> write('' ''); true),
	print_coordinates(N, I1).

% Prints separation between lines with size N
print_separation(N):-
	print_separation(N, -1).

print_separation(N, N).
print_separation(N, I):-
	I1 is I+1,
	write(''---|''),
	print_separation(N, I1).

% Prints a board line
print_line([]).
print_line([C | L]):-
	write('' | ''), 
	print_cell(C), % prints element of line
	print_line(L). % recursive call without the printed element

% Prints a board cell
print_cell(0):- write('' '').
print_cell(1):- write(''R'').
print_cell(2):- write(''B'').
print_cell(3):- write(''G'').

% Prints game winner
print_winner(1, P1Pieces, P2Pieces):- 
	nl, write(''Player Red won!\n''), 
	write(''Score: ''), write(P1Pieces), 
	write('' to ''), write(P2Pieces), nl.

print_winner(2, P1Pieces, P2Pieces):- 
	nl, write(''Player Blue won!\n''),
 	write(''Score: ''), write(P2Pieces), 
	 write('' to ''), write(P1Pieces), nl.

	 
');
INSERT INTO Snippet (id, date, title, description, points, author, language, code) VALUES (13, '2018-12-16 20:30', 'SQL query', '', 0, 7, 'sql', '.mode columns 
.headers on 
.nullvalue NULL
SELECT User.name AS "User Name", User.points AS "User Points", Itinerary.name AS "Reviewed Name", ItnReview.points AS "Review Points"
FROM User, Itinerary, ItnReview
WHERE User.points > 20 AND ItnReview.userId = User.id AND Itinerary.id = ItnReview.itnId AND ItnReview.points > 0
UNION
SELECT User.name AND "User Name", User.points AND "User Points", Location.name AND "Reviewed Name", LocReview.points AND "Review Points"
FROM User, Location, LocReview
WHERE User.points > 20 AND LocReview.userId = User.id AND Location.id = LocReview.locId AND LocReview.points > 0
ORDER BY User.points DESC;
');
INSERT INTO Snippet (id, date, title, description, points, author, language, code) VALUES (14, '2018-12-16 20:31', 'Some CSS styling', '', 0, 7, 'css', '@import url(''https://fonts.googleapis.com/css?family=Montserrat:400,700'');

body>header {
    background-color: #046DD5;
    color: white;
    font-family: ''Verdana'', sans-serif;
    margin: 0;
    padding: 1em;
}

body>header a {
    color: white;
    text-decoration: none;
}

#signup a:first-child::after {
    content: '''';
    margin: 0 1em;
    border-right: 1px solid white;
}

body>header>* {
    margin: 0.1em;
    padding: 0.1em;
}

body>header>h1 {
    font-size: 28px;
}

body>header>h2 {
    font-size: 15px;
}

body>header>div {
    font-size: 13px;
}

#menu>ul {
    list-style-type: none;
    text-align: center;
    margin: 0;
    padding: 0;
    width: 100%;
}

#hamburger {
    display: none;
}

#menu {
    background-color: white;
}

#news>article {
    background-color: white;
}

#menu li>a {
    text-decoration: none;
    color: black;
    font-family: ''Verdana'', sans-serif;
    font-size: 20px;
}

#menu ul li:nth-child(1) {
    border-top: 5px solid #E1493E;
    padding: 1em;
}

#menu ul li:nth-child(2) {
    border-top: 5px solid #8ABA56;
    padding: 1em;
}

#menu ul li:nth-child(3) {
    border-top: 5px solid #5B4282;
    padding: 1em;
}

#menu ul li:nth-child(4) {
    border-top: 5px solid #FF8932;
    padding: 1em;
}

#menu ul li:nth-child(5) {
    border-top: 5px solid #19B6E9;
    padding: 1em;
}

#menu ul li:nth-child(6) {
    border-top: 5px solid #E84C8B;
    padding: 1em;
}

#related {
    margin: 0;
    padding: 1em;
    color: white;
    background-color: #2A2F33;
}

#related h1>a {
    text-decoration: none;
    color: white;
    font-family: ''Verdana'', sans-serif;
    font-size: 22px;
}

#related p {
    font-family: Georgia, ''Times New Roman'', Times, serif;
    font-size: 18px;
}

#news>article>img {
    width: 100%;
}

#news>article {
    position: relative;
    margin: 1em 0;
}

#news>article>header {
    position: absolute;
    padding: 1em;
    width: 15%;
    margin: 1em;
}

#news>article p {
    font-family: Georgia, ''Times New Roman'', Times, serif;
    font-size: 16px;
    margin: 1em;
}

#news>article p:nth-child(3)::first-letter {
    font-size: 30px;
}

#news>article>footer {
    background-color: #F4655F;
    padding: 1em;
}

#news header a {
    text-decoration: none;
    color: white;
    font-family: ''Verdana'', sans-serif;
    font-size: 20px;
    text-shadow: 5px 5px 6px black;
}

body>footer {
    background-color: #2A2F33;
    padding: 0.5em;
    color: white;
}

#news footer>span {
    color: white;
    font-size: 13px;
    font-family: ''Verdana'', sans-serif;
}

#news footer a {
    text-decoration: none;
    color: white;
    font-size: 13px;
    font-family: ''Verbana'', sans-serif;
    border-bottom: 1px solid white;
}

#news footer span:nth-child(3) {
    padding: 1em;
}

#news footer>a::after {
    content: " comments";
}');
INSERT INTO Snippet (id, date, title, description, points, author, language, code) VALUES (15, '2018-12-16 20:42', 'Hello World in PHP', '', 0, 8, 'php', '<?php echo "<h1>Hello World!</h1>"?>');
INSERT INTO Snippet (id, date, title, description, points, author, language, code) VALUES (16, '2018-12-16 20:43', 'A simplified grep in C ', '', 0, 8, 'c', '#define _GNU_SOURCE
#include <stdio.h>
#include <string.h>
#include <stdbool.h>
#include <errno.h>
#include <stdlib.h>
#include <ctype.h>
#include <dirent.h>
#include <signal.h>
#include <unistd.h>
#include <sys/stat.h>
#include <sys/types.h>

#define DEFAULT_DIR    "stdin"

char * directory = "";
char * pattern = "";
bool ignoreCase = false;
bool showFileName = false;
bool lineNumbers = false;
bool lineCount = false;
bool wholeWord = false;
bool recursive = false;
int totalLineCount = 0;


void sigint_handler(int signo){
    kill(0, SIGTSTP);
    char ans[30];
    printf("\n");
    do {
        printf("Are you sure you want to terminate (Y/N)? ");
        scanf("%s", ans);
    } while(strcasecmp(ans, "y") != 0 && strcasecmp(ans, "n") != 0);
	
	if (strcasecmp(ans, "y") == 0) exit(0);
	else if (strcasecmp(ans, "n") == 0) {
        kill(0, SIGCONT);
    }
	return;
}

bool findWord(char * line){
    char * (*compareFunc)(const char *, const char *);
    compareFunc = (ignoreCase? &strcasestr : &strstr);
    if (wholeWord){
        char * word;
        if ((word = (compareFunc)(line, pattern))){
            return ((word == line || *(word - 1) == '' '' || *(word - 1) == ''\0'' || *(word - 1) == ''\n'') && 
            (*(word + strlen(pattern) ) == '' '' || *(word + strlen(pattern)) == ''\0'' || *(word + strlen(pattern) ) == ''\n''));
        }
    } else {
        if ((compareFunc)(line, pattern)) {
            return true;
        }
    }
    return false;
}


int searchFile(char * path){
    FILE * file = NULL;
    char * line = NULL;
    int count = 0;
    int nLines = 0;
    size_t n;
    bool found = false;
    if (path != DEFAULT_DIR){
        if ((file = fopen(path, "r")) == NULL){
            printf("Error opening file: %d\n", errno);
            return 1;
        }
    } else {
        file = stdin;
    }

    while(getline(&line, &n, file) != -1){
        count++;
        found = findWord(line);
            if (found) {
                nLines++;
                totalLineCount++;
                if (!lineCount){
                    if (!showFileName) {
                        if (recursive) printf("%s:", path);
                        if (lineNumbers) printf("%d: ", count);
                        printf("%s", line);
                        if (*(line + strlen(line) - 1) != ''\n'') printf("\n");
                    }
                }
            }
    }

    free(line);

    if (nLines > 0 && showFileName) {
        printf("%s\n", path);
        return 0;
    }
    fclose(file);
    return 0;

}

int isDirectory(char * path) {
    struct stat statbuf;
    stat(path, &statbuf);
    if(S_ISDIR(statbuf.st_mode)) {
        return 1;
    } else {
        return 0;
    }
}

int loopDirectory(char * path) {
    DIR *dfd;
    struct dirent *dp;
    char filename[100];

    if ((dfd = opendir(path)) == NULL) {
        fprintf(stderr, "Cannot open dir %s\n", path);
        return 0;
    }

    int pid;
    while((dp = readdir(dfd)) != NULL) {
        sprintf(filename, "%s/%s",path,dp->d_name);
        if ((strcmp(dp->d_name, ".") == 0) || strcmp(dp->d_name, "..") == 0) {
            continue;
        }     
        if (isDirectory(filename)) {
             pid = fork();
            if (pid == 0) {

                struct sigaction sa;
                sa.sa_handler = SIG_DFL;
                sigemptyset(&sa.sa_mask);
                sa.sa_flags = 0;

                sigignore(SIGINT);

                if (sigaction(SIGTSTP, &sa ,NULL) == -1){
                    fprintf(stderr,"Unable to install SIGTSTP handler\n");
                    exit(1);
                }
                loopDirectory(filename);
                break;
            } else {
                continue;
            } 
        } else {
            searchFile(filename);
        } 
    }

    int status;
    waitpid(pid, &status, 0);
    return 0;

}


int main(int argc, char* argv[]){
    directory = (char *)malloc(30*sizeof(char));
    pattern = (char *)malloc(30*sizeof(char));

    struct sigaction sa;
    sa.sa_handler = sigint_handler;
    sigemptyset(&sa.sa_mask);
    sa.sa_flags = 0;

    if (sigaction(SIGINT, &sa ,NULL) == -1){
        fprintf(stderr,"Unable to install SIGINT handler\n");
        exit(1);
    }

    sa.sa_handler = SIG_IGN;

    if (sigaction(SIGTSTP, &sa ,NULL) == -1){
        fprintf(stderr,"Unable to install SIGTSTP handler\n");
        exit(1);
    }

    if (argc < 3){
        pattern = argv[1];
        directory = DEFAULT_DIR;
    } else {
        int i;
        for (i = 1; i < argc; i++){

            if (strcmp(argv[i], "-i") == 0){
                ignoreCase = true;
                continue;
            }

            if (strcmp(argv[i], "-l") == 0){
                showFileName = true;
                continue;
            }

            if (strcmp(argv[i], "-n") == 0){
                lineNumbers = true;
                continue;
            }

            if (strcmp(argv[i], "-c") == 0){
                    lineCount = true;
                    continue;
            }

            if (strcmp(argv[i], "-w") == 0){
                    wholeWord = true;
                    continue;
            }
            if (strcmp(argv[i], "-r") == 0){
                    recursive = true;
                    continue;
            }

            break;
        }

        pattern = argv[i];

        if (++i < argc){
            directory = argv[i];
        } else {
            directory = DEFAULT_DIR;
        }

    }

    if (recursive && directory != DEFAULT_DIR) {
        loopDirectory(directory);
    } else {
        searchFile(directory);
    }
    if (lineCount) printf("%d\n", totalLineCount);
    return 0;
}
');
INSERT INTO Snippet (id, date, title, description, points, author, language, code) VALUES (17, '2018-12-16 20:44', 'Example of a helper.h file', '', 0, 8, 'c', '#include <unistd.h>

#define MAX_CLI_SEATS 99
#define DELAY()
#define WIDTH_PID 5
#define WIDTH_XXNN 5
#define WIDTH_SEAT 4
#define MAX_ROOM_SEATS 9999
#define FIFO_REQ_NAME "requests"
#define FIFO_ANS_PREFIX "ans"
#define SLOG_FILE "slog.txt"
#define SBOOK_FILE "sbook.txt"
#define CLOG_FILE "clog.txt"
#define CBOOK_FILE "cbook.txt"
#define BUF_FULL "buffer_full"
#define BUF_EMPTY "buffer_empty"
#define MAX_SEAT -1
#define INVALID_NUM_WANTED_SEATS -2
#define INVALID_SEAT -3
#define INVALID_PARAM -4
#define UNAVAILABLE_SEAT -5
#define FULL -6
#define TIME_OUT -7
#define SERVER_CLOSED "SERVER CLOSE\n"
#define macroToString(x) toString(x)
#define toString(x) #x
#define FILLER(w) "%0" macroToString(w) "d"
#define SLOG_SEAT_FORMAT " " FILLER(WIDTH_SEAT)
#define LOG_BOOKED_SEATS_FORMAT FILLER(WIDTH_SEAT) "\n"
#define SLOG_BOOK_FORMAT FILLER(2) "-" FILLER(WIDTH_PID) "-" FILLER(2)
#define CLOG_SUCCESS_BOOK_FORMAT FILLER(WIDTH_PID) " " FILLER(2) "." FILLER(2) " " FILLER(WIDTH_SEAT) "\n"
#define CLOG_FAIL_BOOK_FORMAT FILLER(WIDTH_PID) " %s\n"
#define SLOG_OFFICE_OPEN FILLER(2) "-OPEN\n"
#define SLOG_OFFICE_CLOSE FILLER(2) "-CLOSE\n"


typedef struct {
    int clientId;
    int num_seats;
    int num_wanted_seats;
    int seats[MAX_ROOM_SEATS];
} Request;

int readline(int fd, char *str){
    int n;
    int num = 0;
    do {
        n = read(fd,str,1);
        if (n) num++;
    } while (n>0 && *str++ != ''\0'');
    str[num-1] = ''\0'';
    return (num);
}');
INSERT INTO Snippet (id, date, title, description, points, author, language, code) VALUES (18, '2018-12-16 20:51', 'A plane using nurbs', 'This is a primitive Plane using CGFnurbs ', 0, 10, 'javascript', '/**
 * Plane
 * @constructor
 */
class Plane extends CGFobject {
    constructor(scene, u, v) {
        super(scene);
        this.makeSurface(u, v);
        this.plane = new CGFnurbsObject(scene, u, v, this.surface);

    };

    makeSurface(u, v) {
        let degree1 = 1;
        let degree2 = 1;

        let controlPoints = [
            [
                [-0.5, 0, 0.5, 1],
                [-0.5, 0.0, -0.5, 1]
            ],
            [
                [0.5, 0.0, 0.5, 1],
                [0.5, 0.0, -0.5, 1]
            ]
        ];

        this.surface = new CGFnurbsSurface(degree1, degree2, controlPoints);
    };

    display() {
        this.plane.display();
    }
}');
INSERT INTO Snippet (id, date, title, description, points, author, language, code) VALUES (19, '2018-12-16 20:56', 'Some exceptions', '', 0, 4, 'cpp', '#include <iostream>
#include "exceptions.h"

using namespace std;

InvalidFormat::InvalidFormat() {}

InvalidPassenger::InvalidPassenger(unsigned int id) {

    this->id = id;
}

void InvalidPassenger::print() const {

    cout << id << " is an invalid passenger id. Reenter.\n";

}

void InvalidPassenger::printDuplicate() const {

    cout << "This passenger already exists. Please insert another id or delete the passenger.\n";

}

InvalidAirplane::InvalidAirplane(unsigned int id) {

    this->id = id;
}

void InvalidAirplane::print() const {

    cout << id << " is an invalid airplane id. Reenter.\n";

}

void InvalidAirplane::printDuplicate() const {

    cout << "This airplane already exists. Please insert another id or delete the airplane.\n";

}

InvalidFlight::InvalidFlight(unsigned int id) {

    this->id = id;
}

void InvalidFlight::print() const {

    cout << id << " is an invalid flight id. Reenter.\n";

}

void InvalidFlight::printDuplicate() const {

    cout << "This flight already exists. Please insert another id or delete the flight.\n";

}

InvalidSeat::InvalidSeat(string seat) {

    this->seat = seat;
}

void InvalidSeat::print() const {

    cout << seat << " is and invalid seat on the flight. Reenter.\n";
}

OverlappingFlight::OverlappingFlight() {}


void OverlappingFlight::print() const {

    cout << "It is not possible to add this flight to this plane.\n";

}

ConnectionFlight::ConnectionFlight() {}

void ConnectionFlight::print() const {

    cout << "It is not possible to delete this flight.\n";
}

void InvalidFilePath::print() {

    if (type == "empty") cout << "File path is empty.\n";
    else if (type == "fail") cout << "Failed to open file.\n";
}

InvalidFilePath::InvalidFilePath(std::string type) : type(type) {}

UnavailableTechnician::UnavailableTechnician(string model) : model(model) {}

void UnavailableTechnician::print() const {
    cout << "There is no available technician for " << model
         << " airplane model. Please reschedule maintenance session.\n";
}

InvalidTechnician::InvalidTechnician(unsigned int id) {
    this->id = id;

}

void InvalidTechnician::print() const {

    cout << id << "is an invalid technician id. Reenter.\n";

}

void InvalidTechnician::printDuplicate() const {

    cout << "This technician already exists. Please insert another id or delete the technician.\n";
}
');

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
    ON CONFLICT REPLACE,
    FOREIGN KEY (
        snippet
    )
    REFERENCES Snippet (id) ON DELETE CASCADE,
    FOREIGN KEY (
        user
    )
    REFERENCES User (id) ON DELETE CASCADE
);

INSERT INTO SnippetRating (user, snippet, isLike) VALUES (1, 2, 1);
INSERT INTO SnippetRating (user, snippet, isLike) VALUES (5, 2, 1);
INSERT INTO SnippetRating (user, snippet, isLike) VALUES (5, 8, 1);
INSERT INTO SnippetRating (user, snippet, isLike) VALUES (6, 8, 1);
INSERT INTO SnippetRating (user, snippet, isLike) VALUES (6, 2, 1);
INSERT INTO SnippetRating (user, snippet, isLike) VALUES (7, 10, 1);
INSERT INTO SnippetRating (user, snippet, isLike) VALUES (9, 8, 1);
INSERT INTO SnippetRating (user, snippet, isLike) VALUES (9, 2, 1);
INSERT INTO SnippetRating (user, snippet, isLike) VALUES (4, 8, 1);
INSERT INTO SnippetRating (user, snippet, isLike) VALUES (1, 8, 0);

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

INSERT INTO User (id, username, email, name, password, points) VALUES (1, 'tiagofragoso', 'tiagofragoso@outlook.com', 'Tiago Fragoso', '$2y$12$xpjz1z7WffXRpIG5p6gqjePXCRDpk4TUhAhYtFyl5hQFIRsLHJHga', 4);
INSERT INTO User (id, username, email, name, password, points) VALUES (3, 'joao123', 'joao@maildojoao.com', NULL, '$2y$12$2uE45ptpSBCh78DBCyAOietxVMz81R88U4FxmITrOlEYBrzIo/W3e', 4);
INSERT INTO User (id, username, email, name, password, points) VALUES (4, 'mariana', 'mariana@gmail.com', 'Mariana Aguiar', '$2y$12$K1jiE3p6GFkprgV66vZY9eP4tVsuoPxa2O698AR4q1QZ/ypxBGSCC', 0);
INSERT INTO User (id, username, email, name, password, points) VALUES (5, 'joanasantos', 'joana@gmail.com', 'Joana Santos', '$2y$12$iT45enPKK2dv86eniqwxw.LCKmBCIPfayKyYcpIZEW0/vLMrmphCC', 1);
INSERT INTO User (id, username, email, name, password, points) VALUES (6, 'leonorsousa', 'leonorsousa@gmail.com', NULL, '$2y$12$kEh1Y6xKi4kBMcnuaPJnAOi7TTPmZhlTxaedBsW14AL8VJlOLRq6i', 0);
INSERT INTO User (id, username, email, name, password, points) VALUES (7, 'carolpereira', 'carolinapereira@hotmail.com', 'Carolina Pereira', '$2y$12$troBvzbGqE6/Jya1yfLRR.wm3onx6as8qihOwcew8hbrTJX73OiNi', 0);
INSERT INTO User (id, username, email, name, password, points) VALUES (8, 'brunosantos', 'brunoo@gmail.com', NULL, '$2y$12$fgsvobbdfAjsHkB4g2RNXeb93KCZJRqz77nE5CJVNCsVYskh6Fc3K', 0);
INSERT INTO User (id, username, email, name, password, points) VALUES (9, 'pedrobarbosa', 'pedrobarbosa@hotmail.com', NULL, '$2y$12$FFQ1Aspt3gb4ybvxRdmkduWr7dFmPWz5AP82kHG6G5vMMg1.ciVjK', 0);
INSERT INTO User (id, username, email, name, password, points) VALUES (10, 'joaopinto55', 'joaopinto123@gmail.com', 'Joao Pinto', '$2y$12$fQacFQDoNXGLeI5jwfQ31eugceTyooMb/Ys9HfM2CzSGdu8U0EPNi', 0);

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
