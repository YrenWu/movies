<form action="register" method="post" accept-charset="utf-8">
	<?php 
		foreach($user->getValidationErrors() as $error){
		echo "<p>" . ($error) . "</p>" ; 
	} ?>
	<label class="reg">
		Nom :
		<input class="register" type="text" name="name" value="<?= $user->getName(); ?>" placeholder="John Doe">
	</label>

	<label class="reg">
		Password :

		<input class="register" type="password" name="passwd1" >
		<input class="register" type="password" name="passwd2" >
	</label>

	<label class="reg">
		E-mail :
		<input class="register" type="text" name="email" value="<?= $user->getEmail(); ?>">
	</label>
	<input class="register" type="submit"  value="Register">
</form>