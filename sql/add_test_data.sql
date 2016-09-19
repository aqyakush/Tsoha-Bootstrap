-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO ASIAKAS (atunnus, nimi, password, lennot, syntymaaika) VALUES ('1','Matti','Matti123','AY2000','01.01.91');
--tuote taulun testidata--
INSERT INTO TUOTE (ttunnus,nimi,hinta,kuvas) VALUES ('1','Iphone 7','999.99','älypuhelin, uusi kamera, vesitiivis ja blablabla');
--tilaus taulun testidata--
INSERT INTO TILAUS(otunnus, atunnus, ttunnus, lento) VALUES ('1','1','1','AY200');
--toiveet taulun testidata--
INSERT INTO TOIVEET(atunnus, lento, toive) VALUES ('1','AY200','haluisin istua ikkunan vieressa');
