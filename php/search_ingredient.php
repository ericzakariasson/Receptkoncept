<?php
    include_once('functions.php');
    if(isset($_POST['key'])) {
	    $key = db_strip($_POST['key']);
	    #hämtar ingredienser där 'key' matchar
	    $result = db_query("SELECT * FROM ingredients WHERE ingredient_name LIKE '%{$key}%'");
	    if ($result == false) {
            echo 'error';
        }
	    #associative array
	    while ($row = mysqli_fetch_assoc($result)) {
	        $search_ingredient[] = array('id' => $row['ingredient_id'], 'name' => $row['ingredient_name']);
	    }
	    #skriver ut i JSON-format
	    echo json_encode($search_ingredient);
	}