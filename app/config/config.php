<?php

	//url racine du site. Sert à générer des URLs absolues
	const BASE_URL 		= "http://localhost/TP-Movies/movies/"; 			//adresse complète menant à index.php. Modifier CHEMIN ! Utile pour tous les liens dans le HTML.
	const UPLOAD_DIR 	= __DIR__ . "/../../public/uploads/";	//chemin menant au dossier d'upload
	const PICS_DIR 		= BASE_URL . "public/pics/";

	//infos de connexion à la db
	const DB_HOST = "localhost";
	const DB_NAME = "movies";
	const DB_USER = "root";
	const DB_PASS = "imie";

	