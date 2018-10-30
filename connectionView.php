<?php
	$title = "connexion";
	// We declare there will be no dropdown or return link on this page.
	$backLinkCheck = false;
	$dropDownCheck = false;
	$_SESSION['isConnect'] = false;
	require ('header.php');
?>


	<div class="container-fluid col-5 max-auto text-left mt-5">
		<form method="post" action="index.php?action=connection">
			
			<label for="identifiant">Indiquez votre identifiant de connexion.</label>
			<br />
			<input type="text" name="identifiant">
			<br />	

			<label for="password-check">
			Indiquez votre mot de passe.</label>
			<br />
			<input type="password" name="password-check">
			<br />

			<label for="auto_connection">Connexion automatique</label>
			<input type="checkbox" name="auto_connection">
			<br />

			<input type="submit" value="Se connecter">
		</form>

		<p class="text-center">
			Pas encore de compte ? <a href="index.php?action=registration">Inscrivez-vous !</a>
		</p>
	</div>		