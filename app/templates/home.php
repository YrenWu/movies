<h1>Home page</h1>

<h3>List of movies </h3>

	<?php foreach ($movies as $movie) { ?> 
		<article>
			<h5><?= $movie->getTitle() ?></h5>
			<?= $movie->getDirectors() ?><br>
			<?= $movie->getYear() ?> <?= $movie->getRating() ?>

		</article>
	<?php } ?>

<!-- // ### Accueil
// - La page d'accueil affiche une liste de films, trié du meilleur au moins bon. La liste est paginée.
// - 2 formulaires au haut de la page permettent de rechercher par mot-clef, 
// par genre de film ou de filtrer par date
// - Seuls les affiches de films sont présentées. Elles sont cliquables et mènent vers la page de détails. -->