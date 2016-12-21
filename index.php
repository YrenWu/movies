<?php
	//ceci est le contrôleur frontal
	//il doit être short & sweet

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
// 	- consulter une liste de films, tous de bonne qualité
// 	- rechercher (dans un premier temps) par mot-clef, par genre ou par date
// 	- donner une note à un film
// 	- créer un compte, se connecter/déconnecter, oublier son mot de passe
// 	- ajouter/retirer des films à sa liste personnelle de films à voir (watchlist)
// 	- partager une fiche de film, ou sa watchlist

// Le client veut de son côté pouvoir : 
// 	- ajouter/modifier/supprimer des films de la base de données. Il a besoin d'une interface web.

// ### Détails d'un film
// - Infos à mettre en forme
// - Un widget permettant de donner une note sur 10 (ie. style étoiles) (connectés seulement)
// - Un bouton permet d'ajouter/supprimer de sa watchlist (connectés seulement)
// - Un formulaire permet de partager par email le film (connectés seulement)