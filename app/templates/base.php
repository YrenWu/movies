<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title><?= $title ?></title>
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>public/css/style.css">
</head>
<body>
	<div class="container">
		
		<?php 

			// ça sert à rien d'afficher le formulaire de login si on est sur celui de register
			if ($_SERVER['REQUEST_URI'] != "/TP-Movies/movies/register")
			{
				include("app/templates/login.php") ;
			}
		
			?> 
		<?php //include le fichier spécifié à la fin des méthodes de contrôleurs ?>
		<?php include("app/templates/$page.php") ?>
		<a href="<?= BASE_URL ?>user/watchlist">Watchlist</a>
		<a href="<?= BASE_URL ?>"> Home page </a><br>
		<!-- lien vers la watchlist on pourra le cacher plus tard si n'est pas loggué -->
	
	</div>

	<div >
		
	</div>
</body>
</html>