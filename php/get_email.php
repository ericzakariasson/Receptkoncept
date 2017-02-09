<?php 
	session_start();
	include_once('functions.php');
	#hämtar e-post från databas
	$result = db_query("SELECT email FROM users WHERE user_id = '$_SESSION[user_id]'");
	if ($result == false) {
        echo 'error';
    }
	$email = mysqli_fetch_assoc($result);
	#skriver ut e-post
	echo $email['email'];
