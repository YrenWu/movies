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
		$this->userManager = new UserManager();
	}

	/**
	*	Watchlist functions
	*/
	public function add()
	{
		$movieId = strip_tags($_GET['id']);
		// récuper le user aussi 
		$user = $_SESSION['user'];
		$user->addToWatchlist($movieId);

		$this->userManager->saveWatchlist($user);
		header("Location: " . BASE_URL); 	

	}

	public function remove() // remove from watchlist
	{
		$movieId = strip_tags($_GET['id']);
		// récuper le user aussi 
		$user = $_SESSION['user'];
		$user->removeFromWatchlist($movieId);

		$this->userManager->saveWatchlist($user);
		header("Location: " . BASE_URL); 	

	}

	public function vote()
	{
		// $id = strip_tags($_GET['id']);
		// // récuper le user aussi 
		// $userId = $_SESSION['user']->getId();

	}

	/**
	*	fonctions du panneau d'admin
	*/
	public function delete()
	{
		if(!empty($_GET)) {

			$id = strip_tags($_GET['id']);
			$obj = strip_tags($_GET['obj']);

			// si on supprime un film
			if($obj == 'movie'){
				$this->movieManager->delete($id);
			}
			// si on supprime un user
			if($obj == 'user'){
				$this->userManager->delete($id);
			}

		}
		//redirige vers la page
		header("Location: " . BASE_URL . "admin/manage"); 
	}

	public function manage() // fonction qui affiche le panneau d'admin
	{
		View::show('admin/manage.php', "Manage your movies", ['data' => null]);
	}

	public function moviesList()
	{
		$movies = [];
		// la findall() va lister les films on augmente le nombre de l'offset
		// du coup la fonction prend un deuxième param
		$movies = $this->movieManager->findAll(1, 100);  
		View::show('admin/manage.php', 'List of movies', ['data' => $movies]);
	}

	public function moviesCreate()
	{
		$movie = new Movie();

		if(!empty($_POST)){
		
			$movie->setTitle(strip_tags($_POST['title']));
			$movie->setRuntime(strip_tags($_POST['runtime']));
			$movie->setYear(strip_tags($_POST['year']));
			$movie->setWriters(strip_tags($_POST['writers']));
			$movie->setImdbId(strip_tags($_POST['imdbId']));
			$movie->setTrailerUrl(strip_tags($_POST['trailerUrl']));
			$movie->setPlot(strip_tags($_POST['plot']));
			$movie->setCast(strip_tags($_POST['cast']));
			$movie->setDirectors(strip_tags($_POST['directors']));

			if($movie->isValid()){
				$this->movieManager->insert($movie);
				header("Location: " . BASE_URL . "admin/manage"); 
			}

		}

		View::show('admin/moviesCreate.php', "Manage your movies", ['movie' => $movie]);
	}

	// fonction qui liste tous les utilisateurs pour suppression 
	// de compte dans le panneau admin (ça rigole pas)
	public function userList()
	{
		$users = $this->userManager->findAll();
		View::show('admin/manage.php', 'List of users', ['data' => $users]);
	}

	/** fonction pour se logguer
	* 
	*/
	public function login()
	{

		if(!empty($_POST)){

			$user = new User();

			$login = strip_tags($_POST['login']);
			//user sorti de la bdd 
			$result = $this->userManager->login($login);
			$user->setName($result->getName());
			$user->setId($result->getId());
			$user->setEmail($result->getEmail());
			$user->setPasswd($result->pass);
			$user->setRole($result->admin);
			$user->setWatchList($result->getWatchlist());

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
				$this->userManager->insert($user); 
				// si tout est ok on insère dans la db
				header("Location: " . BASE_URL); 	
			}
		}

		View::show('register.php', "Register", ["user" => $user]);
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
		if(!empty($_SESSION)){

			$user = $_SESSION['user'];
			$this->userManager->saveWatchlist($user);
		}

		View::show("user/watchlist.php", "WatchList?");
	}
}