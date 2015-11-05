--SQL> CREATE ROLE Masteruser WITH SUPERUSER
--SQL> CREATE DATABASE Varastotietokanta WITH Masteruser

CREATE TABLE KAYTTAJA (
	Kayttajatunnus	varchar (8) serial PRIMARY KEY,
	Salasana	varchar(30) NOT NULL CHECK (Salasana <> ' '),
	Etunimi		varchar(20) NOT NULL CHECK (Etunimi <> ' '),
	Sukunimi	varchar(30),
	Kayttooikeudet	Boolean --True for Paakayttaja, false for varastotyöntekijä
);

CREATE TABLE TUOTE (
	Tuote_ID	NUMBER (13) serial PRIMARY KEY,
	Tuotteen_nimi	varchar(30) NOT NULL CHECK (Tuotteen_nimi <> ' '),
	Kuvaus		varchar(150),
	Valmistaja	varchar(30),
	History_kuka_lisasi	varchar (8) TUOTE_History_kuka_lisasi_fkey FOREIGN KEY (Kayttajatunnus) 
	REFERENCES KAYTTAJA(kayttajatunnus) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION,
	History_date		timestamp
);

CREATE TABLE VARASTO (
	Tuote_ID		NUMBER (13) VARASTO_Tuote_ID_fkey FOREIGN KEY (Tuote-ID) 
	REFERENCES TUOTE (TuoteID) MATCH FULL ON DELETE delete MATCH FULL ON UPDATE update,
	Lukumaara		INTEGER DEFAULT (0),
	History_kuka_inventoi	varchar(8) VARASTO_History_kuka_inventoi_fkey FOREIGN KEY (Kayttajatunnus) 
	REFERENCES KAYTTAJA(kayttajatunnus) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE NO ACTION,
	History_date		timestamp
);

-- Lisää CREATE TABLE lauseet tähän tiedostoon
