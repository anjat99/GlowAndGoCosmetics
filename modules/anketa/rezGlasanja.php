<?php
    ob_start();
    session_start();
    require_once("../../setup/konekcija.php");
    require_once("functions.php");
    header("Content-type:application/json");
    $data=null;
    $code=404;

        if(isset($_POST['send'])){
            $idKorisnik = $_POST['id'];
            $idOdgovor=$_POST['odgovor'];

            $upitAnketa = "SELECT * FROM anketa WHERE aktivna=1";
            $rez = $konekcija->query($upitAnketa)->fetch();
            $idAnketa=$rez->idAnketa;
            
            $upit = "SELECT * from anketa as a INNER JOIN anketa_odgovor as o on a.idAnketa=o.idAnketa WHERE a.aktivna=1 and o.idKorisnik=:idKorisnik";
            $rez = $konekcija->prepare($upit);
            $rez->bindParam(":idKorisnik", $idKorisnik);
            $rez->execute();

            if($rez->rowCount()==0){
                $upit1 = "INSERT INTO anketa_korisnik (idKorisnik, idOdgovor) VALUES (:idKorisnik,:idOdgovor)";
                $rez1 = $konekcija->prepare($upit1);
                $rez1->bindParam(":idKorisnik", $idKorisnik);
                $rez1->bindParam(":idOdgovor", $idOdgovor);

                $upit2 = "INSERT INTO anketa_odgovor (idKorisnik, idAnketa) VALUES (:idKorisnik,:idAnketa)";
                $rez2 = $konekcija->prepare($upit2);
                $rez2->bindParam(":idKorisnik", $idKorisnik);
                $rez2->bindParam(":idAnketa", $idAnketa);
                
                try{
                    $konekcija->beginTransaction();
                    $rez1->execute();
                    $rez2->execute();
                    $konekcija->commit();
                    echo json_encode(['message'=> 'Uspesno glasanje']);
                    http_response_code(201);
                }
                catch(PDOException $e){
                    $konekcija->rollback();
                    echo $e->getMessage();
                    echo json_encode(['message'=> 'Greska prilikom glasanja']);
                    http_response_code(500);
                }
            } else{
                $code = 500;
                echo json_encode(['message'=> 'Već ste iskoristili pravo glasa"']);
            }
        }  
        echo json_encode($data);
        