<?php 
include_once('functions.php');
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = db_strip($_POST['username']);
    $password = db_strip($_POST['password']);

    #hämtar data från databasen
    $result = db_query("SELECT user_id, username, passwordHash FROM users WHERE username = '$username'");
    $user = mysqli_fetch_assoc($result);

    if(!$user) {
        #fångas upp med javascript och visar för användaren att användarnamnet eller lösenordet är fel
        echo 'error';
    } else {
        #kollar om lösenordet överensstämmer
        $passwordVerify = password_verify($password, $user['passwordHash']);
        if($passwordVerify == $password) {
            #starta session och spara info om användaren i sessionsvariabler
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            echo 'success';
        } else {
            #fångas upp med javascript och visar för användaren att användarnamnet eller lösenordet är fel
            echo 'error';
        }
    }
}
