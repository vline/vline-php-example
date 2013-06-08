<?php
class Checker{
	function checkInstallation($pre="../"){
		error_reporting(0);
		if(file_exists($pre.'conf.json')){
			$r = fopen($pre.'conf.json', 'r');
			if(!$r)
				return false;
			$contents = fread($r, filesize($pre.'conf.json'));
			$conf = json_decode($contents);

			$mysqli = new mysqli($conf->host, $conf->username, $conf->password);
			if (mysqli_connect_error()){
				return false;
			}
			else{
				$sql = 'SELECT COUNT(*) AS `exists` FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMATA.SCHEMA_NAME="vline-php-example"';
				// execute the statement
				$query = $mysqli->query($sql);
				if ($query === false) {
					return false;
				}
				// extract the value
				$row = $query->fetch_object();
				$dbExists = (bool) $row->exists;
				if($dbExists){
					return true;	
				}
				else{
					return false;	
				}
			}
		}
		else{
			return false;
		}
		
	}
}
?>