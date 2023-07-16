
<!-- PARAMETRE FORM UPLOAD -->

<form class="form-img" method="POST" enctype="multipart/form-data">

	<div>
		<img class="flex" src="images/avatar/<?php echo $utilisateurAvatar;?>">
	</div>

	<div id="parametre-div-upload">

		<input class="none" id="avatar-file" type="file" name="avatar">
		<label for="avatar-file" class="btn">Upload</label>

		<input type="submit" name="valider-avatar" value="Valider">
	</div>

</form>					

<?php

// AVATAR

if (isset($_POST['valider-avatar']))
{
	if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
	{
		$tailleMax = 1000000;

        if ($_FILES['avatar']['size'] < $tailleMax)
        {
            $extensionsUpload = explode('/', $_FILES['avatar']['type']);

            if($extensionsUpload[0] == 'image')
            {
                $type = explode('/', $_FILES['avatar']['type']);

                if ($type[1] == 'png' || 'jpg' || 'jpeg')
                {
				    $chemin = "images/avatar/" . $utilisateurId . "." . $type[1];
				    $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);

				    $avatar = $utilisateurId . "." . $type[1];

				    if ($resultat)
				    {
				        $_SESSION['avatar'] = $avatar;

				        $updateAvatar = $dbh->prepare("UPDATE utilisateur SET avatar = :avatar WHERE id = :id");
				        $updateAvatar->bindValue('avatar', $avatar);
				        $updateAvatar->bindValue('id', $utilisateurId);
				        $updateAvatar->execute();
				    }    						
            	}
            }
        }
	}
}

?>


<!-- PARAMETRE FORM NOM -->

<form class="form" method="POST">

	<div class="flex">

		<input class="input-parametre" type="text" name="name" placeholder="Nouveau Nom">
		<input class="input-submit-parametre" type="submit" name="valider-nom" value="Valider">

	</div>

	<?php

	// NOM

	if (isset($_POST['valider-nom']))
	{
		$postNom = trim($_POST['name']);

		if (isset($postNom) && !empty($postNom))
		{
	        $prendreNom = $dbh->prepare('SELECT * FROM utilisateur WHERE nom = :postnom');
	        $prendreNom->bindValue('postnom', $postNom);
	        $prendreNom->execute();

	        if ($prendreNom->rowCount() == 0)
	        {
		 		$nouveauUtilisateurNom = $dbh->prepare('UPDATE utilisateur SET nom = :postnom WHERE id = :id');
				$nouveauUtilisateurNom->bindValue('postnom', $postNom);
				$nouveauUtilisateurNom->bindValue('id', $utilisateurId);
				$nouveauUtilisateurNom->execute();

				if ($nouveauUtilisateurNom)
				{
				    $_SESSION['nom'] = $postNom;

				    $messageValid = "Modification prise en compte.";

				    header('Location: index?parametre=Y');
				    exit;		    
			    }                 				
			}

			else
			{
				$messageError = "Nom deja existant.";
			}			
		}

		else
		{
			$messageError = "Veuillez entrer un nouveau nom.";
		}

		// AFFICHAGE DES MESSAGES

		if (!empty($messageError))
		{
			echo "<p class='message-erreur'>" . $messageError . "</p>";
		}

		else if (!empty($messageValid))
		{
			echo "<p class='message-valid'>" . $messageValid . "</p>";
		}
	}

	?>

</form>


<!-- PARAMETRE FORM MOT DE PASSE -->

<form class="form" method="POST">

	<div class="flex">

		<input class="input-parametre" type="text" name="mdp" placeholder="Nouveau MDP">
		<input class="input-submit-parametre" type="submit" name="valider-mdp" value="Valider">

	</div>

	<?php

	// MOT DE PASSE

	if (isset($_POST['valider-mdp']))
	{
		$postMdp = trim($_POST['mdp']);

		if (isset($postMdp) && !empty($postMdp))
		{
			$motDePasseHash = password_hash($postMdp, PASSWORD_DEFAULT);

			$nouveauUtilisateurMdp = $dbh->prepare('UPDATE utilisateur SET mdp = :mdphash WHERE id = :id');
			$nouveauUtilisateurMdp->bindValue('mdphash', $motDePasseHash);
			$nouveauUtilisateurMdp->bindValue('id', $utilisateurId);
			$nouveauUtilisateurMdp->execute();

			if ($nouveauUtilisateurMdp)
			{
			    $_SESSION['mdp'] = $postMdp;

			    $messageValid = "Modification prise en compte.";
		    }     	
		}

		else
		{
			$messageError = "Veuillez entrer un nouveau mot de passe.";
		}

		// AFFICHAGE DES MESSAGES

		if (!empty($messageError))
		{
			echo "<p class='message-erreur'>" . $messageError . "</p>";
		}

		else if (!empty($messageValid))
		{
			echo "<p class='message-valid'>" . $messageValid . "</p>";
		}
	}

	?>

