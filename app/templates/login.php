<?php 

	//session_start();

	if(!empty($_POST)){
		$sql = "SELECT * FROM users 
				WHERE name = :login 
				OR email = :login ";

		if(password_verify($_POST['passwd'], $user->getPasswd())){ 
			$_SESSION['user'] = $user; //ou user stocker le $user ; 
		}
	}
?>

<form action="login" method="post" accept-charset="utf-8">
	Sign in :
	<input type="text" name="login" value="" placeholder="John Doe">
	<input type="password" name="passwd" >
	<!-- prévoir une procédure d'envoi de mots de passe par mail en cas d'oubli -->
	<input type="submit" name="" value="Login" ><a href="<?= BASE_URL ?>register">Register</a>
</form>