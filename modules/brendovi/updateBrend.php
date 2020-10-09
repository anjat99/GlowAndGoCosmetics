<?php
 session_start();

    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
        if(isset($_POST['btnIzmenaBrend'])){
        require_once("../../setup/konekcija.php");
    
        $naziv=$_POST['tbNazivBrend'];
        $id = $_POST['skrivenoPoljeBrend'];
        $greske=[];

        if($naziv==""){
            array_push($greske, "Niste uneli naziv brenda");
        }
        
        if(count($greske)){
            $_SESSION['poruka']="Niste ispravno uneli sve podatke";
        }else{
                global $konekcija;
                $upit="UPDATE brendovi SET naziv=:naziv WHERE idBrend=$id";
                $salji=$konekcija->prepare($upit);
                $salji->bindParam(":naziv",$naziv);

                try{
                    $uspelo = $salji->execute();
                    if($uspelo){
                       $_SESSION['poruka']="Brend je uspešno izmenjen";
                    }else{
                        echo "nije uspelo";
                    }
                    
                }catch(PDOException $e){
                    echo $e->getMessage();
                    $_SESSION['poruka']="Greška, brend nije izmenjen";
;                }
           
        }
        header("Location:../../views/admin/admin_brendovi.php");
    }
    endif;