<?php

class VlinePHPinstaller{
	function checkConfFile(){
		$toreturn = array('exists'=>true, 'iswritable'=>true);
		if(file_exists('../conf.json')){
			$toreturn['exists'] = true;	
			$toreturn['iswritable'] = is_writable('../conf.json');
		}
		else{
			$toreturn['exists'] = false;
			$toreturn['iswritable'] = false;
		}
		
		return $toreturn;
	}
	
	function getYesNoIcon($val){
		if($val){
			return "check";	
		}
		else{
			return "error";	
		}
	}
	
	function checkDBconnectionFromConf(){
		error_reporting(0);
		$r = fopen('../conf.json', 'r');
		$contents = fread($r, filesize('../conf.json'));
		$conf = json_decode($contents);
		return array('conf'=>$conf, 'connected'=>$this->checkDBconnection($conf->host, $conf->username, $conf->password));;
	}
	
	function checkDBconnection($host, $uname, $pass){
		$mysqli = new mysqli($host, $uname, $pass);
		if (mysqli_connect_error()){
			return false;
		}
		else{
			return true;	
		}
	}
	
	function saveDB($data){
		$conf = array("host"=>$data['host'], "username"=>$data['user'], "password"=>$data['password']);
		$r = fopen('../../conf.json', 'w');
		fwrite($r, json_encode($conf));
		fclose($r);
	}
	
	function createDBandTables(){
		$r = fopen('../conf.json', 'r');
		$contents = fread($r, filesize('../conf.json'));
		$conf = json_decode($contents);
		$mysqli = new mysqli($conf->host, $conf->username, $conf->password);
		
		$toreturn = array("dbcreated"=>false,"tablecreated"=>false,"admincreated"=>false);
		if($mysqli->query("CREATE DATABASE IF NOT EXISTS `vline-php-example` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;") === TRUE){
			$toreturn['dbcreated'] = true;	
			mysqli_select_db($mysqli, 'vline-php-example');
			if($mysqli->query("CREATE TABLE IF NOT EXISTS `vline-php-example`.`user` (
				`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`username` VARCHAR( 150 ) NOT NULL ,
				`password` VARCHAR( 150 ) NOT NULL ,
				`surname` VARCHAR( 150 ) NOT NULL ,
				`name` VARCHAR( 150 ) NOT NULL ,
				`isadmin` TINYINT( 1 ) NOT NULL DEFAULT  '0'
				) ENGINE = INNODB;") == TRUE){
					$toreturn['tablecreated'] = TRUE;	
					$result = $mysqli->query("SELECT * from `user`");
					if($result->num_rows == 0){
						$mysqli->query("INSERT INTO  `vline-php-example`.`user` (
							`id` ,
							`username` ,
							`password` ,
							`surname` ,
							`name` ,
							`isadmin`
							)
							VALUES (
							NULL ,  'admin',  'admin',  'Super',  'Admin',  '1'
						);");
						$toreturn['admincreated'] = true;	
					}
					else{
						$toreturn['admincreated'] = false;	
					}
			}
			else{
				$toreturn['tablecreated'] = FALSE;	
			}
		}
		else{
			$toreturn['dbcreated'] = false;
		}
		return $toreturn;
	}
}

?>