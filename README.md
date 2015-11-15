
# Varasto -tietokantasovellus

 
Yleisiä linkkejä:


* [Linkki sovellukseeni](http://rotsten.users.cs.helsinki.fi/Varasto/)
* [Linkki dokumentaatiooni](https://github.com/rotsten/Varasto/blob/master/doc/dokumentaatio.pdf)
* [Linkki Tietokantakuvaukseen] http://rotsten.users.cs.helsinki.fi/Varasto/tietokantayhteys

Tällä hetkellä Varasto-tietokantasovellus on pahassa käymistilassa.
Toimivaa on: 
- kirjautuminen sisään. Käyttäjätunnus ja salasana tarkastetaan tietokannasta. Testauskäyttöä varten on
käytössä pari: testing testing. 
- Tuotteen lisääminen toimii.
- Tuotteiden listaaminen toimii. Valitettavasti tällä hetkellä ei enää toimi "Näytä tarkemmat tuotetiedot". 
- Käyttäjien listaaminen toimii
- Varaston listaaminen toimii, mutta ei ole vielä kovin mielekästä katsottavaa. 

Toimimatonta: 
- Tuotteen muutos
- Varastotilanteen muutos (tarvitsee vielä pienen lisäyksen myös tietokantaratkaisuun)
- Käyttäjätietojen muutos
- Tuotteen poistaminen

Tulossa:
- Lisää käyttäjä, poista käyttäjä
- Käyttäjäoikeuksien tarkastaminen eri toimintojen aluksi.

## Varastotietokantasovellus

Varastotietokantasovellus on pienen yrityksen varaston ylläpitoon tarkoitettu web-pohjainen tietokantasovellus. Sovelluksen päätarkoitus on yrityksen tuotevalikoiman ja varastotietojen ylläpitäminen. 

Varastotietokantasovelluksen käyttöliittymä tarjoaa toiminnot yrityksen käyttäjä-, tuote- ja varastotietojen hallintaan. 

Järjestelmällä on kahden tyyppisiä käyttäjiä: henkilöitä esimerkiksi varastotyöntekijöitä tai kiireapulaisia, jotka voivat inventoida varastoa (muuttaa yksittäisten tuotteiden lukumäärätietoa tai tarkastaa varaston tilanteen), mutta eivät voi vahingossakaan lisätä tuotteita valikoimiin tai poistaa niitä sieltä; ja pääkäyttäjiä, jotka voivat varaston inventoinnin lisäksi lisätä hallita sovelluksen käyttäjien tietoja, lisätä tuotevalikoimaan uusia tuotteita, muuttaa tuotetietoja ja poistaa tuotteita. 


