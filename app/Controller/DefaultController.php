<?php

namespace Controller;

use View\View; //on peut donc utiliser cette classe comme View au lieu de \View\View
use Model\Entity\Demo;
use Model\Manager\DemoManager;

class DefaultController 
{

	/**
	*	liste les films trouvés par le formulaire de recherche
	*/
	public function search()
	{

		$movies = [];
		$demoManager = new DemoManager();

		if(!empty($_POST['date'])){
			$date = htmlentities($_POST['date']);
			$movies = $demoManager->findByDate($date);
		} 

		if(!empty($_POST['genre'])){
			$genre = htmlentities($_POST['genre']);
			$movies = $demoManager->findByGenre($genre);
		}
		var_dump($movies);

	}

	/**
	* affiche un film dans le détail
	*/
	public function details()
	{
		$id = htmlentities($_GET["id"]);

		$demoManager = new DemoManager();
		$movie = $demoManager->findOne($id);
			
		if(empty($movie)){
			header("HTTP/1.0 404 Not Found");
			return $this->error404();
		} else {
			View::show('details.php', "Détails", ['movie' => $movie]);
		}
	}

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

