<?php
	if(empty($_SESSION['user']) || $_SESSION['user']->getRole() != 1) {	
	} else { ?>

<?php include('manageMenu.php');

 } ?>
<!--  En fonction de si on cherche la liste des utilisateurs, la modification, 
l'ajout ou la suppression de film l'affichage sera différent -->
<?php
	if($data != null){ ?> <!--  si on a des données envoyées --> <ul>	
		<?php foreach ($data as $elem) {

				if(get_class($elem) == 'Model\Entity\Movie'){ ?>
					<li><?= $elem->getTitle() . ' ' ?>
						<a href="delete?id=<?= $elem->getId()?>&obj=movie"> X </a> 
						<a href="update?id=<?= $elem->getId()?>"> Update </a> 
					</li>
				<?php }

				else if (get_class($elem) == 'Model\Entity\User'){ ?>
					<li><?= $elem->getName() . ' ' ?> 
						<a href="delete?id=<?= $elem->getId() ?>&obj=user"> X </a>
					</li>
					
				<?php
				}
			} ?>
		</ul> 
	<?php } ?>