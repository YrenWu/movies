<h1>Home page</h1>

<h3>List of movies </h3>

	<?php foreach ($movies as $movie) { ?> 
		<article>
			<a href="<?=BASE_URL?>details?id=<?= $movie->getId()?>">	
			<img class="thumbnail" src="<?= PICS_DIR . $movie->getImdbId() . ".jpg" ?>" alt="<?= $movie->getTitle() ?>"></a>

		</article>
	<?php } ?>

<!-- // ### Accueil
// La liste est paginée.
// - 2 formulaires au haut de la page permettent de rechercher par mot-clef, 
// par genre de film ou de filtrer par date
// - Seuls les affiches de films sont présentées. Elles sont cliquables et mènent vers la page de détails. -->