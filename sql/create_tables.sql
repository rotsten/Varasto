--SQL> CREATE ROLE Masteruser WITH SUPERUSER
--SQL> CREATE DATABASE Varastotietokanta WITH Masteruser

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
	Tuote_ID		varchar(13) REFERENCES TUOTE (Tuote_ID) MATCH FULL,
	History_kuka_inventoi	varchar(8) REFERENCES KAYTTAJA (kayttajatunnus) MATCH SIMPLE
);
