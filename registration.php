<?php
  session_start();
	$title = "S'enregister";
	$backLinkCheck = true;
	$dropDownCheck = false;
	$backLink = "index.php?action=connection";
	require ('header.php');
?>

  <div class="container col-10 mx-auto" style="text-align:left; font-size:0.9em;">

    <form method="post" action="index.php?action=registration">
      <p>
        <div class="col-12">
          <input type="text" name="pseudo"/>
          <label for="pseudo">Veuillez indiquer votre pseudonyme comprenant entre 3 à 10 caractères.</label>
        </div>

        <div class="col-12">
          <input type="password" name="password">
          <label for="password">Veuillez indiquer un mot de passe comprenant au moins l'un des caractrès spéciaux suivant (@ . _ -) et d'au moins 5 caractères.</label>
        </div>  

        <div class="col-12">
          <input type="password" name="password_verification">
          <label for="password_verification">Veuillez confirmer votre mot de passe.</label>
        </div>

        <div class="col-12">
          <input type="text" name="email">
          <label for="email">Veuillez indiquer un email valide.</label>
        </div>

        <input type="submit" value="Valider"/>
      </p>
    </form>

  </div>	