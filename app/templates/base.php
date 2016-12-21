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
		<a href="<?= BASE_URL ?>user/watchlist">Watchlist</a>
		<!-- lien vers la watchlist on pourra le cacher plus tard si n'est pas loggué -->
	
	</div>
</body>
</html>