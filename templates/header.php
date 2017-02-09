<!DOCTYPE html>
<html>
<head>
	<title>Receptkoncept</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/mustache.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
	<header>
        <section id="titleContainer">
            <div class="hc" id="logoContainer">
                <a href="index.php">
                    <h1 class="vc">Receptkoncept</h1>
                    <img class="vc" src="img/logo.svg" alt="logo">
                </a>
            </div>
        </section>
        <input id="searchRecipe" class="vc" placeholder="Sök bland tusentals mustiga recept">
        <?php
            #om användren är inloggad
            if (isset($_SESSION['user_id'])) {
                include_once('user/navLoggedIn.php');
                include_once('user/updateEmail.php');
                include_once('user/updatePassword.php');
            #om användaren inte är inloggad
            } else {
                include_once('user/nav.php');
                include_once('user/login.php');
                include_once('user/register.php');
            }
        ?>
    </header>
