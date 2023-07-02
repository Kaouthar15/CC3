
<?php

try{
    $conn=new PDO("mysql:host=localhost;dbname=project",'root','');
}catch(PDOException $e)
{
    die('message erreur'.$e->getMessage());
}


?>