
<?php
include 'config.php';

if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];

   try {
      $select = "SELECT * FROM users WHERE user_email = :email AND user_password = :password";
      $stmt = $conn->prepare($select);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $pass);
      $stmt->execute();

      if($stmt->rowCount() > 0){
         $error[] = 'User already exists!';
      } else {
         if($pass != $cpass){
            $error[] = 'Passwords do not match!';
         } else {
            $insert = "INSERT INTO users (user_name, user_email, user_password) VALUES (:name, :email, :password)";
            $stmt = $conn->prepare($insert);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $pass);
            $stmt->execute();
            header('location: login.php');
         }
      }
   } catch(PDOException $e) {
      die("Error: " . $e->getMessage());
   }
}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="login.css">
   <!-- Bootstrap Css link  -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
   integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

      <!--   Traduction     -->
    <div class="gtranslate_wrapper"></div>
<script>window.gtranslateSettings = {"default_language":"en","native_language_names":true,"detect_browser_language":true,"languages":["en","fr","es","ar"],"wrapper_selector":".gtranslate_wrapper","flag_style":"3d"}</script>
<script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>
    <!--       -->
    
    <section style=" background: rgb(252, 243, 162);">
    <header class="container">
            <div>
            <a href="../accueil.php">
               <img src="logo.png" alt="" class="logo">
               </a>
            </div>

            <div>
            <button class="header-bottom-actions-btn" aria-label="Cart" id="searchbtn">
            <ion-icon name="moon-outline" id="dark"></ion-icon>
            </button>
            </div>
           

         
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
        </header>
        <div class="content">
                <div class="form-container">
                <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>
                </div>
                <div class="img">
                <img src="loginMobile.png" alt="login picture">
                </div>
        </div>
    </section>
</body>
</html>