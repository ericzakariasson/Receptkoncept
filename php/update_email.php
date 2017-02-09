<?php 
	session_start();
	include_once('functions.php');
	$newEmail = $_POST['email'];
	#uppdatera email för inloggad användare
	$result = db_query("UPDATE users SET email = '$newEmail' WHERE user_id = '$_SESSION[user_id]'");
    if ($result == false) {
        echo "Ett fel uppstod. Försök igen senare.";
    }
