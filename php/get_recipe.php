<?php
    session_start();
    include_once('functions.php');
    if(isset($_POST['recipeId'])) {
        $recipe_id = db_strip($_POST['recipeId']);

        #tre olika förfrågningar

        #receptheader
        $recipeData = db_query("SELECT * FROM recipes WHERE recipe_id = '$recipe_id'");
        if ($recipeData == false) {
            echo 'error';
        }
        #ingredienser
        $recipeIngredients = db_query("SELECT amount_required, ingredient_name, ingredient_unit FROM recipe_ingredients, ingredients WHERE recipe_id = '$recipe_id' AND recipe_ingredients.ingredient_id = ingredients.ingredient_id");
        if ($recipeIngredients == false) {
            echo 'error';
        }
        #instruktioner
        $recipeSteps = db_query("SELECT instructions, step_number FROM recipe_steps WHERE recipe_id = '$recipe_id'");
        if ($recipeSteps == false) {
            echo 'error';
        }

        while ($row = mysqli_fetch_assoc($recipeData)) {
                $recipeDataJSON = array('info' => array('id' => $row['recipe_id'], 'name' => $row['recipe_name'], 'imgUrl' => $row['recipe_img'], 'description' => $row['recipe_description'], 'time' => $row['recipe_time']));
        }

        while ($row = mysqli_fetch_assoc($recipeIngredients)) {
                $recipeIngredientsJSON[] = array( 'ingredient' => array('ingredient_name' => $row['ingredient_name'], 'amount_required' => $row['amount_required'], 'ingredient_unit' => $row['ingredient_unit']));
        }

        while ($row = mysqli_fetch_assoc($recipeSteps)) {
                $recipeStepsJSON[] = array('step' => array('step_number' => $row['step_number'], 'instructions' => $row['instructions']));
        }

        #slänger ihop alla arrays till en som sedan skriv ut till JSON-format
        $data = array();
        array_push($data, $recipeDataJSON, $recipeIngredientsJSON, $recipeStepsJSON);

        echo json_encode($data);
    }