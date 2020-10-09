<?php
    function svePorudzbine(){
        return izvrsiUpit("SELECT * FROM proizvodi p INNER JOIN detalji_kupovine dk on p.idProizvod=dk.proizvod_id INNER join kupovina k on k.idKupovine=dk.kupovina_id inner join korisnici kor on kor.idKorisnik=k.korisnik_id");
    }

    function sviDPJednaPorudzbina($id){
        global $konekcija;
        $salji=$konekcija->prepare("SELECT dk.*,k.*,p.naziv,t.putanja as mala_putanja, t.alt as mala_alt, k.ime,k.prezime,kup.datumVreme_kupovine FROM detalji_kupovine dk INNER JOIN proizvodi p ON dk.proizvod_id=p.idProizvod INNER JOIN kupovina kup ON kup.idKupovine=dk.kupovina_id INNER JOIN slike s on p.idProizvod=s.idProizvod INNER JOIN slike_thumbnail t on p.idProizvod=t.idProizvod INNER JOIN korisnici k ON k.idKorisnik=kup.korisnik_id WHERE dk.kupovina_id=?");
        $salji->execute([$id]);
        return $salji->fetchAll();
    }

    function obrisiDP($id){
        global $konekcija;
        $salji=$konekcija->prepare("DELETE FROM detalji_kupovine WHERE kupovina_id=?");
        return $salji->execute([$id]);
    }

    function obrisiPorudzbinu($id){
        global $konekcija;
        $salji=$konekcija->prepare("DELETE FROM kupovina WHERE idKupovine=?");
        return $salji->execute([$id]);
    }
