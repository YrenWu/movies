<h1>Welcome dear administrator !</h1>

<ul>
	<li>Add a movie</li>
	<li>Update a movie</li>
</ul>

<h4>Delete a movie</h4>
	<?php foreach ($movies as $movie) { ?> 
		<article>
			<?= $movie->getTitle() . " "?>
			<a href="<?=BASE_URL?>admin/delete?id=<?= $movie->getId()?>">X</a>

		</article>
	<?php } ?>
<!-- // Le client veut de son côté pouvoir : 
// 	- ajouter/modifier/supprimer des films de la base de données. Il a besoin d'une interface web. -->