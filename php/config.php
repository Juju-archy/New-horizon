<?php 

try{
	$bdd = new PDO ('mysql:host=127.0.0.1; dbname=newhorizon; charset=UTF8', 'root', '');
} catch(Exception $e) {
	exit('Erreur: '.$e -> getMessage());
}
?>