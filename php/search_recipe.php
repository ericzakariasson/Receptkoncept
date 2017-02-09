<?php
    include_once('functions.php');
    if (isset($_POST['key'])) {
        $key = db_strip($_POST['key']);
        #söker efter recept där 'key' matchar receptnamnet
        $result = db_query("SELECT * FROM recipes WHERE recipe_name LIKE '%{$key}%'");
        if ($result == false) {
            echo 'error';
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $search_recipe[] = array('id' => $row['recipe_id'], 'name' => $row['recipe_name'], 'imgUrl' =>$row['recipe_img'], 'description' => $row['recipe_description'], 'time' => $row['recipe_time']);
        }
        #skriver ut i JSON-format
        echo json_encode($search_recipe);
    }
