CREATE TABLE VARASTO (
	Tuote_ID		varchar(13) REFERENCES TUOTE (Tuote_ID) ON DELETE CASCASE,
        Lukumaara       INTEGER DEFAULT(0),
	History_kuka_inventoi	varchar(8) REFERENCES KAYTTAJA (kayttajatunnus) ON DELETE CASCASE
);


