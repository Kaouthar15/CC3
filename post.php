<?php 
session_start();
if (!isset($_SESSION) || empty($_SESSION))
{
    header('location:./login system/login.php');
}
else
{
require("conn.php");
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    extract($_POST);
    if (isset($s_name) && !empty($s_name)
    && isset($desc) && !empty($desc)
    && isset($loca) && !empty($loca)
    && isset($pri) && !empty($pri)
    && isset($id_s) && !empty($id_s)
    && isset($avail) && !empty($avail))
    {
        if (isset($_FILES) && $_FILES["img"]["error"]==0)
        {
            $type = $_FILES['img']['type'];
            $test = ['image/png','image/jpeg','image/tiff','image/jpg','image/gif','image/jfif'];
            if (in_array($type,$test))
            {
                if ($_FILES['img']['size'] < 40000000)
                {
                    move_uploaded_file($_FILES['img']['tmp_name'],"./image/".$_FILES['img']['name']);
                    try
                    {
                        $rs = $con -> prepare("INSERT INTO services(user_id,category_id,service_name,description,location,price,availability,pictures)
                                                VALUES (?,?,?,?,?,?,?,?)");
                        $rs -> execute([$_SESSION['user_id'],$service_id,$s_name,$desc,$loca,$pri,$avail,".\\images\\".$_FILES['img']['name']]);
                        if ($rs)
                        {
                            header("location:listing.php");
                        }
                        else
                        {
                            header("Location: post.php?msg=Service non inséré.");
                        }
                    }
                    catch(PDOException $e)
                    {
                        die($e->getMessage());
                    }
                }
                else
                {
                    header("Location:post.php?msg=L'image dépasse 40Mo");
                }
            }
            else
            {
                header("Location:post.php?msg=Il faut téléchager une image non pas un fichier.");
            }
        }
    }
    else
    {
        header("location:post.php?msg=Veuillez remplir tous les champs.");
    }
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>POST a service</title>
    <link rel="stylesheet" href="./css/styleP.css">
    
</head>
<body>

            
               <button   class="header-bottom-actions-btn" aria-label="Cart" id="searchbtn">
                  <ion-icon name="moon-outline" id="dark"></ion-icon>
               </button>
               <!-- Dark  Mode script -->
          <script>
            var  divv=document.getElementById('searchbtn');
            var  icon=document.getElementById('dark');
            divv.onclick=function () {
    
            document.body.classList.toggle("dark-theme");
            if(document.body.classList.contains("dark-theme")){
              icon.setAttribute("name", "sunny-outline");
                  if(icon.classList.contains("moon-outline")){
                    icon.setAttribute("name", "sunny-outline");
                }
            }else{  
              icon.setAttribute("name", "moon-outline");
               }; 
            };
         </script>
        
    <form method="POST" enctype='multipart/form-data'>
    <a href="accueil.php">
                <img src="images/logo.png" class="logo" alt="Homeverse logo">
            </a>
    <div class="err"><p align="center" ><b><?php if (isset($_GET['msg'])) echo $_GET["msg"]?></b></p></div>

        <input type="text" id="service-name" name="s_name"  placeholder="Service name">
        
        <textarea id="description" name="desc" placeholder="Description"></textarea>
        
        <input type="text" id="location" name="loca" placeholder="Location">
        
        <input type="number" id="price" name="pri" placeholder='Price'>
 
        <label for="availability">Catégorie: </label>
        <select id="availability" name="id_s">
            <option value="santé">1</option>
            <option value="transport">2</option>
            <option value="éducation">3</option>
            <option value="coiffure">4</option>
            <option value="alimentation">5</option>
            <option value="sport">6</option>    
        </select>

        <label for="availability">Availability:</label> 
        <select id="availability" name="avail">
            <option value="disponible">Disponible</option>
            <option value="indisponible">Indisponible</option>
        </select>
        
        <label for="pictures">Pictures:</label>
        <input type="file" id="pictures" name="img">
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
