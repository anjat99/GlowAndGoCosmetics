<?php
    session_start();
    ob_start();
    $code=404;
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
        if(isset($_POST['id'])){
            $id=$_POST['id'];
       
            require_once("../../setup/konekcija.php");
            
            global $konekcija;

            $upit="DELETE FROM proizvodi WHERE idProizvod=:id";
            $slanje=$konekcija->prepare($upit);
            $slanje->bindParam(":id",$id);

                try{
                    $rezultat=$slanje->execute();
                    $code=$rezultat?204:500;
                }
                catch(PDOException $e){
                    $code=409;
                    echo $e->getMessage();
                }
                http_response_code($code);
                header("Location:../../views/admin/admin_proizvodi.php");
        }
    endif;