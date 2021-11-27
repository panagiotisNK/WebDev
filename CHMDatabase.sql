DROP DATABASE if exists PROJECT_WEB;
CREATE DATABASE PROJECT_WEB;
USE PROJECT_WEB;

CREATE TABLE IF NOT EXISTS USERS(
EMAIL VARCHAR(35) DEFAULT 'unknown' NOT NULL,
USERNAME VARCHAR(30) DEFAULT 'unknown' NOT NULL,
PASSWORD VARCHAR(30) DEFAULT 'unknown' NOT NULL,
EMAIL VARCHAR(35) DEFAULT 'unknown' NOT NULL,
PRIMARY KEY(USERNAME)
);

CREATE TABLE IF NOT EXISTS ADMINISTRATOR (
ADMINISTRATORUSERNAME VARCHAR(12) DEFAULT 'unknown' NOT NULL,
PRIMARY KEY(ADMINISTRATORUSERNAME),
CONSTRAINT MAN_USER FOREIGN KEY(ADMINISTRATORUSERNAME) REFERENCES USERS(USERNAME)
ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS USER(
USERNAME VARCHAR(12) DEFAULT 'unknown' NOT NULL,
PRIMARY KEY(USERNAME),
CONSTRAINT EMPL_USER FOREIGN KEY (USERNAME) REFERENCES USERS(USERNAME)
ON DELETE CASCADE ON UPDATE CASCADE

);