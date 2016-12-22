<?php

	$movieManager = new Model\Manager\MovieManager;

	if(!empty($_SESSION['user'])) { 
	$user = $_SESSION['user']; ?>

	<h1>Welcome <?= $user->getName() ?></h1>
	<?php 
		$watchlist = unserialize($user->getWatchlist());
		foreach ($watchlist as $movieId) {
			$movie = $movieManager->findOne($movieId);
			echo($movie->getTitle());
			echo '<img class="thumbnail" src="'. PICS_DIR . $movie->getImdbId() . '.jpg">';
		}?>

<?php	}
?> <!-- vérifier que l'utilisateur est loggué pour afficher et afficher ses favoris -->
<!-- // 	- ajouter/retirer des films à sa liste personnelle de films à voir (watchlist)
// 	- partager une fiche de film, ou sa watchlist -->
