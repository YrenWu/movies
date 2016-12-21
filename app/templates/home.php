<h1>Accueil !</h1>

<h3>Liste des films </h3>

	<?php foreach ($movies as $movie) { ?> 
		<article>
			<h2><?= $movie->getTitle() ?></h2></a>
		</article>
	<?php } ?>

<!-- // ### Accueil
// - La page d'accueil affiche une liste de films, trié du meilleur au moins bon. La liste est paginée.
// - 2 formulaires au haut de la page permettent de rechercher par mot-clef, 
// par genre de film ou de filtrer par date
// - Seuls les affiches de films sont présentées. Elles sont cliquables et mènent vers la page de détails. -->