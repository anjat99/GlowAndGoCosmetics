<?php
    session_start();
    ob_start();
    header("Content-type:application/json");
        if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
            require_once("../../setup/konekcija.php");
            require_once("functions.php");
            $data=null;
            $code=404;

            try{
                $data=dohvatiSveAnkete();
                $code=200;
            }catch(PDOException $e){
                $code=500;
                $data=["greska"=>$e->getMessage()];
                echo $e->getMessage();
            }
           
        endif;
        echo json_encode($data);
        http_response_code($code);