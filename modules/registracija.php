<?php
 require_once("../setup/konekcija.php");
 $code=404;
 $data=null;

    if(isset($_POST['send'])){
            $ime=$_POST['ime'];
            $prezime=$_POST['prezime'];
            $email=$_POST['email'];
            $lozinka=$_POST['lozinka'];

            $greske=[];
            
            $reIme = "/^[A-Z][a-z]{2,29}(\s[A-Z][a-z]{2,29})*$/";
            $rePrezime = "/^[A-Z][a-z]{2,49}(\s[A-Z][a-z]{2,49})*$/";
            $reEmail = "/^[a-z]{3,}(\.)?[a-z\d]{1,}(\.[a-z0-9]{1,})*\@[a-z]{2,7}\.[a-z]{2,3}(\.[a-z]{2,3})?$/";
            $reLozinka = "/^\S{5,50}$/";


            if(!preg_match($reIme, $ime)){
                $greske[] =  "Ime nije u dobrom formatu";
            }
               
            if(!preg_match($rePrezime, $prezime)){
                $greske[] =  "Prezime nije u dobrom formatu";
            }
               
            if(!preg_match($reEmail, $email)){
                $greske[] =  "Email nije u dobrom formatu";
            }

            if(!preg_match($reLozinka, $lozinka)){
                $greske[] =  "Lozinka nije u dobrom formatu";
            }

            if(count($greske)){
                $data=$greske;
                $code=422;
            }
            else{
                $upit="INSERT INTO korisnici(ime, prezime, email, lozinka, uloga_id) VALUES(:ime, :prezime, :email, :lozinka, 2)";
                $izvrsi=$konekcija->prepare($upit);
                $izvrsi->bindParam(":ime",$ime);
                $izvrsi->bindParam(":prezime",$prezime);
                $izvrsi->bindParam(":email",$email);
    
                $lozinka = md5($lozinka);
                $izvrsi->bindParam(":lozinka",$lozinka);
              
                try{
                    $code = $izvrsi->execute() ? 202 : 500; 
                    header("Location: ../index.php?page=login");
                }catch(PDOException $e){
                    $code = 409;
                    echo $e->getMessage();
                }
                // echo "Nema gresaka i uspesan upis";
            }  
    }

    http_response_code($code);
?>



      