</form>


<!-- PARAMETRE FORM EMAIL -->

<form class="form" method="POST">

	<div class="flex">

		<input class="input-parametre" type="text" name="email" placeholder="Nouvelle Email">
		<input class="input-submit-parametre" type="submit" name="valider-email" value="Valider">

	</div>

	<?php

	// EMAIL

	if (isset($_POST['valider-email']))
	{
		$postEmail = trim($_POST['email']);

		if (isset($postEmail) && !empty($postEmail))
		{
	        $prendreEmail = $dbh->prepare('SELECT * FROM utilisateur WHERE email = :email');
	        $prendreEmail->bindValue('email', $postEmail);
	        $prendreEmail->execute();

	        if ($prendreEmail->rowCount() == 0)
	        {
		 		$nouveauUtilisateurEmail = $dbh->prepare('UPDATE utilisateur SET email = :email WHERE id = :id');
				$nouveauUtilisateurEmail->bindValue('email', $postEmail);
				$nouveauUtilisateurEmail->bindValue('id', $utilisateurId);
				$nouveauUtilisateurEmail->execute();

				if ($nouveauUtilisateurEmail)
				{
				    $_SESSION['email'] = $postEmail;

				    $messageValid = "Modification prise en compte.";
			    }                 				
			}

			else
			{
				$messageError = "Adresse email déjà existant.";
			}			
		}

		else
		{
			$messageError = "Veuillez entrer une adresse e-mail.";
		}

		// AFFICHAGE DES MESSAGES

		if (!empty($messageError))
		{
			echo "<p class='message-erreur'>" . $messageError . "</p>";
		}

		else if (!empty($messageValid))
		{
			echo "<p class='message-valid'>" . $messageValid . "</p>";
		}	
	}

	?>

</form>


<!-- PARAMETRE FORM SEXE -->

<form class="form" method="POST">

	<div class="flex-ali-center" id="parametre-form-sexe">

		<!-- JQUERY ID -->

		<div id="radio-un">
			<input class="none" type="radio" name="sexe" id="sexe-homme" value="男">
			<label class="pointer" for="sexe-homme">男</label>			
		</div>

		<!-- JQUERY ID -->

		<div id="radio-deux">
			<input class="none" type="radio" name="sexe" id="sexe-femme" value="女">
			<label class="pointer" for="sexe-femme">女</label>
		</div>

		<input class="input-submit-parametre" type="submit" name="valider-radio" value="Valider">		

	</div>

	<?php

	// TYPE

	if (isset($_POST['valider-radio']))
	{
		if (isset($_POST['sexe']) && !empty($_POST['sexe']))
		{
			$postSexe = $_POST['sexe'];

			$nouveauUtilisateurSexe = $dbh->prepare('UPDATE utilisateur SET sexe = :sexe WHERE id = :id');
			$nouveauUtilisateurSexe->bindValue('sexe', $postSexe);
			$nouveauUtilisateurSexe->bindValue('id', $utilisateurId);
			$nouveauUtilisateurSexe->execute();

			if ($nouveauUtilisateurSexe)
			{
			    $_SESSION['sexe'] = $postSexe;
		    }     	
		}

		else
		{
			$messageError = "Veuillez sélectionné un type.";
		}

		// AFFICHAGE DES MESSAGES

		if (!empty($messageError))
		{
			echo "<p class='message-erreur'>" . $messageError . "</p>";
		}

		else if (!empty($messageValid))
		{
			echo "<p class='message-valid'>" . $messageValid . "</p>";
		}
	}

	?>

</form>


<!--  PARAMETRE FORM SUPPRIMER -->

<div class="form">

	<a class="a-supprimer pointer" onclick="supprimerCompte(<?php echo $utilisateurId ?>)">Supprimer compte</a>

</div>
