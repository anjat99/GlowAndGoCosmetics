<?php
 ob_start();
 session_start();
        if(isset($_POST['btnLogin'])){
            $email=$_POST['tbEmail'];
            $lozinka=$_POST['tbLozinka'];
            $reEmail = "/^[a-z]{3,}(\.)?[a-z\d]{1,}(\.[a-z0-9]{1,})*\@[a-z]{2,7}\.[a-z]{2,3}(\.[a-z]{2,3})?$/";
            $reLozinka = "/^\S{5,50}$/";

            $greske=[];

            if(!preg_match($reLozinka,$lozinka)){
                $greske[]="Lozinka ne valja";
            }
            if(!preg_match($reEmail, $email)){
                $greske[] =  "Email ne valja";
            }

            if(count($greske)>0){
                $_SESSION['greske']="Neispravni email ili lozinka";
                header("Location:../index.php?page=login");
            }else{
                require_once("../setup/konekcija.php");
                $lozinka=md5($lozinka);

                $upit="SELECT k.*, u.naziv FROM korisnici k INNER JOIN uloge u on k.uloga_id=u.idUloga where k.email=:email AND k.lozinka=:lozinka";
                $slanje=$konekcija->prepare($upit);
                $slanje->bindParam(":email",$email);
                $slanje->bindParam(":lozinka",$lozinka);
                $slanje->execute();

                if($slanje->rowCount()==1){
                    $rezultat=$slanje->fetch();
                    $_SESSION['korisnik']=$rezultat;
                    if($rezultat->naziv=="korisnik"){
                        header("Location:../index.php?page=korisnik");
                    }else if($rezultat->naziv=="admin"){
                        header("Location:../views/admin.php");
                    }
                }else{
                        $_SESSION['greske']="Pogrešan password/email";
                        header("Location:../index.php?page=login");
                }
                
            }
        }