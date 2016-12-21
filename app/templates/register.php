<form action="register" method="post" accept-charset="utf-8">
	<?php 
		foreach($user->getValidationErrors() as $error){
		echo "<p>" . ($error) . "</p>" ; 
	} ?>
	<label>
		Nom :
		<input type="text" name="name" value="<?= $user->getName(); ?>" placeholder="John Doe">
	</label>

	<label>
		Password :

		<input type="password" name="passwd1" >
		<input type="password" name="passwd2" >
	</label>

	<label>
		E-mail :
		<input type="text" name="email" value="<?= $user->getEmail(); ?>">
	</label>
	<input type="submit"  value="Register">
</form>