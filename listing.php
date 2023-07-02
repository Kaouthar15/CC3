<?php
require("conn.php");
$searchQuery = $_POST['searchQuery']; 


//$query = "SELECT * FROM services WHERE service_name LIKE '%$searchQuery%'";

try {
    // Construct the database query
    $query = "SELECT * FROM services WHERE service_name LIKE :searchQuery";

    // Prepare the SQL statement
    $stmt = $con->prepare($query);

    // Bind the search query parameter
    $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');

    // Execute the query
    $stmt->execute();

    // Fetch all rows as an associative array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Handle errors gracefully
    echo "Error: " . $e->getMessage();
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorie Page </title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/styleListing.css">
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
    <!-- 
    - favicon
  -->
    <link rel="shortcut icon" href="favicon.svg" type="image/svg+xml">
    <!-- 
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
        <style>
            #stars{display:flex; margin-left:10px;}
            .star {
            font-size: 34px;
            color: gray;
             cursor: pointer;
                }

            .star:hover,
            .star.selected {
            color: orange;
            }
        </style>
</head>

<body>
    <header class="header" data-header>

        <div class="overlay" data-overlay></div>




        <!--   Traduction     -->
        <div class="gtranslate_wrapper"></div>
        <script>window.gtranslateSettings = { "default_language": "en", "native_language_names": true, "detect_browser_language": true, "languages": ["en", "fr", "es", "ar"], "wrapper_selector": ".gtranslate_wrapper", "flag_style": "3d" }</script>
        <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>
        <!--       -->


        <div class="header-bottom">
            <div class="container">

                <a href="accueil.php" class="logo">
                    <img src="images/logo.png" alt="BeenYeedik logo" width="150px">
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

                    <button class="header-bottom-actions-btn" aria-label="Profile">
                        <ion-icon name="person-outline"></ion-icon>

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

    <?php
        if (count($result) > 0) {
            foreach ($result as $row) {
    ?>
    <div class="container">
        <div class="list-container">
            <div class="left-col">
                <div class='house'>
                    <div class='house-img'>
                        <a href='accueil.php'><img src='<?php echo $row['pictures']; ?>'></a>
                    </div>
                    <div class='house-info'>
                        <p><?php echo $row['category_id']; ?></p>
                        <h3><?php echo $row['service_name']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                        <div id='stars'>
                            <span class='star' onclick='rateStar(1)'>&#9734;</span>
                            <span class='star' onclick='rateStar(2)'>&#9734;</span>
                            <span class='star' onclick='rateStar(3)'>&#9734;</span>
                            <span class='star' onclick='rateStar(4)'>&#9734;</span>
                            <span class='star' onclick='rateStar(5)'>&#9734;</span>
                        </div>
                        <script>
                            let selectedStars = 0;

                            function rateStar(stars) {
                            selectedStars = stars;

                            const starElements = document.getElementsByClassName('star');
                            for (let i = 0; i < starElements.length; i++) {
                                if (i < stars) {
                                starElements[i].classList.add('selected');
                                } else {
                                starElements[i].classList.remove('selected');
                                }
                            }


                            }
                        </script>
                        <div class='house-price'>
                            <p><?php echo $row['price']; ?></p>
                            <h4><?php echo $row['availability']; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
            }
        } else {
    ?>
           <div class='notDiv' style=" width: 100%;padding: 20px;display: flex;justify-content: center;align-items: center;
    height:85vh;background-color: grey;color: white;">
                <h1 class='notF' style="font-size:70px ;">Service Not Found</h1>
          </div>
     <?php   }
    ?>

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
