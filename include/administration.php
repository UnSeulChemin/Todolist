
<?php 

if (!isset($_GET['connexion']) || isset($_GET['inscription']) && $_GET['inscription'] == "Y")
{
	?>

	<!-- INSCRIPTION SECTION -->

	<section id="inscription-section">

		<!-- INSCRIPTION SECTION GAUCHE -->

		<section id="inscription-section-gauche">

			<div id="inscription-div-gauche">
				
				<h2 class="h">Inscription</h2>

				<p class="p">Vous trouverez ci-dessous les différents prérequis pour l'inscription.</p>

				<div>

					<h3 class="h">Prérequis pour le nom.</h3>

					<p class="p">- Le champ ne doit pas être vide.</p>
					<p class="p">- Le nom saisi ne doit pas déjà exister.</p>
				</div>

				<div>

					<h3 class="h">Prérequis pour le mot de passe.</h3>

					<p class="p">- Le champ ne doit pas être vide.</p>

				</div>

				<div>

					<h3 class="h">Vérification du mot de passe.</h3>

					<p class="p">- Confirmer une nouvelle fois le mot de passe.</p>

				</div>

				<div>

					<h3 class="h">Choisisez votre genre.</h3>

					<p class="p">- Veuillez choisir votre genre correspondant.</p>

				</div>

				<h3 class="h">=> Inscription.</h3>

			</div>
			
		</section>

		<!-- INSCRIPTION SECTION DROITE -->

		<section id="inscription-section-droite">

			<div id="inscription-div-droite">

				<form method="POST">

					<h2 class="h">Inscription</h2>

					<input class="input" type="text" name="nom" placeholder="Nom" value="<?php echo (isset($_POST['nom'])) ? $_POST['nom'] : false; ?>">
					<input class="input" type="email" name="email" placeholder="Email" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : false; ?>">

					<div class="position-rel">		
						<input class="input" id="pass_y" type="password" name="mdp" placeholder="Mot de passe">
						<img src="images/outils/hide.png" id="eye_y" class="eye" onClick="changeY()">
					</div>

					<div class="position-rel">
						<input class="input" id="pass_x" type="password" name="mdp-verification" placeholder="Vérification du mot de passe">
						<img src="images/outils/hide.png" id="eye_x" class="eye" onClick="changeX()">
					</div>

					<div id="radio-div">

						<!-- JQUERY ID -->

						<div id="radio-un">
							<input class="none" type="radio" name="sexe" id="sexe-homme" value="男">
							<label class="label" for="sexe-homme">男</label>	
						</div>

						<!-- JQUERY ID -->

						<div id="radio-deux">
							<input class="none" type="radio" name="sexe" id="sexe-femme" value="女">
							<label class="label" for="sexe-femme">女</label>
						</div>

					</div>

					<input class="input-submit" type="submit" name="inscription" value="Inscription">

					<?php

					if (isset($_SESSION['inscription']) && !empty($_SESSION['inscription']))
					{
						$messageValid =  $_SESSION['inscription'];
					}

					// INSCRIPTION
						
					if (isset($_POST['inscription']))	
					{
						$avatar = "default.jpg";
						$postNom = trim($_POST['nom']);
						$postMdp = trim($_POST['mdp']);
						$postEmail = trim($_POST['email']);
						$postMdpVerification = trim($_POST['mdp-verification']);
						$niveau = 1;
						$experience = 1;

						if (isset($postNom) && !empty($postNom) && isset($postMdp) && !empty($postMdp) && isset($postMdpVerification) && !empty($postMdpVerification) && isset($postEmail) && !empty($postEmail) && isset($_POST['sexe']) && !empty($_POST['sexe']))
						{
							$prendreNom = $dbh->prepare('SELECT * FROM utilisateur WHERE nom = :postnom');
							$prendreNom->bindValue('postnom', $postNom);
							$prendreNom->execute();

							if ($prendreNom->rowCount() == 0)
							{
								if ($postMdp === $postMdpVerification)
								{
									$postSexe = $_POST['sexe'];
									$mdpHash = password_hash($postMdp, PASSWORD_DEFAULT);

							    	$insererUtilisateur = $dbh->prepare('INSERT INTO utilisateur (avatar, nom, mdp, email, sexe, niveau, experience)
							    										VALUES (:avatar, :nom, :mdp, :email, :sexe, :niveau, :experience)');
									$insererUtilisateur->bindValue('avatar', $avatar);
									$insererUtilisateur->bindValue('nom', $postNom);
									$insererUtilisateur->bindValue('mdp', $mdpHash);
									$insererUtilisateur->bindValue('email', $postEmail);
									$insererUtilisateur->bindValue('sexe', $postSexe);									
									$insererUtilisateur->bindValue('niveau', $niveau);
									$insererUtilisateur->bindValue('experience', $experience);
									$insererUtilisateur->execute();

									if ($insererUtilisateur)
									{
							 			header('Location: index');

							 			$_SESSION['inscription'] = "Votre compte a été créer.";
									}
								}

								else
								{
									$messageError =  "Le MDP ne correspond pas.";
								}						
							}

							else
							{
								$messageError = "Nom deja existant.";						
							}
						}

						else
						{
					    	$messageError = "Veuillez remplir les champs.";
						}
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

					?>

					<div id="inscription-div-existant">
						<h2 class="h">Déjà un compte?</h2>
						<a class="input-submit" href="index?connexion=Y" name="connexion" id="connexion">Connexion</a>
					</div>

				</form>
				
			</div>		
			
		</section>

	</section>

	<?php
}

if (isset($_GET['connexion']) && $_GET['connexion'] == "Y")
{
	unset($_SESSION['inscription']);

	?>

	<!-- CONNEXION SECTION -->

	<section id="connexion-section">

		<!-- CONNEXION SECTION GAUCHE -->

		<section id="connexion-section-gauche">

			<div id="connexion-div-gauche">
				
				<h2 class="h">Connexion</h2>

				<p class="p">Vous trouverez ci-dessous les différents prérequis pour la connexion.</p>

				<div>

					<h3 class="h">Créer un compte avec l'inscription.</h3>

					<p class="p">- Aller sur la page d'inscription et créer un compte.</p>

				</div>

				<div>

					<h3 class="h">Vérification du nom.</h3>

					<p class="p">- Veuillez entrer le nom de votre compte.</p>

				</div>

				<div>

					<h3 class="h">Vérification du mot de passe.</h3>

					<p class="p">- Veuillez entrer le mot de passe de votre compte.</p>

				</div>

				<h3 class="h">=> Connexion.</h3>

			</div>
			
		</section>

		<!-- CONNEXION SECTION DROITE -->

		<section id="connexion-section-droite">

			<div id="connexion-div-droite">

				<form method="POST">

					<h1 class="h">Connexion</h1>

					<input class="input" type="text" name="nom" placeholder="Nom" value="<?php echo (isset($_POST['nom'])) ? $_POST['nom'] : false; ?>">

					<div class="position-rel">
						<input class="input" id="pass_z" type="password" name="mdp" placeholder="Mot de passe">
						<img src="images/outils/hide.png" id="eye_z" class="eye" onClick="changeZ()">
					</div>					

					<input class="input-submit" type="submit" name="connexion" id="connexion" value="Connexion">

					<?php

					// CONNEXION
						
					if (isset($_POST['connexion']))	
					{
						$avatar = "default.jpg";
					    $postNom = trim($_POST['nom']);
					    $postMdp = trim($_POST['mdp']);

					    if (isset($postNom) && !empty($postNom) && isset($postMdp) && !empty($postMdp))
					    {
					        $prendreUtilisateur = $dbh->prepare('SELECT * FROM utilisateur WHERE nom = :postnom'); 
					        $prendreUtilisateur->bindValue('postnom', $postNom);
					        $prendreUtilisateur->execute();

							if ($prendreUtilisateur->rowCount() > 0)
							{
								$utilisateurInfo = $prendreUtilisateur->fetch();

								$utilisateurMdp = $utilisateurInfo['mdp'];

								if (password_verify($postMdp, $utilisateurMdp))
								{
									$_SESSION['id'] = $utilisateurInfo['id'];
									$_SESSION['avatar'] = $utilisateurInfo['avatar'];
									$_SESSION['nom'] = $utilisateurInfo['nom'];
									$_SESSION['mdp'] = $utilisateurInfo['mdp'];
									$_SESSION['email'] = $utilisateurInfo['email'];
									$_SESSION['sexe'] = $utilisateurInfo['sexe'];									
									$_SESSION['niveau'] = $utilisateurInfo['niveau'];
									$_SESSION['experience'] = $utilisateurInfo['experience'];

							 		header('Location: index');
								}

								else
								{
									$messageError = "Information incorrect.";
								}
							}

							else
							{
								$messageError = "Information incorrect.";
							}
						}

						else
						{
							$messageError = "Veuillez remplir les champs.";
						}
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

					?>

					<div id="connexion-div-non-existant">
						<h2 class="h">Pas de compte?</h2>
						<a class="input-submit" href="index?inscription=Y" name="inscription" id="inscription">Inscription</a>
					</div>

				</form>
				
			</div>

		</section>	
		
	</section>

	<?php 
}

?>

<footer>

	<!-- ADMINISTRATION FOOTER -->

	<section>
		
		<h2 class="h">Comment utiliser Todolist Maker.</h2>

		<p class="p">Création de votre compte et connexion.</p>
		<p class="p">Ajouter vos premières taches à réaliser à votre todolist.</p>
		<p class="p">Une fois votre tâche terminé, compléter là et gagner l'xp correspondant.</p>
		<p class="p">Aller sur une liste de mots et ajouter les mots désirés.
		<p class="p">Vous avez le choix entre une liste de mots français, anglais, chinois, informatique.</p>

	</section>

</footer>

<div class="none">
	<img id="lien-sombre" src="" alt="none">
</div>
