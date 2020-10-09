<?php
    session_start();
    ob_start();
    header('Content-Type: application/json');
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'){
        if(isset($_POST['btnDodajBrend'])){
            require_once("../../setup/konekcija.php");
                $naziv = $_POST['tbNazivBrenda'];
                $rezultat = $konekcija->prepare("INSERT INTO brendovi VALUES (NULL, ?)");

                try {
                    $rezultat->execute([$naziv]);
                    http_response_code(201); 
                    echo json_encode(["uspeh"=> "Uspesno kreiran brend!"]);
                    header("Location:../../views/admin/admin_brendovi.php");
                }
                catch(PDOException $e){
                    echo json_encode(['poruka'=> 'Problem sa bazom: ' . $e->getMessage()]);
                    http_response_code(500);
                }
                
        }else{
            http_response_code(400);
        }
        header("Location:../../views/admin/admin_brendovi.php");
    }      


  