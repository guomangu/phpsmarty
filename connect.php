<?php
try 
{
	if ( $_SERVER['SERVER_NAME'] == "localhost" ) 
	{
		$bdd = new PDO( 'mysql:host=localhost;dbname=monsite;charset=utf8',
						'monutilisateur',
						'motdepasse' );
	} 
	else 
	{
		$bdd = new PDO( 'mysql:host=localhost;dbname=monsite;charset=utf8',
						'monutilisateur',
						'motdepasse' );
	}
} 
catch ( Exception $e ) 
{
	die('Erreur : '. $e->getMessage());
}
?>