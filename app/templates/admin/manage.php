<?php
	if(empty($_SESSION['user']) || $_SESSION['user']->getRole() != 1) {	
	} else { ?>

<h1>Welcome dear administrator !</h1>

<ul>
	<li>Add a movie</li>
	<li>Delete a movie</li>
	<li>Update a movie</li>
	<a href="userList"><li>Users accounts</li></a>
</ul>

<?php } ?>

<!-- // Le client veut de son côté pouvoir : 
// 	- ajouter/modifier/supprimer des films de la base de données. Il a besoin d'une interface web. -->