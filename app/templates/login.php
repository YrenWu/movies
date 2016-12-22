<form action="login" method="post" accept-charset="utf-8">
	Sign in :
	<input type="text" name="name" value="" placeholder="John Doe">
	<input type="password" name="passwd" >
	<!-- prévoir une procédure d'envoi de mots de passe par mail en cas d'oubli -->
	<input type="submit" name="" value="Login" ><a href="<?= BASE_URL ?>register">Register</a>
</form>