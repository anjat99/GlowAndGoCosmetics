
<?php
    session_start();
    ob_start();
    $code=404;
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
        if(isset($_POST['id'])){
            $id=$_POST['id'];
       
            require_once("../../setup/konekcija.php");
            
            global $konekcija;

            $upit="DELETE FROM detalji_kupovine WHERE kupovina_id=:id";
            $slanje=$konekcija->prepare($upit);
            $slanje->bindParam(":id",$id);

                try{
                    $rezultat=$slanje->execute();
                    $code=$rezultat?204:500;
                    header("Location:../../views/admin/admin_orders.php");
                }
                catch(PDOException $e){
                    $code=409;
                    echo $e->getMessage();
                }
               
        }
        http_response_code($code);
        
    endif;