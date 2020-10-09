<?php
    
    function dohvatiSveBrendove(){
        return izvrsiUpit("SELECT * FROM brendovi");
    }

    function dohvatiJedanBrend($id){
        global $konekcija;
        $brend=$konekcija->prepare("SELECT * FROM brendovi WHERE idBrend=$id");
        $brend->execute([$id]);
        return $brend->fetch();
    }