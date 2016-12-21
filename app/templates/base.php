<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title><?= $title ?></title>
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>public/css/style.css">
</head>
<body>
	<div class="container">

		<?php //include le fichier spécifié à la fin des méthodes de contrôleurs ?>
		<?php include("app/templates/$page.php") ?>
	
	</div>
</body>
</html>

<!-- // ### Watchlist
// - Un lien omniprésent permet d'afficher la watchlist 
// (même présentation sous forme d'affiches que la page d'accueil). La liste est également paginée. 
// Connectés seulement bien sûr. 
 -->