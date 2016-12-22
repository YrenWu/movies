<?php
	if(empty($_SESSION['user']) || $_SESSION['user']->getRole() != 1) {	
	} else { ?>

<h1>Welcome dear administrator !</h1>

<ul>
	<a href="moviesList"><li>Manage movies</li></a>
	<a href="userList"><li>Users accounts</li></a>
</ul>

<?php } ?>
<!--  En fonction de si on cherche la liste des utilisateurs, la modification, 
l'ajout ou la suppression de film l'affichage sera différent -->
<?php
if($data != null){ // si on a des données envoyées
	foreach ($data as $elem) {
		if(get_class($elem) == 'Model\Entity\Movie'){
			echo($elem->getTitle() . "<br>");
		}
		else if (get_class($elem) == 'Model\Entity\User'){
			echo($elem->getName() . "<br>");
		}
	} 
}
?>



<!-- // Le client veut de son côté pouvoir : 
// 	- ajouter/modifier/supprimer des films de la base de données. Il a besoin d'une interface web. -->