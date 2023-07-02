<?php

session_start();
if (!isset($_SESSION) || empty($_SESSION)) {
    header('location:login.php');
} else {
    $err = '';
    include 'config.php';
    if (isset($_SESSION['user_id'])) {
        $rs = $con->prepare('SELECT * FROM users WHERE user_id = ?');
        $rs->execute([$_SESSION['user_id']]);
        $p = $rs->fetchAll();
        print_r($p);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (
            isset($old_pass) &&
            !empty($old_pass) &&
            password_verify($old_pass, $p[0]['user_password'])
        ) {
            if (isset($_FILES) && $_FILES['img']['error'] == 0) {
                $type = $_FILES['img']['type'];
                $test = [
                    'image/png',
                    'image/jpeg',
                    'image/tiff',
                    'image/jpg',
                    'image/gif',
                    'image/jfif',
                ];
                if (in_array($type, $test)) {
                    if ($_FILES['img']['size'] < 40000000) {
                        move_uploaded_file(
                            $_FILES['img']['tmp_name'],
                            './image/' . $_FILES['img']['name']
                        );
                        try {
                            $rup = $con->prepare(
                                'UPDATE users SET user_name = ? , user_email = ? , user_password = ?, profil_picture = ? WHERE user_id = ?'
                            );
                            $rup->execute([
                                $update_name,
                                $update_email,
                                $confirm_pass,
                                '.\\image\\' . $_FILES['img']['name'],
                                $_SESSION["user_id"]
                            ]);
                        } catch (PDOException $e) {
                            die(
                                'Problème dans la mise à jour dans la base de données' .
                                    $e->getMessage()
                            );
                        }
                    } else {
                        header("Location:update.php?msg=L'image dépasse 40Mo");
                    }
                }
            }
            if (
                isset($new_pass) &&
                !empty($new_pass) &&
                isset($confirm_pass) &&
                !empty($confirm_pass)
            ) {
                if ($new_pass === $confirm_pass) {
                } else {
                    header(
                        "Location:update.php?msg=La confirmation du mot de passe n'est pas correcte."
                    );
                }
            }
            else
            {
              header(
                "Location:update.php?msg=Veuillez remplir les champs du code et de confirmation."
            );
            }
        } else {
            header(
                "location: update.php?msg=Veuillez saisir l'ancien mot de passe pour que vous puisse faire des changements"
            );
        }
    }
}
?>
<html>
  <head>
    <meta charset="UTF-8" /> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>update profile</title>
    <!-- <link rel="shortcut icon" href="favicon.svg" type="image/svg+xml"> -->

    <!-- custom css file link  -->
    <link rel="stylesheet" href="styleUpdate.css" />
  </head>
  <body>


 <!-- main -->
    <div class="update-profile">
      <form method="post" enctype="multipart/form-data">

        <img src="./image/profile1.jpg"/>
        <div class="message">
    <span><?php if (isset($_GET['msg'])) {
        echo $_GET['msg'];
    } ?></span>
  </div>
        <div class="flex">
          <div class="inputBox">
            <span>username :</span>
            <input type="text" name="update_name" class="box" value="<?php if (
                isset($p[0]['user_name'])
            ) {
                echo $p[0]['user_name'];
            } ?>"/>
            <span>your email :</span>
            <input type="email" name="update_email" class="box" value="<?php if (
                isset($p[0]['user_email'])
            ) {
                echo $p[0]['user_email'];
            } ?>"/>
            <span>update your pic :</span>
            <input type="file" name="update_image" class="box" />
          </div>
          <div class="inputBox">
            <span>old password :</span>
            <input type="password" name="old_pass" placeholder="enter previous password" class="box"/>
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box"/>
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box"/>
          </div>
        </div>
        <input type="submit" value="update profile" name="update_profile" class="btn"/>
        <a href="" class="delete-btn">go back</a>
      </form>
    </div>
  </body>
</html>
