-- Lisää INSERT INTO lauseet tähän tiedostoon
--Asiakas taulus testidata--
INSERT INTO ASIAKAS ( atunnus ,nimi, salasana, oikeuksia) VALUES ('1','Admin','Admin','0');
INSERT INTO ASIAKAS ( atunnus ,nimi, salasana, oikeuksia) VALUES ('2','User1','User1','1');
--tuote taulun testidata--
INSERT INTO TUOTE (nimi,hinta,kuvaus) VALUES ('Iphony','999.99','älypuhelin, uusi kamera, vesitiivis ja blablabla');
INSERT INTO TUOTE (nimi,hinta,kuvaus) VALUES ('Kamera','123.45','kamera jolla pystyy ottaa kuvia');
INSERT INTO TUOTE (nimi,hinta,kuvaus) VALUES ('Hajuvesi','40.00','Hyvää tuoksuinen harjuvesi, 40ml');
INSERT INTO TUOTE (nimi,hinta,kuvaus) VALUES ('Suklaa','4.99','Vazzer sinen 100g');
INSERT INTO TUOTE (nimi,hinta,kuvaus) VALUES ('Tietokone','799.00','Hyvää ja nopea tietokone');
--tilaus taulun testidata--
--INSERT INTO TILAUS(otunnus, atunnus, lento) VALUES ('1','1','AY200');
--toiveet taulun testidata--
--INSERT INTO TOIVEET(atunnus, lento, toive) VALUES ('1','AY200','haluisin istua ikkunan vieressa');
--liitos taulun testidata--
--INSERT INTO LIITOSTAULU(otunnus, ttunnus) VALUES ('1','1');
