CREATE DATABASE `Agencija`;

CREATE TABLE `Agencija`.`User`(
    UserID          int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    UserRealName    varchar(50) NOT NULL,
    UserSurname     varchar(50) NOT NULL,
    UserStatus      varchar(20) NOT NULL,
    Username        varchar(50) NOT NULL,
    Password        varchar(50) NOT NULL   
);

CREATE TABLE `Agencija`.`Aranzman` (
    AranzmanID        int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    SifraAranzmana      char(13) NOT NULL,
    NazivDestinacije      varchar(50) NOT NULL,
    Cena   int(50) NOT NULL,
    DatumPolaska    date NOT NULL
);
CREATE TABLE `Agencija`.`Destinacija` (
    DestinacijaID        int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ImeDestinacije       varchar(50) NOT NULL,
    Drzava   varchar(50) NOT NULL
);

INSERT INTO `Agencija`.`User` (UserRealName, UserSurname, UserStatus, Username, Password) VALUES ('Stefan', 'Zivanov', 'admin', 'stefan', '123');
INSERT INTO `Agencija`.`User` (UserRealName, UserSurname, UserStatus, Username, Password) VALUES ('Nikola', 'Nikolic', 'user', 'nikola', '123');

INSERT INTO `Agencija`.`Aranzman` (SifraAranzmana, NazivDestinacije, Cena, DatumPolaska) VALUES ('00001', 'Barselona', '10000', '2022-01-18');
INSERT INTO `Agencija`.`Aranzman` (SifraAranzmana, NazivDestinacije, Cena, DatumPolaska) VALUES ('00002', 'Rim', '5000', '2021-02-18');

INSERT INTO `Agencija`.`Destinacija` (ImeDestinacije, Drzava) VALUES ('Barselona', 'Spanija');
INSERT INTO `Agencija`.`Destinacija` (ImeDestinacije, Drzava) VALUES ('Rim', 'Italija');

ALTER TABLE `Agencija`.`User` ADD CONSTRAINT UniqueUsername UNIQUE (Username);
ALTER TABLE `Agencija`.`Aranzman` ADD CONSTRAINT UniqueJMBG UNIQUE (SifraAranzmana);