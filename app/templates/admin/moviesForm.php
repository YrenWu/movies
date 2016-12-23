<?php include('manageMenu.php'); 	

	foreach($movie->getValidationErrors() as $error){
	echo "<p>" . ($error) . "</p>" ; 
	var_dump($movie);

} ?>
<!-- transmettre l'action au formulaire (moviesForm dans le défalut controller et modifier ou créer en fonction) -->
<form action="moviesForm" method="post" accept-charset="utf-8"> 

	<fieldset>
	
		<legend>Movie</legend>
		<label class="reg">
			Title :
			<input class="register" type="text" name="title" value="<?= $movie->getTitle(); ?>" placeholder="Indiana Jones">
		</label>
		<label class="reg">
			Year :
			<input class="register" type="text" name="year" value="<?= $movie->getYear(); ?>" placeholder="">
		</label>
		<label class="reg">
			Runtime :
			<input class="register" type="text" name="runtime" value="<?= $movie->getRuntime(); ?>" placeholder="">
		</label>
	</fieldset>

	<fieldset>
		<legend>Team</legend>
			<label class="reg">
			Directors :
			<input class="register" type="text" name="directors" value="<?= $movie->getDirectors(); ?>" placeholder="Georges Lucas">
		</label>
		<label class="reg">
			Writers :
			<input class="register" type="text" name="writers" value="<?= $movie->getWriters(); ?>" placeholder="">
		</label>
		<label class="reg">
			Plot : <br>
			<textarea name="plot"><?= $movie->getPlot(); ?></textarea>
		</label>
		<label class="reg">
			Casting : <br>
			<textarea name="cast"><?= $movie->getCast(); ?></textarea>
		</label>
	</fieldset>

	<fieldset>
		<legend>Pictures and Trailer</legend>
		<label class="reg">
			Imdb : <br>
			<input class="register" type="text" name="imdbId"  value="<?= $movie->getImdbId(); ?>">
		</label>
		<label class="reg">
			Trailer : <br>
			<input class="register" type="text" name="trailerUrl"  value="<?= $movie->getTrailerUrl(); ?>">
		</label>
	</fieldset>
	<input type="hidden" name="action" value="<?= $action?>"/>
	<input class="register" type="submit"  value="Submit">
</form>