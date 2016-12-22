<?php
	if(!empty($_SESSION['user'])) { ?>

	<h1>Welcome <?= $_SESSION['user']->getName() ?></h1>

<?php	}
?> <!-- vérifier que l'utilisateur est loggué pour afficher et afficher ses favoris -->
<!-- // 	- ajouter/retirer des films à sa liste personnelle de films à voir (watchlist)
// 	- partager une fiche de film, ou sa watchlist -->
