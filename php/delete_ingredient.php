<?php
session_start();
include_once('functions.php');
if (isset($_POST['id'])) {
    $id = db_strip($_POST['id']);
    #om inloggad
    if (isset($_SESSION['user_id'])) {
        #ta bort från databasen
        $result = db_query("DELETE FROM user_ingredients WHERE user_id = '$_SESSION[user_id]' AND ingredient_id = '$id'");
        if ($result == false) {
            echo 'error';
        }
    #om inte inloggad
    } else {
        #hitta elementet i array med samma id som ska tas bort
        $pos = array_search($id, array_column($_SESSION['user_ingredients'], 'id'));
        #ta bort från array
        unset($_SESSION['user_ingredients'][$pos]);
        #indexera array rätt igen
        $_SESSION['user_ingredients'] = array_values($_SESSION['user_ingredients']);
    }
}
