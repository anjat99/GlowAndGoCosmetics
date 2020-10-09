<?php
ob_start();
 session_start();

    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
        if(isset($_POST['btnIzmenaKat'])){
        require_once("../../setup/konekcija.php");
    
        $naziv=$_POST['tbNazivKat'];
        $id = $_POST['skrivenoPoljeKat'];
        $rezultat = $konekcija->prepare("UPDATE kategorije SET naziv = UPPER(?) WHERE idKategorija = ?");

        $rezultat->bindValue(1, $naziv);
        $rezultat->bindValue(2, $id);

        try {
            $uspelo = $rezultat->execute();
            http_response_code(204); 
            if($uspelo){
                $_SESSION['poruka']="Kategorija je uspešno izmenjena";
             }else{
                 echo "Nije uspelo izvrsavanje";
             }
        }
        catch(PDOException $e){
            echo json_encode(['poruka'=> 'Problem sa bazom: ' . $e->getMessage()]);
            http_response_code(500);
            $_SESSION['poruka']="Greška, kategorija nije izmenjena";
        }
        
        header("Location:../../views/admin/admin_kat.php");
    }else {
        http_response_code(400); 
    }
endif;