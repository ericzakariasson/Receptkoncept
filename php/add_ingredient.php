<?php 
    session_start();
    include_once('functions.php');
    if(isset($_POST['id']) && isset($_POST['name'])) {
        $id = db_strip($_POST['id']);
        $name = db_strip($_POST['name']);

        #om användaren är inloggad
        if(isset($_SESSION['user_id'])) {
            #spara till databasen
            $result = db_query("INSERT INTO user_ingredients (user_id, ingredient_id) VALUES ('$_SESSION[user_id]', '$id')");
            if ($result == false) {
                echo 'error';
            }
    #om användaren inte är inloggad
    } else {
        #kollar om sessionvariablen är en array
        if(!is_array($_SESSION['user_ingredients'])) {
            $_SESSION['user_ingredients'] = array();
        }
        #spara till sessionsvariabel
        $_SESSION['user_ingredients'][] = array('id' => $id, 'name' => $name);
        #förhindra dubletter
        $_SESSION['user_ingredients'] = unique_multidim_array($_SESSION['user_ingredients'],'id');
    }
}
