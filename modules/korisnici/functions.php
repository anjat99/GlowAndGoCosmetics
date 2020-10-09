<?php
    
    function dohvatiSveKorisnike(){
        return izvrsiUpit("SELECT k.*,u.naziv FROM korisnici k INNER JOIN uloge u on k.uloga_id=u.idUloga");
    }

    function dohvatiUloge(){
        return izvrsiUpit("SELECT * FROM uloge");
    }

    function brisanjeKorisnika($id){
        global $konekcija;
        $brisanje=$konekcija->prepare("DELETE FROM korisnici WHERE idKorisnik=$id");
        return $brisanje->execute();
    }

    function dohvatiJednogKorisnika($id){
        global $konekcija;
        $korisnik=$konekcija->prepare("SELECT * FROM korisnici k INNER JOIN uloge u ON k.uloga_id=u.idUloga WHERE idKorisnik=$id");
        $korisnik->execute([$id]);
        return $korisnik->fetch();
        }