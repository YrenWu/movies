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

	/**
	*	fonctions du panneau d'admin
	*/
	public function moviesList()
	{
		$movies = [];
		// la findall() va lister les films on augmente le nombre de l'offset
		// du coup la fonction prend un deuxième param
		$movies = $this->movieManager->findAll(1, 100);  
		View::show('admin/manage.php', 'List of movies', ['data' => $movies]);
	}

	
	// fonction qui liste tous les utilisateurs pour suppression 
	// de compte dans le panneau admin (ça rigole pas)
	public function userList()
	{
		$userManager = new UserManager();
		$users = $userManager->findAll();

		View::show('admin/manage.php', 'List of users', ['data' => $users]);
	}

	/** fonction pour se logguer
	* 
	*/
	public function login()
	{

		if(!empty($_POST)){

			$userManager = new UserManager();
			$user = new User();

			$login = strip_tags($_POST['login']);
			//user sorti de la bdd 
			$result = $userManager->login($login);
			$user->setName($result->getName());
			$user->setId($result->getId());
			$user->setEmail($result->getEmail());
			$user->setPasswd($result->pass);
			$user->setRole($result->admin);

			// verifie que le pass sorti de la bdd est le même que celui posté
			if(password_verify($_POST['passwd'], $user->getPasswd())){ 
				$_SESSION['user'] = $user; //ou user stocker le $user ; 
				header("Location: ". BASE_URL);
			} 
		}
	}

	public function logout()
	{
		// deconnexion 
		unset($_SESSION['user']);
		// redirection
		header("Location: ". BASE_URL);
		
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
			$errors = [];
		

			$user->setName(strip_tags($_POST['name']));
			$user->setEmail(strip_tags($_POST['email']));

			// si les deux passes sont identiques
			if($_POST['passwd1'] === $_POST['passwd2']) {

				// bcrypt, pas md5
				$pass = password_hash($_POST['passwd1'], PASSWORD_DEFAULT);
				$user->setPasswd($pass);
				$user->setRole(0);
				$user->setToken("");

			} else {
				$errors[] = "Les mots de passes sont différents";
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
			$id = strip_tags($_GET['id']);
			$this->movieManager->delete($id);
		}
		//redirige vers la page
		header("Location: " . BASE_URL . "admin/manage"); 
	}


	public function manage() // fonction qui affiche le panneau d'admin
	{
		
		View::show('admin/manage.php', "Manage your movies", ['data' => null]);
	}
	/**
	* affiche un film dans le détail
	*/
	public function details()
	{
		$id = strip_tags($_GET["id"]);

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
		$page = (empty($_GET['page'])) ? 1 : strip_tags($_GET['page']);

		if(!empty($_POST['date'])){ // si recherche par date
			$date = strip_tags($_POST['date']);
			$movies = $this->movieManager->findByDate($date);
		} 

		else if(!empty($_POST['keyword'])){ // si recherche par genre
			$keyword = strip_tags($_POST['keyword']);
			$movies = $this->movieManager->findByKeyword($keyword);
		}

		else { // si pas de recherche on affiche tout
			$movies = $this->movieManager->findAll($page, 5); 
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