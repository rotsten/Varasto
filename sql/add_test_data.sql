INSERT INTO KAYTTAJA (Kayttajatunnus, Salasana, Etunimi, Sukunimi, Kayttooikeudet)
VALUES ('Taneli', 'tuikkurlz', 'Taina-Liisa', 'Matikainen', 'true');

INSERT INTO KAYTTAJA (Kayttajatunnus, Salasana, Etunimi, Sukunimi, Kayttooikeudet)
VALUES ('Antti', 'the_boss', 'Antti', ' ', 'true');

INSERT INTO KAYTTAJA (Kayttajatunnus, Salasana, Etunimi, Sukunimi, Kayttooikeudet)
VALUES ('Salmi_1', 'mies74', 'Jarkko', 'Salminen', 'false');
 
INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja, Lukumaara, history_date)
VALUES ('9789522910325', 'Big data & pilvipalvelut', 'Immo Salo: Big data & pilvipalvelut', 'Docendo', '7', '2015-05-11 20:45');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja, Lukumaara, history_date)
VALUES ('9781292061351', 'W. Stallings: Operating Syst.', 'W. Stallings: Operating Systems, Internals and design principles', 'Pearson', '1', '2015-05-11 21:09');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja, Lukumaara, history_date)
VALUES('9789511174684', 'Suomen lasten kalevala', 'Kuvitettu teos', 'Otava', '5', '2015-05-11 21:11');

INSERT INTO VARASTO (Tuote_ID, History_kuka_inventoi)
VALUES ('9789522910325', 'Taneli');

INSERT INTO VARASTO (Tuote_ID, History_kuka_inventoi)
VALUES ('9781292061351', 'Salmi_1');

INSERT INTO VARASTO (Tuote_ID, History_kuka_inventoi)
VALUES ('9789511174684', 'Salmi_1');
