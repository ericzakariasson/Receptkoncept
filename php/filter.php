<?php
    session_start();
    include_once('functions.php');
    #hämta inställningar
    if(isset($_POST['time'])) {
        $recipe_time = db_strip($_POST['time']);
        $vegetarian = db_strip($_POST['vegetarian']);
        $vegan = db_strip($_POST['vegan']);
        $lactose_free = db_strip($_POST['lactosefree']);
        $gluten_free = db_strip($_POST['glutenfree']);
        
        #tack till David Lundholm och Daniel Berg för att försöka använda JOIN och för att försöka hitta tabellen 'ingredients'
        #tack till Gustaf Rosenblad för inspiration och för sitt innovativa sätt att tänka när det kommer till SQL

        #om inloggad
        if(isset($_SESSION['user_id'])) {
            #sparar som en sträng för att användas i förfrågan senare
            $user_ingredients = "(SELECT ingredient_id FROM user_ingredients WHERE user_id = $_SESSION[user_id])";
        } else {
            $user_ingredients = "(";
            #för varje ingrediens läggs id:t till följt av ett kommatecken (','). Tex "(1, 3, 3, 7)"
            foreach ($_SESSION['user_ingredients'] as $ingredient) {
                if (strlen($user_ingredients) != 1) {
                    $user_ingredients .= ", ";
                }
                #lägger till ingrediens-id
                $user_ingredients .= $ingredient["id"];
            }
            #när alla id är tillagda avslutas strängen med en slutparentes
            $user_ingredients .= ")";
        }
        #hämtar alla recept där alla användarens krav uppfylls
        $recipes = db_query("SELECT * FROM recipes WHERE recipe_id IN (SELECT recipe_id FROM recipe_ingredients WHERE ingredient_id IN $user_ingredients) AND recipe_time <= '$recipe_time' AND vegetarian = '$vegetarian' AND vegan = '$vegan' AND lactose_free = '$lactose_free' AND gluten_free = '$gluten_free'");
        #lägger in all data i en ny array som sedan skrivs ut
        while ($row = mysqli_fetch_assoc($recipes)) {
            $recipe = array('id' => $row['recipe_id'], 'name' => $row['recipe_name'], 'imgUrl' =>$row['recipe_img'], 'description' => $row['recipe_description'], 'time' => $row['recipe_time']);
        }

        #skriver ut i JSON-format som javascript hämtar och visar för användaren
        echo json_encode($recipe);
    }