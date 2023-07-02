<?php 
include("config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   extract($_POST);
   if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
       $error[] = "Invalid Email";
   }
   if (preg_match("/^[A-Z]/", $password) == false) {
       $error[] = "Password must start with an uppercase letter";
   }
   if (!isset($email) || empty($email)) {
       $error[] = "Email is empty";
   }
   if (!isset($password) || empty($password)) {
       $error[] = "Password is empty";
   }
   if (empty($error)) {
       try {
           $stmt = $conn->prepare("SELECT * FROM users WHERE user_email=? AND user_password =?");
           $stmt->execute([$email, $password]);
           $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
           $count = count($rows);

           if ($count == 1) {
               session_start();
               $_SESSION["id_utilisateur"] = $rows[0]["user_id"];

               // Creation of the cookie
               if (isset($rbm)) {
                   setcookie("email", $email, time() + 30 * 24 * 60 * 60);
                   setcookie("motpasse", $password, time() + 30 * 24 * 60 * 60);
               }
               header("Location: ../accueil.php");
               exit();
           } else {
               $error[] = 'Incorrect email or password!';
               header("Location: login.php?msg=" . urlencode(serialize($error)));
               exit();
           }
       } catch (Exception $e) {
           die("Erreur de sélection : " . $e->getMessage());
       }
   } else {
      header("Location: login.php?msg=" . urlencode(serialize($error)));   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page </title>
    <link rel="stylesheet" href="login.css">
   <!-- Bootstrap Css link  -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
   integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/css/ionicons.min.css">
</head>
<body>

      <!--   Traduction     -->
    <div class="gtranslate_wrapper"></div>
<script>window.gtranslateSettings = {"default_language":"en","native_language_names":true,"detect_browser_language":true,"languages":["en","fr","es","ar"],"wrapper_selector":".gtranslate_wrapper","flag_style":"3d"}</script>
<script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>
    <!--       -->

    <section style=" background: rgb(252, 243, 162);">
        <header class="container">
         <!--  LOGO  -->
            <div>
               <a href="../accueil.php">
               <img src="logo.png" alt="" class="logo">
               </a>
           
            </div>

         <!--  ICON DARK MODE -->
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
         <!--  FORMULAIRE  -->
            <div class="form-container">
                <form  method="post">
                     <h3>login now</h3>
                           <?php
                            if (isset($_GET['msg'])) {
                              $error = unserialize(urldecode($_GET['msg']));
                              if ($error === false) {
                                  // Handle the error condition
                                  echo "Error occurred while unserializing the data.";
                              } else {
                                  // Process the unserialized data
                                  foreach ($error as $errorMsg) {
                                      echo '<span class="error-msg">' . $errorMsg . '</span>';
                                  }
                              }
                          }
                             
                              
                           /*
                              if(isset($error)){
                                 foreach($error as $error){
                                    echo '<span class="error-msg">'.$error.'</span>';
                                 };
                              }; */     
                           ?>
         <input type="email" name="email" required placeholder="enter your email" value="<?php if (isset($_COOKIE['email'])) echo $_COOKIE['email']; ?>">
         <input type="password" name="password" required placeholder="enter your password" value="<?php if (isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>">
         <input type="submit" name="submit" value="login now" class="form-btn">         
         <div class="form-row">
               <input type="checkbox" name="rbm" id="remember">
               <label for="remember">Remember Me</label>
         </div>
         <p>don't have an account? <a href="register.php"> register now</a></p>
         </form>
            </div>
            
            <!--  Picture Login  -->
            <div class="img">
                <img src="loginMobile.png" alt="login picture">
            </div>
        </div>
      
    </section>
</body>
</html>