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

INSERT INTO (('9789511174684', 'Suomen lasten kalevala', 'Kuvitettu teos', 'Otava', '5', '2015-05-11 21:11');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja, Lukumaara, history_date)
VALUES ('9789513233259', 'A. Ankka #390 "Outolintu"', 'Aku Ankan taskukirja vuodelta 2002', 'Sanoma Magazines', '5', '2015-05-11 20:45');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja, Lukumaara, history_date)
VALUES ('9789522641632', 'H-J. C. "23 tosiasiaa kapital"', 'Ha-Joon Chang "23 tosiasiaa kapitalismista", Kansainvälinen bestselleri', 'Into Kustannus Oy', '2', '2015-05-11 21:09');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja, Lukumaara, history_date)
VALUES ('6430032616506', 'A4 Avolehtiö', '7x7 mm ruudullinen avolehtiö kokoa A4', 'Wulff Oy Ab', '154', '2015-05-11 21:11');

INSERT INTO VARASTO (Tuote_ID, History_kuka_inventoi)
VALUES ('9789522910325', 'Taneli');

INSERT INTO VARASTO (Tuote_ID, History_kuka_inventoi)
VALUES ('9781292061351', 'Salmi_1');

INSERT INTO VARASTO (Tuote_ID, History_kuka_inventoi)
VALUES ('9789511174684', 'Salmi_1');

INSERT INTO VARASTO (Tuote_ID, History_kuka_inventoi)
VALUES ('9789513233259', 'Antti');

INSERT INTO VARASTO (Tuote_ID, History_kuka_inventoi)
VALUES ('9789522641632', 'Salmi_1');

INSERT INTO VARASTO (Tuote_ID, History_kuka_inventoi)
VALUES ('6430032616506', 'Antti');

