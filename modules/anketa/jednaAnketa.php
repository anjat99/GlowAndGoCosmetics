<?php
    ob_start();
    header("Content-type:application/json");
    $code=404;
    $data=null;
        if(isset($_POST['send'])){
            require_once("../../setup/konekcija.php");
            require_once("functions.php");
            $id=$_POST['id'];
           
            try{
            $data=rezultatJedneAnkete($id);
            $code=200;
            }catch(PDOException $e){
                $code=500;
                $data=["greska"=>$e->getMessage()];
                echo $e->getMessage();
            }
        }
    echo json_encode($data);
    http_response_code($code);