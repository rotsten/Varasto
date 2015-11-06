--SQL> CREATE ROLE Masteruser WITH SUPERUSER
--SQL> CREATE DATABASE Varastotietokanta WITH Masteruser

CREATE TABLE KAYTTAJA (
	Kayttajatunnus	serial PRIMARY KEY, 
	Salasana	varchar(30) NOT NULL,
	Etunimi		varchar(20) NOT NULL,
	Sukunimi	varchar(30),
	Kayttooikeudet	Boolean DEFAULT FALSE --True for Paakayttaja, false for varastotyöntekijä
);

CREATE TABLE TUOTE (
	Tuote_ID	serial PRIMARY KEY, 
	Tuotteen_nimi	varchar(30) NOT NULL,
	Kuvaus		varchar(150),
	Valmistaja	varchar(30),
	History_kuka_lisasi	varchar (8) REFERENCES KAYTTAJA (Kayttajatunnus) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION,
	History_date		timestamp
);

CREATE TABLE VARASTO (
	Tuote_ID		NUMBER (13) REFERENCES TUOTE (TuoteID) MATCH FULL ON DELETE delete MATCH FULL ON UPDATE update,
	Lukumaara		INTEGER DEFAULT (0),
	History_kuka_inventoi	varchar(8) REFERENCES KAYTTAJA(kayttajatunnus) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION,
	History_date		timestamp
);

-- Lisää CREATE TABLE lauseet tähän tiedostoon
