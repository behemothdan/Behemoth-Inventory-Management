<?php
	function connect(){
		global $db;
		$host="localhost";
		$username="EDITED-OUT";
		$password="EDITED-OUT";
		$db_name="inventory";		
		$db = new PDO('mysql:host=localhost;dbname=inventory;charset=utf8', $username, $password);
	}	
?>