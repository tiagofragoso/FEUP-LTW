--
-- File generated with SQLiteStudio v3.1.1 on Tue Dec 11 17:54:34 2018
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
    date    DATE,
    points  INTEGER NOT NULL
                    DEFAULT (0) 
);

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        1,
                        2,
                        2,
                        'Wow! This is really not spaghett!',
                        NULL,
-                       1
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        2,
                        1,
                        2,
                        'You are right!',
                        NULL,
-                       1
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        3,
                        1,
                        3,
                        'Olaaa lolada mixeroni',
                        '2018-11-24 23:41',
                        0
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        4,
                        2,
                        3,
                        'Olaa mixlolada lolololololol',
                        '2018-11-24 23:42',
                        1
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        5,
                        1,
                        2,
                        'kldjaksd',
                        '2018-11-26 10:23',
-                       1
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        6,
                        1,
                        3,
                        'djfjlkasdfhkashfkjsadf',
                        '2018-11-26 10:50',
-                       1
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        7,
                        1,
                        2,
                        'sadfjkhafdksjhjasfas',
                        '2018-11-28 10:34',
-                       1
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        8,
                        2,
                        1,
                        'hi
',
                        '2018-12-09 14:41',
                        0
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        9,
                        2,
                        1,
                        'hii',
                        '2018-12-09 14:42',
                        0
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        10,
                        2,
                        1,
                        'hii',
                        '2018-12-09 14:47',
                        0
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        11,
                        2,
                        1,
                        'jii',
                        '2018-12-09 14:49',
                        0
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        12,
                        1,
                        2,
                        'yellow',
                        '2018-12-09 22:12',
                        1
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        13,
                        1,
                        2,
                        'green',
                        '2018-12-09 22:12',
                        0
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        14,
                        1,
                        2,
                        'blue',
                        '2018-12-09 22:13',
                        0
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        15,
                        2,
                        1,
                        'quero um comment mesmo mesmo grande para perceber como é que isto fica quando é mesmo mesmo grande
',
                        '2018-12-10 10:24',
                        0
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        16,
                        2,
                        1,
                        'preciso de um comment ainda maior porque aquele não dava para perceber se o texto esta justificado e então é por isso que preciso de ainda mais texto e é essa a razão pela qual estou a escrever esta palha toda nem sei se temos max nestes comments se calhar deviamos ter oh well',
                        '2018-12-10 20:57',
                        0
                    );

