DROP DATABASE IF EXISTS pois;
CREATE DATABASE pois;
USE pois;

CREATE TABLE poi(
    poiId VARCHAR(30) NOT NULL,
    poiName VARCHAR(100) NOT NULL,
    poiAddress VARCHAR(100) NOT NULL,
    poiRating FLOAT(3,2) DEFAULT 0.00 NOT NULL,
    poiRatingn INT(10) DEFAULT 0 NOT NULL,
    poiCurrPop INT(10) DEFAULT 0, --den einai aparaithto
    --timespent den einai aparaithto
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
    day ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday') NOT NULL,
    PRIMARY KEY (poiId, day),
    CONSTRAINT REL
    FOREIGN KEY (poiId) REFERENCES poi(poiId)
    ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE poiData(
    poiId VARCHAR(30) NOT NULL,
    dataDay ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday') NOT NULL,
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
    PRIMARY KEY (poiId, dataDay),
    CONSTRAINT POPULARITY
    FOREIGN KEY (poiId, dataDay) REFERENCES popularTimes(poiId, day)
    ON DELETE CASCADE ON UPDATE CASCADE
);


