<?php
    session_start();
    ob_start();
    require_once("../../setup/konekcija.php");
    require_once("functions.php");
    header("Content-type:application/json");
    $code=404;
    $data=null;

        if(isset($_POST['send'])){
            $id=$_POST['id'];
            $prod=$_POST['prod'];
            $trenutno = time();
            $datum=date("Y-m-d H:i:s", $trenutno);
           
            $upit1 = "INSERT INTO kupovina VALUES (NULL,:datum,:idDK)";
            $rez1 = $konekcija->prepare($upit1);
            $rez1->bindParam(":datum", $datum);
            $rez1->bindParam(":idDK", $id);
            
            try{
                $konekcija->beginTransaction();
                $rez1->execute();
                $lastIdKup = $konekcija->lastInsertId();
                $konekcija->commit();
                http_response_code(201);
            }
            catch(PDOException $e){
                $konekcija->rollback();
                echo $e->getMessage();
                http_response_code(500);
            }
            $upit2 = "INSERT INTO detalji_kupovine (kolicina_proizvoda, proizvod_id, kupovina_id) VALUES";
            foreach($prod as $p){
                $detaljiPorValues[] = '('.$p['kolicina'].','.$p['id'].','.$lastIdKup.')';
            }
            $upit2 .= implode(',',$detaljiPorValues);
            
            try{
                $konekcija->beginTransaction();
                $konekcija->exec($upit2);
                $konekcija->commit();
                http_response_code(201);
            }
            catch(PDOException $e){
                $konekcija->rollback();
                echo $e->getMessage();
                http_response_code(500);
            }
           }
                
             else{
                $code = 500;
            }
        
       
        echo json_encode($data);

?>