INSERT INTO Comment (
                        id,
                        user,
                        snippet,
                        text,
                        date,
                        points
                    )
                    VALUES (
                        17,
                        2,
                        1,
                        'coiso',
                        '2018-12-10 21:00',
                        0
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

INSERT INTO CommentRating (
                              user,
                              comment,
                              isLike
                          )
                          VALUES (
                              2,
                              2,
                              0
                          );

INSERT INTO CommentRating (
                              user,
                              comment,
                              isLike
                          )
                          VALUES (
                              2,
                              12,
                              1
                          );

INSERT INTO CommentRating (
                              user,
                              comment,
                              isLike
                          )
                          VALUES (
                              2,
                              5,
                              0
                          );

INSERT INTO CommentRating (
                              user,
                              comment,
                              isLike
                          )
                          VALUES (
                              2,
                              1,
                              0
                          );

INSERT INTO CommentRating (
                              user,
                              comment,
                              isLike
                          )
                          VALUES (
                              2,
                              4,
                              1
                          );

INSERT INTO CommentRating (
                              user,
                              comment,
                              isLike
                          )
                          VALUES (
                              2,
                              6,
                              0
                          );

INSERT INTO CommentRating (
                              user,
                              comment,
                              isLike
                          )
                          VALUES (
                              2,
                              7,
                              0
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

INSERT INTO FollowLanguage (
                               user,
                               language
                           )
                           VALUES (
                               1,
                               'c'
                           );

INSERT INTO FollowLanguage (
                               user,
                               language
                           )
                           VALUES (
                               1,
                               'java'
                           );

INSERT INTO FollowLanguage (
                               user,
                               language
                           )
                           VALUES (
                               1,
                               'git'
                           );

INSERT INTO FollowLanguage (
                               user,
                               language
                           )
                           VALUES (
                               1,
                               'cpp'
                           );

INSERT INTO FollowLanguage (
                               user,
                               language
                           )
                           VALUES (
                               1,
                               'javascript'
                           );

INSERT INTO FollowLanguage (
                               user,
                               language
                           )
                           VALUES (
                               1,
                               'swift'
                           );

INSERT INTO FollowLanguage (
                               user,
                               language
                           )
                           VALUES (
                               1,
                               'html'
                           );

INSERT INTO FollowLanguage (
                               user,
                               language
                           )
                           VALUES (
                               1,
                               'css'
                           );

INSERT INTO FollowLanguage (
                               user,
                               language
                           )
                           VALUES (
                               1,
                               'lua'
                           );

INSERT INTO FollowLanguage (
                               user,
                               language
                           )
                           VALUES (
                               1,
                               'matlab'
                           );

INSERT INTO FollowLanguage (
                               user,
                               language
                           )
                           VALUES (
                               1,
                               'sql'
                           );

INSERT INTO FollowLanguage (
                               user,
                               language
                           )
                           VALUES (
                               1,
                               'sass'
                           );

INSERT INTO FollowLanguage (
                               user,
                               language
                           )
                           VALUES (
                               2,
                               'cpp'
                           );

INSERT INTO FollowLanguage (
                               user,
                               language
                           )
                           VALUES (
                               2,
                               'c'
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

INSERT INTO FollowUser (
                           user1,
                           user2
                       )
                       VALUES (
                           1,
                           3
                       );

INSERT INTO FollowUser (
                           user1,
                           user2
                       )
                       VALUES (
                           1,
                           2
                       );

INSERT INTO FollowUser (
                           user1,
                           user2
                       )
                       VALUES (
                           1,
                           7
                       );

INSERT INTO FollowUser (
                           user1,
                           user2
                       )
                       VALUES (
                           1,
                           6
                       );

INSERT INTO FollowUser (
                           user1,
                           user2
                       )
                       VALUES (
                           1,
                           5
                       );

INSERT INTO FollowUser (
                           user1,
                           user2
                       )
                       VALUES (
                           1,
                           4
                       );

INSERT INTO FollowUser (
                           user1,
                           user2
                       )
                       VALUES (
                           3,
                           1
                       );

INSERT INTO FollowUser (
                           user1,
                           user2
                       )
                       VALUES (
                           4,
                           1
                       );

INSERT INTO FollowUser (
                           user1,
                           user2
                       )
                       VALUES (
                           5,
                           1
                       );

INSERT INTO FollowUser (
                           user1,
                           user2
                       )
                       VALUES (
                           2,
                           5
                       );

INSERT INTO FollowUser (
                           user1,
                           user2
                       )
                       VALUES (
                           2,
                           1
                       );


-- Table: Language
DROP TABLE IF EXISTS Language;

CREATE TABLE Language (
    code TEXT NOT NULL
              PRIMARY KEY,
    name TEXT UNIQUE
              NOT NULL
);

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'markup',
                         'Markup'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'css',
                         'CSS'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'clike',
                         'Clike'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'javascript',
                         'JavaScript'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'c',
                         'C'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'csharp',
                         'C#'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'cpp',
                         'C++'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'aspnet',
                         'ASP.NET'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'ruby',
                         'Ruby'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'dart',
                         'Dart'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'elixir',
                         'Elixir'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'markdown',
                         'Markdown'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'git',
                         'Git'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'go',
                         'Go'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'graphql',
                         'GraphQL'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'less',
                         'Less'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'http',
                         'HTTP'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'java',
                         'Java'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'json',
                         'JSON'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'kotlin',
                         'Kotlin'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'latex',
                         'LaTeX'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'lua',
                         'Lua'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'makefile',
                         'Makefile'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'matlab',
                         'MATLAB'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'pascal',
                         'Pascal'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'objectivec',
                         'Objective-C'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'perl',
                         'Perl'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'php',
                         'PHP'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'sql',
                         'SQL'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'powershell',
                         'PowerShell'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'prolog',
                         'Prolog'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'sass',
                         'SASS'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'scss',
                         'SCSS'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'python',
                         'Python'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'r',
                         'R'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'scala',
                         'Scala'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'scheme',
                         'Scheme'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'pug',
                         'Pug'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'swift',
                         'Swift'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'typescript',
                         'TypeScript'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'vbnet',
                         'VB.net'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'visual-basic',
                         'Visual Basic'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'yaml',
                         'YAML'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'html',
                         'HTML'
                     );

INSERT INTO Language (
                         code,
                         name
                     )
                     VALUES (
                         'none',
                         'Plain Text'
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

INSERT INTO Snippet (
                        id,
                        date,
                        title,
                        description,
                        points,
                        author,
                        language,
                        code
                    )
                    VALUES (
                        1,
                        '2018-11-20 22:11',
                        'This is a larger title',
                        'das',
                        1,
                        1,
                        'php',
                        '<?php
	header("Location: pages/signup.php");
?>'
                    );

INSERT INTO Snippet (
                        id,
                        date,
                        title,
                        description,
                        points,
                        author,
                        language,
                        code
                    )
                    VALUES (
                        2,
                        '2018-11-22 22:13',
                        'This is a really really really long title for testing',
                        'afafa',
                        1,
                        1,
                        'css',
                        'body {
	font-family: ''Montserrat'', sans-serif;
	margin: 0;
	padding: 0;
	background-color: #cecece;
}

a {
	text-decoration: none;
	color: inherit;
}

.content-center {
	background-color: white;
	width: 600px;
	margin: 0px auto;
	margin-top: 30px;
	padding: 30px;
}'
                    );

INSERT INTO Snippet (
                        id,
                        date,
                        title,
                        description,
                        points,
                        author,
                        language,
                        code
                    )
                    VALUES (
                        3,
                        '2018-11-24 00:01',
                        'Oi',
                        'Oi bea',
                        1,
                        1,
                        'c',
                        '#include <stdio.h> 
#include <stdlib.h> 
#include <errno.h> 
#include <netdb.h> 
#include <sys/types.h>
#include <netinet/in.h> 
#include<arpa/inet.h>

int main(int argc, char *argv[])
{
	struct hostent *h;

        if (argc != 2) {  
            fprintf(stderr,"usage: getip address\n");
            exit(1);
        }
        
        
/*
struct hostent {
	char    *h_name;	Official name of the host. 
    	char    **h_aliases;	A NULL-terminated array of alternate names for the host. 
	int     h_addrtype;	The type of address being returned; usually AF_INET.
    	int     h_length;	The length of the address in bytes.
	char    **h_addr_list;	A zero-terminated array of network addresses for the host. 
				Host addresses are in Network Byte Order. 
};

#define h_addr h_addr_list[0]	The first address in h_addr_list. 
*/
        if ((h=gethostbyname(argv[1])) == NULL) {  
            herror("gethostbyname");
            exit(1);
        }

        printf("Host name  : %s\n", h->h_name);
        printf("IP Address : %s\n",inet_ntoa(*((struct in_addr *)h->h_addr)));

        return 0;
}
'
                    );

INSERT INTO Snippet (
                        id,
                        date,
                        title,
                        description,
                        points,
                        author,
                        language,
                        code
                    )
                    VALUES (
                        4,
                        '2018-11-24 00:15',
                        'RCOM BOYS',
                        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus tempor lorem sed interdum. In vitae neque eu eros gravida commodo. Mauris sed tellus at mi ornare maximus. Quisque fringilla lectus eget lacus mollis, vitae iaculis purus convallis. Aenean massa urna, eleifend ac interdum vitae, semper non est. Ut imperdiet turpis sapien, imperdiet congue mi finibus eu. Vivamus imperdiet libero a auctor lacinia. Pellentesque porta molestie blandit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc pulvinar odio neque, at maximus nisl tincidunt id. Nunc accumsan enim id consequat egestas.

Aenean fermentum dapibus ullamcorper. Quisque sed ultrices elit. Etiam tincidunt eros a elementum suscipit. Vestibulum et leo ipsum. Pellentesque volutpat velit in dolor blandit cursus. Nunc pellentesque dui eu dictum rutrum. Nunc ac consectetur ante, nec tincidunt mi.',
                        0,
                        1,
                        'c',
                        '#include "LinkLayer.h"

struct termios oldtio, newtio;

static LinkLayer this;

int llopen(int port, int flag) {
	int fd;
  	this.type = flag;

	if (port == 0) {
		sprintf(this.port, "%s", "/dev/ttyS0");
	} else if (port == 1) {
		sprintf(this.port, "%s", "/dev/ttyS1");
	}

	this.sequenceNumber = 0;
	this.timeout = this.type == TRANSMITTER? TRANS_TIMEOUT: REC_TIMEOUT;
	this.numTransmissions = RETRY_COUNT;

	/*
	Open serial port device for reading and writing and not as controlling tty
	because we don''t want to get killed if linenoise sends CONTROL-C.
	*/

	fd = open(this.port, O_RDWR | O_NOCTTY);
	if (fd < 0) {
		perror(this.port);
		exit(-1);
	}

	if (tcgetattr(fd, &oldtio) == -1) { /* save current port settings */
		perror("tcgetattr");
		exit(-1);
	}

	bzero(&newtio, sizeof(newtio));
	newtio.c_cflag = BAUDRATE | CS8 | CLOCAL | CREAD;
	newtio.c_iflag = IGNPAR;
	newtio.c_oflag = 0;

	/* set input mode (non-canonical, no echo,...) */
	newtio.c_lflag = 0;

	newtio.c_cc[VTIME] = this.timeout * 10;
	newtio.c_cc[VMIN] = 0; 

	/*
	VTIME e VMIN devem ser alterados de forma a proteger com um temporizador a
	leitura do(s) pr�ximo(s) caracter(es)
	*/

	tcflush(fd, TCIOFLUSH);

	if (tcsetattr(fd, TCSANOW, &newtio) == -1) {
		perror("tcsetattr");
		exit(-1);
	}

  	printf("New termios structure set\n");
  
	if (flag == TRANSMITTER) {
		if (initTransmitterSequence(fd) == -1) return -1;
	} else if (flag == RECEIVER) {
		if (initReceiverSequence(fd) == -1) return -1;
	}

	return fd;
}

int initReceiverSequence(int fd) {
	message_t res = readLoop(fd, CMD_TRANSM);
	if (res == SET_RCV){
		unsigned char msg[S_FRAME_SIZE];
		buildMessage(msg, UA, CMD_TRANSM);
		write(fd, msg, sizeof(msg));
	} else if (res == NONE) {
		close(fd);
		printf("Timed out.\n");
		return -1;
	}
	return 0;
}

int initTransmitterSequence(int fd) {
	unsigned char msg[S_FRAME_SIZE];
	buildMessage(msg, SET, CMD_TRANSM);	
	if (writeMessageTimeout(fd, msg, sizeof(msg), UA_RCV, CMD_TRANSM) == -1){
		printf("Timed out.\n");
		close(fd);
		return -1;
	}
	return 0;
}

int llwrite(int fd, unsigned char * buffer, int length) {
	printf("Sequence number: %d\n", this.sequenceNumber);
	unsigned char msg[STUFFED_SIZE(length) + S_FRAME_SIZE];
	int res = buildDataMessage(msg, buffer, length);

	message_t expected = this.sequenceNumber? RR0_RCV: RR1_RCV;

	int numWritten = writeMessageTimeout(fd, msg, res, expected, CMD_TRANSM);

	if (numWritten) {
		changeSequenceNumber();
		return numWritten;
	} else {
		printf("Timed out.\n");
		return -1;
	};
}

int llread(int fd, unsigned char * buffer) {

	this.stuffedData_size = 0;
	message_t res = readLoop(fd, CMD_TRANSM);
	ctrlfield_t rec_response = this.sequenceNumber? RR0: RR1;
	
	int ret = 0;
	
	if (res == DATA0_RCV || res == DATA1_RCV) {
		if (validBCC2() == -1){
			rec_response = this.sequenceNumber? REJ1: REJ0;
		} else {
			memcpy(buffer, this.data, this.data_size);
			changeSequenceNumber();
			ret = this.data_size;
		}
	} else if (res == DUP_RCV){
		rec_response = this.sequenceNumber? RR1: RR0;
		ret = 0;
	} else if (res == NONE){
		printf("Timed out.\n");
		ret = -1;
	}

	unsigned char msg[S_FRAME_SIZE];
	buildMessage(msg, rec_response, CMD_TRANSM);
	usleep(T_PROP * 1000);
	write(fd, msg, sizeof(msg));
	
	return ret;
}

message_t readLoop(int fd, addrfield_t address){
	unsigned char buf;
	int res;
	StateMachine sm;
	initSM(&sm, this.type, address, this.sequenceNumber);
	while (sm.message == NONE) {
		res = read(fd, &buf, 1);
		if (res > 0) {
			transition(&sm, buf);
			if (sm.state == DATA && sm.message == NONE){
				if (this.stuffedData_size >= MAX_SIZE) break; 
					this.stuffedData[this.stuffedData_size++] = buf;
			}
		} else break;
	}
	printMessage(sm.message);
	return sm.message;
}

int writeMessageTimeout(int fd, unsigned char * msg, int size, message_t expectedRes, unsigned char addr){
	int bytesWritten;
	int counter = 0;
	this.stuffedData_size = 0;
	this.data_size = 0;

	while (counter < this.numTransmissions) {
		bytesWritten = write(fd, msg, size);
		printf("%d bytes written\n", bytesWritten);
		message_t res;
		res = readLoop(fd, addr);
		if (res == NONE) {
			counter++;
			printf("Timeout %d\n", counter);
			continue;
		} else counter = 0;
		
		if (res == expectedRes) return bytesWritten;
	}

	return -1;
}

void buildMessage(unsigned char * msg, unsigned char control, unsigned char addr){
	msg[0] = FLAG;
  	msg[1] = addr;
	msg[2] = control;
	msg[3] = msg[1] ^ msg[2];
  	msg[4] = FLAG;
}

int buildDataMessage(unsigned char * msg, unsigned char * data, int size){
	unsigned char unstuffedData[STUFFED_SIZE(size)];
	unsigned char stuffedData[STUFFED_SIZE(size)];

	if (this.sequenceNumber) {
		buildMessage(msg, DAT1, CMD_TRANSM);
	} else {
		buildMessage(msg, DAT0, CMD_TRANSM);
	}

	int i = 0;
	unsigned char bcc2 = data[i++]; 
	while (i < size){
		bcc2 ^= data[i++];
	}
	
	memcpy(unstuffedData, data, size);
	unstuffedData[size++] = bcc2;

	int stuffedSize = msgStuffing(unstuffedData, stuffedData, size);

	memcpy(msg + 4, stuffedData, stuffedSize); 
	
	msg[4 + stuffedSize] = FLAG;

	return stuffedSize + 5;
}

int closeTransmitter(int fd) {
	unsigned char msg[S_FRAME_SIZE];
	buildMessage(msg, DISC, CMD_TRANSM);
	if (writeMessageTimeout(fd, msg, sizeof(msg), DISC_RCV, CMD_REC) > 0) {
		buildMessage(msg, UA, CMD_REC);
		write(fd, msg, sizeof(msg));
		return 0;
	}

	return -1;
}

int closeReceiver(int fd) {
	message_t res = readLoop(fd, CMD_TRANSM);
	if (res == DISC_RCV) {
		unsigned char msg[S_FRAME_SIZE];
		buildMessage(msg, DISC, CMD_REC);
		if (writeMessageTimeout(fd, msg, sizeof(msg), UA_RCV, CMD_REC) > 0) {
			return 0;
		}
	}
	return -1;
}

int llclose(int fd) {
	int res;
	if (this.type == RECEIVER) {
		res = closeReceiver(fd);
	} else {
		res = closeTransmitter(fd);
	}
	if (res == 0) {
		sleep(2);
		tcsetattr(fd, TCSANOW, &oldtio);
		close(fd);
		return 0;
	}
	return -1;
}

int msgStuffing(unsigned char * data, unsigned char * stuffedData, int size) {
    int i = 0, j = 0; 
    while (i < size) {
        if(data[i] == FLAG) {
            stuffedData[j] = STUFF;
            stuffedData[++j] = FLAG_STUFF;
        } else if (data[i] == ESCAPE_OCT) {
			stuffedData[j] = STUFF;
			stuffedData[++j] = ESCAPE_STUFF;
		} else {   
			stuffedData[j] = data[i];
		}
    i++;
    j++;
    }
	return j;
}

int msgDestuffing(unsigned char * stuffedData, unsigned char * destuffedData, int size) {
    int i = 0, j = 0; 
    while (i < size) {
        if(stuffedData[i] == STUFF){
			if(i + 1 < size) {
				switch(stuffedData[i + 1]) {
					case FLAG_STUFF:
						destuffedData[j] = FLAG;
						i++;
						break;
					case ESCAPE_STUFF:
						destuffedData[j] = ESCAPE_OCT;
						i++;
						break;
					default: 
						destuffedData[j] = stuffedData[i];
						break;
					}
			 } else destuffedData[j] = stuffedData[i];
		} else destuffedData[j] = stuffedData[i];
	i++;
	j++;
	}
return j;
}

int validBCC2(){
	int res = msgDestuffing(this.stuffedData, this.data, this.stuffedData_size);
	int i = 0;
	unsigned char bcc2 = this.data[i++]; 
	while (i < res - 1){
		bcc2 ^= this.data[i++];
	}
	if (this.data[res - 1] == bcc2) {
		if (rand() % 100 < BCC2_ERR_RATE){
			printf("BCC WRONG\n");
			return -1;
		}
		this.data_size = res-1;
		return res; 
	} else {
		printf("BCC WRONG\n");
			return -1;
	}
}

void changeSequenceNumber() {
	if (this.sequenceNumber) this.sequenceNumber = 0;
	else this.sequenceNumber = 1;
}
'
                    );

INSERT INTO Snippet (
                        id,
                        date,
                        title,
                        description,
                        points,
                        author,
                        language,
                        code
                    )
                    VALUES (
                        5,
                        '2018-11-24 12:38',
                        'CSS Flexbox guide: How to horizontally center something in a big div ',
                        'kadjklçjlkjsafkjdafjjjsjfkçlddasjfkldasjfkljdasfkljdaskfjdsakfjksalfjçksfajsfkljadsfkljaslkfçasfafjaklsçfasfadsfaljkajsdkfçadsfkjaskfljadskfljaskfljasçklfjkljlk',
-                       2,
                        1,
                        'javascript',
                        'var DEGREE_TO_RAD = Math.PI / 180;

/**
 * XMLscene class, representing the scene that is to be rendered.
 */
class XMLscene extends CGFscene {
    /**
     * @constructor
     * @param {MyInterface} myinterface 
     */
    constructor(myinterface) {
        super();

        this.interface = myinterface;
        this.lightValues = {};
    }

    /**
     * Initializes the scene, setting some WebGL defaults, initializing the camera and the axis.
     * @param {CGFApplication} application
     */
    init(application) {
        super.init(application);
        this.camera = new CGFcamera(40 * DEGREE_TO_RAD, 0.1, 500, vec3.fromValues(60, 25, 60), vec3.fromValues(0, 0, 0));
        this.changeMaterials = 0;
        this.sceneInited = false;
        this.selectedCamera;

        this.enableTextures(true);

        this.gl.clearDepth(100.0);
        this.gl.enable(this.gl.DEPTH_TEST);
        this.gl.enable(this.gl.CULL_FACE);
        this.gl.depthFunc(this.gl.LEQUAL);

        this.defaultMaterial = new CGFappearance(this);

        this.axis = new CGFaxis(this);
    }

    /**
     * Initializes the scene lights with the values read from the XML file.
     */
    initLights() {

        let i = 0;
        // Lights index.

        // Reads the lights from the scene graph.
        for (let key in this.graph.lights) {
            if (i >= 8)
                break; // Only eight lights allowed by WebGL.

            if (this.graph.lights.hasOwnProperty(key)) {
                let light = this.graph.lights[key];

                //lights are predefined in cgfscene
                let lightProp = light.properties;
                this.lights[i].setPosition(lightProp.location.x, lightProp.location.y, lightProp.location.z, lightProp.location.w);
                this.lights[i].setAmbient(lightProp.ambient.r, lightProp.ambient.g, lightProp.ambient.b, lightProp.ambient.a);
                this.lights[i].setDiffuse(lightProp.diffuse.r, lightProp.diffuse.g, lightProp.diffuse.b, lightProp.diffuse.a);
                this.lights[i].setSpecular(lightProp.specular.r, lightProp.specular.g, lightProp.specular.b, lightProp.specular.a);

                if (light.type == "spot") {
                    let target = vec4.fromValues(lightProp.target.x, lightProp.target.y, lightProp.target.z, lightProp.target.w);
                    let direction = vec4.create();
                    vec4.sub(direction, target, this.lights[i].position);
                    vec4.normalize(direction, direction);
                    this.lights[i].setSpotDirection(direction[0], direction[1], direction[2]);
                    this.lights[i].setSpotExponent(light.exponent);
                    this.lights[i].setSpotCutOff(light.angle);

                }

                this.lightValues[key] = light.enabled;

                this.lights[i].setVisible(true);

                if (light.enabled)
                    this.lights[i].enable();
                else
                    this.lights[i].disable();

                this.lights[i].update();

                i++;
            }
        }

    }


    /* Handler called when the graph is finally loaded. 
     * As loading is asynchronous, this may be called already after the application has started the run loop
     */
    onGraphLoaded() {

        this.initCameras();

        this.interface.addViewsGroup(this.cameras);

        this.axis = new CGFaxis(this, this.graph.axisLength);

        if (this.graph.ambient.background != null) {
            let bg = this.graph.ambient.background;
            this.gl.clearColor(bg.r, bg.g, bg.b, bg.a);
        }

        if (this.graph.ambient.ambient != null) {
            let amb = this.graph.ambient.ambient;
            this.setGlobalAmbientLight(amb.r, amb.g, amb.b, amb.a);
        }

        this.initLights();

        // Adds lights group.
        this.interface.addLightsGroup(this.lightValues);

        this.setUpdatePeriod(1 / 60 * 1000);
        this.lastUpdate = (new Date()).getTime();

        this.sceneInited = true;
    }

    /**
     * Initializes scene cameras from graph views
     */
    initCameras() {
        this.cameras = {};
        if ((Object.keys(this.graph.views)).length == 0) {
            this.cameras["default"] = this.camera;
            this.selectedCamera = "default";
        }
        for (let key in this.graph.views) {
            const cam = this.graph.views[key];
            let newCam;
            if (cam.type == "perspective") {
                newCam = new CGFcamera(
                    cam.angle * DEGREE_TO_RAD, cam.near, cam.far, Object.values(cam.from), Object.values(cam.to)
                );

            } else if (cam.type == "ortho") {
                newCam = new CGFcameraOrtho(
                    cam.left, cam.right, cam.bottom, cam.top, cam.near, cam.far, Object.values(cam.from), Object.values(cam.to), vec3.fromValues(0, 1, 0)
                );
            }
            this.cameras[cam.id] = newCam;
            if (cam.id === this.graph.defaultViewId) {
                this.camera = newCam;
                this.interface.setActiveCamera(this.camera);
                this.selectedCamera = key;
            }
        }
    }
    /**
     * Sets scene active camera
     * @param  {camera id} id
     */
    setActiveCamera(id) {
        this.camera = this.cameras[id];
    }

    update(currTime) {
        if (this.sceneInited) {
            const delta = currTime - this.lastUpdate;
            this.graph.update(delta);
            this.lastUpdate = currTime;
        }

    }

    /**
     * Displays the scene.
     */
    display() {
        // ---- BEGIN Background, camera and axis setup

        // Clear image and depth buffer everytime we update the scene
        this.gl.viewport(0, 0, this.gl.canvas.width, this.gl.canvas.height);
        this.gl.clear(this.gl.COLOR_BUFFER_BIT | this.gl.DEPTH_BUFFER_BIT);

        // Initialize Model-View matrix as identity (no transformation
        this.updateProjectionMatrix();
        this.loadIdentity();

        // Apply transformations corresponding to the camera position relative to the origin
        this.applyViewMatrix();

        this.pushMatrix();

        if (this.sceneInited) {
            this.defaultMaterial.apply();
            if (this.changeMaterials) this.graph.changeMaterials();
            this.changeMaterials = 0;
            // Draw axis
            this.axis.display();
            var i = 0;
            for (var key in this.lightValues) {
                if (this.lightValues.hasOwnProperty(key)) {
                    if (this.lightValues[key]) {
                        this.lights[i].setVisible(true);
                        this.lights[i].enable();
                    } else {
                        this.lights[i].setVisible(false);
                        this.lights[i].disable();
                    }
                    this.lights[i].update();
                    i++;
                }
            }

            // Displays the scene (MySceneGraph function).
            this.graph.displayScene();
        } else {
            // Draw axis
            this.axis.display();
        }

        this.popMatrix();
        // ---- END Background, camera and axis setup
    }
}'
                    );

INSERT INTO Snippet (
                        id,
                        date,
                        title,
                        description,
                        points,
                        author,
                        language,
                        code
                    )
                    VALUES (
                        6,
                        '2018-11-25 16:17',
                        'adjsaklçf',
                        'thiohiasodflkjsafkljasdfkçadjskfjsaklçfafkjfkladsjfklçasjfklçadjsflksadjlfkçasj',
                        0,
                        2,
                        'html',
                        '<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>CGFexample</title>

<style>
body, html {
    border: 0;
    padding: 0;
    margin: 0;
    overflow: hidden;
}

canvas {
    width: 100%;
    height: 100%;
}
</style>
</head>
<body>

<script src="main.js"></script>

</body>
</html>'
                    );

INSERT INTO Snippet (
                        id,
                        date,
                        title,
                        description,
                        points,
                        author,
                        language,
                        code
                    )
                    VALUES (
                        7,
                        '2018-11-28 11:12',
                        'shaders',
                        'eu gosto de shaders',
                        2,
                        2,
                        'clike',
                        '#ifdef GL_ES
precision highp float;
#endif

attribute vec2 aTextureCoord;
attribute vec3 aVertexPosition;
varying vec2 vTextureCoord;
uniform mat4 uMVMatrix;
uniform mat4 uPMatrix;

uniform float timeFactor;
uniform float heightScale;
uniform float texScale;
uniform sampler2D heightMapSampler;

void main() {
	vec2 coordsOffset = vec2(0.0, 1.0) * 0.00005 * timeFactor;
	vTextureCoord = (aTextureCoord * texScale) + coordsOffset;
	vec4 color = texture2D(heightMapSampler, aTextureCoord+coordsOffset);
	float height = (color.r + color.b + color.g)/3.0;
	vec3 heightOffset = vec3(0.0, 1.0, 0.0) * height * heightScale;
	gl_Position = uPMatrix * uMVMatrix * vec4(aVertexPosition + heightOffset , 1.0);

}'
                    );

INSERT INTO Snippet (
                        id,
                        date,
                        title,
                        description,
                        points,
                        author,
                        language,
                        code
                    )
                    VALUES (
                        8,
                        '2018-11-30 15:26',
                        'Parser',
                        'This snippet parses grades and average grade of a SiFEUP page.',
                        1,
                        1,
                        'dart',
                        'import ''package:html/dom.dart'';
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
}'
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

INSERT INTO SnippetRating (
                              user,
                              snippet,
                              isLike
                          )
                          VALUES (
                              1,
                              7,
                              1
                          );

INSERT INTO SnippetRating (
                              user,
                              snippet,
                              isLike
                          )
                          VALUES (
                              1,
                              5,
                              0
                          );

INSERT INTO SnippetRating (
                              user,
                              snippet,
                              isLike
                          )
                          VALUES (
                              1,
                              6,
                              0
                          );

INSERT INTO SnippetRating (
                              user,
                              snippet,
                              isLike
                          )
                          VALUES (
                              1,
                              8,
                              1
                          );

INSERT INTO SnippetRating (
                              user,
                              snippet,
                              isLike
                          )
                          VALUES (
                              2,
                              5,
                              0
                          );

INSERT INTO SnippetRating (
                              user,
                              snippet,
                              isLike
                          )
                          VALUES (
                              2,
                              6,
                              1
                          );

INSERT INTO SnippetRating (
                              user,
                              snippet,
                              isLike
                          )
                          VALUES (
                              2,
                              1,
                              1
                          );

INSERT INTO SnippetRating (
                              user,
                              snippet,
                              isLike
                          )
                          VALUES (
                              2,
                              7,
                              1
                          );

INSERT INTO SnippetRating (
                              user,
                              snippet,
                              isLike
                          )
                          VALUES (
                              2,
                              2,
                              1
                          );

INSERT INTO SnippetRating (
                              user,
                              snippet,
                              isLike
                          )
                          VALUES (
                              2,
                              3,
                              1
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


COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
