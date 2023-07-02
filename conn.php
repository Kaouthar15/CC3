<?php 
try
{
    $con = new PDO('mysql:host=localhost;dbname=project',"root","");
}
catch(PDOException $e)
{
    die("Erreur de la connection à la base de données".$e->getMessage());
}

?>