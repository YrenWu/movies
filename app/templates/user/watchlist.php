<?php

	$movieManager = new Model\Manager\MovieManager;

	if(!empty($_SESSION['user'])) { 

		$user = $_SESSION['user']; ?>

		<h1>Welcome <?= $user->getName() ?></h1>

		<?php 

			$watchlist = $user->getWatchlist();
			$watch[] = explode('-', $watchlist);

			foreach ($watch[0] as $movieId) {
				if($movieId != ''){

					$movie = $movieManager->findOne($movieId); ?>

					<?= $movie->getTitle() ?>
					<a href="remove?id=<?= $movie->getId() ?>">X</a>
					<img class="thumbnail" src="<?= PICS_DIR . $movie->getImdbId() ?>.jpg">
					
				<?php
				}
			}
		 }
	?> 
<!--
	}

 // - ajouter/retirer des films à sa liste personnelle de films à voir (watchlist)
// 	- partager une fiche de film, ou sa watchlist -->