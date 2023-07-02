<?php 
require("conn.php");
try
{
  $rs = $con -> query("SELECT * FROM categories");
  $p = $rs -> fetchAll();
}
catch(PDOException $r)
{
  die("Erreur à la connction".$r->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BEENYEDDIK</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet">
</head>

<body>

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>

    <div class="overlay" data-overlay></div>

    <div class="header-top">

      </div>
    </div>
    <!--   Traduction     -->
    <div class="gtranslate_wrapper"></div>
    <script>window.gtranslateSettings = { "default_language": "en", "native_language_names": true, "detect_browser_language": true, "languages": ["en", "fr", "es", "ar"], "wrapper_selector": ".gtranslate_wrapper", "flag_style": "3d" }</script>
    <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>
    <!--       -->


    <div class="header-bottom">
      <div class="container">

        <a href="accueil.php" class="logo">
          <img src="images/logo.png" alt="BeenYeedik logo" width="120px">
        </a>

        <nav class="navbar" data-navbar>

          <div class="navbar-top">

            <a href="#" class="logo">
              <img src="images/logo.png" alt="Homeverse logo">
            </a>

            <button class="nav-close-btn" data-nav-close-btn aria-label="Close Menu">
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </div>


        </nav>

        <div class="header-bottom-actions">

          

          <button class="header-bottom-actions-btn" aria-label="Cart" id="searchbtn">
            <ion-icon name="moon-outline" id="dark"></ion-icon>
          </button>
          <!-- Dark  Mode script -->
          <script>
            var divv = document.getElementById('searchbtn');
            var icon = document.getElementById('dark');
            divv.onclick = function () {

              document.body.classList.toggle("dark-theme");
              if (document.body.classList.contains("dark-theme")) {
                icon.setAttribute("name", "sunny-outline");
                if (icon.classList.contains("moon-outline")) {
                  icon.setAttribute("name", "sunny-outline");
                }
              } else {
                icon.setAttribute("name", "moon-outline");
              };
            };
          </script>

          <a href="login system/login.php">
              <button class="header-bottom-actions-btn" aria-label="Profile">
              <ion-icon name="person-outline"></ion-icon>
          </a>

            <span>Profile</span>
          </button>



          <button class="header-bottom-actions-btn" data-nav-open-btn aria-label="Open Menu">
            <ion-icon name="menu-outline"></ion-icon>

            <span>Menu</span>
          </button>

        </div>

      </div>
    </div>

  </header>





  <main>
    <article>

      

      <section class="hero" id="home">
        <div id="slider">

          <div class="image-container"></div>
          <img src="./images/san1.jpeg" alt="Image 1">
          <img src="./images/coif1.jpeg" alt="Image 2">
          <img src="./images/tran1.jpeg" alt="Image 3">
          <img src="./images/spo1.jpeg" alt="Image 4">
          <img src="./images/cui1.jpeg" alt="Image 5">
          <div class="content">

            <p class="hero-subtitle">
              <ion-icon name="timer-outline"></ion-icon>

              <span>MultiService Agency</span>
            </p>


            <h2 class="h1 hero-title">Find Your Needs Here </h2>

           

            <div class="hero-search">
              
              <div class="c-hero__cta__post">
                <button class="btn"><a href="post.php">Post a Service - It's Free</a></button>
              </div>
            </div>


          </div>

        </div>

      </section>


      <!-- 
        - #FEATURES
      -->

      <section class="features">
        <div class="container">

          <p class="section-subtitle">Our Services</p>


          <ul class="features-list">
    
                <li>
                <a <?php echo "href='listing.php?id=2'" ?> class="features-card">

                    <div class="card-icon">
                    <ion-icon name="car-sport-outline"></ion-icon>
                    </div>

                    <h3 class="card-title"><?php echo $p[1][1] ;?></h3>

                    <div class="card-btn">
                    <ion-icon name="arrow-forward-outline"></ion-icon>
                    </div>

                </a>
                </li>

            

            <li>
              <a   <?php echo "href='listing.php?id=4'" ?>  class="features-card">

                <div class="card-icon">
                  <ion-icon name="cut-outline"></ion-icon>
                </div>

                <h3 class="card-title"><?php echo $p[3][1] ;?></h3>

                <div class="card-btn">
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>

              </a>
            </li>

            <li>
              <a  <?php echo "href='listing.php?id=1'" ?>  class="features-card">

                <div class="card-icon">
                  <ion-icon name="fitness-outline"></ion-icon>
                </div>

                <h3 class="card-title"><?php echo $p[0][1] ;?></h3>

                <div class="card-btn">
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>

              </a>
            </li>

            <li>
              <a  <?php echo "href='listing.php?id=3'"?>  class="features-card">

                <div class="card-icon">
                  <ion-icon name="library-outline"></ion-icon>
                </div>

                <h3 class="card-title"><?php echo $p[2][1] ;?></h3>

                <div class="card-btn">
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>

              </a>
            </li>

            

            <li>
              <a  <?php echo "href='listing.php?id=5'"?>  class="features-card">

                <div class="card-icon">
                  <ion-icon name="restaurant"></ion-icon>
                </div>

                <h3 class="card-title"><?php echo $p[4][1] ;?></h3>

                <div class="card-btn">
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>

              </a>
            </li>

            <li>
              <a  <?php echo "href='listing.php?id=6'" ?>  class="features-card">

                <div class="card-icon">
                  <ion-icon name="football-outline"></ion-icon>
                </div>

                <h3 class="card-title"><?php echo $p[5][1] ;?></h3>

                <div class="card-btn">
                  <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>

              </a>
            </li>

          </ul>

        </div>
      </section>

  <!-- 
    - custom js link
  -->
  <script src="./js/script2.js"></script>

  <script src="./js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>