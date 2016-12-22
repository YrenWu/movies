<?php

namespace Controller;

use View\View; //on peut donc utiliser cette classe comme View au lieu de \View\View
use Model\Entity\Movie;
use Model\Entity\User;
use Model\Manager\MovieManager;
use Model\Manager\UserManager;

class DefaultController 
{

	private $movieManager;


	public function __construct()
	{
		$this->movieManager = new MovieManager();
	}

	/** fonction pour se logguer
	* 
	*/
	public function login()
	{
		// vérifier que le pass entré hashé en md5 correspond à celui de la 
		// bdd (john doe = plopplopplop et jane doe = azertyuiop pour tests)

	}

	// fonction qui liste tous les utilisateurs pour suppression 
	// de compte dans le panneau admin (ça rigole pas)
	public function userList()
	{
		$userManager = new UserManager();
		$users = $userManager->findAll();

		View::show('admin/userList.php', 'List of users', ['users' => $users]);
	}
	/**
	* Inscription sur le site
	*/
	public function register()
	{

		$user = new User();
		// si on a rempli le formulaire
		if(!empty($_POST)){
			$userManager = new UserManager();
		

			$user->setName(htmlentities($_POST['name']));
			$user->setEmail(htmlentities($_POST['email']));

			if($_POST['passwd1'] === $_POST['passwd1']) {
				$pass = md5($_POST['passwd1']);
				$user->setPasswd($pass);
			}

			if($user->isValid()){
				$userManager->insert($user); 
				// si tout est ok on insère dans la db
				header("Location: " . BASE_URL); 	
			}
		}

		View::show('register.php', "Register", ["user" => $user]);
	}

	/**
	* 	fonctions CRUD pour l'admin
	*/
	public function delete()
	{
		if(!empty($_GET)) {
			$id = htmlentities($_GET['id']);
			$this->movieManager->delete($id);
		}
		//redirige vers la page
		header("Location: " . BASE_URL . "admin/manage"); 
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
		$count = $this->movieManager->countAll();

		$movies = [];
		$page = (empty($_GET['page'])) ? 1 : htmlentities($_GET['page']);

		if(!empty($_POST['date'])){ // si recherche par date
			$date = htmlentities($_POST['date']);
			$movies = $this->movieManager->findByDate($date);
		} 

		else if(!empty($_POST['keyword'])){ // si recherche par genre
			$keyword = htmlentities($_POST['keyword']);
			$movies = $this->movieManager->findByKeyword($keyword);
		}

		else { // si pas de recherche on affiche tout
			$movies = $this->movieManager->findAll($page); 
		}

		View::show("home.php", "Home page !", 
					["movies" => $movies, 'count' => $count, 'p' => $page]);
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

