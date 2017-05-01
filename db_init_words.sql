/* create synonym table
*/

DROP TABLE IF EXISTS synonym;

CREATE TABLE synonym (
	Word varchar(255) NOT NULL,
	WordGroup int NOT NULL AUTO_INCREMENT,
	Global BIT(1) DEFAULT 0,
	PRIMARY KEY (Word, WordGroup)
);
