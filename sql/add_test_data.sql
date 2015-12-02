INSERT INTO KAYTTAJA (Kayttajatunnus, Salasana, Etunimi, Sukunimi, Kayttooikeudet)
VALUES ('Taneli', 'tuikkurlz', 'Taina-Liisa', 'Matikainen', 'true');

INSERT INTO KAYTTAJA (Kayttajatunnus, Salasana, Etunimi, Sukunimi, Kayttooikeudet)
VALUES ('Antti', 'the_boss', 'Antti', ' ', 'true');

INSERT INTO KAYTTAJA (Kayttajatunnus, Salasana, Etunimi, Sukunimi, Kayttooikeudet)
VALUES ('Salmi_1', 'mies74', 'Jarkko', 'Salminen', 'false');

INSERT INTO KAYTTAJA (Kayttajatunnus, Salasana, Etunimi, Sukunimi, Kayttooikeudet)
VALUES ('Kylli', 'rotta10', 'Kyllikki', 'Kymäräinen', 'true');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja)
VALUES ('9789522910325', 'Big data & pilvipalvelut', 'Immo Salo: Big data & pilvipalvelut', 'Docendo');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja)
VALUES ('9781292061351', 'W. Stallings: Operating Systems, Internals and design principles', 'W. Stallings: Operating Systems, Internals and design principles, oppikirja käyttöjärjestelmistä', 'Pearson');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja)
VALUES ('9789513233259', 'Aku Ankan taskukirja nro 390 "Outolintu"', 'Aku Ankan taskukirja vuodelta 2002', 'Sanoma Magazines');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja)
VALUES ('9789522641632', 'Ha-Joon Chang "23 tosiasiaa kapitalismista"', 'Ha-Joon Chang "23 tosiasiaa kapitalismista", Kansainvälinen bestselleri', 'Into Kustannus Oy');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja)
VALUES ('6430032616506', 'A4 Avolehtiö', '7x7 mm ruudullinen avolehtiö kokoa A4', 'Wulff Oy Ab');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja)
VALUES ('2057030102660', 'Lakua', 'Porvoon musta laku, 250 g annospussi', 'Porvoon herkku'); 

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja)
VALUES ('9789511174684', 'Suomen lasten kalevala', 'Otava', 'Suomen lasten kalevala kuvitettu teos'); 

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja )
VALUES ('9789522205087', 'Auta lastasi matematiikassa', 'readme.fi', 'Carol Vorderman: "Auta lastasi matematiikassa läpi koko peruskoulun ja lukion", oppikirja'); 

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja )
VALUES ('5050582340112', 'Johnny Guitar	Universal', 'Klassikkolänkkäri, formaatti: DVD');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja )
VALUES ('5035822416437', 'Monty Python and the holy grail', 'Python (Monty) Pictures', 'Leffa, DVD-levy');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja )
VALUES ('9789525874457', 'William J. Mann: "Elizabeth Taylor Hollywoodin kuningatar"', 'Helsinki-kirjat', 'Elizabeth Taylorin elämäkerta');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja )
VALUES ('9789513164737', 'Ernest Hemingway: "Kuolema iltapäivällä"', 'Tammi', 'Ernest Hemingway: "Kuolema iltapäivällä". Tammen kultainen kirjasto. Alkuperäisteos vuodelta 1932');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja )
VALUES ('9789523001084', 'James Church', 'Atena', 'James Church on pseudonyymi, jonka takana on tiedustelualan ammattilainen');

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja )
VALUES ('9512009110', 'Mauri Sariola: "Susikosken ajojahti"', 'Gummerus', 'Poliisiromaani vuodelta 1974'); 

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja )
VALUES ('9781292025407', 'Introduction to Computer Security', 'Pearson', 'Kirjoittajat: Michael Goodrich & Robert Tamassia. Hyvin yleisesti käytetty oppikirja.'); 

INSERT INTO TUOTE (Tuote_ID, Tuotteen_nimi, Kuvaus, Valmistaja )
VALUES ('9789511163602', 'Peter von Bagh: "Elämää suuremmat elokuvat"', 'Otava', 'Peter von Bagh: "Elämää suuremmat elokuvat", 511-sivuinen järkälemäinen analyysi maailman parhaista elokuvista'); 

INSERT INTO VARASTO (Tuote_ID, Lukumaara, History_kuka_inventoi)
VALUES ('9789522910325', '1', 'Taneli');

INSERT INTO VARASTO (Tuote_ID, Lukumaara, History_kuka_inventoi)
VALUES ('9781292061351', '2', 'Salmi_1');

INSERT INTO VARASTO (Tuote_ID, Lukumaara, History_kuka_inventoi)
VALUES ('9789511174684', '3', 'Salmi_1');

INSERT INTO VARASTO (Tuote_ID, Lukumaara, History_kuka_inventoi)
VALUES ('9789522641632', '5', 'Salmi_1');

INSERT INTO VARASTO (Tuote_ID, Lukumaara, History_kuka_inventoi)
VALUES ('6430032616506', '6', 'Antti');

INSERT INTO VARASTO (Tuote_ID, Lukumaara, History_kuka_inventoi)
VALUES ('5050582340112', '7', 'Kylli');

INSERT INTO VARASTO (Tuote_ID, Lukumaara, History_kuka_inventoi)
VALUES ('5035822416437', '8', 'Kylli');

INSERT INTO VARASTO (Tuote_ID, Lukumaara, History_kuka_inventoi)
VALUES ('9789525874457', '9', 'Kylli');

INSERT INTO VARASTO (Tuote_ID, Lukumaara, History_kuka_inventoi)
VALUES ('9789513164737', '10', 'Kylli');
 
INSERT INTO VARASTO (Tuote_ID, Lukumaara, History_kuka_inventoi)
VALUES ('9789523001084', '11', 'Kylli');

INSERT INTO VARASTO (Tuote_ID, Lukumaara, History_kuka_inventoi)
VALUES ('9512009110', '12', 'Kylli');

INSERT INTO VARASTO (Tuote_ID, Lukumaara, History_kuka_inventoi)
VALUES ('2057030102660', '13', 'Kylli');

INSERT INTO VARASTO (varasto_id, nimi)
VALUES ('001', 'Ilvesvuoren teollisuusalue, halli 1');

INSERT INTO VARASTO (varasto_id, nimi)
VALUES ('002', 'Ilvesvuoren teollisuusalue, halli 2');

INSERT INTO VARASTO (varasto_id, nimi)
VALUES ('003', 'Ilvesvuoren teollisuusalue, halli 3');
