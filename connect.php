<?php
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);

try 
{
	if ( $_SERVER['SERVER_NAME'] == "localhost" ) 
	{
		$bdd = new PDO( 'mysql:host=loldb;dbname=lola;charset=utf8',
						'idlol',
						'passlol',
						$options);
	} 
	else 
	{
		$bdd = new PDO( 'mysql:host=loldb;dbname=lola;charset=utf8',
						'idlol',
						'passlol',
						$options);
	}
} 
catch ( Exception $e ) 
{
	die('Erreur : '. $e->getMessage());
}
?>