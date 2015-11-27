-- SQL> CREATE ROLE Masteruser WITH SUPERUSER
-- SQL> CREATE DATABASE Varastotietokanta WITH Masteruser
 CREATE TABLE KAYTTAJA (
	Kayttajatunnus	varchar(8)PRIMARY KEY, 
	Salasana	varchar(30) NOT NULL,
	Etunimi		varchar(20) NOT NULL,
	Sukunimi	varchar(30),
	Kayttooikeudet	Boolean DEFAULT FALSE 
 );

 CREATE TABLE TUOTE (
	Tuote_ID	varchar(13)PRIMARY KEY, 
	Tuotteen_nimi	varchar(30) NOT NULL,
	Kuvaus		varchar(150),
	Valmistaja	varchar(30),
	Lukumaara       INTEGER DEFAULT (0),
	History_date	timestamp
 );

CREATE TABLE VARASTO (
        varasto_id     INTEGER PRIMARY KEY, 
        name varchar(50) NOT NULL);

CREATE TABLE VARASTO_TUOTE (
        varasto_id     INTEGER,
        tuote_id       VARCHAR(13),
        lukumaara      INTEGER DEFAULT(0),
        FOREIGN KEY (varasto_id) REFERENCES VARASTO (varasto_id),
        FOREIGN KEY (tuote_id) REFERENCES TUOTE (tuote_id) ON DELETE CASCADE
);
