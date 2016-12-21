
<!-- 	formulaire de recherche par date (année) ou par genre -->
	<form action="<?=BASE_URL?>" method="post" accept-charset="utf-8">
		<fieldset class="forms">
			<legend>Search by keywords</legend>
			<input type="text" name="keyword" placeholder="Western, Sci-Fi, Horror...">
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
<!-- Commenté car fait laguer la page
	<?php foreach ($movies as $movie) { ?> 
		<article>
			<a href="<?=BASE_URL?>details?id=<?= $movie->getId()?>">	
			<img class="thumbnail" src="<?= PICS_DIR . $movie->getImdbId() . ".jpg" ?>" alt="<?= $movie->getTitle() ?>"></a>

		</article>
	<?php } ?> -->

<!-- // ### Accueil
// La liste est paginée.-->