<ul>
	<?php foreach ($users as $user): ?>
		<!-- il serait pas mal d'afficher le détail de l'utilisateur -->
		<li><?= $user->getName() ?> 
		<a href="">X</a></li> 
	<?php endforeach ?>
</ul>