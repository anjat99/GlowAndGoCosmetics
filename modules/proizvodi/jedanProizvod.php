<?php
    session_start();
    ob_start();
    header("Content-type:application/json");

    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
        if(isset($_POST['id'])){
            $id=$_POST['id'];
            require_once("../../setup/konekcija.php");
            require_once("functions.php");
            $code=404;
            $data=null;
                try {
                    $data=dohvatiJedanProizvod($id);
                    $code=200;
                }catch (PDOException $e) {
                    $code=500;
                    $data=["greska"=>$e->getMessage()];
                    echo $e->getMessage();
                }
            http_response_code($code);
            echo json_encode($data);
        }
  endif;
?>
