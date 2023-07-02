<?php
include("config.php");
if(isset($_GET["user_id"])){
    extract($_GET);
    try{
        $reqdel=$conn->prepare("DELETE FROM users WHERE user_id= :id");
        $r=$reqdel->execute([":id"=>$id]);
        if($r) header("Location: tableUser.php");

    }catch(PDOException $ex){
        die("Erreur de suppression :".$ex->getMessage());
    }
}






?>