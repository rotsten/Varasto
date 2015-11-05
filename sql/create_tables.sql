--SQL> CREATE ROLE Masteruser WITH SUPERUSER
--SQL> CREATE DATABASE Varastotietokanta WITH Masteruser

CREATE TABLE KAYTTAJA (
	Kayttajatunnus	varchar (8) SERIAL PRIMARY KEY,
	Salasana	varchar(30) NOT NULL CHECK (Salasana <> ' '),
	Etunimi		varchar(20) NOT NULL CHECK (Etunimi <> ' '),
	Sukunimi	varchar(30),
	Kayttooikeudet	Boolean --True for Paakayttaja, false for varastotyöntekijä
);

CREATE TABLE TUOTE (
	Tuote-ID	NUMBER (13) SERIAL PRIMARY KEY,
	Tuotteen_nimi	varchar(30) NOT NULL CHECK (Tuotteen_nimi <> ' '),
	Kuvaus		varchar(150),
	Valmistaja	varchar(30),
	History-kuka-lisasi	varchar (8) CONSTRAIN TUOTE_History-kuka-lisasi_fkey FOREIGN KEY (Kayttajatunnus) 
	REFERENCES KAYTTAJA(kayttajatunnus) MATCH SIMPLE
	ON UPDATE NO ACTION ON DELETE NO ACTION,
	History-date		timestamp
);

CREATE TABLE VARASTO (
	Tuote-ID		NUMBER (13) CONSTRAIN VARASTO_Tuote-ID_fkey FOREIGN KEY (Tuote-ID) 
	REFERENCES TUOTE (Tuote-ID) MATCH FULL ON DELETE delete MATCH FULL ON UPDATE update,
	Lukumaara		INTEGER CONSTRAINT Lukumaara DEFAULT (0),
	History-kuka-inventoi	varchar(8) CONSTRAIN VARASTO_History-kuka-inventoi_fkey FOREIGN KEY (Kayttajatunnus) 
	REFERENCES KAYTTAJA(kayttajatunnus) MATCH SIMPLE
	ON UPDATE NO ACTION ON DELETE NO ACTION,
	History-date		timestamp
);

-- Lisää CREATE TABLE lauseet tähän tiedostoon
