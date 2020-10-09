<?php
    $serverBaze="localhost";
    $username = "id13059617_beauty_31";
    $password = "nekaTamoLepota";
    $nazivBaze = "id13059617_lifeofbeauty";

    try{
           $konekcija = new PDO("mysql:host=$serverBaze;dbname=$nazivBaze;",$username,$password);
            $konekcija -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $konekcija -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

    function izvrsiUpit($upit){
        global $konekcija;
        $rez=$konekcija->query($upit)->fetchAll();
        return $rez;
    }

    define("URL", "http://localhost/sajtphp1/");
 

       
?>