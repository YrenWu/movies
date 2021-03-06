<?php 
	$logged = !empty($_SESSION['user']) ? true : false; // si l'utilisateur est loggué
?>
<!-- 	formulaire de recherche par date (année) ou par genre -->
	<form class="searchform" action="<?=BASE_URL?>" method="post" accept-charset="utf-8">
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

	<!-- pagination $p == numéro de page -->
	<div>
		Movies <?= ($p*5-5) +1 ?> to <?= ($p*5)?>  on <?= $count ?> movies 
		<div class="pagination">
		<?php if ($p != 1) { ?>
			<a href="?page=<?= $p-1 ?>">Previous</a> 
		<?php } ?>

		<?php if($p != $count/5)  { ?>
			<a href="?page=<?= $p+1 ?>">Following</a>
		<?php } ?>
		</div>
	</div>

	<!-- boucle d'affichage des films -->
	<?php foreach ($movies as $movie) { ?> 

		<article>
			<a href="<?=BASE_URL?>details?id=<?= $movie->getId()?>">	
			<img class="thumbnail" src="<?= PICS_DIR . $movie->getImdbId() . ".jpg" ?>" alt="<?= $movie->getTitle() ?>"></a>
			<?php $mov = $logged ? '<a href="'.BASE_URL.'add?id='.$movie->getId().'">Add to Watchlist</a><br>': null ;?>
			<?php $mov .= $logged ? '<a href="'.BASE_URL.'vote?id='.$movie->getId().'">Vote</a>': null ;?>
			<?= $mov ?>
		</article>

	<?php } ?> <br>