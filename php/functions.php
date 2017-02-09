<?php
    function logOut() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
    }

	function db_connect() {
		#finns endast i funktionen men förlorar inte sitt värde när funktionen inte körs
		static $connection;
		
		#om ingen anslutning finns hämtas inställningar från config.ini
		if(!isset($connection)) {
			$config = parse_ini_file('config.ini'); 
			$connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);
		}

		if($connection == false) {
			return mysqli_connect_error(); 
		}
		#utf-8
		mysqli_set_charset($connection, 'utf8');
		return $connection;
	}

	#förfrågan till databasen
	function db_query($query) {
		$connection = db_connect();
		$result = mysqli_query($connection, $query);
		if($result == false) {
			return mysqli_error($connection);
		}
		return $result;
	}

	function db_error() {
		$connection = db_connect();
		return mysqli_error($connection);
	}
    
    #skalar en sträng som användaren ger
	function db_strip($string) {
		$connection = db_connect();
        $string = mysqli_real_escape_string($connection, $string);
        $string = htmlspecialchars($string);
        $string = strip_tags($string);
        $string = stripslashes($string);
        return $string;
	}

    #varje värde i en multidimensionell array blir unikt
    function unique_multidim_array($array, $key) { 
        $temp_array = array(); 
        $i = 0; 
        $key_array = array(); 
        
        foreach($array as $val) { 
            if (!in_array($val[$key], $key_array)) { 
                $key_array[$i] = $val[$key]; 
                $temp_array[$i] = $val; 
            } 
            $i++; 
        } 
        return $temp_array; 
    } 
