-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE ASIAKAS(
    atunnus SERIAL PRIMARY KEY,
    nimi varchar(40) NOT NULL,
    password varchar(50) NOT NULL,
    Lennot varchar(20) NOT NULL,
    syntymaaika varchar(8)
);

CREATE TABLE TUOTE(
    ttunnus SERIAL PRIMARY KEY,
    kuva BYTEA,
    nimi varchar(40) NOT NULL,
    hinta DECIMAL(10,2) NOT NULL,
    kuvas varchar(300)
);

CREATE TABLE TILAUS(
    otunnus SERIAL PRIMARY KEY,
    atunnus INTEGER REFERENCES asiakas(atunnus),
    ttunnus INTEGER REFERENCES tuote(ttunnus),
    lento varchar(20) NOT NULL
);
CREATE TABLE TOIVEET(
    atunnus INTEGER REFERENCES asiakas(atunnus),
    lento varchar(20) NOT NULL,
    toive varchar(300) NOT NULL
);