 
<?php

session_start();

require("db/db.php");

include("script/theme.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://kit.fontawesome.com/118716b668.js" crossorigin="anonymous"></script>
	<title>To Do List</title>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans">
  	<link rel="shortcut icon" type="image/png" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link rel="stylesheet" type="text/css" href="css/administration.css">
	<link rel="stylesheet" type="text/css" href="css/parametre.css">
	<link rel="stylesheet" type="text/css" href="css/theme/<?php echo $themeActuelle; ?>" id="theme_css">
</head>

<body class="<?php echo $themeBody; ?>">

<div id="container">

	<?php 

	if (!isset($_SESSION['mdp']))
	{
		include("include/administration.php");
	}

	else
	{
		// VARIABLES DE SESSIONS

		$utilisateurId = $_SESSION['id'];
		$utilisateurAvatar = $_SESSION['avatar'];
		$utilisateurNom = $_SESSION['nom'];
		$utilisateurMdp = $_SESSION['mdp'];
		$utilisateurEmail = $_SESSION['email'];
		$utilisateurSexe = $_SESSION['sexe'];		
		$utilisateurNiveau = $_SESSION['niveau'];
		$utilisateurExperience = $_SESSION['experience'];

		?>

		<main class="main">

			<!-- INDEX SECTION GAUCHE -->
			
			<section id="index-section-gauche">

				<!-- INDEX ARTICLE PROFILE -->
				
				<article id="index-article-profile">

					<div>
						<img class="flex img" src="images/avatar/<?= $utilisateurAvatar; ?>">
					</div>

					<div id="index-div-profile">

						<a class="a" href="index"><?= $utilisateurNom; ?> (<?= $utilisateurSexe; ?>)</a>

						<?php

						// TEXTE

						$lvl = "lvl";

						// UTILISATEUR RANG

						$rang = array("Novice", "Senior", "Master", "Hero", "Legend", "Divinity", "Phoenix", "Eternal");

						// UTILISATEUR EXPERIENCE ET NIVEAU

						if ($utilisateurExperience < 10)
						{
							?>

							<p class="p"><?= $lvl; ?> <?= $utilisateurNiveau; ?> <?= $rang[0]; ?></p>
							<p class="p"><?= $utilisateurExperience; ?> / 10</p>

							<?php
						}

						else if ($utilisateurExperience >= 10 AND $utilisateurExperience < 50)
						{
							$utilisateurNiveau = 2;

					        $nouveauUtilisateurNiveau = $dbh->prepare("UPDATE utilisateur SET niveau = :niveau WHERE id = :id");
					        $nouveauUtilisateurNiveau->bindValue('niveau', $utilisateurNiveau);
					        $nouveauUtilisateurNiveau->bindValue('id', $utilisateurId);
					        $nouveauUtilisateurNiveau->execute();

							?>

							<p class="p"><?= $lvl; ?> <?= $utilisateurNiveau; ?> <?= $rang[1]; ?></p>
							<p class="p"><?php echo $utilisateurExperience; ?> / 50</p>

							<?php
						}

						else if ($utilisateurExperience >= 50 AND $utilisateurExperience < 200)
						{
							$utilisateurNiveau = 3;

		              		$nouveauUtilisateurNiveau = $dbh->prepare("UPDATE utilisateur SET niveau = :niveau WHERE id = :id");
		              		$nouveauUtilisateurNiveau->bindValue('niveau', $utilisateurNiveau);
		              		$nouveauUtilisateurNiveau->bindValue('id', $utilisateurId);
		              		$nouveauUtilisateurNiveau->execute();

							?>

							<p class="p"><?= $lvl; ?> <?= $utilisateurNiveau; ?> <?= $rang[2]; ?></p>
							<p class="p"><?php echo $utilisateurExperience; ?> / 200</p>

							<?php
						}

						else if ($utilisateurExperience >= 200 AND $utilisateurExperience < 1000)
						{
							$utilisateurNiveau = 4;

		              		$nouveauUtilisateurNiveau = $dbh->prepare("UPDATE utilisateur SET niveau = :niveau WHERE id = :id");
		              		$nouveauUtilisateurNiveau->bindValue('niveau', $utilisateurNiveau);
		              		$nouveauUtilisateurNiveau->bindValue('id', $utilisateurId);
		              		$nouveauUtilisateurNiveau->execute();							

							?>

							<p class="p"><?= $lvl; ?> <?= $utilisateurNiveau; ?> <?= $rang[3]; ?></p>
							<p class="p"><?php echo $utilisateurExperience; ?> / 1000</p>

							<?php
						}

						?>

						<a class="a" href="index?parametre=Y">Paramètre</a>
						<a class="a" href="script/deconnexion">Déconnexion</a>
							
					</div>

				</article>		

				<!-- INDEX ARTICLE AJOUTER -->

				<article id="index-article-ajouter">
					
					<form method="POST">

			            <input class="input" type="text" id="titre-ajouter-todolist" placeholder="Titre">        
			            <input class="input" type="text" id="contenu-ajouter-todolist" placeholder="Contenu">
			            <input class="input" type="text" id="experience-ajouter-todolist" placeholder="Expérience">

			            <input class="input-submit" type="submit" id="ajouter-todolist" value="Ajouter">
			    		<p class="none message-erreur erreur"></p>		            

					</form>

				</article>

				<!-- INDEX ARTICLE THEME -->

				<article id="index-article-theme">
					
					<div>
		          		<img id="lien-sombre" src="images/theme/dark.png" alt="lien sombre">
		        	</div>

				</article>

			</section>

			<!-- INDEX SECTION DROITE -->

			<section id="index-section-droite">
				
				<?php

				// INDEX FORM RECHERCHER

				include("include/rechercher.php");

				if (isset($_GET['parametre']) && $_GET['parametre'] == "Y")
				{
					include ('include/parametre.php');
				}

				else
				{
					if (!isset($_GET['modifier']))
					{

						?>

						<div id="index-div-todolist">			

						<?php

						// TABLE TODOLIST DATA

		        		if ($prendreTodolist->rowCount() > 0)
		        		{
		        			$nombreTodolist = 0;

		        			while ($todolistInfo = $prendreTodolist->fetch())
		        			{
		        				$todolistId = htmlspecialchars($todolistInfo['id']);
		        				$todolistTitre = htmlspecialchars($todolistInfo['titre']);
		        				$todolistContenu = htmlspecialchars($todolistInfo['contenu']);
		        				$todolistExperience = htmlspecialchars($todolistInfo['experience']);

		        				if ($nombreTodolist <= 2)
		        				{
									?>

									<div class="index-div-todolist-boucle" id="supprimer-last-type">

									<?php

									$nombreTodolist++;
						      	}

						      	else
						      	{
									?>

									<div class="index-div-todolist-boucle">

									<?php						      		
						      	}

						      	?>

						      	<!-- <div class="div-index-todolist-boucle"> -->

										<p class="title"><?= $todolistTitre; ?></p>
										<p class="p"><?= $todolistContenu; ?> (<?= $todolistExperience ?> xp)</p>

										<div id="index-div-todolist-boucle-option">
											<a class="input-submit" href="index?modifier=Y&id=<?php echo $todolistId; ?>">Modifier</a>	      	
										    <a class="input-submit" onclick="completerTodolist(<?= $todolistId; ?>)">Valider</a>
									    </div>

							      	</div>
							    <?php
		          			}
		    			}

						?>

						</div>

						<?php
					}

					else if (isset($_GET['modifier']) && $_GET['modifier'] == "Y" && isset($_GET['id']))
					{
						$getid = $_GET['id'];

						$prendreTodolist = $dbh->prepare('SELECT * FROM todolist WHERE id = :id');
						$prendreTodolist->bindValue('id', $getid);
						$prendreTodolist->execute();

						if ($prendreTodolist->rowCount() > 0)
						{
							$todolistInfo = $prendreTodolist->fetch();

						    $todolistId = $todolistInfo['id'];
						    $todolistTitre = $todolistInfo['titre'];
						    $todolistContenu = $todolistInfo['contenu'];
						    $todolistExperience = $todolistInfo['experience'];
						}

						?>

						<!-- INDEX FORM TODOLIST MODIFIER -->

						<form class="form" id="index-form-todolist-modifier" method="POST"> 

							<div class="flex-dir-col-center">

								<input class="none" type="hidden" id="id-modifier-todolist" value="<?= $todolistId; ?>">

								<input class="input" type="text" id="titre-modifier-todolist" value="<?= $todolistTitre; ?>">
								<input class="input" type="text" id="contenu-modifier-todolist" value="<?= $todolistContenu; ?>">
								<input class="input" type="text" id="experience-modifier-todolist" value="<?= $todolistExperience; ?>">

								<input class="input-submit" type="submit" name="modifier" id="modifier-todolist" value="Modifier">

							</div>		

						</form>

						<?php
					}					

				}

				?>

				<!-- INDEX NAV MOT -->

				<nav>

					<div class="flex-jus-space-bet">

						<div>

							<ul class="flex ul">
								<li><a class="page-non-actuelle a-menu" href="menu/mot/mot?mot=fr&p=1" target="_blank">Mots FR</a></li>
								<li><a class="page-non-actuelle a-menu" href="menu/mot/mot?mot=en&p=1" target="_blank">Mots EN</a></li>
								<li><a class="page-non-actuelle a-menu" href="menu/mot/mot?mot=ch&p=1" target="_blank">Mots CH</a></li>
								<li><a class="page-non-actuelle a-menu" href="menu/mot/mot?mot=inf&p=1" target="_blank">Mots INF</a></li>
							</ul>

						</div>

						<div>

							<ul class="flex ul">
								<li><a class="page-non-actuelle a-menu" href="menu/mot/mot?mot=completer" target="_blank">Completer</a></li>
							</ul>

						</div>

					</div>

				</nav>

				<?php

				if ($utilisateurId == 1)
				{
					?>

					<!-- INDEX NAV OPTION -->

					<nav>

						<div class="flex-jus-space-bet">
								
							<ul class="flex ul">
								<li><a class="page-non-actuelle a-menu" href="menu/option/cv" target="_blank">CV</a></li>
								<li><a class="page-non-actuelle a-menu" href="menu/option/portfolio" target="_blank">Portfolio</a></li>
							</ul>

						</div>				
						
					</nav>

					<?php
				}

				?>

			</section>

		</main>

	<?php

	}

	?>

</div>

</body>
<script src="javascript/minjquery-3.6.0.js"></script>
<script src="javascript/script.js"></script>
</html>