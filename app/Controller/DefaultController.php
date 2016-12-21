<?php

namespace Controller;

use View\View; //on peut donc utiliser cette classe comme View au lieu de \View\View
use Model\Entity\Demo;
use Model\Manager\DemoManager;

class DefaultController 
{

	private $movieManager;


	public function __construct()
	{
		$this->movieManager = new DemoManager();
	}


	public function delete()
	{
		if(!empty($_GET)) {
			var_dump($_GET);
			die;

			// $id = htmlentities($_GET['id']);

			// $postManager = new PostManager();
			// $postManager->delete($id);
		}
		header("Location: " . BASE_URL . "home");
	}


	public function manage() // fonction qui affiche le panneau d'admin
	{
		$movies = $this->movieManager->findAll();

		View::show('admin/manage.php', "Manage your movies", ['movies' => $movies]);
	}
	/**
	* affiche un film dans le détail
	*/
	public function details()
	{
		$id = htmlentities($_GET["id"]);

		$movie = $this->movieManager->findOne($id);
			
		if(empty($movie)){
			header("HTTP/1.0 404 Not Found");
			return $this->error404();
		} else {
			View::show('details.php', "Details", ['movie' => $movie]);
		}
	}

	/**
	 * Affiche la page d'accueil
	 */
	public function home()
	{
		
		$movies = [];

		if(!empty($_POST['date'])){ // si recherche par date
			$date = htmlentities($_POST['date']);
			$movies = $this->movieManager->findByDate($date);
		} 

		else if(!empty($_POST['genre'])){ // si recherche par genre
			$genre = htmlentities($_POST['genre']);
			$movies = $this->movieManager->findByGenre($genre);
		}

		else { // si pas de recherche on affiche tout
			$movies = $this->movieManager->findAll(); 
		}

		View::show("home.php", "Home page !", ["movies" => $movies]);
	}

	/**
	 * Affiche la page d'erreur 404
	 */
	public function error404()
	{
		//envoie une entête 404 (pour notifier les clients que ça a foiré)
		header("HTTP/1.0 404 Not Found");
		View::show("errors/404.php", "Oups ! Lost ?");
	}

	/**
	 * Affiche la watchlist
	 */
	public function watchlist()
	{
		View::show("user/watchlist.php", "WatchList?");
	}
}

