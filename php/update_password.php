<?php
    session_start();
    include_once('functions.php');
    if (isset($_POST['updatedPassword'])) {
        $updatedPassword = db_strip($_POST['updatedPassword']);
        $confirmPassword = db_strip($_POST['confirmPassword']);

        #bekräfta nytt lösenord genom att skriva i ditt gamla
        $password = db_query("SELECT passwordHash FROM users WHERE user_id = '$_SESSION[user_id]'");
        $password = mysqli_fetch_assoc($password);
        $passwordVerify = password_verify($confirmPassword, $password['passwordHash']);

        #om det stämmer
        if ($confirmPassword == $passwordVerify) {
            #kryptera
            $ePassword = password_hash($updatedPassword, PASSWORD_BCRYPT);
            $result = db_query("UPDATE users SET passwordHash = '$ePassword' WHERE user_id = '$_SESSION[user_id]'");
            if ($result == false) {
                echo "Ett fel uppstod. Försök igen senare.";
            }
        } else {
            #skriv ut error som ajax plockar upp och visar ett felmeddelande
            echo 'error';
        }
    }
