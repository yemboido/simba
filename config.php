<?php
try
{
	global $bdd;
	$bdd = new PDO('mysql:host=localhost;dbname=simba;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
