<?php
    function dohvatiSveKategorije(){
        return izvrsiUpit("SELECT * FROM kategorije");
    }

    function dohvatiSveBrendove(){
        return izvrsiUpit("SELECT * FROM brendovi");
    }

    function dohvatiJedanProizvod($id){
        global $konekcija;
        $izvrsenje=$konekcija->prepare("SELECT p.*, k.naziv as nazivKat, b.naziv as nazivBrend FROM proizvodi p inner join kategorije k  ON k.idKategorija = p.kat_id inner join brendovi b  ON b.idBrend = p.brend_id WHERE p.idProizvod=:id");
        $izvrsenje->bindParam(":id",$id);
        $izvrsenje->execute();
        return $izvrsenje->fetch();
    }

    function dohvatiSveProizvode(){
        return izvrsiUpit("SELECT p.*, s.putanja AS velika_putanja, t.putanja as mala_putanja, s.alt as velika_alt, t.alt as mala_alt, k.naziv as nazivKat, b.naziv as nazivBrend FROM proizvodi p inner join slike s  ON s.idProizvod = p.idProizvod inner join slike_thumbnail t  ON t.idProizvod = p.idProizvod inner join kategorije k  ON k.idKategorija = p.kat_id inner join brendovi b  ON b.idBrend = p.brend_id");
    }

    function ukupanBrojProizvoda(){
        global $konekcija;
        return $konekcija->query("SELECT COUNT(*) AS brojProizvoda FROM proizvodi")->fetch();
    }

    function brojProizvodaZaJednuKategoriju($id){
        global $konekcija;
        $slanje=$konekcija->prepare("SELECT COUNT(*) AS brojSlika FROM proizvodi WHERE kat_id=$id");
        $slanje->execute([$id]);
        return $slanje->fetch();
    }

    