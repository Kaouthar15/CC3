<?php
include('config.php');
try{

    $rs=$conn->query(" SELECT * FROM users" );
    $donne=$rs->fetchAll();

}catch(PDOException $e)
{
    die('message erreur'.$e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Informations of User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
   integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body style="background:hsl(0, 0%, 93%)">
 <a href="../accueil.php"><img src="logo.png" alt="" width=150 style="margin-left:30px;"></a>
    <br>
    <h1 align=center class="alert alert-warning text-warning"> Informations de Utilisateur</h1>
    <table class="table table-striped w-75 p4 text-center mt-4 container" border=1>
        <tr class="text-danger">
        <th> ID </th>
        <th>NOM</th>
        <th>EMAIL</th>
        <th>PASSWORD</th>
        <th>ACTIONS</th>
        <tr>
        <?php
            foreach ($donne as $v) {
                $id=$v["user_id"];
                echo "<tr>";
                    echo "<td>".  $v["user_id"]  ."</td>" ;
                    echo "<td>". $v["user_name"]."</td>" ;
                    echo "<td>". $v["user_email"]."</td>" ;
                    echo "<td>". $v["user_password"]."</td>" ;
                    echo"<td><a href='supprimer.php?id=$id' class=\"btn btn-danger\">Supprimer </a>
                    <a href='' class=\"btn btn-warning\">Modifier</a></td></tr>";
                echo"</tr>";
            }
        ?>

    </table>
</body>
</html>