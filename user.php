<?php
require_once("requests.php");

$x = $_GET["userid"];
$usercontent = getUser($x);

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">



    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instameme</title>
</head>

<body>
    <header>
        <div id="navbar-left">
            <a href="index.php"><img src="img/logo_dark.png" id="logo"></a>
            <a href="index.php" home"> Accueil </a>
        </div>
        <div id="center">
            <form id="search" method="post">
                <input id="searchbar" type="text" placeholder="Rechercher" name="searchresult">
                <input type="hidden" name="memeid" value="<?= $_GET["userid"]; ?>">
                <button id="searchbutton">🔍</button>
            </form>
        </div>
        <div id="navbar-right">
            <?php if (!isset($_SESSION["sid"])) { ?>
                <a href="signup.php" id="post"> Inscription </a>
                <a href="signin.php" id="profile"> Connexion </a>
            <?php } else { ?>
                <a href="post.php" id="post"> Créer </a>
                <a href="user.php?userid=<?= $_SESSION["id"] ?>" id="profile"> Profil </a>
                <a href="signout.php" id="logout"> Déconnexion </a>
            <?php } ?>
        </div>
    </header>

    <div id="content">

        <?php foreach ($usercontent as $content) { ?>
            <article class="card flipped">
                <a href="meme.php?memeid=<?= $content["idm"] ?>"><img class="meme" src="memes/<?= $content["chemin_image"] ?>"></a>
                <div class="card-bottom">
                    <div class="actions">
                        <span class="like<?php if (!canLike($content["id"])) { ?>d<?php } ?>"><a disabled <?php if (canLike($content["id"])) { ?>href="like.php?likeid=<?= $content["id"] ?>" <?php } ?>>Aimer</a></span>
                        <span class="repost"><a href="post.php">Reposter</a></span>
                    </div>
                </div>
            </article>
        <?php } ?>

    </div>

</body>

</html>