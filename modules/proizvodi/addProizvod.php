<?php
    session_start();
    ob_start();
    header("Content-Type: application/json");
    $data=null;
    $code = 404;
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
        if(isset($_POST['btnUnosProizvoda'])){
            require_once("../../setup/konekcija.php");
            
            $naziv = $_POST['nazivProizvoda'];
            $opis=$_POST['opisProizvoda'];
            $cena=$_POST['cenaProizvoda'];
            $cenaStara=$_POST['cenaProizvodaStara'];
            $stanje=isset($_POST['chStanje'])?$_POST['chStanje']:0;
            $kolicina = $_POST['kolicina'];
            $kategorija=$_POST['ddlKategorija'];
            $brend=$_POST['ddlBrend'];
            $datumIzForme=$_POST['datumAdd'];
            $datumNiz=explode("-",$datumIzForme);
            $timestamp=time();
            $datumUnos=date("Y-m-d H:i:s",$timestamp);

            $slika = $_POST['slikaProizvoda'];
            $thumbnail = $_POST['slikaProizvodaMala'];
            $alt = "proizvod".time();
            $altMala = "proizvod_thumbnail".time();
            
            
            $upit1 = "INSERT INTO proizvodi VALUES(NULL, :naziv, :opis, :cena, :stara_cena, :na_stanju, :uk_kolicina, :kategorija, :brend, :datum_unosa)";
                $rez1 = $konekcija->prepare($upit1);
                $rez1->bindParam(":naziv", $naziv);
                $rez1->bindParam(":opis", $opis);
                $rez1->bindParam(":cena", $cena);
                $rez1->bindParam(":stara_cena", $cenaStara);
                $rez1->bindParam(":na_stanju", $stanje);
                $rez1->bindParam(":uk_kolicina", $kolicina);
                $rez1->bindParam(":kategorija", $kategorija);
                $rez1->bindParam(":brend", $brend);
                $rez1->bindParam(":datum_unosa", $datumUnos);
            
            $upit2 = "INSERT INTO slike VALUES (:idProizvod, :putanja, :alt)";
                $rez2 = $konekcija->prepare($upit2);
                $rez2->bindParam(":idProizvod", $idPr);
                $rez2->bindParam(":putanja", $slika);
                $rez2->bindParam(":alt", $alt);
                
              

            $upit3 = "INSERT INTO slike_thumbnail VALUES (:idProizvod, :putanja, :alt)";
                $rez3 = $konekcija->prepare($upit3);
                $rez3->bindParam(":idProizvod", $idPr);
                $rez3->bindParam(":putanja", $thumbnail);
                $rez3->bindParam(":alt", $altMala);
                

            try{
                $konekcija->beginTransaction();
                $rez1->execute();
                $idPr = $konekcija->lastInsertId();
                $rez2->execute();
                $rez3->execute();
                $konekcija->commit();
                echo json_encode(['message'=> 'Product successfully created']);
                http_response_code(201);
            }
            catch(PDOException $e){
                $konekcija->rollback();
                echo json_encode(['message'=> $e->getMessage()]);
                http_response_code(500);
            }
           
        } 
        http_response_code($code);
        echo json_encode($data);
    endif;