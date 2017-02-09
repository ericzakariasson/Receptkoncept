<?php 
    session_start();
    include_once('functions.php');
    #om användaren är inloggad
    if(isset($_SESSION['user_id'])) {
        #hämtar ingredienser som användaren lagrat
        $result = db_query("SELECT ingredient_name, ingredients.ingredient_id FROM ingredients JOIN user_ingredients ON user_ingredients.ingredient_id = ingredients.ingredient_id WHERE user_id = '$_SESSION[user_id]'");
        if ($result == false) {
            echo 'error';
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = array('id' => $row['ingredient_id'], 'name' => $row['ingredient_name']);
        }
        echo json_encode($array);
    #om användren inte är inloggad används sessionsvariablen om den finns
    } elseif (isset($_SESSION['user_ingredients'])) {
        echo json_encode($_SESSION['user_ingredients']);
    }