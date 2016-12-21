<?php

namespace Controller;

use View\View; //on peut donc utiliser cette classe comme View au lieu de \View\View
use Model\Entity\Demo;
use Model\Manager\DemoManager;

class DefaultController 
{
	/**
	 * Affiche la page d'accueil
	 */
	public function home()
	{
		
		$movieManager = new  DemoManager();
		$movies = $movieManager->findAll();
			// $postManager = new PostManager();
			// $posts = $postManager->findAll();

			// View::render('home.php', "Accueil", ["posts" => $posts]);
		View::show("home.php", "Accueil !", ["movies" => $movies]);
	}

	/**
	 * Affiche la page d'erreur 404
	 */
	public function error404()
	{
		//envoie une entête 404 (pour notifier les clients que ça a foiré)
		header("HTTP/1.0 404 Not Found");
		View::show("errors/404.php", "Oups ! Perdu ?");
	}

	/**
	 * Affiche la watchlist
	 */
	public function watchlist()
	{
		View::show("user/watchlist.php", "Oups ! Perdu ?");
	}
}

