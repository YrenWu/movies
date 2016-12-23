<?php
	
	//notre table de correspondance entre les urls et les fonctions
	//de contrôleur à appeler
	
	//la clef (à gauche) est l'URL qui sera comparée avec l'URL de la requête.
	//si l'URL correspond, la méthode de contrôleur (la valeur, à droite), sera appelée par le Dispatcher

	//les routes peuvent ressemble à ce que vous voulez, mais commencent toutes par / : 

	$routes = [
		"/" => "home",
		"/user/watchlist" => "watchlist",
		"/details" => "details",
		"/register" => "register",

		//pour pouvoir se connecter et se déconnecter ou qu'on soit
		"/login" => "login",
		"/logout" => "logout",
		"/user/logout" => "logout",
		"/admin/logout" => "logout",
		"/user/login" => "login",
		"/admin/login" => "login",

		// panneau d'admin
		"/admin/" => "manage",
		"/admin/manage" => "manage",
		"/admin/userList" => "userList",
		// movies
		"/admin/moviesList" => "moviesList",
		"/admin/moviesCreate" => "moviesCreate",

		// ajout watchlist et vote
		"/add" => "add",
		"/vote" => "vote",
		"/user/remove" => "remove",

		//admin delete
		"/admin/delete" => "delete",

	];