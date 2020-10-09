<?php
        
        function aktivnaAnketaOdgovori(){
            return izvrsiUpit("SELECT * FROM odgovori");
        }

        function dohvatiSveAnkete(){
            return izvrsiUpit("SELECT * FROM anketa");
        }
        
        function aktivnaAnketa(){
            global $konekcija;
            return $konekcija->query("SELECT * FROM anketa WHERE aktivna=1")->fetch();
        }

        function rezultatJedneAnkete($id){
            global $konekcija;
            $salji=$konekcija->prepare("SELECT odg.naziv,count(odg.idOdgovor) as broj FROM anketa_odgovor o LEFT OUTER JOIN anketa_korisnik r on o.idKorisnik=r.idKorisnik INNER JOIN odgovori as odg on odg.idOdgovor=r.idOdgovor inner join korisnici kor on r.idKorisnik=kor.idKorisnik WHERE o.idAnketa=? GROUP BY odg.naziv,odg.idOdgovor");
            $salji->execute([$id]);
            return $salji->fetchAll();
        }

        function rezultatJedneAnketeAdmin($id){
            global $konekcija;
            $salji=$konekcija->prepare("SELECT kor.email, odg.naziv,count(odg.idOdgovor) as broj FROM anketa_odgovor o LEFT OUTER JOIN anketa_korisnik r on o.idKorisnik=r.idKorisnik INNER JOIN odgovori as odg on odg.idOdgovor=r.idOdgovor inner join korisnici kor on r.idKorisnik=kor.idKorisnik WHERE o.idAnketa=? GROUP BY odg.naziv, kor.email");
            $salji->execute([$id]);
            return $salji->fetchAll();
        }