<?php
    ob_start();
    session_start();
    header("Content-type:application/json");

    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
        header("Content-type:application/json");
        if(isset($_POST['id'])){
            $id=$_POST['id'];
            require_once("../../setup/konekcija.php");
            require_once("functions.php");
            $code=404;
            $data=null;

                try{
                    $data=dohvatiJednuKategoriju($id);
                    $code=200;
                }catch(PDOException $e){
                    $code=500;
                    $data=["greska"=>$e->getMessage()];
                    echo $e->getMessage();
                }
            http_response_code($code);
            echo json_encode($data);
        }
    endif;