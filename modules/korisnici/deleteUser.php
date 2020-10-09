<?php
    session_start();

    $code=404;

    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
        if(isset($_POST['id'])){
        $id=$_POST['id'];
        
        require_once("../../setup/konekcija.php");
        require_once("functions.php");
            try{
                if(brisanjeKorisnika($id)){
                    $code=204;
                }
                else{
                    $code=500;
                }
            }
            catch(PDOException $e){
                $code=409;
                echo $e->getMessage();
            }
        http_response_code($code);
        }
endif;
