
<article class="movie">
	
	<h1><?= $movie->getTitle(); ?></h1>
	<img class="thumbnail" src="<?= PICS_DIR . $movie->getImdbId() . ".jpg" ?>" alt="<?= $movie->getTitle() ?>">

	<div>
		<?= $movie->getYear(); ?> 
		<?= $movie->getRating(); ?> 
		<?= $movie->getVotes(); ?> 
		<?= $movie->getDirectors(); ?>
		<?= $movie->getRuntime(); ?> 

	</div>
	<div>
		<p><?= $movie->getPlot(); ?></p>
		<p><?= $movie->getWriters(); ?></p> 
		<!-- si writers N/A cacher ? -->
		<p><?= $movie->getCast(); ?></p>
	</div>

	<div>
		<a href="<?= $movie->getTrailerUrl(); ?> ">Trailer<a/>
		<?= $movie->getDateCreated(); ?> 
		<?= $movie->getDateModified(); ?> 
	</div>
</article>