<?php
    session_start();
    ob_start();
    require_once("../../setup/konekcija.php");
    require_once("functions.php");
    $data=null;
    $code=404;
    header("Content-type:application/json");

    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
    

        try{
            $data=svePorudzbine();
            // var_dump($data);
            $code=201;
        }
        catch(PDOException $e){
            $code=500;
            $data=["greska"=>$e->getMessage()];
            echo $e->getMessage();
        }
 echo json_encode($data);
 http_response_code($code);
endif;