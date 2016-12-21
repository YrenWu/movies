<h3>List of movies </h3>

	<?php foreach ($movies as $movie) { ?> 
		<article>
			<a href="<?=BASE_URL?>details?id=<?= $movie->getId()?>">	
			<img class="thumbnail" src="<?= PICS_DIR . $movie->getImdbId() . ".jpg" ?>" alt="<?= $movie->getTitle() ?>"></a>

		</article>
	<?php } ?>