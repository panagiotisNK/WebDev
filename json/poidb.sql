DROP DATABASE IF EXISTS pois;
CREATE DATABASE pois;
USE pois;

CREATE TABLE poi(
    poiId VARCHAR(30) NOT NULL,
    poiName VARCHAR(100) NOT NULL,
    poiAddress VARCHAR(100) NOT NULL,
    poiRating FLOAT(3,2) DEFAULT 0.00 NOT NULL,
    poiRatingn INT(10) DEFAULT 0 NOT NULL,
    poiCurrPop INT(10) DEFAULT 0, 
    PRIMARY KEY (poiId)
);

CREATE TABLE poiTypes(
    poiId VARCHAR(30) NOT NULL,
    poiType VARCHAR(25) NOT NULL,
    CONSTRAINT ISA
    FOREIGN KEY (poiId) REFERENCES poi(poiId)
    ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE poiCoordinates(
    poiId VARCHAR(30) NOT NULL,
    lat FLOAT(9,7) DEFAULT 0 NOT NULL,
    lng FLOAT(9,7) DEFAULT 0 NOT NULL,
    PRIMARY KEY (poiId),
    CONSTRAINT ISAT
    FOREIGN KEY (poiId) REFERENCES poi(poiId)
    ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE popularTimes(
    poiId VARCHAR(30) NOT NULL,
    dataDay SET("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"),
    dataVal0 INT(10) DEFAULT 0 NOT NULL,
    dataVal1 INT(10) DEFAULT 0 NOT NULL,
    dataVal2 INT(10) DEFAULT 0 NOT NULL,
    dataVal3 INT(10) DEFAULT 0 NOT NULL,
    dataVal4 INT(10) DEFAULT 0 NOT NULL,
    dataVal5 INT(10) DEFAULT 0 NOT NULL,
    dataVal6 INT(10) DEFAULT 0 NOT NULL,
    dataVal7 INT(10) DEFAULT 0 NOT NULL,
    dataVal8 INT(10) DEFAULT 0 NOT NULL,
    dataVal9 INT(10) DEFAULT 0 NOT NULL,
    dataVal10 INT(10) DEFAULT 0 NOT NULL,
    dataVal11 INT(10) DEFAULT 0 NOT NULL,
    dataVal12 INT(10) DEFAULT 0 NOT NULL,
    dataVal13 INT(10) DEFAULT 0 NOT NULL,
    dataVal14 INT(10) DEFAULT 0 NOT NULL,
    dataVal15 INT(10) DEFAULT 0 NOT NULL,
    dataVal16 INT(10) DEFAULT 0 NOT NULL,
    dataVal17 INT(10) DEFAULT 0 NOT NULL,
    dataVal18 INT(10) DEFAULT 0 NOT NULL,
    dataVal19 INT(10) DEFAULT 0 NOT NULL,
    dataVal20 INT(10) DEFAULT 0 NOT NULL,
    dataVal21 INT(10) DEFAULT 0 NOT NULL,
    dataVal22 INT(10) DEFAULT 0 NOT NULL,
    dataVal23 INT(10) DEFAULT 0 NOT NULL,
    PRIMARY KEY (poiId,dataDay),
    CONSTRAINT POP
    FOREIGN KEY (poiId) REFERENCES poi(poiId)
);


CREATE TABLE users(
    userId AUTO_INCREMENT NOT NULL,
    username VARCHAR(10) NOT NULL,
    email VARCHAR(100) NOT NULL,
    userType VARCHAR(5) NOT NULL,
    pass VARCHAR(100) NOT NULL,
    PRIMARY KEY (userId),
    UNIQUE KEY (username),
    UNIQUE KEY (email)
);


CREATE TABLE visits(
    poiId VARCHAR(30) NOT NULL,
    userId INT(10) NOT NULL,
    visitStamp TIMESTAMP NOT NULL,
    PRIMARY KEY (poiId, userId),
    CONSTRAINT VISITED
    FOREIGN KEY (poiId) REFERENCES poi(poiId)
    ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (userId) REFERENCES users(userId)
    ON DELETE CASCADE ON UPDATE CASCADE
);

