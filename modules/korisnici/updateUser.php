<?php
 session_start();

    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
        if(isset($_POST['btnIzmena'])){
        require_once("../../setup/konekcija.php");
    
        $ime=$_POST['tbIme'];
        $prezime=$_POST['tbPrezime'];
        $email=$_POST['tbEmail'];
        $uloga=$_POST['ddlUloga'];
        $id = $_POST['skrivenoPolje'];
        $greske=[];
        $reimeprez="/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,20})*$/";
        $reuser="/^[\d\w\_\-\.@]{4,30}$/";

        if($uloga==0){
            array_push($greske, "Niste uneli ulogu korisnika");
        }
        if(!preg_match($reimeprez, $ime)){
            array_push($greske, "Ime nije u dobrom formatu");
        }

        if(!preg_match($reimeprez, $prezime)){
            array_push($greske, "Prezime nije u dobrom formatu");
        }

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
             array_push($greske, "Email nije u dobrom formatu");
        }

        if(count($greske)){
            $_SESSION['poruka']="Niste ispravno uneli sve podatke";
        }else{
                global $konekcija;
                $upit="UPDATE korisnici SET ime=:ime, prezime=:prezime, email=:email, uloga_id=:uloga_id WHERE idKorisnik=$id";
                $salji=$konekcija->prepare($upit);
                $salji->bindParam(":ime",$ime);
                $salji->bindParam(":prezime",$prezime);
                $salji->bindParam(":email",$email);
                $salji->bindParam(":uloga_id",$uloga);

                try{
                    $uspelo = $salji->execute();
                    if($uspelo){
                       $_SESSION['poruka']="Korisnik je uspešno izmenjen";
                    }else{
                        echo "nije uspelo";
                    }
                    
                }catch(PDOException $e){
                    echo $e->getMessage();
                    $_SESSION['poruka']="Greška, korisnik nije izmenjen";
;                }
           
        }
        header("Location:../../views/admin/admin_users.php");
    }
    endif;