<?php
    session_start();
    ob_start();
    require_once("../../setup/konekcija.php");
    require_once("functions.php");
    header("Content-type:application/json");
    $data=null;
    $code=404;


    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
        if(isset($_POST['id'])){
            $id=$_POST['id'];
          
          
            try{
                $data=sviDPJednaPorudzbina($id);
                $code=200;
            }
            catch(PDOException $e){
                $code=500;
                $data=["greska"=>$e->getMessage()];
                echo $e->getMessage();
            }
        }
        echo json_encode($data);
        http_response_code($code);
endif;