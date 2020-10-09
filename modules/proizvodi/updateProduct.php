<?php
ob_start();
 session_start();

    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
        if(isset($_POST['btnIzmenaProizvoda'])){
        require_once("../../setup/konekcija.php");
    
        $id=$_POST['skrivenoPoljeProizvod'];
        $naziv=$_POST['nazivArtiklaUpdate'];
        $kategorijaId=$_POST['ddlKategorijaUpdate'];
        $brendId=$_POST['ddlBrendUpdate'];
        $cena=$_POST['cenaArtiklaUpdate'];
        $stara_cena=$_POST['cenaStaraArtiklaUpdate'];
        $opis=$_POST['opisArtiklaUpdate'];

        $rezultat = $konekcija->prepare("UPDATE proizvodi SET naziv = ?, opis = ?, cena = ?, stara_cena = ?, kat_id = ?, brend_id = ?  WHERE idProizvod = ?");

        $rezultat->bindValue(1, $naziv);
        $rezultat->bindValue(2, $opis);
        $rezultat->bindValue(3, $cena);
        $rezultat->bindValue(4, $stara_cena);
        $rezultat->bindValue(5, $kategorijaId);
        $rezultat->bindValue(6, $brendId);
        $rezultat->bindValue(7, $id);

        try {
            $uspelo = $rezultat->execute();
            http_response_code(204); 
            if($uspelo){
                $_SESSION['poruka']="Proizvod je uspešno izmenjen";
             }else{
                 echo "Nije uspelo izvrsavanje";
             }
        }
        catch(PDOException $e){
            echo json_encode(['poruka'=> 'Problem sa bazom: ' . $e->getMessage()]);
            http_response_code(500);
            $_SESSION['poruka']="Greška, proizvod nije izmenjen";
        }
        
        header("Location:../../views/admin/admin_proizvodi.php");
    }else {
        http_response_code(400); 
    }
endif;
