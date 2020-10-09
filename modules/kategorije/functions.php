<?php
    
    function dohvatiSveKategorije(){
        return izvrsiUpit("SELECT * FROM kategorije");
    }

    function dohvatiJednuKategoriju($id){
        global $konekcija;
        $kategorija=$konekcija->prepare("SELECT * FROM kategorije WHERE idKategorija=$id");
        $kategorija->execute([$id]);
        return $kategorija->fetch();
    }