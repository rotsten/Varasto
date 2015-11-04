--SQL> CREATE ROLE Masteruser WITH SUPERUSER
--SQL> CREATE DATABASE Varastotietokanta WITH Masteruser

SQL > CREATE TABLE KAYTTAJA (
	Kayttajatunnus	NUMBER 8 CONSTRAIN Kayttajatunnus PRIMARY KEY
	Salasana		VARCHAR2(30) NOT NULL CHECK (Salasana <> ' ')
	Etunimi		VARCHAR2(20) NOT NULL CHECK (Etunimi <> ' ')
	Sukunimi		VARCHAR2(30)
	Kayttooikeudet	BYTE
);

SQL > CREATE TABLE TUOTE (
	Tuote-ID		NUMBER 13 CONSTRAIN Tuote-ID PRIMARY KEY
	Tuotteen_nimi	VARCHAR2(30) NOT NULL CHECK (Tuotteen_nimi <> ' ')
	Kuvaus		VARCHAR2(150)
	Valmistaja		VARCHAR2(30)
	History-kuka-lisasi	NUMBER (8) CONSTRAIN TUOTE_History-kuka-lisasi_fkey FOREIGN KEY (Kayttajatunnus) 
	REFERENCES KAYTTAJA(kayttajatunnus) MATCH SIMPLE
	ON UPDATE NO ACTION ON DELETE NO ACTION
	History-date		timestamp
);

SQL > CREATE TABLE VARASTO (
	Tuote-ID		NUMBER 13 CONSTRAIN VARASTO_Tuote-ID_fkey FOREIGN KEY (Tuote-ID) 
	REFERENCES TUOTE (Tuote-ID) MATCH FULL ON DELETE delete MATCH FULL ON UPDATE update
	Lukumaara		INTEGER CONSTRAINT Lukumaara DEFAULT (0)
		History-kuka-inventoi	NUMBER (8) CONSTRAIN VARASTO_History-kuka-inventoi_fkey FOREIGN KEY (Kayttajatunnus) 
	REFERENCES KAYTTAJA(kayttajatunnus) MATCH SIMPLE
	ON UPDATE NO ACTION ON DELETE NO ACTION
	History-date		timestamp
);

-- Lisää CREATE TABLE lauseet tähän tiedostoon
