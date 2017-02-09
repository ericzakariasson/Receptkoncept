<?php 
    include_once('functions.php');
    $username = db_strip($_POST['username']);
    $email = db_strip($_POST['email']);
    $password = db_strip($_POST['password']);
    $password2 = db_strip($_POST['password2']);

    #kryptera lösenord
    $ePassword = password_hash($password, PASSWORD_BCRYPT);
    #spara användardata till databasen
    $registration = db_query("INSERT INTO users (username, email, passwordhash) VALUES ('$username', '$email', '$ePassword')");
    if ($registration == false) {
        echo 'error';
    } else {
        #hämta data om den nyligen registrerade användaren för den ska slippa logga in efter den har registrerat sig
        $result = db_query("SELECT user_id, username FROM users WHERE username = '$username'");
        if ($result == false) {
            echo 'error';
        } else {
            $user = mysqli_fetch_assoc($result);
            session_start();
            #användaren blir inloggad direkt
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            #skriver ut ett meddelande att registrering lyckades. ajax plockar upp och laddar om sidan.
            echo 'success';
        }
    }
