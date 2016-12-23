<?php
	require("app/Model/Entity/User.php"); // nécessaire pour les sessions


	//ceci est le contrôleur frontal
	//il doit être short & sweet
	session_start();


	//charge nos définitions de routes
	require("app/config/routes.php");

	//configuration de l'appli
	require("app/config/config.php");

	//charge toutes nos dépendances composer
	if (file_exists("vendor/autoload.php")){
		require("vendor/autoload.php");
	}

	//auto chargement de nos classes
	spl_autoload_register(function($className){
		$path = "app" . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $className) . ".php";
		if (file_exists($path)){
			require($path);
		}
	});

	//le dispatcher trouve la correspondance entre nos routes et l'url
	$p = (empty($_GET['p'])) ? "/" : $_GET['p'];
	$dispatcher = new Controller\Dispatcher();
	$dispatcher->dispatch($routes, $p);

// L'internaute peut 
// 	- donner une note à un film
//  oublier son mot de passe

// ### Détails d'un film
// - Infos à mettre en forme
// - Un widget permettant de donner une note sur 10 (ie. style étoiles) (connectés seulement)
// - Un bouton permet d'ajouter/supprimer de sa watchlist (connectés seulement)
// - Un formulaire permet de partager par email le film (connectés seulement)

	// fonction isvalid etpour le crud de Movie (movies) et user
	// class user et usermanager
	// faire messages de validation après redirection
	// metrre un token si oublié
	// remember me
	// set_cookie();
	// faire pagination pour les fonctions searchbyyear etc
	// faire en sorte de na pas ajouter le film plusieurs fois a la watchlist
	// et de pouvoir retirer le film de la watchlist


	// John Doe = azertyuiop
	// Jane Doe = qsdfghjklm

	// la watchlist est bugguée à cause de la sérialization désérialisation , à corriger