-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO KAYTTAJA (Kayttajatunnus, Salasana, Etunimi, Sukunimi, Kayttooikeudet)
VALUES
 (Tuikku, tuikkurlz, Tiina-Liisa, Matikainen, true ),
 (Antti, the_boss, Antti, Matikainen, true ),
 (Salminen, mies74, Jarkko, Salminen, false);
 
INSERT INTO TUOTE (Tuote-ID, Tuotteen_nimi, Kuvaus, Valmistaja, History-kuka-lisasi, history-date)
VALUES
 (9789513233259, Aku Ankan taskukirja nro 390 "Outolintu", Aku Ankan taskukirja vuodelta 2002, Sanoma Magazines, Tuikku, 2015-05-11 20:45), --in format 1999-01-08 04:05:06
 (9789522641632, Ha-Joon Chang "23 tosiasiaa kapitalismista", Kansainvälinen bestselleri, Into Kustannus Oy, Tuikku, 2015-05-11 21:09),
 (6430032616506, A4 Avolehtiö, 7x7 mm ruudullinen avolehtiö kokoa A4, Wulff Oy Ab, Tuikku, 2015-05-11 21:11)

INSERT INTO VARASTO (Tuote-ID, Lukumaara, History-kuka-inventoi, History-date)
VALUES
 (9789513233259, 7, Tuikku, 2015-05-11 21:20), 
 (9789522641632, 1, Salminen, 2015-05-11 21:22),
 (6430032616506, 210, Salminen, 2015-05-11 21:25)
