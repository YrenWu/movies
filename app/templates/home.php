	<form action="<?=BASE_URL?>" method="post" accept-charset="utf-8">
		<fieldset class="forms">
			<legend>Search by genre</legend>
			<input type="text" name="genre" placeholder="Western, Sci-Fi, Horror...">
			<input type="submit" value="Search">
		</fieldset>
		<fieldset class="forms">
			<legend>Search by year</legend>
			<input type="text" name="date" placeholder="1982">
			<input type="submit" value="Search">
		</fieldset>
	</form>

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
// par genre de film ou de filtrer par date -->